<?php

namespace App\Imports;

use App\Team;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;


class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if ($row[1] == 'name') {
            return null;
        }

        $user = Team::where('email', $row[2])->first();

        if ($user) {
            // Update existing record
            $user->name = $row[1];
            $user->country_id = $row[3];
            $user->save();
        } else {
                $user = new Team([
                'name' => $row[1],
                'email' => $row[2],
                'country_id' => $row[3],
                'password' => Hash::make('password'),
                'ip' => "192.1.1.1",
                'phone' => '0303022',
                'image' => 'jsjsjsjsjjsjsjs',
            ]);
            $user->save();
        }
        return $user;
    }
}
