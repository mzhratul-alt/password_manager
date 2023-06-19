<?php

namespace App\Exports;

use App\Models\Hash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HashesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Hash::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'name',
            'short_code',
            'hash',
            'creation_date',
            'remark'
        ];
    }
}
