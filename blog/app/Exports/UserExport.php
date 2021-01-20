<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {
        $users = User::all('id','name','email','isAdmin','created_at');
        foreach ($users as $user){
            if($user->isAdmin == 1)
                $user->isAdmin = 'Yes';
            else
                $user->isAdmin = 'No';
        }
        return $users;

    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Admin',
            'Created at'
        ];
    }
}
