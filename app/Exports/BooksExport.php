<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class BooksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::with(['category','user'])->get();
    }
    public function headings() : array {
        return [
            'title','total', 'category', 'description', 'author', 'created','last_modified',
        ];
    }

    public function map($book) : array{
        return [
            $book->title,
            $book->total,
            $book->category->name,
            $book->description,
            $book->user->name,
            $book->created_at,
            $book->updated_at,
        ];
    }
}
