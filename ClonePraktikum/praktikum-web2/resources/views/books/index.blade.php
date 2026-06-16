<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="flex flex-col md:flex-row justify-between items-center m-4 gap-4">

                    <form method="GET" action="{{ route('book.index') }}"
                        class="flex items-center gap-2 w-full md:w-auto">
                        <x-text-input name="keyword" type="text" class="block w-full" placeholder="Cari data buku..."
                            value="{{ request('keyword') }}" />
                        <x-primary-button type="submit">
                            {{ __('Cari') }}
                        </x-primary-button>
                    </form>

                    <div class="flex flex-wrap justify-end gap-2">
                        <x-primary-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'import-book')">Import Book</x-primary-button>

                        <x-primary-button tag="a" href="{{ route('book.export') }}" target="_blank">
                            Export Book
                        </x-primary-button>

                        <x-primary-button tag="a" href="{{ route('book.print') }}" target="_blank">
                            Print Book
                        </x-primary-button>

                        <x-primary-button tag="a" href="{{ route('book.create') }}">
                            Add Book
                        </x-primary-button>
                    </div>
                </div>

                <x-table>
                    <x-slot name="head">
                        <th>No</th>
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
                        @forelse ($books as $index => $book)
                            <tr>
                                <td>{{ $books->firstItem() + $index }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->city }}</td>
                                <td>
                                    @if ($book->cover)
                                        <img src="{{ asset('storage/cover_buku/' . $book->cover) }}" alt="cover"
                                            width="100px" class="rounded">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $book->bookshelf->name ?? '-' }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <x-primary-button tag="a"
                                            href="{{ route('book.edit', $book->id) }}">Edit</x-primary-button>
                                        <x-danger-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')"
                                            x-on:click="$dispatch('set-action', '{{ route('book.destroy', $book->id) }}')">Delete</x-danger-button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-red-500 font-bold">
                                    Data yang anda cari tidak ada
                                </td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table>

                <div class="m-4">
                    {{ $books->links() }}
                </div>

            </div>
        </div>
    </div>

    <x-modal name="confirm-book-deletion" focusable maxWidth="xl">
        <form method="post" x-bind:action="action" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Apakah anda yakin akan menghapus data?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete!!!') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="import-book" focusable maxWidth="xl">
        <form method="post" action="{{ route('book.import') }}" class="p-6" enctype="multipart/form-data">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Import Data Buku') }}
            </h2>

            <div class="max-w-xl mt-4">
                <x-input-label for="cover" class="sr-only" value="File Import" />
                <x-file-input id="cover" name="file" class="mt-1 block w-full" required />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('Upload') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

</x-app-layout>
