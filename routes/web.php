<?php

use App\Http\Controllers\DiagnosticController;
use App\Livewire\CommissionComponent;
use App\Livewire\Components\RegimeLevelGrades\IndexRegimeLevelGradeComponent;
use App\Livewire\Components\Regimes\IndexRegimeComponent;
use App\Livewire\Parameterization\DependenciesComponent;
use App\Livewire\Parameterization\JobPositionComponent;
use App\Livewire\Parameterization\SalaryLevels\ShowRegimesComponent;
use App\Livewire\Parameterization\VinculationComponent;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\UsersComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

// Rutas de diagnóstico (solo en desarrollo)
if (config('app.debug')) {
    Route::get('diagnostic/microsoft', [DiagnosticController::class, 'microsoftInfo']);
    Route::get('diagnostic/microsoft/json', [DiagnosticController::class, 'microsoftTest']);
}

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'profile.complete'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/usuarios', UsersComponent::class)->name('users');
    Route::get('/comisiones', CommissionComponent::class)->name('commissions');

    Route::get('/parametrizacion/puestos', JobPositionComponent::class)->name('parametrization.job_positions');
    Route::get('/parametrizacion/dependencias', DependenciesComponent::class)->name('parametrization.dependencies');
    Route::get('/parametrizacion/tipos-vinculacion', VinculationComponent::class)->name('parametrization.vinculation');

    Route::get('/parametrizacion/regimenes', IndexRegimeComponent::class)->name('parametrization.regimes');
    Route::get('/parametrizacion/regimenes/{regimeId}', ShowRegimesComponent::class)->name('parametrization.regimes.show');
    Route::get('/parametrizacion/regimenes/1/niveles/1', IndexRegimeLevelGradeComponent::class)->name('parameterization.regimes.levels.grades.show');
});

require __DIR__.'/auth.php';
