<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-end m-4">
                    {{-- <x-primary-button tag="a" href="{{ route('book.create') }}">
                        Add Book
                    </x-primary-button> --}}
                    <a href="{{ route('book.create') }}">
                        <x-primary-button>
                            Add
                        </x-primary-button>
                    </a>
                </div>
                <x-table>
                    <x-slot name="head">
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Publisher</th>
                        <th>City</th>
                        <th>Cover</th>
                        <th>Bookshelf</th>
                        <th>Actions</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->city }}</td>
                                <td>
                                    <img src="{{ asset('storage/cover_buku/' . $book->cover) }}" alt="cover"
                                        width="100px">

                                </td>
                                <td>{{ $book->bookshelf->name }}</td>
                                <td>
                                    {{-- <x-primary-button tag="a"
                                        href="{{ route('book.edit', $book->id) }}">Edit</x-primary-button> --}}
                                    <a href="{{ route('book.edit', $book->id) }}">
                                        <x-primary-button>
                                            Edit
                                        </x-primary-button>
                                    </a>
                                    {{-- <a href="{{ route('book.delete', $book->id) }}">
                                        <x-primary-button>
                                            Hapus
                                        </x-primary-button>
                                    </a> --}}
                                    <form action="{{ route('book.delete', $book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <x-danger-button>
                                            Hapus
                                        </x-danger-button>
                                    </form>
                                    {{-- <x-danger-button>Delete</x-danger-button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
