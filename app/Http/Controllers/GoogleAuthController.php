<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    // Redirige al usuario a la página de autenticación de Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Maneja la respuesta de Google después de la autenticación
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt(uniqid()), // Contraseña aleatoria segura
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
