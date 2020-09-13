<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Abono;
use Illuminate\Http\Request;
use App\Http\Requests\TurnoRequest;
use DataTables;
use DB;
use Alert;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteSolicitud;

class SolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Solicitud::query(DB::table('solicituds')->whereNull('deleted_at'))->orderBy('solicituds.created_at', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" >';
                        $btn = $btn.'<a href="solicitudes/'.$row->id.'/edit" class="btn btn-info btn-sm"> <i class="far fa-edit"></i> </a>';
                        $btn = $btn.'&nbsp;';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm eliminarSolicitud"><i class="fas fa-minus"></i></a>';
                        $btn = $btn.'</div>';
                        return $btn;
                })
                ->editColumn('fecha_solicitud', function($row){
                    return Carbon::parse($row->fecha_solicitud)->format('d/m/Y');
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('solicitudes.index');
    }
    public function create()
    {
        $solicitud = (new Solicitud);
        return view('solicitudes.create', compact('solicitud'));
    }
    public function store(Request $request)
    {
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha_nacimiento'));

        $data = explode('-',$request->get('cuit'));
        $abono = Abono::where('dni','=',$data[1])->first();
        if(!empty($abono)){
            $solicitud = (new Solicitud);
            $solicitud->fill($request->all());
            $solicitud->estado = 'SOLICITADO';
            $solicitud->fecha_nacimiento = $date;
            $solicitud->fecha_solicitud = Carbon::now();
            $solicitud->save();
            $solicitud->nro_solicitud = 'TS-'.(1000+$solicitud->id);
            $solicitud->update();

            return redirect()->route('solicitudes.index');
        }else{
            alert()->error('Advertencia','Ud. no está registrado como beneficiario jubilado o mayores de 70 años o discapacitados o ley 7811');
            return redirect()->back()->withInput($request->all());
        }
    }
    
    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return view('solicitudes.edit', compact('solicitud'));
    }
    public function update(Request $request, $id)
    {
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha_nacimiento'));

        $data = explode('-',$request->get('cuit'));
        $abono = Abono::where('dni','=',$data[1])->first();
        if(!empty($abono)){
            $solicitud = Solicitud::findOrFail($id);
            $solicitud->fill($request->all());
            $solicitud->fecha_nacimiento = $date;
            $solicitud->update();

            toast('El Solicitud '.$solicitud->nro_solicitud.' ha sido actualizada con éxito','info');
            return redirect()->route('solicitudes.index');
        }else{
            alert()->error('Advertencia','Ud. no está registrado como beneficiario jubilado o mayores de 70 años o discapacitados o ley 7811');
            return redirect()->back()->withInput($request->all());
        }
    }
    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        $response = array();
        $response['status']='success';
        $response['msg']='El Solicitud  ha sido eliminado correctamente ';

        return $response;
    }
    public function reporte(Request $request){
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha_desde'));
        $dateFin = Carbon::createFromFormat($format, $request->get('fecha_hasta'));
        return Excel::download(new ReporteSolicitud($date,$dateFin), 'solicitudes-'. Carbon::now().'.xlsx',null,[\Maatwebsite\Excel\Excel::XLSX]);
    }
}
