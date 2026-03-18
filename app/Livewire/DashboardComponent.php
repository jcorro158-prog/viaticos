<?php

namespace App\Livewire;

use App\Models\Commission;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $today = Carbon::today();

        $totalCommissions = Commission::count();

        $activeCommissions = Commission::query()
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->count();

        $upcomingCommissions = Commission::query()
            ->whereDate('start_date', '>', $today)
            ->count();

        $commissionsWithoutEvidence = Commission::query()
            ->where(function ($query) {
                $query->whereNull('evidence_path')
                    ->orWhere('evidence_path', '');
            })
            ->count();

        $endingSoonCount = Commission::query()
            ->whereDate('end_date', '>=', $today)
            ->whereDate('end_date', '<=', $today->copy()->addDays(3))
            ->count();

        $incompleteProfilesCount = User::query()
            ->where(function ($query) {
                $query->whereNull('name')->orWhere('name', '')
                    ->orWhereNull('surname')->orWhere('surname', '')
                    ->orWhereNull('dni')->orWhere('dni', '')
                    ->orWhereNull('cellphone')->orWhere('cellphone', '')
                    ->orWhereNull('address')->orWhere('address', '');
            })
            ->count();

        $recentCommissions = Commission::query()
            ->with(['user', 'commissionStatus', 'resolutions'])
            ->orderByDesc('start_date')
            ->limit(5)
            ->get();

        $alerts = collect([
            [
                'title' => 'Comisiones sin evidencia',
                'count' => $commissionsWithoutEvidence,
                'description' => 'Comisiones que todavía no tienen soporte cargado.',
                'url' => route('commissions'),
            ],
            [
                'title' => 'Comisiones que terminan pronto',
                'count' => $endingSoonCount,
                'description' => 'Comisiones con fecha de fin en los próximos 3 días.',
                'url' => route('commissions'),
            ],
            [
                'title' => 'Usuarios con perfil incompleto',
                'count' => $incompleteProfilesCount,
                'description' => 'Usuarios que aún no completan toda su información obligatoria.',
                'url' => route('users'),
            ],
        ])->filter(fn ($alert) => $alert['count'] > 0)->values();

        $stats = [
            [
                'title' => 'Total comisiones',
                'value' => $totalCommissions,
                'description' => 'Registros creados en el sistema',
            ],
            [
                'title' => 'En curso',
                'value' => $activeCommissions,
                'description' => 'Comisiones activas al día de hoy',
            ],
            [
                'title' => 'Próximas',
                'value' => $upcomingCommissions,
                'description' => 'Comisiones programadas hacia adelante',
            ],
            [
                'title' => 'Sin evidencia',
                'value' => $commissionsWithoutEvidence,
                'description' => 'Pendientes por cargar soporte',
            ],
        ];

        return view('livewire.dashboard-component', [
            'stats' => $stats,
            'recentCommissions' => $recentCommissions,
            'alerts' => $alerts,
        ])->layout('components.layouts.app', [
            'title' => 'Dashboard',
        ]);
    }
}