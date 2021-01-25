<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Abono;
use App\Enviado;
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
    public function particulares(){
        $agent = new Agent();
        return view('particulares');
    }
    public function landing(){
        $agent = new Agent();
        return view('inicio');
    }
    public function retirala(){
        $agent = new Agent();
        return view('retirala');
    }
    public function validarAbono(Request $request){
        $response = array();

        $data = $request->get('documento');
        $abono = Abono::where('dni','=',$data)->first();
        if(!empty($abono)){
            $response['status'] = 'success';
            $response['abono'] =  $abono->abono;
            $response['msg'] =  'Ústed esta solicitando el abono por "'.$abono->abono.'"';
        }else{
            $response['status'] = 'error';
            $response['msg'] =  'Ud. No está Registrado como Beneficiario Jubilado o Mayores de 70 años o Discapacidad o Ley 7811.Para solicitar por primera vez su tarjeta, solicitarla a través de la App 148 Mendoza.';
        }

        $validar = Solicitud::where('dni','=',$request->get('documento'))->where('estado','=','SOLICITADO')->first();
        if(!empty($validar)){
            $response['status'] = 'error';
            $response['msg'] =  'Ud. ya tiene una solicitud con el DNI ingresado';
        }
        
        return $response;
    }

    public function validarAbonoParticular(Request $request){
        $response = array();

        $data = $request->get('documento');
        $abono = Abono::where('dni','=',$data)->first();
        if(!empty($abono)){
            $response['status'] = 'error';
            $response['msg'] =  'Ud. está Registrado como Beneficiario Jubiliado, Mayor de 70 años o Discapacidad, para solicitar el envio de su Tarjeta Ingrese en el Menu Principal a Abono Jubiliados';
            return $response;
        }
        $validar = Solicitud::where('dni','=',$request->get('documento'))->where('estado','=','SOLICITADO')->first();
        if(!empty($validar)){
            $response['status'] = 'error';
            $response['msg'] =  'Ud. ya tiene una solicitud con el DNI ingresado';
            return $response;
        }
        $enviado = Enviado::where('documento','=',$request->get('documento'))->first();
        if(!empty($enviado)){
            $response['status'] = 'error';
            $response['msg'] =  'Ya ha sido enviada su Tarjeta SUBE anteriormente ';
            return $response;
            
        }
        $response['status'] = 'success';
        $response['tipo_abono'] = 'Resto';
        return $response;
    }
    public function registrar(Request $request){
        //return $request;
        //if($this->validarCuit($requesst->get('cuit'))){
            $validar = Solicitud::where('cuit','=',$request->get('cuit'))->where('estado','=','SOLICITADO')->first();
            if(empty($validar)){
                $data = explode('-',$request->get('cuit'));
                $abono = Abono::where('dni','=',$request->get('dni'))->first();
                $format = 'd/m/Y';
                $date = Carbon::createFromFormat($format, $request->get('fecha_nacimiento'));

                $solicitud = (new Solicitud);
                $solicitud->fill($request->all());
                $solicitud->nombre = ucfirst($request->get('nombre'));
                $solicitud->apellido = ucfirst($request->get('apellido'));
                $solicitud->calle = ucfirst($request->get('calle'));
                $solicitud->localidad = ucfirst($request->get('localidad'));
                $solicitud->estado = 'SOLICITADO';
                $solicitud->tipo_abono = $abono->abono;
                $solicitud->fecha_nacimiento = $date;
                $solicitud->fecha_solicitud = Carbon::now();
                $solicitud->save();

                $solicitud->nro_solicitud = 'TS-'.(1000+$solicitud->id);
                $solicitud->update();
                
                alert()->success('Información','Se ha registrado la solicitud de Abono '.$solicitud->abono.' con el Nro de Solicitud '.$solicitud->nro_solicitud);
                return redirect()->route('home')->with('message', 'Se ha registrado la solicitud de Abono '.$solicitud->abono.' con el Nro de Solicitud '.$solicitud->tipo_abono);
            }else{
                alert()->success('Información','Ya se encuentra una solicitud pendiente con CUIL del solicitante');
                return redirect()->route('home')->withInput($request->all());
            }
       /* }else{
            alert()->error('Importante','El CUIL ingresado no es válido');
        }*/
    }
    public function registrarParticular(Request $request){
        //return $request;
        //if($this->validarCuit($requesst->get('cuit'))){
            $validar = Solicitud::where('cuit','=',$request->get('cuit'))->where('estado','=','SOLICITADO')->first();
            if(empty($validar)){
                $data = explode('-',$request->get('cuit'));
                $format = 'd/m/Y';
                $date = Carbon::createFromFormat($format, $request->get('fecha_nacimiento'));

                $solicitud = (new Solicitud);
                $solicitud->fill($request->all());
                $solicitud->nombre = ucfirst($request->get('nombre'));
                $solicitud->apellido = ucfirst($request->get('apellido'));
                $solicitud->calle = ucfirst($request->get('calle'));
                $solicitud->localidad = ucfirst($request->get('localidad'));
                $solicitud->estado = 'SOLICITADO';
                $solicitud->tipo_abono = 'PARTICULARES';
                $solicitud->fecha_nacimiento = $date;
                $solicitud->fecha_solicitud = Carbon::now();
                $solicitud->save();

                $solicitud->nro_solicitud = 'TS-'.(1000+$solicitud->id);
                $solicitud->update();
                
                alert()->success('Información','Se ha registrado la solicitud con el Nro de Solicitud '.$solicitud->nro_solicitud);
                return redirect()->route('home')->with('message', 'Se ha registrado la solicitud con el Nro de Solicitud '.$solicitud->tipo_abono);
            }else{
                alert()->success('Información','Ya se encuentra una solicitud pendiente con CUIL del solicitante');
                return redirect()->route('home')->withInput($request->all());
            }
       /* }else{
            alert()->error('Importante','El CUIL ingresado no es válido');
        }*/
    }
    public function validarCuit($cuit){
		if (strlen($cuit) != 13) return false;
		$rv = false;
		$resultado = 0;
		$cuit_nro = str_replace("-", "", $cuit);
		
		$codes = "6789456789";
		$cuit_long = intVal($cuit_nro);
		$verificador = intVal($cuit_nro[strlen($cuit_nro)-1]);
        
		$x = 0;
		while ($x < 10)
		{
			$digitoValidador = intVal(substr($codes, $x, 1));
			$digito = intVal(substr($cuit_nro, $x, 1));
			$digitoValidacion = $digitoValidador * $digito;
			$resultado += $digitoValidacion;
			$x++;
		}
		$resultado = intVal($resultado) % 11;
		$rv = $resultado == $verificador;
		return $rv;
	}
    
}
