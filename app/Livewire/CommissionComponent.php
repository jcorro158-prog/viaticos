<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Commission;
use App\Models\Resolution;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CommissionComponent extends Component
{
    use WithFileUploads;

    // Identificador de edición
    public $commission_id = null;

    // Campos del formulario (mapeados al modelo Commission)
    public $objective = '';
    public $identification = '';
    public $start_date = null;
    public $end_date = null;

    // Exterior (abroad)
    public $is_exterior = '0'; // '0' => No, '1' => Si
    public $exterior_zone = '';
    public $dollar_value = null;

    // Destino / Descripción
    public $destination = '';
    public $description = '';

    // Campos relacionados con 'Gastos de capacitación'
    public $training_gastos_toggle = '0'; // control en la vista (0/1)
    public $training_details = '';
    public $training_value = null; // se mapea a training_expenses

    // Gastos / Tipo
    public $expense_type = '';
    public $expense_value = null;

    // Relaciones / referencias opcionales
    public $user_id = null;
    public $commission_status_id = null;
    public $dependency_id = null;
    public $budget_id = null;

    // Archivos temporales (Livewire WithFileUploads)
    public $invitation_file;
    public $evidence_file;

    // Filtros / Otros
    public $industry;

    protected function rules()
    {
        return [
            'objective' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'identification' => 'nullable|numeric',
            'is_exterior' => 'nullable',
            'exterior_zone' => 'nullable|string',
            'dollar_value' => 'nullable|numeric',
            'destination' => 'nullable|string',
            'description' => 'nullable|string',
            'training_gastos_toggle' => 'nullable',
            'training_details' => 'required_if:training_gastos_toggle,1|string',
            'training_value' => 'nullable|numeric',
            'expense_type' => 'nullable|string',
            'expense_value' => 'nullable|numeric',
            'invitation_file' => 'nullable|file|max:10240', // 10MB
            'evidence_file' => 'nullable|file|max:10240',
            'user_id' => 'nullable|integer',
            'commission_status_id' => 'nullable|integer',
            'dependency_id' => 'nullable|integer',
            'budget_id' => 'nullable|integer',
        ];
    }

    public function resetFields()
    {
        $this->commission_id = null;
        $this->objective = '';
        $this->identification = '';
        $this->start_date = null;
        $this->end_date = null;
        $this->is_exterior = '0';
        $this->exterior_zone = '';
        $this->dollar_value = null;
        $this->destination = '';
        $this->description = '';
        $this->training_gastos_toggle = '0';
        $this->training_details = '';
        $this->training_value = null;
        $this->expense_type = '';
        $this->expense_value = null;
        $this->user_id = null;
        $this->commission_status_id = null;
        $this->dependency_id = null;
        $this->budget_id = null;
        $this->invitation_file = null;
        $this->evidence_file = null;
        $this->industry = null;
    }

    /**
     * Guardar (crear o actualizar) comisión en la BD y archivos a storage.
     */
    public function save()
    {
        try {
            $validated = $this->validate();
        } catch (ValidationException $ve) {
            foreach ($ve->errors() as $field => $messages) {
                $this->addError($field, implode(' ', $messages));
            }
            session()->flash('message', 'Errores de validación en el formulario.');
            Log::warning('Validation failed in CommissionComponent@save', ['errors' => $ve->errors()]);
            return;
        }

        DB::beginTransaction();

        try {
            $dependencyId = $this->dependency_id;
            if (empty($dependencyId)) {
                $dependencyId = auth()->check() && isset(auth()->user()->dependency_id)
                    ? auth()->user()->dependency_id
                    : 1;
            }

            $data = [
                'objetive' => $this->objective,
                'identification' => $this->identification ?: null,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'destination' => $this->destination ?: null,
                'description' => $this->description ?: null,
                'abroad' => $this->is_exterior === '1' ? true : false,
                'training_expenses' => ($this->training_gastos_toggle === '1') ? (float) str_replace(['.', ','], ['', '.'], $this->training_value ?: '0') : 0,
                'user_id' => $this->user_id ?: auth()->id(),
                'commission_status_id' => $this->commission_status_id ?: null,
                'dependency_id' => $dependencyId,
                'budget_id' => $this->budget_id ?: null,
            ];

            if ($this->commission_id) {
                $commission = Commission::find($this->commission_id);
                if (!$commission) {
                    throw new \Exception('Comisión no encontrada para actualizar.');
                }
                $commission->update($data);
            } else {
                $commission = Commission::create($data);

                // Generar número de resolución automático desde 1000
                $lastResolution = Resolution::orderByDesc('id')->first();
                $nextNumber = $lastResolution ? (int) $lastResolution->number + 1 : 1000;

                Resolution::create([
                    'number' => str_pad($nextNumber, 4, '0', STR_PAD_LEFT),
                    'date' => now(),
                    'file' => null,
                    'user_id' => auth()->id(),
                    'commission_id' => $commission->id,
                ]);
            }

            // invitation_file
            if ($this->invitation_file) {
            $extension = $this->invitation_file->getClientOriginalExtension();
            $filename = 'invitation-' . time() . '.' . $extension;
            $path = $this->invitation_file->storeAs("commissions/{$commission->id}", $filename, 'public');
            $commission->invitation_path = $path;
            $commission->save();
            }

            // evidence_file
            if ($this->evidence_file) {
                $filename = 'evidence-' . time() . '.' . $this->evidence_file->getClientOriginalExtension();
                $storePath = $this->evidence_file->storeAs("public/commissions/{$commission->id}", $filename);
                $commission->evidence_path = Str::replaceFirst('public/', '', $storePath);
                $commission->save();
            }

            DB::commit();

            session()->flash('message', $this->commission_id ? 'Comisión actualizada.' : 'Comisionado creado.');

            $this->resetFields();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error guardando comisión: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            session()->flash('message', 'Error al crear/actualizar la comisión. Revisa el log.');
        }

        $this->dispatch('close-modal', name: 'new-commission');
    }

    /**
     * Cargar datos para edición.
     */
    public function edit($id)
    {
        try {
            $commission = Commission::findOrFail($id);

            $this->commission_id = $commission->id;
            $this->objective = $commission->objetive ?? '';
            $this->identification = $commission->identification ?? '';
            $this->start_date = optional($commission->start_date)->format('Y-m-d') ?? null;
            $this->end_date = optional($commission->end_date)->format('Y-m-d') ?? null;
            $this->is_exterior = $commission->abroad ? '1' : '0';
            $this->exterior_zone = $commission->exterior_zone ?? '';
            $this->dollar_value = $commission->dollar_value ?? null;
            $this->destination = $commission->destination ?? '';
            $this->description = $commission->description ?? '';
            $this->training_gastos_toggle = ($commission->training_expenses && $commission->training_expenses > 0) ? '1' : '0';
            $this->training_details = $commission->training_details ?? '';
            $this->training_value = $commission->training_expenses ?? null;
            $this->expense_type = $commission->expense_type ?? '';
            $this->expense_value = $commission->expense_value ?? null;
            $this->user_id = $commission->user_id ?? null;
            $this->commission_status_id = $commission->commission_status_id ?? null;
            $this->dependency_id = $commission->dependency_id ?? null;
            $this->budget_id = $commission->budget_id ?? null;

        } catch (\Throwable $e) {
            Log::error("Error al cargar comisión {$id} para edición: " . $e->getMessage());
            session()->flash('message', 'No se pudo cargar la comisión para editar.');
        }
    }

    public function delete($id)
    {
        try {
            $commission = Commission::findOrFail($id);

            if (!empty($commission->invitation_path)) {
                $p = 'public/' . ltrim($commission->invitation_path, '/');
                if (Storage::exists($p)) {
                    Storage::delete($p);
                } elseif (Storage::exists($commission->invitation_path)) {
                    Storage::delete($commission->invitation_path);
                }
            }
            if (!empty($commission->evidence_path)) {
                $p = 'public/' . ltrim($commission->evidence_path, '/');
                if (Storage::exists($p)) {
                    Storage::delete($p);
                } elseif (Storage::exists($commission->evidence_path)) {
                    Storage::delete($commission->evidence_path);
                }
            }

            $commission->delete();

            session()->flash('message', 'Comisionado eliminado.');
        } catch (\Throwable $e) {
            Log::error("Error al eliminar comisión {$id}: " . $e->getMessage());
            session()->flash('message', 'Error al eliminar la comisión.');
        }
    }

    public function uploadEvidence($id)
    {
    $this->validate([
        'evidence_file' => 'required|file|max:10240',
    ]);

    try {
        $commission = Commission::findOrFail($id);

        $extension = $this->evidence_file->getClientOriginalExtension();
        $filename = 'evidence-' . time() . '.' . $extension;
        
        $path = $this->evidence_file->storeAs("commissions/{$id}", $filename, 'public');
        
        $commission->evidence_path = $path;
        $commission->save();

        session()->flash('message', 'Evidencia subida correctamente.');
        $this->evidence_file = null;
        $this->dispatch('close-modal', name: 'upload-evidence-' . $id);
    } catch (\Throwable $e) {
        Log::error("Error subiendo evidencia para comisión {$id}: " . $e->getMessage());
        session()->flash('message', 'Error al subir la evidencia.');
    }
}

    public function render()
    {
        $commissions = collect();

        try {
            $commissions = Commission::with(['user', 'resolutions', 'commissionStatus'])
                ->orderBy('start_date', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::warning('No se pudo obtener commissions en CommissionComponent: ' . $e->getMessage());
        }

        return view('livewire.commission-component', [
            'commissions' => $commissions,
        ]);
    }
}