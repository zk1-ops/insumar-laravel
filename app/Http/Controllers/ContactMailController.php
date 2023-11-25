<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormReceived;

use Mail;
use App\Models\Employee;

use Storage;


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
                
                
                 // Registra los detalles del correo enviado en un archivo de log
                    $logDetails = [
                        'id' => rand(1,100),
                        'subject' => 'INSUMAR - Formulario de contacto',
                        'content' => $data,
                        'sent_at' => now()->toDateTimeString(),
                        'reviewed' => false, // Estado inicial: no revisado

                    ];

                 $rutaArchivoLog = 'mail/' . $employee->email . '.log';


                 // Crear la carpeta 'mail' si no existe
                    if (!Storage::exists('mail')) {
                        Storage::makeDirectory('mail');
                    }

                 // Guardar los detalles del correo en el archivo de log del usuario
                 Storage::append($rutaArchivoLog, json_encode($logDetails));
            }

            return response()->json('Enviado correctamente');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getEmail(Request $request) {


        $user = $request->user(); // Obtener el usuario autenticado


        $contenido =  Storage::disk('local')->get('mail/'. $user->email . '.log');


        // Dividir el archivo en líneas (cada línea es un registro JSON)
        $lines = explode("\n", $contenido);

        $emails = [];
        foreach ($lines as $line) {
            // Decodificar cada línea del log como un JSON y agregarlo al array $emails
            $emails[] = json_decode($line, true);
        }

        return response()->json($emails);
    }

    public function updateStatus(Request $request) {

        $user = $request->user(); // Obtener el usuario autenticado

        $contenido =  Storage::disk('local')->get('mail/'. $user->email . '.log');
        $rutaArchivoLog = 'mail/' . $user->email . '.log';

        // Dividir el archivo en líneas (cada línea es un registro JSON)
        $lines = explode("\n", $contenido);

        $emails = [];
        foreach ($lines as $line) {
            // Decodificar cada línea del log como un JSON y agregarlo al array $emails
            $emails[] = json_decode($line, true);
        }
        
        foreach ($emails as &$mensaje) {
            if ($mensaje['id'] === $request->idmensaje) {
                $mensaje['reviewed'] = true; // Marcar el mensaje como revisado
                break; // Terminar la iteración una vez que se encuentra el mensaje
            }
        }

        // Convertir el array a una cadena JSON antes de sobrescribir el archivo
        $nuevoContenido = array_map('json_encode', $emails);
        $nuevoContenido = implode("\n", $nuevoContenido);

        // Sobrescribir el archivo con los datos actualizados
        Storage::put($rutaArchivoLog, $nuevoContenido);

    }
    
    public function deleteMail(Request $request) {
        $user = $request->user(); // Obtener el usuario autenticado
        $id_mensaje = $request->idmensaje;
    
        $contenido = Storage::disk('local')->get('mail/' . $user->email . '.log');
        $rutaArchivoLog = 'mail/' . $user->email . '.log';
    
        $lines = explode("\n", $contenido);
    
        // Filtrar las líneas para eliminar la que contiene el ID específico
        $filteredLines = array_filter($lines, function ($line) use ($id_mensaje) {
            $data = json_decode($line, true);
            return $data['id'] !== $id_mensaje;
        });
    
        // Unir las líneas filtradas de nuevo en una sola cadena
        $newContent = implode("\n", $filteredLines);
    
       // Verificar si todas las líneas están vacías o son NULL
        if (empty(trim($newContent))) {
            // Si todas las líneas están vacías o son NULL, eliminar el archivo completo
            Storage::delete($rutaArchivoLog);
        } else {
            // Sobrescribir el archivo con el contenido modificado
            Storage::put($rutaArchivoLog, $newContent);
        }
    }
}
