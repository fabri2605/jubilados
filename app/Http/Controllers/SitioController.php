<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Abono;
use App\Enviado;
use App\OficinaAgendaDetalle;
use App\EnviadoSanRafael;
use App\Solicitud;
use App\Oficina;
use App\DiaEspecial;
use App\Turno;
use App\SolicitudSanRafael;
use Carbon\Carbon;
use Mail;
use Alert;
use Jenssegers\Agent\Agent;
use Carbon\CarbonPeriod;
use DB;

class SitioController extends Controller
{
   
    public function sitio(){
        $agent = new Agent();
        return view('welcome');
    }
    public function turno(){
        $agent = new Agent();
        return view('turno');
    }
    public function particulares(){
        $agent = new Agent();
        return view('particulares');
    }
    //sanrafael
    public function sanrafael(){
        $agent = new Agent();
        return view('sanrafael');
    }
    public function landing(){
        $agent = new Agent();
        return view('inicio');
    }
    public function landingSR(){
        $agent = new Agent();
        //return view('inicio_sanrafael');
        return view('waiting');
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
    public function validarAbonoParticularSanRafael(Request $request){
        $response = array();

        $data = $request->get('documento');
        /*$abono = Abono::where('dni','=',$data)->first();
        if(!empty($abono)){
            $response['status'] = 'error';
            $response['msg'] =  'Ud. está Registrado como Beneficiario Jubiliado, Mayor de 70 años o Discapacidad, para solicitar el envio de su Tarjeta Ingrese en el Menu Principal a Abono Jubiliados';
            return $response;
        }*/
        $validar = Solicitud::where('dni','=',$request->get('documento'))->where('estado','=','SOLICITADO')->first();
        if(!empty($validar)){
            $response['status'] = 'error';
            $response['msg'] =  'Ud. ya tiene una solicitud con el DNI ingresado';
            return $response;
        }
        $enviado = EnviadoSanRafael::where('documento','=',$request->get('documento'))->first();
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
    public function registrarParticularSanRafael(Request $request){
        $validar = SolicitudSanRafael::where('cuit','=',$request->get('cuit'))->where('estado','=','SOLICITADO')->first();
        if(empty($validar)){
            $data = explode('-',$request->get('cuit'));
            $format = 'd/m/Y';
            $date = Carbon::createFromFormat($format, $request->get('fecha_nacimiento'));

            $solicitud = (new SolicitudSanRafael);
            $solicitud->fill($request->all());
            $solicitud->nombre = ucfirst($request->get('nombre'));
            $solicitud->apellido = ucfirst($request->get('apellido'));
            $solicitud->calle = ucfirst($request->get('calle'));
            $solicitud->estado = 'SOLICITADO';
            $solicitud->tipo_abono = 'PARTICULARES';
            $solicitud->fecha_nacimiento = $date;
            $solicitud->fecha_solicitud = Carbon::now();
            $solicitud->save();

            $solicitud->nro_solicitud = 'TS-'.(1000+$solicitud->id);
            $solicitud->update();
            
            alert()->success('Información','Se ha registrado la solicitud con el Nro de Solicitud '.$solicitud->nro_solicitud);
            return redirect()->route('sanrafael')->with('message', 'Se ha registrado la solicitud con el Nro de Solicitud '.$solicitud->tipo_abono);
        }else{
            alert()->success('Información','Ya se encuentra una solicitud pendiente con CUIL del solicitante');
            return redirect()->route('sanrafael')->withInput($request->all());
        }
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


    // ACA VA LO DE TURNOS

    public function obtenerOficinasXLocalidad(Request $request){
        $response = array();
        $oficinas = Oficina::select('id', "denominacion", "lat", "lng")
                    ->where("localidad", $request->get("localidad"))
                    ->where("visibilidad_web", 1)
                    ->orderBy("denominacion", "asc")
                    ->get();

        if(!$oficinas){
            $response['status'] = 'error';
            $response['data'] = 'nodata';
            $response['msg'] = 'No hay oficinas disponibles';
            return $response;
        }
        $response['status'] = 'success';
        $response['data'] = $oficinas;
        return $response;
    }

    public function diasEspeciales(){
        $especiales = DiaEspecial::select('fecha')->whereDate('fecha', ">=", Carbon::now())->get();
        $response = array();
        foreach($especiales as $item){
            array_push($response, $item->fecha);
        }
        return response()->json($response);
    }

    public function diasDisponibles(Request $request){
        $response = array();
        $tramites = DB::table('oficinas')
            ->join('oficina_agendas', 'oficinas.id', '=', 'oficina_agendas.oficina_id')
            ->select('oficina_agendas.id')
            ->where('oficinas.visibilidad_web', '=', 1)
            ->where('oficinas.id', '=', $request->get('oficina'))
            ->get();

        $agendas_id = collect();
        foreach($tramites as $item){
            $agendas_id->push($item->id);
        }

        
        //Obtengo todos los dias disponibles de acuerdo al tipo de oficina
        $today = Carbon::now()->startOfDay();
        $detallesAgenda = OficinaAgendaDetalle::select("fecha_inicio", "fecha_fin","cantidad_turnos", "cantidad_turnos_tarde","dia_semana")
                                                  ->whereDate('fecha_fin', '>=', $today)
                                                  ->whereIn('oficina_agenda_id',$agendas_id )
                                                  ->get();

        $rangos = collect();
        
        foreach($detallesAgenda as $item){
            $period = CarbonPeriod::create(Carbon::parse($item->fecha_inicio)->format('d-m-Y'),Carbon::parse($item->fecha_fin)->format('d-m-Y'));
            foreach($period as $date){
                if($date->gte($today)){
                    //verifico dia habil
                    if($date->dayOfWeek != Carbon::SUNDAY && $date->dayOfWeek != Carbon::SATURDAY){
                        $rangos->push($date->format('Y-m-d'));
                    }
                }
            }
        }

        $unicos = $rangos->unique();
        $listadoDisponibles = collect();

        //Por cada día si hay disponibilidad
        foreach($unicos as $item){
            $diaIterado = Carbon::createFromFormat('Y-m-d', $item);
            $otorgados =Turno::select('id')
                 ->whereDate('fecha_turno', '=', $diaIterado)
                 ->where('estado', '!=', 'RECHAZADO')
                 ->where('estado', '!=', 'PREVIO')
                 ->whereIn('oficina_id',$agendas_id)->count();

            $cantidad = 0;
            $cantidadAgendas = count($agendas_id);
            foreach($detallesAgenda as $detalle){
                if($detalle->dia_semana == $diaIterado->dayOfWeek){
                    $cantidad+=($detalle->cantidad_turnos+$detalle->cantidad_turnos_tarde);
                    $cantidadAgendas--;
                    /*if($diaIterado->toDateString() == '2021-03-19')
                        dd($diaIterado->toDateString(),$cantidad, $otorgados, $detalle);*/
                    if($cantidad == 0)
                        break;
                }
            }
           
            if($cantidad > $otorgados && !($cantidad == $otorgados)){
                $listadoDisponibles->push($item);
            }
        }
        
        return $listadoDisponibles;
    }

    public function horariosDia(Request $request){
        $tipo =  $request->get('oficina');
        $listado = collect();
        if($request->get("fecha_turno")){
            $tramites = DB::table('oficinas')
            ->join('oficina_agendas', 'oficinas.id', '=', 'oficina_agendas.oficina_id')
            ->select('oficina_agendas.id')
            ->where('oficinas.visibilidad_web', '=', 1)
            ->where('oficinas.id', '=', $tipo)
            ->get();

            $agendas_id = collect();
            $detallesAgenda = collect();
            foreach($tramites as $item){
                $agendas_id->push($item->id);
            }
            
            $diaSeleccionado = Carbon::createFromFormat('Y-m-d', $request->get("fecha_turno"));

            $detallesAgenda = OficinaAgendaDetalle::select("fecha_inicio", "fecha_fin","cantidad_turnos", 
                                                                "cantidad_turnos_tarde","dia_semana",
                                                                "hora_inicio", "hora_fin","hora_inicio_tarde","hora_fin_tarde")
                                                  ->where('dia_semana', '>=', $diaSeleccionado->dayOfWeek)
                                                  ->whereDate('fecha_fin', '>=', $diaSeleccionado)
                                                  ->whereIn('oficina_agenda_id',$agendas_id )
                                                  ->get();
            $otorgados =Turno::select('id')
                 ->whereDate('fecha_turno', '=', $diaSeleccionado)
                 ->where('estado', '!=', 'RECHAZADO')
                 ->where('estado', '!=', 'PREVIO')
                 ->whereIn('oficina_id',$agendas_id)->count();
            
                        
            $cantidad = 0;
            $detallesInvolucrados = collect();
            foreach($detallesAgenda as $detalle){
                $cantidad+=($detalle->cantidad_turnos+$detalle->cantidad_turnos_tarde);
            }
            if($cantidad > $otorgados){
                $horariosDisponibles = collect();
                $horariosNoDisponibles = collect();
                foreach($detallesAgenda as $det){
                    if($det->cantidad_turnos > 0){
                        $inicio = new Carbon(strval($diaSeleccionado->toDateString().' '.$det->hora_inicio));
                        $fin = new Carbon(strval($diaSeleccionado->toDateString().' '.$det->hora_fin));
                        $minutos = $inicio->diffInMinutes($fin);

                        
                        $calculo = 0;
                        $calculo = intval($minutos/$det->cantidad_turnos);
                        while($inicio->lt($fin)){
                            $horariosDisponibles->push($inicio->toTimeString());
                            $inicio->addMinutes($calculo);
                        }
                        $horariosDisponibles->push($fin->toTimeString());
                    }
                    if($det->cantidad_turnos_tarde > 0){
                        $inicio_tarde = new Carbon(strval($diaSeleccionado->toDateString().' '.$det->hora_inicio_tarde));
                        $fin_tarde = new Carbon(strval($diaSeleccionado->toDateString().' '.$det->hora_fin_tarde));
                        $minutos_tarde = $inicio_tarde->diffInMinutes($fin_tarde);
                        
                        $calculo_tarde = intval($minutos_tarde/$det->cantidad_turnos_tarde);

                        while($inicio_tarde->lt($fin_tarde)){
                            $horariosDisponibles->push($inicio_tarde->toTimeString());
                            $inicio_tarde->addMinutes($calculo_tarde);
                        }
                        $horariosDisponibles->push($fin_tarde->toTimeString());
                    }
                    $turnos_otorgados = Turno::select('hora_turno')->where('fecha_turno','=',$diaSeleccionado->toDateString())
                                                    ->where('estado','!=','RECHAZADO')
                                                    ->where('estado', '!=', 'PREVIO')
                                                    ->whereIn('oficina_id',$agendas_id)
                                                    ->whereIn('hora_turno',$horariosDisponibles)
                                                    ->get();
                    
                    foreach($turnos_otorgados as $item){
                        $horariosNoDisponibles->push( $item->hora_turno);
                    }
                   
                }
                $turnosDisponibles = $horariosDisponibles->diff($horariosNoDisponibles);
                $listado = $turnosDisponibles->unique();
            }
        }
        return $listado;
    }
}
