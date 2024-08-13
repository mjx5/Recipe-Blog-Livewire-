<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            session()->flash('message', 'Successfully logged in.');
            return redirect()->intended('/recipes'); // Redirect to the intended URL or home
        } else {
            session()->flash('error', 'Invalid credentials.');
        }
    }


    public function render()
    {
        return view('livewire.auth.login');
    }
}
