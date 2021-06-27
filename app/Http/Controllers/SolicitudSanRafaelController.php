<?php

namespace App\Http\Controllers;

use App\SolicitudSanRafael;
use App\Abono;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Alert;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteSolicitudSanRafael;

class SolicitudSanRafaelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = SolicitudSanRafael::query(DB::table('solicitud_san_rafaels')->whereNull('deleted_at'))->orderBy('solicitud_san_rafaels.created_at', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" >';
                        $btn = $btn.'<a href="solicitudes_san_rafael/'.$row->id.'/edit" class="btn btn-info btn-sm"> <i class="far fa-edit"></i> </a>';
                        $btn = $btn.'&nbsp;';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm eliminarSolicitud"><i class="fas fa-minus"></i></a>';
                        $btn = $btn.'</div>';
                        return $btn;
                })
                ->editColumn('fecha_solicitud', function($row){
                    return Carbon::parse($row->fecha_solicitud)->format('d/m/Y');
                })
                ->editColumn('hora_solicitud', function($row){
                    return Carbon::parse($row->fecha_solicitud)->format('H:i:s');
                })
                ->rawColumns(['action','hora_solicitud', 'fecha_solicitud'])
                ->toJson();
        }
        return view('solicitudes_san_rafael.index');
    }
    public function create()
    {
        $solicitud = (new SolicitudSanRafael);
        return view('solicitudes_san_rafael.create', compact('solicitud'));
    }
    public function store(Request $request)
    {
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha_nacimiento'));

        $data = explode('-',$request->get('cuit'));
        $abono = Abono::where('dni','=',$data[1])->first();
        if(!empty($abono)){
            $solicitud = (new SolicitudSanRafael);
            $solicitud->fill($request->all());
            $solicitud->estado = 'SOLICITADO';
            $solicitud->fecha_nacimiento = $date;
            $solicitud->fecha_solicitud = Carbon::now();
            $solicitud->save();
            $solicitud->nro_solicitud = 'TS-'.(1000+$solicitud->id);
            $solicitud->update();

            return redirect()->route('solicitudes_san_rafael.index');
        }else{
            alert()->error('Advertencia','Ud. no está registrado como beneficiario jubilado o mayores de 70 años o discapacitados o ley 7811');
            return redirect()->back()->withInput($request->all());
        }
    }
    
    public function edit($id)
    {
        $solicitud = SolicitudSanRafael::findOrFail($id);
        return view('solicitudes_san_rafael.edit', compact('solicitud'));
    }
    public function update(Request $request, $id)
    {
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha_nacimiento'));

        $data = explode('-',$request->get('cuit'));
        $abono = Abono::where('dni','=',$data[1])->first();
        if(!empty($abono)){
            $solicitud = SolicitudSanRafael::findOrFail($id);
            $solicitud->fill($request->all());
            $solicitud->fecha_nacimiento = $date;
            $solicitud->update();

            toast('El SolicitudSanRafael '.$solicitud->nro_solicitud.' ha sido actualizada con éxito','info');
            return redirect()->route('solicitudes_san_rafael.index');
        }else{
            alert()->error('Advertencia','Ud. no está registrado como beneficiario jubilado o mayores de 70 años o discapacitados o ley 7811');
            return redirect()->back()->withInput($request->all());
        }
    }
    public function destroy($id)
    {
        $solicitud = SolicitudSanRafael::findOrFail($id);
        $solicitud->delete();

        $response = array();
        $response['status']='success';
        $response['msg']='El SolicitudSanRafael  ha sido eliminado correctamente ';

        return $response;
    }
    public function reporte(Request $request){
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha_desde'));
        $dateFin = Carbon::createFromFormat($format, $request->get('fecha_hasta'));
        return Excel::download(new ReporteSolicitudSanRafael($date,$dateFin), 'solicitudes_san_rafael-'. Carbon::now().'.xlsx',null,[\Maatwebsite\Excel\Excel::XLSX]);
    }
}
