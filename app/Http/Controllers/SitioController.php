<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Abono;
use App\Solicitud;
use Carbon\Carbon;
use Mail;
use Alert;
use Jenssegers\Agent\Agent;

class SitioController extends Controller
{
   
    public function sitio(){
        $agent = new Agent();
        return view('welcome');
    }
    public function validarAbono(Request $request){
        $response = array();

        $data = $request->get('documento');
        $abono = Abono::where('dni','=',$data)->first();
        if(!empty($abono)){
            $response['status'] = 'success';
            $response['abono'] =  $abono;
        }else{
            $response['status'] = 'error';
            $response['msg'] =  'Registro no encontrado';
        }
        return $response;
    }
    public function registrar(Request $request){
        //return $request;
        $validar = Solicitud::where('cuit','=',$request->get('cuit'))->where('estado','=','SOLICITADO')->first();
        if(empty($validar)){
            $data = explode('-',$request->get('cuit'));
            $abono = Abono::where('dni','=',$data[1])->first();

            $format = 'd/m/Y';
            $date = Carbon::createFromFormat($format, $request->get('fecha_nacimiento'));

            $solicitud = (new Solicitud);
            $solicitud->fill($request->all());
            $solicitud->estado = 'SOLICITADO';
            $solicitud->tipo_abono = $abono->abono;
            $solicitud->fecha_nacimiento = $date;
            $solicitud->save();

            $solicitud->nro_solicitud = 'TS-'.(1000+$solicitud->id);
            $solicitud->update();
            
            alert()->success('Información','Se ha registrado la solicitud de Abono '.$solicitud->abono.' con el Nro de Solicitud '.$solicitud->tipo_abono);

            return redirect()->route('home');
        }else{

            return redirect()->route('home')->withInput($request->all());
        }

        


    }
    
}
