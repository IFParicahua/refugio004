<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Persona;
use App\Refugio;
use App\Rubro;
use App\Tipo_refugio;
use App\User;
use Illuminate\Support\Facades\Hash;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function activista_view(){
        return view('auth.registrouser');
    }

    public function empresa_view(){
        $rubros = Rubro::all();
        return view('auth.registroemp', compact('rubros'));
    }

    public function refugio_view(){
        $tipos = Tipo_refugio::all();
        return view('auth.registroref', compact('tipos'));
    }

    public function activista_save(Request $request){
        $validar = $request->validate([
            'txtnombre' => ['required', 'string', 'max:255'],
            'txtapellido' => ['required', 'string', 'max:255'],
            'txtemail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'txtpassword' => ['required', 'string', 'min:8'],
            'txtdireccion' => ['required', 'string', 'max:500'],
            'txtci' => ['required'],
            'txtelefono' => ['required','numeric'],
            'txtnacimiento' => ['required'],
            'txtsexo' => ['required']
        ],[
            'txtnombre.required' => 'El nombre  es requerido.',
            'txtapellido.required' => 'El apellido  es requerido.',
            'txtemail.required' => 'El email  es requerido.',
            'txtpassword.required' => 'La contraseña  es requerido.',
            'txtdireccion.required' => 'La dirección  es requerido.',
            'txtci.required' => 'El CI  es requerido.',
            'txtelefono.required' => 'El Telefono  es requerido.',
            'txtnacimiento.required' => 'La fecha de nacimiento  es requerido.',
            'txtsexo.required' => 'El sexo  es requerido.',
            'txtnombre.max' => 'El nombre no pude tener más de 255 caracteres.',
            'txtapellido.max' => 'El apellido no pude tener más de 255 caracteres.',
            'txtemail.max' => 'El email no pude tener más de 255 caracteres.',
            'txtpassword.min' => 'La contraseña debe tener más de 8 caracteres.',
            'txtdireccion.max' => 'La dirección no pude tener más de 500 caracteres.',
            'txtemail.unique' => 'Este email esta siendo usado, escriba otro email.',
            'txtelefono.numeric' => 'El nombre debe ser numerico.'
        ]);
        if($validar){
            try {
                $user = new User;
                $user->name = $request->get('txtnombre');
                $user->imagen_perfil = 'imagenblanco.png';
                $user->email = $request->get('txtemail');
                $user->password = Hash::make($request->get('txtpassword'));
                $user->rol = '1';
                $user->save();
                $persona = new Persona;
                $persona->nom_persona = $request->get('txtnombre');
                $persona->apellido = $request->get('txtapellido');
                $persona->dir_persona = $request->get('txtdireccion');
                $persona->telefono = $request->get('txtelefono');
                $persona->CI = $request->get('txtci');
                $persona->genero_persona = $request->get('txtsexo');
                $persona->f_nac_persona = $request->get('txtnacimiento');
                $persona->pkuser = $user->id;
                $persona->save();
                if (Auth::attempt(['email' => $request->get('txtemail'), 'password' => $request->get('txtpassword')], $user))
                {
                    return redirect()->intended('/');
                }
            } catch (Exception $e) {
                return back();
            }
        }else{
            return back()->withInput();
        }

    }


    public function empresa_save(Request $request){
        $validar = $request->validate([
            'txtrazon_social' => ['required', 'string', 'max:255'],
            'txtnombre' => ['required', 'string', 'max:255'],
            'txtapellido' => ['required', 'string', 'max:255'],
            'txtdireccion' => ['required', 'string', 'max:500'],
            'txtdescripcion' => ['string', 'max:500'],
            'txtci' => ['required', 'string', 'max:20'],
            'txtemail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'txtpassword' => ['required', 'string', 'min:8'],
            'txtdireccion_emp' => ['required', 'string', 'max:500'],
            'txtsigla' => ['required', 'string', 'max:10'],
            'txtnit' => ['required','numeric'],
            'txttelefono' => ['required','numeric'],
            'txtrubro' => ['required'],
            'txtdate' => ['required'],
            'txtsexo' => ['required']
        ],[
            'txtrazon_social.required' => 'La razón social es requerida.',
            'txtrubro.required' => 'El rubro es requerido.',
            'txtemail.required' => 'El email es requerido.',
            'txtpassword.required' => 'La contraseña es requerida.',
            'txtdireccion_emp.required' => 'La dirección es requerida.',
            'txtsigla.required' => 'La sigla es requerida.',
            'txtnit.required' => 'El nit es requerido.',
            'txtnombre.required' => 'El nombre es requerido.',
            'txtapellido.required' => 'El apellido es requerido.',
            'txtdireccion.required' => 'La dirección es requerida.',
            'txtci.required' => 'El ci es requerido.',
            'txttelefono.required' => 'El teléfono es requerido.',
            'txtdate.required' => 'La fecha de nacimiento es requerida.',
            'txtsexo.required' => 'El sexo es requerido.',
            'txtrazon_social.max' => 'La razón social no debe tener más de 255 caracteres.',
            'txtnombre.max' => 'El nombre no debe tener más de 255 caracteres.',
            'txtapellido.max' => 'El apellido no debe tener más de 255 caracteres.',
            'txtdireccion.max' => 'El direccion no debe tener más de 500 caracteres.',
            'txtdescripcion.max' => 'La descripcion no debe tener más de 500 caracteres.',
            'txtci.max' => 'El ci no debe tener más de 20 caracteres.',
            'txtemail.max' => 'El email no debe tener más de 255 caracteres.',
            'txtpassword.min' => 'El password debe tener más de 8 caracteres.',
            'txtdireccion_emp.max' => 'El direccion_emp no debe tener más de 500 caracteres.',
            'txtsigla.max' => 'El sigla no debe tener más de 10 caracteres.'
        ]);
        if($validar){
            try {
                $user = new User;
                $user->name = $request->get('txtrazon_social');
                $user->imagen_perfil = 'imagenblanco.png';
                $user->email = $request->get('txtemail');
                $user->password = Hash::make($request->get('txtpassword'));
                $user->rol = '2';
                $user->save();
                $persona = new Persona;
                $persona->nom_persona = $request->get('txtnombre');
                $persona->apellido = $request->get('txtapellido');
                $persona->dir_persona = $request->get('txtdireccion');
                $persona->telefono = $request->get('txttelefono');
                $persona->CI = $request->get('txtci');
                $persona->genero_persona = $request->get('txtsexo');
                $persona->f_nac_persona = $request->get('txtdate');
                $persona->pkuser = $user->id;
                $persona->save();
                $empresa = new Empresa;
                $empresa->razonsocial = $request->get('txtrazon_social');
                $empresa->sigla = $request->get('txtsigla');
                $empresa->nit = $request->get('txtnit');
                $empresa->dir_empresa = $request->get('txtdireccion_emp');
                $empresa->desc_empresa = $request->get('txtdescripcion');
                $empresa->pkrubro = $request->get('txtrubro');
                $empresa->pkpersona = $persona->id;
                $empresa->save();
                if (Auth::attempt(['email' => $request->get('txtemail'), 'password' => $request->get('txtpassword')], $user))
                {
                    return redirect()->intended('/');
                }
            } catch (Exception $e) {
                return back();
            }
        }else{
            return back()->withInput();
        }

    }


    public function refugio_save(Request $request){
        $validar = $request->validate([
            'txtnom_refugio' => ['required', 'string', 'max:255'],
            'txtnombre' => ['required', 'string', 'max:255'],
            'txtapellido' => ['required', 'string', 'max:255'],
            'txtdir_refugio' => ['required', 'string', 'max:500'],
            'txtdescripcion' => ['string', 'max:500'],
            'txtci' => ['required', 'string', 'max:20'],
            'txtemail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'txtdireccion' => ['required', 'string', 'max:500'],
            'txtpassword' => ['required', 'string', 'min:8'],
            'txtsexo' => ['required'],
            'txtdate' => ['required'],
            'txtelefono' => ['required','numeric'],
            'txtipo' => ['required'],
            'txtcapacidad' => ['required']
        ],[
            'txtnom_refugio.required' => 'El nombre del refugio es requerida.',
            'txtnombre.required' => 'El nombre es requerido.',
            'txtapellido.required' => 'El apellido es requerido.',
            'txtdir_refugio.required' => 'La direccion del refugio es requerida.',
            'txtdescripcion.required' => 'La descripción es requerida.',
            'txtci.required' => 'El ci es requerido.',
            'txtemail.required' => 'El email es requerido.',
            'txtdireccion.required' => 'El direccion es requerido.',
            'txtpassword.required' => 'La contraseña es requerida.',
            'txtsexo.required' => 'El sexo es requerido.',
            'txtdate.required' => 'La fecha de nacimiento es requerida.',
            'txtelefono.required' => 'El teléfono es requerido.',
            'txtipo.required' => 'El tipo de refugio es requerido.',
            'txtcapacidad.required' => 'La capacidad es requerida.',
            'txtnom_refugio.max' => 'El nombre del refugio no debe tener más de 255 caracteres.',
            'txtnombre.max' => 'El nombre no debe tener más de 255 caracteres.',
            'txtapellido.max' => 'El apellido no debe tener más de 255 caracteres.',
            'txtdir_refugio.max' => 'El direccion del refugio no debe tener más de 500 caracteres.',
            'txtdescripcion.max' => 'La descripción del refugio no debe tener más de 500 caracteres.',
            'txtci.max' => 'El ci no debe tener más de 20 caracteres.',
            'txtemail.max' => 'El email no debe tener más de 255 caracteres.',
            'txtdireccion.max' => 'El direccion no debe tener más de 500 caracteres.',
            'txtpassword.min' => 'El password debe tener más de 8 caracteres.',
            'txtemail.unique' => 'El sigla no debe tener más de 10 caracteres.',
            'txtelefono.numeric' => 'El teléfono debe ser numerico.'

        ]);
        if($validar){
            try {
                $user = new User;
                $user->name = $request->get('txtnom_refugio');
                $user->imagen_perfil = 'imagenblanco.png';
                $user->email = $request->get('txtemail');
                $user->password = Hash::make($request->get('txtpassword'));
                $user->rol = '3';
                $user->save();
                $persona = new Persona;
                $persona->nom_persona = $request->get('txtnombre');
                $persona->apellido = $request->get('txtapellido');
                $persona->dir_persona = $request->get('txtdireccion');
                $persona->telefono = $request->get('txtelefono');
                $persona->CI = $request->get('txtci');
                $persona->genero_persona = $request->get('txtsexo');
                $persona->f_nac_persona = $request->get('txtdate');
                $persona->pkuser = $user->id;
                $persona->save();
                $refugio = new Refugio;
                $refugio->nom_refugio = $request->get('txtnom_refugio');
                $refugio->capacidad = $request->get('txtcapacidad');
                $refugio->dir_refugio = $request->get('txtdir_refugio');
                $refugio->desc_refugio = $request->get('txtdescripcion');
                $refugio->pktipo = $request->get('txtipo');
                $refugio->pkpersona = $persona->id;
                $refugio->save();
                if (Auth::attempt(['email' => $request->get('txtemail'), 'password' => $request->get('txtpassword')], $user))
                {
                    return redirect()->intended('/');
                }
            } catch (Exception $e) {
                return back();
            }
        }else{
            return back()->withInput();
        }

    }


}
