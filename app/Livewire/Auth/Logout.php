<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout()
{
    try {
        // Attempt to log the user out
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // Redirect the user to the home route
        return redirect()->route('home');

    } catch (\Exception $e) {
        // Store the exception message in the session
        session()->flash('logout-error', 'An error occurred while logging out: ' . $e->getMessage());

        // Redirect the user to the home route with an error message
        return redirect()->route('index');
    }
}

    public function render()
    {
        return view('livewire.auth.logout');
    }

}
