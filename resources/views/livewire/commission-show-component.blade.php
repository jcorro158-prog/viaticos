<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Detalle completo del comisionado</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Revisa toda la información registrada en el formulario.</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center justify-center rounded-xl border border-zinc-300 px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:border-orange-400 hover:bg-orange-50 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-orange-500 dark:hover:bg-zinc-800">
                ← Volver al dashboard
            </a>
            <a href="{{ route('commissions') }}"
               class="inline-flex items-center justify-center rounded-xl border border-zinc-300 px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:border-orange-400 hover:bg-orange-50 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-orange-500 dark:hover:bg-zinc-800">
                Ir a comisiones
            </a>
        </div>
    </div>

    <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <div class="grid gap-4 md:grid-cols-2">
            <div><span class="font-semibold">ID comisión:</span> {{ $commission->id }}</div>
            <div><span class="font-semibold">Estado:</span> {{ $commission->commissionStatus?->name ?? 'Registrada' }}</div>
            <div><span class="font-semibold">Funcionario:</span> {{ $commission->user?->name ?? 'Sin usuario' }}</div>
            <div><span class="font-semibold">Identificación:</span> {{ $commission->identification ?: 'Sin asignar' }}</div>
            <div><span class="font-semibold">Fecha inicio:</span> {{ optional($commission->start_date)->format('d/m/Y') ?: '—' }}</div>
            <div><span class="font-semibold">Fecha fin:</span> {{ optional($commission->end_date)->format('d/m/Y') ?: '—' }}</div>
            <div class="md:col-span-2"><span class="font-semibold">Objetivo:</span> {{ $commission->objetive ?: 'Sin información' }}</div>
            <div class="md:col-span-2"><span class="font-semibold">Destino:</span> {{ $commission->destination ?: 'Sin información' }}</div>
            <div class="md:col-span-2"><span class="font-semibold">Descripción:</span> {{ $commission->description ?: 'Sin información' }}</div>
            <div><span class="font-semibold">¿Exterior?:</span> {{ $commission->abroad ? 'Sí' : 'No' }}</div>
            <div><span class="font-semibold">Zona exterior:</span> {{ $commission->exterior_zone ?: 'No aplica' }}</div>
            <div><span class="font-semibold">Valor dólar (TRM):</span> {{ $commission->dollar_value ?: 'No aplica' }}</div>
            <div><span class="font-semibold">Gastos capacitación:</span> {{ $commission->training_expenses ? '$' . number_format($commission->training_expenses, 0, ',', '.') : 'No aplica' }}</div>
            <div><span class="font-semibold">Tipo gasto:</span> {{ $commission->expense_type ?: 'Sin asignar' }}</div>
            <div><span class="font-semibold">Valor gasto:</span> {{ $commission->expense_value ? '$' . number_format($commission->expense_value, 0, ',', '.') : 'Sin asignar' }}</div>
            <div><span class="font-semibold">Placa vehículo:</span> {{ $commission->vehicle_plate ?: 'No aplica' }}</div>
            <div><span class="font-semibold">Conductor:</span> {{ $commission->driver_name ?: 'No aplica' }}</div>
            <div><span class="font-semibold">Usuario creador (ID):</span> {{ $commission->user_id ?: 'Sin asignar' }}</div>
            <div><span class="font-semibold">Dependencia (ID):</span> {{ $commission->dependency_id ?: 'Sin asignar' }}</div>
            <div><span class="font-semibold">Presupuesto (ID):</span> {{ $commission->budget_id ?: 'Sin asignar' }}</div>
            <div><span class="font-semibold">Estado (ID):</span> {{ $commission->commission_status_id ?: 'Sin asignar' }}</div>
            <div><span class="font-semibold">Creado:</span> {{ optional($commission->created_at)->format('d/m/Y H:i') ?: '—' }}</div>
            <div><span class="font-semibold">Actualizado:</span> {{ optional($commission->updated_at)->format('d/m/Y H:i') ?: '—' }}</div>
        </div>
    </div>

    <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Archivos y resolución</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div>
                <span class="font-semibold">Invitación:</span>
                @if(!empty($commission->invitation_path))
                    <a class="text-blue-600 underline" href="{{ asset('storage/' . $commission->invitation_path) }}" target="_blank">Ver archivo</a>
                @else
                    <span>Sin archivo</span>
                @endif
            </div>
            <div>
                <span class="font-semibold">Evidencia final:</span>
                @if(!empty($commission->evidence_path))
                    <a class="text-blue-600 underline" href="{{ asset('storage/' . $commission->evidence_path) }}" target="_blank">Ver archivo</a>
                @else
                    <span>Sin archivo</span>
                @endif
            </div>
            <div class="md:col-span-2">
                <span class="font-semibold">Números de resolución:</span>
                @if($commission->resolutions->isNotEmpty())
                    {{ $commission->resolutions->pluck('number')->join(', ') }}
                @else
                    Sin resolución
                @endif
            </div>
        </div>
    </div>
</div>