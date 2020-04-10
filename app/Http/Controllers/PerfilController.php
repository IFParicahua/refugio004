<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Enlace;
use App\Persona;
use App\Refugio;
use App\Tipo_cuenta;
use App\Tipo_refugio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    public function perfil_view(){
        $enlaces = Enlace::where('pkpersona', Auth::user()->personaUser->id)->get();
        $tipos = Tipo_refugio::all();
        switch (Auth::user()->rol) {
            case '1':
                return view('view_usuario.perfil', compact('enlaces'));
                break;
            case '2':
                return view('view_empresa.perfil', compact('enlaces'));
                break;
            case '3':
                return view('view_refugio.perfil', compact('enlaces','tipos'));
                break;
        }
    }

    public function validar_activista(Request $request){
        $validar = Validator::make($request->all(), [
            'txtnombre' => ['required', 'string', 'max:255'],
            'txtapellido' => ['required', 'string', 'max:255'],
            'txtemail' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id.',id'],
            'txtpassword' => ['min:8'],
            'txtdireccion' => ['required', 'string', 'max:500'],
            'txtci' => ['required'],
            'txttelefono' => ['required','numeric'],
            'txtdate' => ['required'],
            'txtgenero' => ['required']
        ],[
            'txtnombre.required' => 'El nombre  es requerido.',
            'txtapellido.required' => 'El apellido  es requerido.',
            'txtemail.required' => 'El email  es requerido.',
            'txtdireccion.required' => 'La dirección  es requerido.',
            'txtci.required' => 'El CI  es requerido.',
            'txttelefono.required' => 'El Telefono  es requerido.',
            'txtdate.required' => 'La fecha de nacimiento  es requerido.',
            'txtgenero.required' => 'El sexo  es requerido.',
            'txtnombre.max' => 'El nombre no pude tener más de 255 caracteres.',
            'txtapellido.max' => 'El apellido no pude tener más de 255 caracteres.',
            'txtemail.max' => 'El email no pude tener más de 255 caracteres.',
            'txtpassword.min' => 'La contraseña debe tener más de 8 caracteres.',
            'txtdireccion.max' => 'La dirección no pude tener más de 500 caracteres.',
            'txtemail.unique' => 'Este email esta siendo usado, escriba otro email.',
            'txttelefono.numeric' => 'El nombre debe ser numerico.'
        ]);
        $errors = $validar->errors();
        return response()->json([
            'nombre' => $errors->first('txtnombre'),
            'apellido' => $errors->first('txtapellido'),
            'email' => $errors->first('txtemail'),
            'password' => $errors->first('txtpassword'),
            'direccion' => $errors->first('txtdireccion'),
            'ci' => $errors->first('txtci'),
            'telefono' => $errors->first('txtelefono'),
            'date' => $errors->first('txtdate'),
            'genero' => $errors->first('txtgenero'),
        ]);
    }

    public function activista_update(Request $request){
        DB::beginTransaction();
        try {
            $password = $request->get('txtpassword');
            if ($password == "**********") {
                $user = User::find(Auth::user()->id);
                $user->name = $request->get('txtnombre');
                $user->email = $request->get('txtemail');
                $user->save();
            } else {
                $user = User::find(Auth::user()->id);
                $user->name = $request->get('txtnombre');
                $user->email = $request->get('txtemail');
                $user->password = Hash::make($password);
                $user->save();
            }
            $persona = Persona::find(Auth::user()->personaUser->id);
            $persona->nom_persona = $request->get('txtnombre');
            $persona->apellido = $request->get('txtapellido');
            $persona->dir_persona = $request->get('txtdireccion');
            $persona->telefono = $request->get('txttelefono');
            $persona->CI = $request->get('txtci');
            $persona->genero_persona = $request->get('txtgenero');
            $persona->f_nac_persona = $request->get('txtdate');
            $persona->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return back();
        }
    }

    public function validar_enlace(Request $request){
        $validar = Validator::make($request->all(), [
            'identificador' => ['required','max:50'],
            'enlace' => ['required', 'max:255']
        ],[
            'identificador.max' => 'El identificador solo puede tener 50 caracteres como maximo.',
            'enlace.max' => 'El enlace solo puede tener 255 caracteres como maximo.',
            'identificador.required' => 'El identificador es requerido.',
            'enlace.required' => 'El campo enlace en requerido.'
        ]);
        $errors = $validar->errors();
        return response()->json([
            'identificador' => $errors->first('identificador'),
            'enlace' => $errors->first('enlace')
        ]);
    }

    public function enlace_save(Request $request){
        $link = $request->get('txtenlace');
            $dentifier = $request->get('txtidentificador');
            $r1 = str_replace('https://','', (str_replace('www.','', (str_replace('web.','', $link)))));
            $r2 = str_replace('/',' ', str_replace('.', ' ', $r1));
            $r3 = explode(' ', $r2);
            $r4 = $r3[0];
            try {
                $query = Tipo_cuenta::where('nom_tipo_cuenta', $r4)->first();
                $idcuenta = $query->id;
            } catch (Exception $e) {
                $tpc = new Tipo_cuenta;
                $tpc->nom_tipo_cuenta = $r4;
                $tpc->save();
                $query = Tipo_cuenta::where('nom_tipo_cuenta', $r4)->first();
                $idcuenta = $query->id;
            }
            DB::beginTransaction();
            try {
                $enlace = new Enlace;
                $enlace->link = $link;
                $enlace->identificador = $dentifier;
                $enlace->pkcuenta = $idcuenta;
                $enlace->pkpersona = Auth::user()->personaUser->id;
                $enlace->save();
                DB::commit();
                return back();
            } catch (Exception $e) {
                return back();
            }
    }

    public function enlace_edit(Request $request){
        $id = $request->get('txtid_edit');
            $link = $request->get('txtedit-enlace');
            $dentifier = $request->get('txtedit-identificador');
            $r1 = str_replace('https://','', (str_replace('www.','', (str_replace('web.','', $link)))));
            $r2 = str_replace('/',' ', str_replace('.', ' ', $r1));
            $r3 = explode(' ', $r2);
            $r4 = $r3[0];
            try {
                $query = Tipo_cuenta::where('nom_tipo_cuenta', $r4)->first();
                $idcuenta = $query->id;
            } catch (Exception $e) {
                $tpc = new Tipo_cuenta;
                $tpc->nom_tipo_cuenta = $r4;
                $tpc->save();
                $query = Tipo_cuenta::where('nom_tipo_cuenta', $r4)->first();
                $idcuenta = $query->id;
            }
            DB::beginTransaction();
            try {
                $enlace = Enlace::find($id);
                $enlace->link = $link;
                $enlace->identificador = $dentifier;
                $enlace->pkcuenta = $idcuenta;
                $enlace->save();
                DB::commit();
                return back();
            } catch (Exception $e) {
                return back();
            }
    }

    public function enlase_delete($id){
        DB::beginTransaction();
        try {
            $enlace = Enlace::find($id);
            $enlace->delete();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return back();
        }
    }

    public function perfil_save(Request $request){
        DB::beginTransaction();
        try {
            if ($file = $request->file('file_perfil')){
                $file = $request->file_perfil;
                //$nombre = $file->getClientOriginalName();
                $date = date("YnjGis");
                $exten = $file->getClientOriginalExtension();
                $nombre = 'profile'.Auth::user()->id.'-'.$date.'.'.$exten;
                $file->move('images', $nombre);
            }

            if(Auth::user()->imagen_perfil != 'imagenblanco.png'){
                File::delete('images/'.Auth::user()->imagen_perfil);
            }
            $perfil = User::find(Auth::user()->id);
            $perfil->imagen_perfil = $nombre;
            $perfil->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return back();
        }
    }

    public function validar_persona(Request $request){
        $validar = Validator::make($request->all(), [
            'txtnombre' => ['required', 'string', 'max:255'],
            'txtapellido' => ['required', 'string', 'max:255'],
            'txtdireccion' => ['required', 'string', 'max:500'],
            'txtci' => ['required'],
            'txttelefono' => ['required','numeric'],
            'txtdate' => ['required'],
            'txtgenero' => ['required']
        ],[
            'txtnombre.required' => 'El nombre  es requerido.',
            'txtapellido.required' => 'El apellido  es requerido.',
            'txtdireccion.required' => 'La dirección  es requerido.',
            'txtci.required' => 'El CI  es requerido.',
            'txttelefono.required' => 'El Telefono  es requerido.',
            'txtdate.required' => 'La fecha de nacimiento  es requerido.',
            'txtgenero.required' => 'El sexo  es requerido.',
            'txtnombre.max' => 'El nombre no pude tener más de 255 caracteres.',
            'txtapellido.max' => 'El apellido no pude tener más de 255 caracteres.',
            'txtdireccion.max' => 'La dirección no pude tener más de 500 caracteres.',
            'txttelefono.numeric' => 'El nombre debe ser numerico.'
        ]);
        $errors = $validar->errors();
        return response()->json([
            'nombre' => $errors->first('txtnombre'),
            'apellido' => $errors->first('txtapellido'),
            'direccion' => $errors->first('txtdireccion'),
            'ci' => $errors->first('txtci'),
            'telefono' => $errors->first('txtelefono'),
            'date' => $errors->first('txtdate'),
            'genero' => $errors->first('txtgenero'),
        ]);
    }

    public function persona_update(Request $request){
        DB::beginTransaction();
        try {
            $persona = Persona::find(Auth::user()->personaUser->id);
            $persona->nom_persona = $request->get('txtnombre');
            $persona->apellido = $request->get('txtapellido');
            $persona->dir_persona = $request->get('txtdireccion');
            $persona->telefono = $request->get('txttelefono');
            $persona->CI = $request->get('txtci');
            $persona->genero_persona = $request->get('txtgenero');
            $persona->f_nac_persona = $request->get('txtdate');
            $persona->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return back();
        }
    }

    public function validar_empresa(Request $request){
        $validar = Validator::make($request->all(), [
            'txtrazonsocial' => ['required', 'string', 'max:255'],
            'txtemail' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id.',id'],
            'txtpassword' => ['min:8'],
            'txtdireccionemp' => ['required', 'string', 'max:500'],
            'txtdescripcion' => ['required', 'string', 'max:500'],
            'txtsigla' => ['required', 'string', 'max:10'],
            'txtnit' => ['required', 'string', 'max:10000000000000000000','numeric'],
        ],[
            'txtrazonsocial.required' => 'La razón social es requerida.',
            'txtemail.required' => 'El email es requerido.',
            'txtpassword.required' => 'La contraseña  es requerida.',
            'txtdireccionemp.required' => 'La dirección es requerida.',
            'txtdescripcion.required' => 'La descripción es requerida.',
            'txtsigla.required' => 'La sigla es requerida.',
            'txtnit.required' => 'El NIT es requerido.',
            'txtrazonsocial.max' => 'La razón social no pude tener más de 255 caracteres.',
            'txtemail.max' => 'El email no pude tener más de 255 caracteres.',
            'txtpassword.min' => 'La contraseña debe tener más de 8 caracteres.',
            'txtdireccionemp.max' => 'La dirección debe tener más de 500 caracteres.',
            'txtdescripcion.max' => 'La descripción no pude tener más de 500 caracteres.',
            'txtsigla.max' => 'La sigla no pude tener más de 10 caracteres.',
            'txtnit.max' => 'El NIT no pude tener más de 20 caracteres.',
            'txtnit.numeric' => 'El NIT debe ser numerico.'
        ]);
        $errors = $validar->errors();
        return response()->json([
            'razonsocial' => $errors->first('txtrazonsocial'),
            'email' => $errors->first('txtemail'),
            'password' => $errors->first('txtpassword'),
            'direccionemp' => $errors->first('txtdireccionemp'),
            'descripcion' => $errors->first('txtdescripcion'),
            'sigla' => $errors->first('txtsigla'),
            'nit' => $errors->first('txtnit')
        ]);
    }

    public function empresa_update(Request $request){
        DB::beginTransaction();
        try {
            $password = $request->get('txtpassword');
            if ($password == "**********") {
                $user = User::find(Auth::user()->id);
                $user->name = $request->get('txtrazonsocial');
                $user->email = $request->get('txtemail');
                $user->save();
            } else {
                $user = User::find(Auth::user()->id);
                $user->name = $request->get('txtrazonsocial');
                $user->email = $request->get('txtemail');
                $user->password = Hash::make($password);
                $user->save();
            }
            $empresa = Empresa::find(Auth::user()->personaUser->empresa->id);
            $empresa->razonsocial = $request->get('txtrazonsocial');
            $empresa->dir_empresa = $request->get('txtdireccionemp');
            $empresa->desc_empresa = $request->get('txtdescripcion');
            $empresa->sigla = $request->get('txtsigla');
            $empresa->nit = $request->get('txtnit');
            $empresa->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return back();
        }
    }


    public function validar_refugio(Request $request){
        $validar = Validator::make($request->all(), [
            'txtnomrefugio' => ['required', 'string', 'max:255'],
            'txtemail' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id.',id'],
            'txtpassword' => ['min:8'],
            'txtdireccionref' => ['required', 'string', 'max:500'],
            'txtdescripcion' => ['required', 'string', 'max:500'],
            'txtcapacidad' => ['required', 'max:100','numeric'],
        ],[
            'txtnomrefugio.required' => 'El nombre del refugio es requerido.',
            'txtemail.required' => 'El email es requerido.',
            'txtpassword.required' => 'La contraseña  es requerida.',
            'txtdireccionref.required' => 'La dirección es requerida.',
            'txtdescripcion.required' => 'La descripción es requerida.',
            'txtcapacidad.required' => 'La capacidad es requerido.',
            'txtnomrefugio.max' => 'La razón social no pude tener más de 255 caracteres.',
            'txtemail.max' => 'El email no pude tener más de 255 caracteres.',
            'txtpassword.min' => 'La contraseña debe tener más de 8 caracteres.',
            'txtdireccionref.max' => 'La dirección debe tener más de 500 caracteres.',
            'txtdescripcion.max' => 'La descripción no pude tener más de 500 caracteres.',
            'txtcapacidad.max' => 'La capacidad no pude ser más de 100.',
            'txtcapacidad.numeric' => 'La capacidad debe ser numerico.'
        ]);
        $errors = $validar->errors();
        return response()->json([
            'nomrefugio' => $errors->first('txtnomrefugio'),
            'email' => $errors->first('txtemail'),
            'password' => $errors->first('txtpassword'),
            'direccionref' => $errors->first('txtdireccionref'),
            'descripcion' => $errors->first('txtdescripcion'),
            'capacidad' => $errors->first('txtcapacidad')
        ]);
    }

    public function refugio_update(Request $request){
        DB::beginTransaction();
        try {
            $password = $request->get('txtpassword');
            if ($password == "**********") {
                $user = User::find(Auth::user()->id);
                $user->name = $request->get('txtnomrefugio');
                $user->email = $request->get('txtemail');
                $user->save();
            } else {
                $user = User::find(Auth::user()->id);
                $user->name = $request->get('txtnomrefugio');
                $user->email = $request->get('txtemail');
                $user->password = Hash::make($password);
                $user->save();
            }
            $refugio = Refugio::find(Auth::user()->personaUser->refugio->id);
            $refugio->nom_refugio = $request->get('txtnomrefugio');
            $refugio->dir_refugio = $request->get('txtdireccionref');
            $refugio->desc_refugio = $request->get('txtdescripcion');
            $refugio->capacidad = $request->get('txtcapacidad');
            $refugio->pktipo = $request->get('txttipo');
            $refugio->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return back();
        }
    }

}
