<?php

namespace App\Http\Controllers;
use DB;
use App\DiaEspecial;
use App\Http\Requests\DiaEspecialRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;

class DiaEspecialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
     {  
        if ($request->ajax()) {
            $model = DiaEspecial::query(DB::table('dia_especials'))->orderBy('dia_especials.fecha', 'asc');
            return DataTables::eloquent($model)
                ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" >';
                        $btn = $btn.'<a href="dias/'.$row->id.'/edit" class="btn btn-info btn-sm"> <i class="far fa-edit"></i> </a>';
                        $btn = $btn.'&nbsp;';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm eliminarDia"><i class="fas fa-minus"></i></a>';
                        $btn = $btn.'</div>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('dias.index');
    }

    public function create()    
    {
        $dia = (new DiaEspecial);
        return view('dias.create', compact('dia'));
    }

    public function store(DiaEspecialRequest $request)
    {
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha'));

        $dia = (new DiaEspecial);
        $dia->fill($request->all());
        $dia->fecha = $date;
        $dia->save();

        toast('Día Especial '.$dia->descripcion.' creado con éxito ','info');
        return redirect()->route('dias.index', compact('dia'));
        
    }
    public function edit($id)
    {
        $dia = DiaEspecial::findOrFail($id);
        return view('dias.edit', compact('dia' ));
    }
    public function update(DiaEspecialRequest $request, $id)
    {   
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format, $request->get('fecha'));

        $dia = DiaEspecial::findOrFail($id);
        $dia->fill($request->all());
        $dia->fecha = $date;
        $dia->update();

        return redirect()->route('dias.index')->with('info', 'Día Especial actualizado');
    }
    public function destroy($id)
    {
        $dia = DiaEspecial::findOrFail($id);
        $dia->delete();

        $response = array();
        $response['status']='success';
        $response['msg']='El día  ha sido eliminado correctamente ';

        return $response;
    }
}
