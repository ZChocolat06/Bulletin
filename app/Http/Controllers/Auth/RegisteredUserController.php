<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Http\Requests\Admin\UserRequest;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // dd('index');
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request): RedirectResponse
{
    $validatedData = $request->validated();

    // Hacher le mot de passe avant de créer l'utilisateur
    $validatedData['password'] = Hash::make($validatedData['password']);


    // Si le rôle est "Professeur", rediriger vers la route de création de professeur
    if ($validatedData['role'] === 'Professeur') {
        return redirect()->route('create.professeur', ['user' => $user]);
    }
    // Si le rôle est "Eleve", rediriger vers la route de création d'élève
    elseif ($validatedData['role'] === 'Eleve') {
        return redirect()->route('create.eleve', ['user' => $user]);
    }
    // Sinon, rediriger vers la page d'accueil
    else {
        // Créer l'utilisateur avec les données validées
        $user = User::create($validatedData);
        return redirect(RouteServiceProvider::HOME);
    }
}

}
