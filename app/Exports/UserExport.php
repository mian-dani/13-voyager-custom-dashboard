<?php

namespace App\Exports;

use App\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();
        return collect(Team::getAllUsers());
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Email',
            'Country',
            
        ];
    }
}
