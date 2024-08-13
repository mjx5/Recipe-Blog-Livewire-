<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Register extends Component
{
    public $name;
    public $email;
    public $password;


    protected $rules = [
        'name' => 'required|string|max:255|min:5',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8', // This rule validates that the password and confirm password fields match
    ];

    public function dumpValues(){
        dd($this->name, $this->email, $this->password);
    }
    public function register()
    {

        // Validate the input
        $this->validate();
        $attributes = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
        // Create a new user
        $user = User::create($attributes);
        Auth::login($user);
        $this->reset('name', 'email', 'password');
        // Redirect after successful registration
        return redirect()->to('/recipes');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
