<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class FormController extends Controller
{
    public function create(): View
    {
        return view('users.create');
    }

    // store method to handle form submission
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' =>'required|string|max:255|email|unique:users,email',
                'password' => 'required|string|min:8'
            ]
            );
            $validated['password'] = bcrypt($validated['password']);

            User::create($validated);
            return back()->with( 'success', 'user crested successfully' );

    }
}
