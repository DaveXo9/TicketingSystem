<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Notifications\UserRegistered;

use App\Http\Requests\UserRequest;
use App\Http\Requests\RegisterRequest;



class UserController extends Controller
{
    public function index():View{
        $user = User::where('id', auth()->id())->first();
        return view('users.index', compact('user'));
    }

    public function create():View{
        return view('users.register');
    }

    public function store(RegisterRequest $registerRequest):RedirectResponse{
        $formFields = $registerRequest->validated();
        $formFields['password'] = bcrypt($formFields['password']);
        $user = User::create($formFields);

        auth()->login($user);

        $user->notify(new UserRegistered($user));

        return redirect('/')->with('message', 'User created and logged in');
    }

    public function logout(Request $request):RedirectResponse{
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'User logged out');
    }

    public function login():View{
        return view('users.login');
    }

    public function authenticate(UserRequest $UserRequest):RedirectResponse{
        $formFields = $UserRequest->validated();

        if(auth()->attempt($formFields)){
            return redirect('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function edit(User $user):View{
        return view('users.edit', compact('user'));
    }

    public function update(RegisterRequest $reigsterRequest, User $user):RedirectResponse{
        $formFields = $reigsterRequest->validated();

        $formFields['password'] = bcrypt($formFields['password']);
    

        $user->update($formFields);

        return redirect('/profile')->with('message', 'User updated');
    }

    public function destroy(User $user):RedirectResponse{
        $user->delete();

        return redirect('/')->with('message', 'User deleted');
    
    }




}
