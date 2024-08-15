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
        $lock = Cache::lock($lockKey, 30); // Lock expires after 10 seconds

        // Start the transaction
        DB::beginTransaction();

        try {
            if ($lock->get()) { // Try to acquire the lock
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
            }
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong. Please try again later.');
        } finally {
            // Always release the lock
            $lock->release();
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
