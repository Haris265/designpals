<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ClientImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new Client([
            //
            'sale_person_id'     => $row[0],
            'account_id'     => $row[1],
            'name'     => $row[2],
            'email'     => $row[3],
            'phone_no'     => $row[4],
            'address'     => $row[5],
            'company'     => $row[6],
            'website'     => $row[7],
            'location'     => $row[8]

        ]);
    }
}
