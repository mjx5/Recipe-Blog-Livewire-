<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Exception;

class Logout extends Component
{
    public function logout()
    {
        try {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('home');
        } catch (Exception $e) {
            session()->flash('logout-error', 'An error occurred while logging out: ' . $e->getMessage());
            return redirect()->route('index');
        }
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}
