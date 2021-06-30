<?php

namespace App\Http\Controllers;

use App\Turno;
use App\DiaEspecial;
use App\Oficina;
use App\User;
use App\Parametro;
use App\OficinaAgendaDetalle;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Alert;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class TurnoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
    {
        $oficinas = Oficina::orderBy('denominacion','asc')->get();
        if ($request->ajax()) {
            $model = Turno::query(DB::table('turnos')->whereNull('deleted_at'))->with('oficina');
            if(Auth::user()->hasRoles(['user'])){
                $logged = User::find(Auth::id());
                $model->where("oficina_id", $logged->oficina_id);
            }
            $model->orderBy('turnos.created_at', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" >';
                        $btn = $btn.'<a href="turnos/'.$row->nro_turno.'/edit" class="btn btn-info btn-sm"> <i class="far fa-edit"></i> </a>';
                        $btn = $btn.'&nbsp;';
                        $btn = $btn.'<a href="turnos/confirmar/'.$row->nro_turno.'" class="btn btn-success btn-sm"><i class="far fa-check-square"></i></a>';
                        $btn = $btn.'&nbsp;';
                        $btn = $btn.'<a data-id="'.$row->nro_turno.'"  class="btn btn-lasheras btn-sm rechazarTurno"><i class="fas fa-ban"></i></a>';
                        $btn = $btn.'&nbsp;';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->nro_turno.'" data-original-title="Delete" class="btn btn-danger btn-sm eliminarTurno"><i class="fas fa-minus"></i></a>';
                        $btn = $btn.'</div>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('turnos.index', compact('oficinas'));
    }
    public function create()
    {
        $turno = (new Turno);
        $parametro = Parametro::where('id', '=', 1)->first();
        $oficinas = Oficina::orderby('denominacion')->get();
        return view('turnos.create', compact('turno','oficinas','parametro'));
    }
    public function store(Request $request)
    {
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha_turno'));

        $existe = DiaEspecial::where('fecha','=', $date->toDateString())->first();

        if(empty($existe)){
            $turno = (new Turno);
            $turno->fill($request->all());
            $turno->estado = 'PENDIENTE';
            $turno->fecha_turno = $date;
            $turno->save();
            $turno->nro_turno = 'TL-'.(1000+$turno->id);
            $turno->update();

            return redirect()->route('turnos.index');
        }else{
            toast('El día '.$date->toDateString().' no esta disponible porque es el '.$existe->descripcion,'danger');
            return back();
        }
    }
   
    public function confirmarTurno($nro)
    {
        $turno = Turno::where('nro_turno','=',$nro)->first();
        $turno->estado = 'CONFIRMADO';
        $turno->update();
        toast('El Turno '.$turno->nro_turno.' ha sido confirmado','info');
        return redirect()->route('turnos.index');
    }
    public function edit($nro)
    {
        $turno = Turno::where('nro_turno','=',$nro)->first();
        $parametro = Parametro::where('id', '=', 1)->first();
        $oficinas = Oficina::orderby('denominacion')->get();
        return view('turnos.edit', compact('turno','oficinas','parametro'));
    }
    public function update(Request $request, $id)
    {
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha_turno'));

        $existe = DiaEspecial::where('fecha','=', $date->toDateString())->first();
        if(empty($existe)){
            $turno = Turno::findOrFail($id);
            $turno->fill($request->all());
            $turno->fecha_turno = $date;
            $turno->update();
            toast('El Turno '.$turno->nro_turno.' ha sido actualizado con éxito','info');
            return redirect()->route('turnos.index');
        }else{
            toast('El día '.$date->toDateString().' no esta disponible porque es el '.$existe->descripcion,'danger');
            return back();
        }
    }
    public function destroy($nro_turno)
    {
        $turno = Turno::where('nro_turno','=',$nro_turno)->first();
        $turno->delete();

        $response = array();
        $response['status']='success';
        $response['msg']='El Turno  ha sido eliminado correctamente ';

        return $response;
    }
    public function searchByDocumento(Request $request){
        $filtro = $request->search;
        if(strlen($filtro) > 1){
            return Turno::select('id', 'documento')->whereRaw("documento LIKE '%".strtoupper($filtro)."%' AND deleted_at IS NULL ORDER BY id,documento")->get();
        }
    }
    public function searchByNumero(Request $request){
        $filtro = $request->search;
        if(strlen($filtro) > 1){
            return Turno::select('id', 'nro_turno')->whereRaw("nro_turno LIKE '%".strtoupper($filtro)."%' AND deleted_at IS NULL ORDER BY id,nro_turno")->get();
        }
    }
    public function rechazarTurno(Request $request, $nro_turno){
        $response = array();
        $turno = Turno::where('nro_turno','=',$nro_turno)->first();
        if($turno->estado == 'CONFIRMADO'){
            $response['status']='error';
            $response['msg']='El estado actual del Turno es CONFIRMADO por lo tanto el mismo no puede ser RECHAZADO';
        }else if($turno->estado == 'COMPLETADO'){
            $response['status']='error';
            $response['msg']='El estado actual del Turno es COMPLETADO por lo tanto el mismo no puede ser RECHAZADO';
        }else if($turno->estado == 'VENCIDO'){
            $response['status']='error';
            $response['msg']='El estado actual del Turno es VENCIDO por lo tanto el mismo no puede ser RECHAZADO';
        }else if($turno->estado == 'RECHAZADO'){
            $response['status']='error';
            $response['msg']='El Turno ya se encuentra RECHAZADO';
        }else{
            $turno->estado = 'RECHAZADO';
            $turno->observacion = $request->observacion;
            $turno->update();

            $response['status']='success';
            $response['msg']='El Turno ha sido RECHAZADO con éxito';
        }
        return $response;
    }
    /*public function generarReporte(Request $request){
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha_desde'));
        $dateFin = Carbon::createFromFormat($format, $request->get('fecha_hasta'));
        return Excel::download(new ExportTurnos($date,$dateFin,$request->get('oficina_id')), 'turnos-'. Carbon::now().'.xlsx',null,[\Maatwebsite\Excel\Excel::XLSX]);
    }*/
    public function reprogramarTurno($nro_turno){
        $response = array();
        $turno = Turno::where('nro_turno','=',$nro_turno)->first();
        if($turno->estado == "PENDIENTE"){
            $response["status"] = "success";
            $response["turno"] = $turno;
            $response["disponibles"] = $this->diasDisponibles($turno->oficina_id);
            return $response;
        }else{
            $response["status"] = "error";
            $response["msg"] = "Sólo puede reprogramar turnos que se encuentren en estado Pendiente";
        }
        
    }

    public function diasDisponibles($oficina){
        $response = array();
        $oficinas = DB::table('oficinas')
            ->join('tipo_tramite_agendas', 'oficinas.id', '=', 'tipo_tramite_agendas.oficina_id')
            ->select('tipo_tramite_agendas.id')
            ->where('oficinas.visibilidad_web', '=', 1)
            ->where('oficinas.id', '=', $oficina)
            ->get();

        $agendas_id = collect();
        foreach($oficinas as $item){
            $agendas_id->push($item->id);
        }

        //Obtengo todos los dias disponibles de acuerdo al tipo de tramite
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
        $tipo =  $request->get('tramite');
        $listado = collect();
        if($request->get("fecha_turno")){
            $oficinas = DB::table('oficinas')
            ->join('tipo_tramite_agendas', 'oficinas.id', '=', 'tipo_tramite_agendas.oficina_id')
            ->select('tipo_tramite_agendas.id')
            ->where('oficinas.visibilidad_web', '=', 1)
            ->where('oficinas.id', '=', $tipo)
            ->get();

            $agendas_id = collect();
            $detallesAgenda = collect();
            foreach($oficinas as $item){
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

    public function confirmarReprogramacion($nro_turno, Request $request){
        $response = array();
        $turno = Turno::where('nro_turno','=',$nro_turno)->first();
        if($turno->estado == "PENDIENTE"){
            $turno->hora_turno = $request->get("horario"); 
            $turno->fecha_turno = $request->get("fecha"); 
            $turno->update();

            $response["status"] = "success";
            $response["msg"] = "Turno actualizado";
            return $response;
        }else{
            $response["status"] = "error";
            $response["msg"] = "Solo puede reprogramar turnos que se encuentren en estado Pendiente";
        }
    }
        
}
