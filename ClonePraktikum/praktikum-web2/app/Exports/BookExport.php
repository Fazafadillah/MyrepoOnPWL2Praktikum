<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Override;

class BookExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function Array(): array
    {
        return Book::getDataBooks();
    }

    #[Override]
    public function headings(): array
    {
        return [
            'Judul',
            'Penulis',
            'Tahun Terbit',
            'Penerbit',
            'Kota Terbit'
        ];
    }
}
