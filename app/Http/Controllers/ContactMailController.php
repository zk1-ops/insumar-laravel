<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormReceived;

use Mail;
use App\Models\Employee;


class ContactMailController extends Controller
{   
    public function enviar(Request $request) {
        try {
            $employees = Employee::all();
    
            $name = $request->name;
            $phone = $request->phone;
            $email_contact = $request->mail;
            $message = $request->message;
        
            foreach ($employees as $employee) {
                $nameEmployee = $employee->first_name;
                $lastNameEmployee = $employee->last_name;
        
                // Compacta las variables y crea un array asociativo con las claves correspondientes
                $data = compact('nameEmployee', 'lastNameEmployee', 'name', 'phone', 'email_contact', 'message');
        
                // Crea el objeto de correo electrónico y pasa el array como datos
                $correo = new ContactFormReceived($data);
                Mail::to($employee->email)->send($correo);        
            }

            return response()->json('Enviado correctamente');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
}
