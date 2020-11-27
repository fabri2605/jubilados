<?php

namespace App\Imports;
use App\Enviado;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;


class EnviadoImport implements ToModel, WithBatchInserts, WithChunkReading,WithStartRow
{

    use RemembersRowNumber;

    public function model(array $row)
    {
        $currentRowNumber = $this->getRowNumber();
        
        $existe = Enviado::where('documento','=', $row[0])->first();
        if(empty($existe)){
            $nuevo = (new Enviado);
            $nuevo->documento = $row[0];
            $nuevo->save();
        }
    }
    public function startRow(): int
    {
        return 2;
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
