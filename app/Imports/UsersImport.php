<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'matricula' => $row[0],
            'semestre' => $row[1],
            'carrera' => $row[2],
            'user_id' => $row[3]
        ]);
    }
}
