<?php

namespace App\Http\Controllers;

use App\EnviadoSanRafael;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Alert;
use Carbon\Carbon;
use App\Imports\EnviadoSanRafelImport;
use Maatwebsite\Excel\Facades\Excel;


class EnviadoSanRafaelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = EnviadoSanRafael::query(DB::table('enviado_san_rafaels'))->orderBy('enviado_san_rafael.documento', 'asc');
            return DataTables::eloquent($model)
                ->toJson();
        }
        return view('enviado_san_rafael.index');
    }
    public function importar(Request $request){
        if($request->has('file')){
            Excel::import(new EnviadoSanRafelImport(), request()->file('file'));
        }
        $response = array();
        $response['status'] = 'success';
        return $response;
    }
}
