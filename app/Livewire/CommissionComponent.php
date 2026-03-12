<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Commission;
use Illuminate\Support\Facades\Storage;

class CommissionComponent extends Component
{
    use WithFileUploads;

    public $commissions;
    public $commission_id, $objective, $start_date, $end_date, $destination, $description;
    public $is_exterior = 0, $training_expenses = 0, $training_value = 0;
    public $industry, $expense_type, $expense_value = 0;
    public $exterior_zone;
    public $dollar_value = 0;
    
    // NUEVOS CAMPOS AGREGADOS
    public $identification;
    public $training_details;
    
    // Archivos
    public $invitation_file; 
    public $invitation_path;
    public $evidence_file;
    public $evidence_path;

    public function render()
    {
        $this->commissions = Commission::latest()->get();
        return view('livewire.commission-component');
    }

    public function save()
    {
        $this->validate([
            'objective'      => 'required',
            'identification' => 'required', // Validación de cédula
            'destination'    => 'required',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date',
        ]);

        $data = [
            'objetive'             => $this->objective,
            'identification'       => $this->identification, // Guardar cédula
            'start_date'           => $this->start_date,
            'end_date'             => $this->end_date,
            'destination'          => $this->destination,
            'description'          => $this->description,
            'abroad'               => $this->is_exterior ?? 0,
            'industry'             => $this->industry,
            'expense_type'         => $this->expense_type,
            'training_expenses'    => $this->training_expenses, // Es el booleano 0 o 1
            'training_details'     => $this->training_details,  // Guardar detalles
            'training_value'       => (double) str_replace(['.', ','], ['', '.'], $this->training_value ?? 0),
            'expense_value'        => (double) str_replace(['.', ','], ['', '.'], $this->expense_value ?? 0),
            'user_id'              => auth()->id() ?? 1,
            'commission_status_id' => 1,
            'dependency_id'        => 1,
            'budget_id'            => 1,
        ];

        // Solo sube si hay un archivo real en el input temporal
        if ($this->invitation_file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $data['invitation_path'] = $this->invitation_file->store('commissions/invitations', 'public');
        }

        \App\Models\Commission::updateOrCreate(
            ['id' => $this->commission_id], 
            $data
        );

        session()->flash('message', '¡Operación exitosa!');
        $this->resetFields();
        $this->dispatch('modal-close', name: 'new-commission');
    }

    public function uploadEvidence($id)
    {
        $this->validate([
            'evidence_file' => 'required|file|max:10240',
        ]);

        $commission = \App\Models\Commission::findOrFail($id);
        
        // Guardamos y actualizamos directamente el modelo
        if ($this->evidence_file) {
            $path = $this->evidence_file->store('commissions/evidences', 'public');
            $commission->update(['evidence_path' => $path]);
        }

        session()->flash('message', 'Evidencia cargada.');
        $this->resetFields(); // Limpiamos todo para evitar que el archivo se quede "pegado"
        $this->dispatch('modal-close', name: 'upload-evidence-'.$id);
    }

    public function edit($id)
    {
        $this->resetValidation(); // Limpia errores previos
        $commission = \App\Models\Commission::findOrFail($id);
        
        $this->commission_id = $id;
        $this->objective = $commission->objetive;
        $this->identification = $commission->identification; // Cargar cédula al editar
        $this->destination = $commission->destination;
        $this->start_date = $commission->start_date->format('Y-m-d');
        $this->end_date = $commission->end_date->format('Y-m-d');
        $this->description = $commission->description;
        $this->is_exterior = $commission->abroad;
        $this->industry = $commission->industry;
        $this->expense_type = $commission->expense_type;
        
        // Cargar datos de capacitación
        $this->training_expenses = $commission->training_expenses;
        $this->training_details = $commission->training_details;
        $this->training_value = number_format($commission->training_value, 0, ',', '.');
        
        $this->expense_value = number_format($commission->expense_value, 0, ',', '.');
        
        // Cargamos la ruta actual y limpiamos el input de archivo nuevo
        $this->invitation_path = $commission->invitation_path; 
        $this->invitation_file = null; 

        $this->dispatch('modal-show', name: 'new-commission');
    }

    public function delete($id)
    {
        Commission::find($id)->delete();
        session()->flash('message', 'Eliminado correctamente.');
    }
    
    public function resetFields()
    {
        $this->commission_id = null;
        $this->objective = '';
        $this->identification = ''; // Limpiar cédula
        $this->destination = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->description = '';
        $this->industry = '';
        $this->expense_type = '';
        $this->is_exterior = 0;
        $this->exterior_zone = ''; 
        $this->dollar_value = 0;   
        
        // Limpieza capacitación
        $this->training_expenses = 0;
        $this->training_details = '';
        $this->training_value = 0;
        
        $this->expense_value = 0;
        
        // Limpieza de archivos
        $this->invitation_file = null;
        $this->invitation_path = null;
        $this->evidence_file = null;
        $this->evidence_path = null;
    }
}