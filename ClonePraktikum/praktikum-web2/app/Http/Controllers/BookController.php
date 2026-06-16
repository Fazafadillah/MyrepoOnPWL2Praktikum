<?php

namespace App\Http\Controllers;

use App\Exports\BookExport;
use App\Imports\Bookimport;
use App\Models\Book;
use App\Models\Bookshelf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Menangkap keyword pencarian dari request
        $search = $request->keyword;

        // Query dengan relasi, pencarian, dan paginasi seperti di BukuController
        $data['books'] = Book::with(['bookshelf']) // Pastikan ada relasi 'bookshelf' di model Book
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('year', 'like', "%{$search}%")
                    ->orWhere('publisher', 'like', "%{$search}%")
                    ->orWhereHas('bookshelf', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString(); // Mempertahankan parameter query (termasuk keyword) saat pindah halaman

        return view('books.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['bookshelves'] = Bookshelf::pluck('name', 'id');
        return view('books.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'year' => 'required|integer|digits:4|min:1900|max:' . (date('Y')),
            'publisher' => 'required|max:255',
            'city' => 'required|max:255',
            'cover' => 'required|image',
            'bookshelf_id' => 'required',
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->storeAs(
                'cover_buku/',
                'cover_buku_' . time() . '.' . $request->file('cover')->extension(),
                'public'
            );
            $validated['cover'] = basename($path);
        }

        Book::create($validated);

        $notification = array(
            'message' => 'Data Berhasil diSimpan',
            'alert-type' => 'success'
        );

        if ($request->save) {
            return redirect()->route('book.index')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['book'] = Book::findOrFail($id);
        $data['bookshelves'] = Bookshelf::pluck('name', 'id');
        return view('books.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'year' => 'required|integer|digits:4|min:1900|max:' . (date('Y')),
            'publisher' => 'required|max:255',
            'city' => 'required|max:255',
            'cover' => 'required|image', // Bisa tambahkan nullable jika cover tidak wajib diupdate
            'bookshelf_id' => 'required',
        ]);

        $book = Book::find($id);
        if ($request->hasFile('cover')) {
            if ($book->cover != null) {
                Storage::delete('public/cover_buku/' . $book->cover); // Pastikan path delete sesuai storage
            }
            $path = $request->file('cover')->storeAs(
                'cover_buku/',
                'cover_buku_' . time() . '.' . $request->file('cover')->extension(),
                'public'
            );
            $validated['cover'] = basename($path);
        }

        Book::where('id', $id)->update($validated);

        $notification = array(
            'message' => 'Data Berhasil diSimpan',
            'alert-type' => 'success'
        );

        if ($request->save) {
            return redirect()->route('book.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        Storage::delete('public/cover_buku/' . $book->cover);

        $book->delete();

        $notification = array(
            'message' => 'Data buku berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('book.index')->with($notification);
    }

    public function print()
    {
        $data['books'] = Book::all();
        $pdf = Pdf::loadView('books.print', $data);
        return $pdf->stream('data_buku.pdf');
    }

    public function export()
    {
        return Excel::download(new BookExport, 'data-buku.xlsx');
    }

    public function import(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new Bookimport, $req->file('file'));

        $notification = array(
            'message' => 'Import data berhasil dilakukan',
            'alert-type' => 'success'
        );

        return redirect()->route('book.index')->with($notification);
    }
}
