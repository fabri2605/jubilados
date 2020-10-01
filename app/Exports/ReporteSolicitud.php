<?php

namespace App\Exports;

use App\Solicitud;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use DB;


class ReporteSolicitud implements FromCollection,WithHeadings,ShouldAutoSize
{
    protected $fecha_desde;
    protected $fecha_hasta;

    public function __construct($fecha_desde, $fecha_hasta)
    {
        $this->fecha_desde = $fecha_desde; 
        $this->fecha_hasta = $fecha_hasta; 
    }
    public function headings(): array
    {
        $cabecera = array();
        array_push($cabecera, 'NRO SOLICITUD');
        array_push($cabecera, 'ABONO');
        array_push($cabecera, 'FECHA');
        array_push($cabecera, 'HORA');
        array_push($cabecera, 'APELLIDO');
        array_push($cabecera, 'NOMBRE');
        array_push($cabecera, 'SEXO');
        array_push($cabecera, 'CUIL');
        array_push($cabecera, 'NRO TRAMITE');
        array_push($cabecera, 'FECHA NACIMIENTO');
        array_push($cabecera, 'EMAIL');
        array_push($cabecera, 'FIJO');
        array_push($cabecera, 'CELULAR');
        array_push($cabecera, 'CALLE');
        array_push($cabecera, 'NRO CALLE');
        array_push($cabecera, 'PISO');
        array_push($cabecera, 'DEPTO');
        array_push($cabecera, 'MANZANA');
        array_push($cabecera, 'CASA');
        array_push($cabecera, 'LOCALIDAD');
        array_push($cabecera, 'DEPARTAMENTO');
        array_push($cabecera, 'CODIGO POSTAL');
        array_push($cabecera, 'OBSERVACIONES');
        array_push($cabecera, 'ESTADO');
        return  $cabecera;
    }
    public function collection()
    {
        $solicitudes = Solicitud::whereDate('fecha_solicitud', '<=', $this->fecha_hasta->toDateString())
                        ->whereDate('fecha_solicitud', '>=', $this->fecha_desde->toDateString())->get();

        //dd($solicitudes);
        $response = array();
        foreach($solicitudes as $item){
            $datos =   [
                        'nro_solicitud' => $item->nro_solicitud,
                        'abono' => $item->tipo_abono,
                        'fecha' => Carbon::parse($item->fecha_solicitud)->format('d/m/y'), 
                        'hora' => Carbon::parse($item->fecha_solicitud)->format('H:i:s'),
                        'apellido' => $item->apellido,
                        'nombre' =>  $item->nombre,
                        'sexo' =>  $item->sexo,
                        'cuil' =>  $item->cuit,
                        'tramite' =>  $item->nro_tramite,
                        'fecha_nacimiento' =>  Carbon::parse($item->fecha_nacimiento)->format('d/m/y'), 
                        'email' =>  $item->email,
                        'fijo' =>  $item->fijo,
                        'celular' =>  $item->celular,
                        'calle' =>  $item->calle,
                        'nro_calle' =>  $item->nro_calle,
                        'piso' =>  $item->piso,
                        'depto' =>  $item->depto,
                        'manzana' =>  $item->manzana,
                        'casa' =>  $item->casa,
                        'localidad' =>  $item->localidad,
                        'departamento' =>  $item->departamento,
                        'codigo_postal' =>  $item->codigo_postal,
                        'observaciones' =>  $item->observaciones,
                        'estado' =>  $item->estado,

                        ];
                        
            $aux = collect($datos);
            array_push($response, $aux);
        }
        return collect($response);
    }
}
