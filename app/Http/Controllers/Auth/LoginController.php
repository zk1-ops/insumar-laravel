<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Employee;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

use Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);   

       $exists = Employee::where('email', $request->email)
                     ->first();
        
       if(!$exists) { Session::put('email_message', 'E-mail incorrecto'); return redirect()->back(); }

       Session::forget('email_message'); // Si el email existe, quitamos el mensaje de error 

       $passwordHash = Hash::check($request->password, $exists->password);

       if(!$passwordHash) { Session::put('password_message', 'Contraseña incorrecta'); return redirect()->back(); }
     
       Auth::login($exists);
       $request->session()->regenerate();
        
       return redirect()->route('dashboard'); // Asegúrate de que 'dashboard' sea la ruta correcta
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }

    protected function validateLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

    }

    public function dataUser(Request $request) {
        return response()->json($request->user());
    }
}
