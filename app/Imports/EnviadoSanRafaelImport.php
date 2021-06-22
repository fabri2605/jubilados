<?php

namespace App\Imports;
use App\EnviadoSanRafael;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;


class EnviadoSanRafelImport implements ToModel, WithBatchInserts, WithChunkReading,WithStartRow
{


    public function model(array $row)
    {

        $existe = EnviadoSanRafael::where('documento','=', $row[0])->first();
        if(empty($existe)){
            $nuevo = (new EnviadoSanRafael);
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
