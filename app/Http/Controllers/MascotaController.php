<?php

namespace App\Http\Controllers;

use App\Estado_mascota;
use App\Galeria_mascota;
use App\Historial_mascota;
use App\Mascota;
use App\Raza;
use App\Rescate;
use App\Size_pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Facades\Crypt;


class MascotaController extends Controller
{
    public function mascota_view(){
        $sizes = Size_pet::all();
        $mascotas = Galeria_mascota::where('prioridad', '0')->get();
        $estado_adopcion = DB::table('mascotas')
        ->join('estado_mascotas', 'mascotas.pkestado', '=', 'estado_mascotas.id')
        ->select('estado_mascotas.*',DB::raw('count(*) as estado, pkestado'))
        ->groupBy('pkestado')->get();
        $tipo_refugio = Auth::user()->personaUser->refugio->refugiotipo->tipo_refugio;
        return view('view_refugio.mascota', compact('sizes','tipo_refugio','mascotas','estado_adopcion'));
    }

    public function raza_search(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $class = $request->get('class');
            $data = DB::table('razas')
                ->where([['nom_raza', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu col-12" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 caja-'.$class.'" id="' . $row->id . '"><a href="#" style="color: #1b1e21" class="dropdown-item">' . $row->nom_raza . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function size_search(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $sizes = Size_pet::where('especie',$query)->get();
            $output = ' ';
            foreach ($sizes as $size) {
                $output .= '<option value="' . $size->id . '">' . $size->size . '</option>';
            }
            echo $output;
        }
    }

    public function persona_search(Request $request){
        if ($request->get('query')) {
            $query = $request->get('query');
            $clase = $request->get('class');
            $data = DB::table('personas')
                ->where([['CI', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu col-12" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 responsable_'.$clase.'" id="' . $row->id . '"><a href="#" style="color: #1b1e21" class="dropdown-item">'.$row->CI.' - '.$row->nom_persona.' '.$row->apellido. '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function validar_mascota(Request $request){
        $validar = Validator::make($request->all(), [
            'txtnombre' => ['required'],
            'txtdate' => ['required', 'date'],
            'txtespecie' => ['required'],
            'txtpeso' => ['required', 'numeric'],
            'txtidraza' => ['required', 'numeric'],
            'txtindicacion' => ['max:500'],
            'txtdetalle' => ['max:500'],

        ],[
            'txtnombre.required' => 'El nombre de la mascota es requerida.',
            'txtdate.required' => 'La fecha de nacimiento es requerida.',
            'txtespecie.required' => 'La especie es requerida.',
            'txtpeso.required' => 'El peso es requerido.',
            'txtidraza.required' => 'Dato basio o invalido debe escojer una opcion de la lista.',
            'txtindicacion.max' => 'Este campo no puede tener más de 500 caracteres.',
            'txtdetalle.max' => 'Este campo no puede tener más de 500 caracteres.'
        ]);
        $errors = $validar->errors();
        return response()->json([
            'nombre' => $errors->first('txtnombre'),
            'date' => $errors->first('txtdate'),
            'especie' => $errors->first('txtespecie'),
            'peso' => $errors->first('txtpeso'),
            'idraza' => $errors->first('txtidraza'),
            'recomendacion' => $errors->first('txtindicacion'),
            'detalles' => $errors->first('txtdetalle')
        ]);
    }

    public function validar_rescate(Request $request){
        $validar = Validator::make($request->all(), [
            'txtnombre_rescate' => ['required'],
            'txtdate_rescate' => ['required', 'date'],
            'txtespecie_rescate' => ['required'],
            'txtpeso_rescate' => ['required', 'numeric'],
            'txtidraza_rescate' => ['required', 'numeric'],
            'txtfecha_rescate' => ['required', 'date'],
            'txtlugar_rescate' => ['required'],
            'txtsalud' => ['max:500'],
            'txthistoria' => ['max:500'],

        ],[
            'txtnombre_rescate.required' => 'El nombre de la mascota es requerida.',
            'txtdate_rescate.required' => 'La fecha de nacimiento es requerida.',
            'txtespecie_rescate.required' => 'La especie es requerida.',
            'txtpeso_rescate.required' => 'El peso es requerido.',
            'txtidraza_rescate.required' => 'Dato basio o invalido debe escojer una opcion de la lista.',
            'txtfecha_rescate.required' => 'La fecha es requerida.',
            'txtlugar_rescate.required' => 'El Lugar es requerido.',
            'txtsalud.max' => 'Este campo no puede tener más de 500 caracteres.',
            'txthistoria.max' => 'Este campo no puede tener más de 500 caracteres.'
            ]);
        $errors = $validar->errors();
        return response()->json([
            'nombre' => $errors->first('txtnombre_rescate'),
            'date' => $errors->first('txtdate_rescate'),
            'especie' => $errors->first('txtespecie_rescate'),
            'peso' => $errors->first('txtpeso_rescate'),
            'idraza' => $errors->first('txtidraza_rescate'),
            'fecharescate' => $errors->first('txtfecha_rescate'),
            'lugarescate' => $errors->first('txtlugar_rescate'),
            'salud' => $errors->first('txtsalud'),
            'historia' => $errors->first('txthistoria')
        ]);
    }

    public function mascota_save(Request $request){
        DB::beginTransaction();
        try {
            $mascota = new Mascota;
            $mascota->nom_mascota = $request->get('txtnombre');
            $mascota->indicacion_cuidado = $request->get('txtindicacion');
            $mascota->f_nacimiento = $request->get('txtdate');
            $mascota->genero = $request->get('txtsexo');
            $mascota->especie = $request->get('txtespecie');
            $mascota->pksize = $request->get('txtsize_add');
            $mascota->peso = $request->get('txtpeso');
            $mascota->desc_mascota = $request->get('txtdetalle');
            $mascota->pkestado = 1;
            $mascota->pkraza = $request->get('txtidraza');
            $mascota->pkrefugio = Auth::user()->personaUser->refugio->id;
            $mascota->pkresponsable = $request->get('txtid_responsable_persona');
            $mascota->save();

            $especie = $request->get('txtespecie');
            if ($file = $request->file('txtperfil')){
                $file = $request->txtperfil;
                $date = date("YnjGis");
                $exten = $file->getClientOriginalExtension();
                $nombre = 'file'.Auth::user()->personaUser->refugio->id.'-'.$date.'.'.$exten;
                $file->move('images', $nombre);
            }else{
                $nombre= "perfil".$especie.".png";
            }
            $G_mascota = new Galeria_mascota();
            $G_mascota->img_mascota = $nombre;
            $G_mascota->prioridad = 0;
            $G_mascota->pkmascota = $mascota->id;
            $G_mascota->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function rescate_save(Request $request){
        DB::beginTransaction();
        try {
            $mascota = new Mascota;
            $mascota->nom_mascota = $request->get('txtnombre_rescate');
            $mascota->f_nacimiento = $request->get('txtdate_rescate');
            $mascota->genero = $request->get('txtsexo_rescate');
            $mascota->especie = $request->get('txtespecie_rescate');
            $mascota->pksize = $request->get('txtsize_recate');
            $mascota->peso = $request->get('txtpeso_rescate');
            $mascota->pkestado = 1;
            $mascota->pkraza = $request->get('txtidraza_rescate');
            $mascota->pkrefugio = Auth::user()->personaUser->refugio->id;
            $mascota->pkresponsable = $request->get('txtid_responsable_rescate');
            $mascota->save();

            $rescate = new Rescate;
            $rescate->peso_rescatado = $request->get('txtpeso_rescate');
            $rescate->f_rescate = $request->get('txtfecha_rescate');
            $rescate->lugar_rescate = $request->get('txtlugar_rescate');
            $rescate->detalle_salud = $request->get('txtsalud');
            $rescate->detalle_rescate = $request->get('txthistoria');
            $rescate->pkmascota = $mascota->id;
            $rescate->save();

            $especie = $request->get('txtespecie_rescate');
            $nombre= "perfil".$especie.".png";

            $G_mascota = new Galeria_mascota();
            $G_mascota->img_mascota = $nombre;
            $G_mascota->prioridad = 0;
            $G_mascota->pkmascota = $mascota->id;
            $G_mascota->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function info_complete($ids){
        $id = Crypt::decrypt($ids);
        $sizes = Size_pet::all();
        $pet = Mascota::where('id', $id)->first();
        if($proseso_actual = Estado_mascota::where('id', ($pet->pkestado+1))->first()){
            $proceso = $proseso_actual->nom_estado_mascota;
        }else{
            $proceso = 'reinicio de procedimientos';
        }
        $mascotas = DB::select('select
        m.f_nacimiento as fechanacimiento,
            TIMESTAMPDIFF( YEAR,m.f_nacimiento, now()) as year,
            TIMESTAMPDIFF( MONTH,m.f_nacimiento, now())%12 as month,
            FLOOR( TIMESTAMPDIFF( DAY,m.f_nacimiento, now())% 30.4375)as day
            from mascotas m
            where m.id = ?', [$id]);
        $portada = Galeria_mascota::where([['prioridad', '0'],['pkmascota', $id]])->first();
        $fotos = Galeria_mascota::where('pkmascota', $id)->get();
        $historias = Historial_mascota::where('pkmascota', $id)->get();
        $rescates = Rescate::where('pkmascota', $id)->get();
        return view('view_refugio.info', compact('mascotas','pet','portada','fotos','sizes','historias','proceso','rescates'));
    }

    public function mascota_edit(Request $request){
        DB::beginTransaction();
        try {
            $mascota = Mascota::find($request->get('idmascota'));
            $mascota->nom_mascota = $request->get('txtnombre');
            $mascota->indicacion_cuidado = $request->get('txtindicacion');
            $mascota->f_nacimiento = $request->get('txtdate');
            $mascota->genero = $request->get('txtsexo');
            $mascota->especie = $request->get('txtespecie');
            $mascota->pksize = $request->get('txtsize');
            $mascota->peso = $request->get('txtpeso');
            $mascota->desc_mascota = $request->get('txtdetalle');
            $mascota->pkraza = $request->get('txtidraza');
            $mascota->save();
            $portada = Galeria_mascota::where([['prioridad', '0'],['pkmascota', $request->get('idmascota')]])->first();
            if ($file = $request->file('txtperfil')){
                if($portada->img_mascota == 'perfilGatos.png' || $portada->img_mascota == 'perfilPerros.png'){
                    $file = $request->txtperfil;
                    $date = date("YnjGis");
                    $exten = $file->getClientOriginalExtension();
                    $nombre = 'file'.Auth::user()->personaUser->refugio->id.'-'.$date.'.'.$exten;
                    $file->move('images', $nombre);
                }else{
                    $file = $request->txtperfil;
                    //$nombre = $file->getClientOriginalName();
                    $date = date("YnjGis");
                    $exten = $file->getClientOriginalExtension();
                    $nombre = 'file'.Auth::user()->personaUser->refugio->id.'-'.$date.'.'.$exten;
                    $file->move('images', $nombre);
                    File::delete('images/'.$portada->img_mascota);
                }
            }else{
                $nombre= $portada->img_mascota;
            }
            $G_mascota = Galeria_mascota::find($portada->id);
            $G_mascota->img_mascota = $nombre;
            $G_mascota->save();

            DB::commit();
            return back();
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function mascota_historial_save(Request $request){
        DB::beginTransaction();
        try {
            $historia = new Historial_mascota;
            $historia->desc_historial_mascota = $request->get('historial');
            $historia->pkmascota = $request->get('idmascota');
            $historia->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function mascota_historial_edit(Request $request){
        DB::beginTransaction();
        try {
            $historia = Historial_mascota::find($request->get('idhistorial'));
            $historia->desc_historial_mascota = $request->get('edit_historial');
            $historia->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return redirect('/');
        }
    }
    public function mascota_historial_delete($ids){
        DB::beginTransaction();
        try {
            $historia = Historial_mascota::find($ids);
            $historia->delete();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function gallery_save(Request $request){
        DB::beginTransaction();
        try {
            if ($file = $request->file('txtgaleria')){
                $file = $request->txtgaleria;
                $date = date("YnjGis");
                $exten = $file->getClientOriginalExtension();
                $nombre = 'pet-gallery'.Auth::user()->personaUser->refugio->id.'-'.$date.'.'.$exten;
                $file->move('images', $nombre);
            }
            $galeria = new Galeria_mascota;
            $galeria->img_mascota = $nombre;
            $galeria->prioridad = '1';
            $galeria->pkmascota = $request->get('pkmascota');
            $galeria->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return redirect('/');
        }
    }
    public function gallery_delete($ids){
        DB::beginTransaction();
        try {
            $galeria = Galeria_mascota::find($ids);
            $galeria->delete();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return redirect('/');
        }
    }
    public function process_next($ids){
        DB::beginTransaction();
        try {
            $idestado = Mascota::where('id', $ids)->first();
            if($proseso_actual = Estado_mascota::where('id', ($idestado->pkestado+1))->first()){
                $proceso = $proseso_actual->id;
            }else{
                $idest = Estado_mascota::min('id');
                $proceso = $idest;
            }
            $mascota = Mascota::find($ids);
            $mascota->pkestado = $proceso;
            $mascota->save();
            DB::commit();
            return back();
        } catch (Exception $e) {
            return redirect('/');
        }
    }
}
