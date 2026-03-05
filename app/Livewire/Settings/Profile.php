<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public string $name = '';

    public string $surname = '';

    public string $cellphone = '';

    public string $dni = '';

    public string $address = '';

    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name ?? '';
        $this->surname = $user->surname ?? '';
        $this->cellphone = $user->cellphone ?? '';
        $this->dni = $user->dni ?? '';
        $this->address = $user->address ?? '';
        $this->email = $user->email ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'cellphone' => ['required', 'string', 'max:20'],
            'dni' => ['required', 'string', 'max:20', Rule::unique(User::class)->ignore($user->id)],
            'address' => ['required', 'string', 'max:500'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);

        // Si el perfil ahora está completo, mostrar mensaje de éxito
        if (! empty($user->name) && ! empty($user->surname) && ! empty($user->cellphone) &&
            ! empty($user->dni) && ! empty($user->address)) {
            session()->flash('success', 'Perfil completado exitosamente. Ahora puede navegar por todo el sistema.');
        }
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.settings.profile');
    }
}
