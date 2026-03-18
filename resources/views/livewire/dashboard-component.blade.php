<div class="flex h-full w-full flex-1 flex-col gap-6">
    {{-- HERO / ENCABEZADO PRINCIPAL --}}
    <section class="relative overflow-hidden rounded-3xl border border-orange-200/70 bg-gradient-to-br from-white via-orange-50 to-amber-100 p-6 text-zinc-900 shadow-xl shadow-orange-100/60 dark:border-zinc-800 dark:bg-gradient-to-br dark:from-slate-950 dark:via-zinc-900 dark:to-orange-950/80 dark:text-white dark:shadow-black/10 md:p-8">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(251,146,60,0.18),transparent_30%),radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.85),transparent_35%)] dark:bg-[radial-gradient(circle_at_top_right,rgba(251,146,60,0.18),transparent_30%),radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.08),transparent_25%)]"></div>

    <div class="relative z-10 flex flex-col gap-6 xl:flex-row xl:items-end xl:justify-between">
        <div class="max-w-3xl">
            <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-orange-200 bg-white/80 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-orange-700 shadow-sm dark:border-white/15 dark:bg-white/10 dark:text-orange-200">
                <span class="h-2 w-2 rounded-full bg-orange-500 dark:bg-orange-400"></span>
                Panel Institucional
            </div>

            <h1 class="text-3xl font-bold tracking-tight md:text-4xl">
                Dashboard de control de viáticos
            </h1>

            <p class="mt-3 max-w-2xl text-sm leading-6 text-zinc-700 dark:text-zinc-200 md:text-base">
                Monitorea el estado general de las comisiones, identifica alertas operativas
                y accede rápidamente a los módulos clave del sistema.
            </p>
        </div>

        <div class="grid gap-3 sm:grid-cols-3 xl:min-w-[460px]">
            <a href="{{ route('commissions') }}"
               class="group rounded-2xl border border-orange-200 bg-white/80 p-4 shadow-sm backdrop-blur transition hover:border-orange-400 hover:bg-white dark:border-white/10 dark:bg-white/10 dark:hover:border-orange-400/40 dark:hover:bg-white/15">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-zinc-900 dark:text-white">Comisiones</span>
                    <span class="rounded-full bg-orange-100 px-2 py-1 text-[11px] font-bold text-orange-700 dark:bg-orange-400/15 dark:text-orange-200">
                        Ir
                    </span>
                </div>
                <p class="mt-2 text-xs text-zinc-600 dark:text-zinc-300">
                    Gestiona registros, evidencias y seguimiento operativo.
                </p>
            </a>

            <a href="{{ route('users') }}"
               class="group rounded-2xl border border-orange-200 bg-white/80 p-4 shadow-sm backdrop-blur transition hover:border-orange-400 hover:bg-white dark:border-white/10 dark:bg-white/10 dark:hover:border-orange-400/40 dark:hover:bg-white/15">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-zinc-900 dark:text-white">Usuarios</span>
                    <span class="rounded-full bg-sky-100 px-2 py-1 text-[11px] font-bold text-sky-700 dark:bg-sky-400/15 dark:text-sky-200">
                        Ir
                    </span>
                </div>
                <p class="mt-2 text-xs text-zinc-600 dark:text-zinc-300">
                    Revisa perfiles, datos obligatorios y acceso al sistema.
                </p>
            </a>

            <a href="{{ route('settings.profile') }}"
               class="group rounded-2xl border border-orange-200 bg-white/80 p-4 shadow-sm backdrop-blur transition hover:border-orange-400 hover:bg-white dark:border-white/10 dark:bg-white/10 dark:hover:border-orange-400/40 dark:hover:bg-white/15">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-zinc-900 dark:text-white">Mi perfil</span>
                    <span class="rounded-full bg-emerald-100 px-2 py-1 text-[11px] font-bold text-emerald-700 dark:bg-emerald-400/15 dark:text-emerald-200">
                        Editar
                    </span>
                </div>
                <p class="mt-2 text-xs text-zinc-600 dark:text-zinc-300">
                    Mantén actualizada tu información personal obligatoria.
                </p>
            </a>
        </div>
    </div>
