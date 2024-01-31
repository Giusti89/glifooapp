<?php

namespace App\Http\Controllers;

use App\Mail\ContactosMailable;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;   

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contacto');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // Mail::to('info@glifoo.com')
    // ->send(new ContactosMailable($request->all()));

    public function store(Request $request)
    {
        $messages = [
            'txt_nombre.required' => 'El campo nombre es obligatorio.',
            'txt_nombre.min' => 'El campo nombre no puede tener menos de :min caracteres.',

            'txt_mail.required' => 'El campo email es obligatorio.',
            'txt_mail.email' => 'Ingresa una dirección de correo electrónico válida.',


            'txt_asunto.required' => 'El campo Asunto es obligatorio.',
            'txt_asunto.min' => 'El campo Asunto no puede tener menos de :min caracteres.',

            'txt_wap.required' => 'El campo Whatsapp es obligatorio.',
            'txt_wap.min' => 'El campo Whatsapp no puede tener menos de :min caracteres.',

            'txt_mensaje.required' => 'El campo Mensaje es obligatorio.',
            'txt_mensaje.min' => 'El campo Mensaje no puede tener menos de :min caracteres.',


            'producto.required' => 'El campo producto es obligatorio.',
        ];
        $request->validate([
            'txt_nombre'=>'required|min:3',
            'txt_mail'=>'required|email',
            'txt_asunto'=>'required|min:5',
            'txt_wap'=>'required|min:8',
            'txt_mensaje'=>'required|min:7',
        ],$messages);


        $correo = new ContactosMailable($request->all());
        Mail::to('info@glifoo.com')->send($correo);
        return redirect()->route('contactos')->with('info','Su mensaje se envio de manera correcta');
    }

    /**
        * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
