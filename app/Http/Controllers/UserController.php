<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required','min:3',],
            'email'=> ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:8|confirmed'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    public function logoqut(Request $request){
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'User logged out');
    }

    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            return redirect('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function edit(User $user){
        return view('users.edit');
    }

    public function update(Request $request, User $user){
        $formFields = $request->validate([
            'name' => ['required','min:3',],
            'email'=> ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'sometimes|required|min:8|confirmed'
        ]);

        if (isset($formFields['password'])) {
            $formFields['password'] = bcrypt($formFields['password']);
        }

        $user->update($formFields);

        return redirect('/')->with('message', 'User updated');
    }

    public function destroy(User $user){
        $user->delete();

        return redirect('/')->with('message', 'User deleted');
    
    }




}
