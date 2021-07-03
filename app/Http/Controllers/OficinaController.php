<?php

namespace App\Http\Controllers;
use DB;
use App\Oficina;
use App\OficinaAgenda;
use App\OficinaAgendaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class OficinaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
     {  
	    if ($request->ajax()) {
            $model = Oficina::query(DB::table('oficinas'))->orderBy('oficinas.denominacion', 'asc');
            return DataTables::eloquent($model)
                ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" >';
                        $btn = $btn.'<a href="oficina/'.$row->id.'/edit" class="btn btn-info btn-sm"> <i class="far fa-edit"></i> </a>';
                        $btn = $btn.'&nbsp;';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm eliminarOficina"><i class="fas fa-minus"></i></a>';
                        $btn = $btn.'</div>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('oficina.index');
    }

    public function create()    
    {
        $oficina = (new Oficina);
        return view('oficina.create', compact('oficina'));
    }

    public function store(Request $request)
    {
        $oficina = (new Oficina);
        $oficina->fill($request->all());
        $oficina->save();

        $agenda = (new OficinaAgenda);
        $agenda->oficina_id = $oficina->id;
        $agenda->activa = 1;
        $agenda->save();

        for($i = 1; $i <=6; $i++){
            $dia = (new OficinaAgendaDetalle);
            $dia->dia_semana = $i;
            $dia->oficina_agenda_id = $agenda->id;
            $dia->save();
        }

        $oficina = Oficina::with('agendas')->find($oficina->id);
        toast('Oficina '.$oficina->denominacion.' creado con éxito ','info');
        return redirect()->route('oficina.create', compact('oficina'));
        
    }
    public function edit($id)
    {
        $oficina = Oficina::with('agendas')->findOrFail($id);
        return view('oficina.edit', compact('oficina' ));
    }
    public function update(Request $request, $id)
    {   
        $oficina = Oficina::findOrFail($id);
        $oficina->fill($request->all());
        $oficina->update();
        $agenda = OficinaAgenda::where('oficina_id', '=', $oficina->id)->first();

        if(!empty($agenda)){
            for($i = 1; $i <=5; $i++){
                $dia = OficinaAgendaDetalle::where('dia_semana','=', $i)->where('oficina_agenda_id', '=', $agenda->id)->first();
                if(!empty($dia)){
                    if($request->get('llegada')[($i-1)] == 1){
                        $dia->llegada = $request->get('llegada')[($i-1)];
                        $dia->fecha_inicio = $request->get('fecha_inicio')[($i-1)];
                        $dia->fecha_fin = $request->get('fecha_fin')[($i-1)];
                        $dia->cantidad_turnos = ($request->get('cantidad_turnos')[($i-1)] ? $request->get('cantidad_turnos')[($i-1)] : 0 );
                        $dia->cantidad_turnos_tarde = ($request->get('cantidad_turnos_tarde')[($i-1)] ? $request->get('cantidad_turnos_tarde')[($i-1)] : 0 );
                        $dia->tiempo_minutos = 0;
                        $dia->tiempo_minutos_tarde =0;

                        $dia->hora_inicio = ($request->get('hora_inicio')[($i-1)] ? $request->get('hora_inicio')[($i-1)] : '00:00:00' );
                        $dia->hora_inicio_tarde = ($request->get('hora_inicio_tarde')[($i-1)] ? $request->get('hora_inicio_tarde')[($i-1)] : '00:00:00' );

                        $dia->hora_fin = '00:00:00';
                        $dia->hora_fin_tarde = '00:00:00';

                    }else{
                        $dia->llegada = $request->get('llegada')[($i-1)];
                        $dia->fecha_inicio = $request->get('fecha_inicio')[($i-1)];
                        $dia->fecha_fin = $request->get('fecha_fin')[($i-1)];
                        $dia->hora_inicio = ($request->get('hora_inicio')[($i-1)] ? $request->get('hora_inicio')[($i-1)] : '00:00:00' );
                        $dia->hora_fin = ($request->get('hora_fin')[($i-1)] ? $request->get('hora_fin')[($i-1)] : '00:00:00' );
                        $dia->cantidad_turnos = ($request->get('cantidad_turnos')[($i-1)] ? $request->get('cantidad_turnos')[($i-1)] : 0 );
                        $dia->tiempo_minutos =  ($request->get('tiempo_minutos')[($i-1)] ? $request->get('tiempo_minutos')[($i-1)] : 0 );

                        $dia->hora_inicio_tarde = ($request->get('hora_inicio_tarde')[($i-1)] ? $request->get('hora_inicio_tarde')[($i-1)] : '00:00:00' );
                        $dia->hora_fin_tarde = ($request->get('hora_fin_tarde')[($i-1)] ? $request->get('hora_fin_tarde')[($i-1)] : '00:00:00' );
                        $dia->cantidad_turnos_tarde = ($request->get('cantidad_turnos_tarde')[($i-1)] ? $request->get('cantidad_turnos_tarde')[($i-1)] : 0 );
                        $dia->tiempo_minutos_tarde = ($request->get('tiempo_minutos_tarde')[($i-1)] ? $request->get('tiempo_minutos_tarde')[($i-1)] : 0 );
                    }
                    $dia->update();
                }
            }
    
        }

        return redirect()->route('oficina.index')->with('info', 'Tipo Trámite actualizado');
    }
    public function destroy($id)
    {
        $oficina = Oficina::with('agendas')->findOrFail($id);
        foreach($oficina->agendas as $agenda){
            OficinaAgendaDetalle::where("oficina_agenda_id", '=', $agenda->id)->delete();
            $agenda->delete();
        }
        $oficina->delete();

        $response = array();
        $response['status']='success';
        $response['msg']='La Oficina con su agenda ha sido eliminada correctamente ';

        return $response;
    }
}
