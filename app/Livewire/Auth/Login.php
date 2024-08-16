<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;

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
        $lockKey = 'user-login-' . $this->email; // Unique key based on the email
        $lock = Cache::lock($lockKey, 10); // Lock expires after 10 seconds



        try {
            if ($lock->get()) { // Try to acquire the lock
                DB::beginTransaction();
                $this->validate();

                $credentials = [
                    'email' => $this->email,
                    'password' => $this->password,
                ];

                if (Auth::attempt($credentials)) {
                    DB::commit();
                    session()->flash('message', 'Successfully logged in.');
                    return redirect()->to('/recipes'); // Redirect to the intended URL or home
                } else {
                    DB::rollBack();
                    session()->flash('error', 'Invalid credentials.');
                }
            } else {
                // If the lock is not acquired
                session()->flash('error', 'Login request is being processed. Please try again later.');
                DB::rollBack();
                $lock->release();
            }
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
