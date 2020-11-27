<?php

namespace App\Http\Controllers;

use App\Enviado;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Alert;
use Carbon\Carbon;
use App\Imports\EnviadoImport;
use Maatwebsite\Excel\Facades\Excel;


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
        if($request->has('file')){
            Excel::import(new EnviadoImport(), request()->file('file'));
        }
        $response = array();
        $response['status'] = 'success';
        return $response;
    }
}
