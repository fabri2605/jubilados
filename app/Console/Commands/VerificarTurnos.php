<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Turno;
use Carbon\Carbon;
use DB;

class VerificarTurnos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'validar:turnos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Coloca los turnos vencidos en estado VENCIDO';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $inicio = Carbon::now();
        Log::debug('-------------------INICIANDO VERIFICAR VENCIMIENTOS-----------------------');

        $turnos = DB::table('turnos')
            ->where('fecha_turno', '<=', Carbon::now()->subHours(24)->toDateTimeString())
            ->where('estado', '=', 'PENDIENTE')->get();

        if(count($turnos) > 0){
            Log::debug('-------------------cantidad de turnos -'.count($turnos)."   ".$turnos[0]->fecha_turno." ".$turnos[0]->hora_turno);

            /*$turnos_update = DB::table('turnos')
            ->where('fecha_turno', '<=', Carbon::now()->subHours(24)->toDateTimeString())
            ->where('estado', '=', 'PENDIENTE')->update(['estado' => 'VENCIDO']);*/
        }

        Log::debug('-------------------FINALIZANDO VERIFICAR VENCIMIENTOS-----------------------');
        $this->info('Proceso validar vencidos finalizado duracion '.$inicio->diffForHumans());
    }
}