</section>

    {{-- CABECERA DE SECCIÓN --}}
    <section class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                Resumen general
            </p>
            <h2 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                Vista consolidada del sistema
            </h2>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                Indicadores principales para revisar el comportamiento operativo del módulo.
            </p>
        </div>
    </section>

    {{-- KPI CARDS --}}
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $cardStyles = [
                [
                    'iconBg' => 'bg-orange-100 text-orange-700 dark:bg-orange-500/15 dark:text-orange-300',
                    'line' => 'bg-orange-500',
                ],
                [
                    'iconBg' => 'bg-sky-100 text-sky-700 dark:bg-sky-500/15 dark:text-sky-300',
                    'line' => 'bg-sky-500',
                ],
                [
                    'iconBg' => 'bg-violet-100 text-violet-700 dark:bg-violet-500/15 dark:text-violet-300',
                    'line' => 'bg-violet-500',
                ],
                [
                    'iconBg' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-300',
                    'line' => 'bg-amber-500',
                ],
            ];
        @endphp

        @foreach ($stats as $index => $stat)
            @php
                $style = $cardStyles[$index] ?? $cardStyles[0];
            @endphp

            <article class="group relative overflow-hidden rounded-3xl border border-zinc-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
                <div class="absolute inset-x-0 top-0 h-1 {{ $style['line'] }}"></div>

                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-zinc-500 dark:text-zinc-400">
                            {{ $stat['title'] }}
                        </p>
                        <h3 class="mt-3 text-4xl font-bold tracking-tight text-zinc-950 dark:text-white">
                            {{ $stat['value'] }}
                        </h3>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl {{ $style['iconBg'] }}">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19h16" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V8" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16V5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16v-3" />
                        </svg>
                    </div>
                </div>

                <p class="mt-4 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                    {{ $stat['description'] }}
                </p>
            </article>
        @endforeach
    </section>

    {{-- CONTENIDO PRINCIPAL --}}
    <section class="grid gap-6 xl:grid-cols-[minmax(0,1.6fr)_minmax(320px,0.9fr)]">
        {{-- PANEL DE ACTIVIDAD / TABLA --}}
        <div class="overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 px-6 py-5 dark:border-zinc-800">
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                            Actividad reciente
                        </p>
                        <h3 class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">
                            Últimas comisiones registradas
                        </h3>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            Consulta rápida de los movimientos más recientes del sistema.
                        </p>
                    </div>

                    <a href="{{ route('commissions') }}"
                       class="inline-flex items-center justify-center rounded-xl border border-zinc-300 px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:border-orange-400 hover:bg-orange-50 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-orange-500 dark:hover:bg-zinc-800">
                        Ver módulo completo
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-zinc-50/80 dark:bg-zinc-950/60">
                        <tr class="text-left">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.18em] text-zinc-500">
                                Funcionario
                            </th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.18em] text-zinc-500">
                                Destino
                            </th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.18em] text-zinc-500">
                                Fechas
                            </th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.18em] text-zinc-500">
                                Estado
                            </th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.18em] text-zinc-500">
                                Evidencia
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse ($recentCommissions as $commission)
                            <tr class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/40">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-zinc-100 text-sm font-bold text-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">
                                            {{ strtoupper(substr($commission->user?->name ?? 'S', 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-semibold text-zinc-900 dark:text-white">
                                                {{ $commission->user?->name ?? 'Sin usuario' }}
                                            </p>
                                            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                                Registro de comisión
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-5 text-sm text-zinc-700 dark:text-zinc-300">
                                    {{ $commission->destination ?: 'Sin destino definido' }}
                                </td>

                                <td class="px-6 py-5 text-sm text-zinc-600 dark:text-zinc-400">
                                    <div class="flex flex-col gap-1">
                                        <span>Inicio: {{ optional($commission->start_date)->format('d/m/Y') ?: '—' }}</span>
                                        <span>Fin: {{ optional($commission->end_date)->format('d/m/Y') ?: '—' }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-5">
                                    <span class="inline-flex rounded-full border border-zinc-200 bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">
                                        {{ $commission->commissionStatus?->name ?? 'Sin estado' }}
                                    </span>
                                </td>

                                <td class="px-6 py-5">
                                    @if (!empty($commission->evidence_path))
                                        <span class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/20 dark:text-emerald-300">
                                            Soporte cargado
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700 dark:border-amber-900/40 dark:bg-amber-900/20 dark:text-amber-300">
                                            Pendiente
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="mx-auto max-w-md">
                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400">
                                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V5a4 4 0 0 1 8 0v2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 7v11a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7" />
                                            </svg>
                                        </div>

                                        <h4 class="mt-4 text-base font-semibold text-zinc-900 dark:text-white">
                                            No hay comisiones registradas
                                        </h4>
                                        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                                            Cuando se creen nuevas comisiones, aparecerán aquí para seguimiento rápido.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- COLUMNA LATERAL --}}
        <div class="space-y-6">
            {{-- ALERTAS --}}
            <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                            Alertas
                        </p>
                        <h3 class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">
                            Atención prioritaria
                        </h3>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-700 dark:bg-orange-500/15 dark:text-orange-300">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 17h.01" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                        </svg>
                    </div>
                </div>

                <p class="mt-2 text-sm leading-6 text-zinc-500 dark:text-zinc-400">
                    Registros y situaciones que requieren validación o seguimiento inmediato.
                </p>

                <div class="mt-5 space-y-3">
                    @forelse ($alerts as $alert)
                        <a href="{{ $alert['url'] }}"
                           class="group block rounded-2xl border border-zinc-200 p-4 transition hover:border-orange-400 hover:bg-orange-50/70 dark:border-zinc-800 dark:hover:border-orange-500 dark:hover:bg-zinc-800">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-zinc-900 dark:text-white">
                                        {{ $alert['title'] }}
                                    </p>
                                    <p class="mt-1 text-sm leading-6 text-zinc-500 dark:text-zinc-400">
                                        {{ $alert['description'] }}
                                    </p>
                                </div>

                                <span class="inline-flex min-w-10 justify-center rounded-full bg-orange-100 px-3 py-1 text-sm font-bold text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                                    {{ $alert['count'] }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/40 dark:bg-emerald-900/10">
                            <p class="font-semibold text-emerald-700 dark:text-emerald-300">
                                Sin alertas activas
                            </p>
                            <p class="mt-1 text-sm text-emerald-600 dark:text-emerald-400">
                                El sistema no reporta novedades críticas en este momento.
                            </p>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- ACCESOS RÁPIDOS --}}
            <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                            Navegación
                        </p>
                        <h3 class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">
                            Accesos rápidos
                        </h3>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12h12" />
                        </svg>
                    </div>
                </div>

                <p class="mt-2 text-sm leading-6 text-zinc-500 dark:text-zinc-400">
                    Accede rápidamente a las acciones más frecuentes del sistema.
                </p>

                <div class="mt-5 grid gap-3">
                    <a href="{{ route('commissions') }}"
                       class="group rounded-2xl border border-zinc-200 px-4 py-4 transition hover:border-orange-400 hover:bg-orange-50 dark:border-zinc-800 dark:hover:border-orange-500 dark:hover:bg-zinc-800">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-zinc-900 dark:text-white">
                                    Gestionar comisiones
                                </p>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                    Consulta, edita y realiza seguimiento a registros existentes.
                                </p>
                            </div>
                            <span class="text-orange-600 dark:text-orange-400">→</span>
                        </div>
                    </a>

                    <a href="{{ route('users') }}"
                       class="group rounded-2xl border border-zinc-200 px-4 py-4 transition hover:border-orange-400 hover:bg-orange-50 dark:border-zinc-800 dark:hover:border-orange-500 dark:hover:bg-zinc-800">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-zinc-900 dark:text-white">
                                    Administrar usuarios
                                </p>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                    Revisa información de perfiles y control de usuarios del sistema.
                                </p>
                            </div>
                            <span class="text-orange-600 dark:text-orange-400">→</span>
                        </div>
                    </a>

                    <a href="{{ route('settings.profile') }}"
                       class="group rounded-2xl border border-zinc-200 px-4 py-4 transition hover:border-orange-400 hover:bg-orange-50 dark:border-zinc-800 dark:hover:border-orange-500 dark:hover:bg-zinc-800">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-zinc-900 dark:text-white">
                                    Actualizar perfil
                                </p>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                    Completa o corrige los datos obligatorios de tu cuenta.
                                </p>
                            </div>
                            <span class="text-orange-600 dark:text-orange-400">→</span>
                        </div>
                    </a>
                </div>
            </section>
        </div>
    </section>
</div>