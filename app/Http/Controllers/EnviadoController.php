<?php

namespace App\Http\Controllers;

use App\Enviado;
use Illuminate\Http\Request;
use App\Http\Requests\TurnoRequest;
use DataTables;
use DB;
use Alert;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteSolicitud;

class EnviadoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Enviado::query(DB::table('enviados'))->orderBy('enviados.documento', 'asc');
            return DataTables::eloquent($model)
                ->toJson();
        }
        return view('enviados.index');
    }
    public function importar(Request $request){
        
    }
}
