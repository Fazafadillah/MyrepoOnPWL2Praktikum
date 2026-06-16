<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Bookimport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $path = $row['cover']->storeAs;

        return new Book([
            'title' => $row['judul'],
            'author' => $row['penulis'],
            'year' => $row['tahun_terbit'],
            'publisher' => $row['penerbit'],
            'city' => $row['kota_terbit'],
            'cover' => 'kosong',
            'bookshelf_id' => 1,
        ]);
    }
}
