<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">

        <h2 class="text-2xl text-white font-bold text-gray-800">
            Book List
        </h2>

        <div>
            <input type="text" wire:model.live.debounce.1000ms="search" placeholder="Search books..."
                class="w-[90%] mx-auto block px-4 py-2 mt-10 border rounded-lg">

        </div>

        <div class="space-x-2">

            <!-- ACTIVE -->
            <button wire:click="$set('showTrashed', false)" class="bg-green-500 text-white px-3 py-2 rounded">
                Active
            </button>

            <!-- TRASH -->
            <button wire:click="$set('showTrashed', true)" class="bg-gray-700 text-white px-3 py-2 rounded">
                Trash
            </button>

            <a href="{{ route('livewire.books.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                + Create Book
            </a>

        </div>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="min-w-full bg-white border shadow-sm">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Available</th>
                    <th>Total</th>
                    <th>Publisher</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($books as $book)
                    <tr class="border-t hover:bg-gray-50" wire:key="book-{{ $book->id }}">

                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->isbn }}</td>

                        <td>{{ $book->category->name ?? 'N/A' }}</td>

                        <td>Rs. {{ $book->price }}</td>
                        <td>{{ $book->available_copies }}</td>
                        <td>{{ $book->total_copies }}</td>
                        <td>{{ $book->publisher }}</td>

                        <td>{{ $book->creator->name ?? 'N/A' }}</td>

                        <!-- STATUS -->
                        <td>
                            @if ($book->available_copies > 0)
                                <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                                    Available
                                </span>
                            @else
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                                    Out of Stock
                                </span>
                            @endif
                        </td>

                        <!-- ACTIONS -->
                        <td class="space-x-1">

                            @if (!$showTrashed)
                                <button wire:click="delete({{ $book->id }})"
                                    class="bg-red-500 text-white px-2 py-1 rounded text-sm">
                                    Delete
                                </button>

                                <a href="{{ route('livewire.books.view', $book->id) }}"
                                    class="bg-blue-500 text-white px-2 py-1 rounded text-sm">
                                    View
                                </a>

                                <a href="{{ route('livewire.books.edit', $book->id) }}"
                                    class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">
                                    Edit
                                </a>
                            @else
                                <button wire:click="restore({{ $book->id }})"
                                    class="bg-green-500 text-white px-2 py-1 rounded text-sm">
                                    Restore
                                </button>

                                <button wire:click="forceDelete({{ $book->id }})"
                                    wire:confirm="Delete permanently?"
                                    class="bg-red-700 text-black px-2 py-1 rounded text-sm">
                                    Delete Forever
                                </button>
                            @endif

                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="12" class="text-center py-4">
                            No books found
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>
    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>

</div>
