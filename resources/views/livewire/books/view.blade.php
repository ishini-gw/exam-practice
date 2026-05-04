<div class="p-6 max-w-3xl mx-auto">

    <h2 class="text-2xl text-white font-bold mb-6 text-gray-800">
        Book Details
    </h2>

    <div class="bg-white shadow rounded p-6 space-y-4">

        <div>
            <strong>Title:</strong> {{ $book->title }}
        </div>

        <div>
            <strong>Author:</strong> {{ $book->author }}
        </div>

        <div>
            <strong>ISBN:</strong> {{ $book->isbn }}
        </div>

        <div>
            <strong>Category:</strong> {{ $book->category->name ?? 'N/A' }}
        </div>

        <div>
            <strong>Published Date:</strong> {{ $book->published_date }}
        </div>

        <div>
            <strong>Pages:</strong> {{ $book->pages }}
        </div>

        <div>
            <strong>Price:</strong> Rs. {{ $book->price }}
        </div>

        <div>
            <strong>Available Copies:</strong> {{ $book->available_copies }}
        </div>

        <div>
            <strong>Total Copies:</strong> {{ $book->total_copies }}
        </div>

        <div>
            <strong>Publisher:</strong> {{ $book->publisher ?? 'N/A' }}
        </div>

        <div>
            <strong>Created By:</strong> {{ $book->creator->name ?? 'N/A' }}
        </div>

        <div>
            <strong>Description:</strong>
            <p class="mt-1 text-gray-600">
                {{ $book->description ?? 'No description' }}
            </p>
        </div>

        <!-- STATUS -->
        <div>
            <strong>Status:</strong>
            @if($book->available_copies > 0)
                <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                    Available
                </span>
            @else
                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                    Out of Stock
                </span>
            @endif
        </div>

    </div>

    <!-- ACTION BUTTONS -->
    <div class="mt-6 flex gap-2">

        <a href="{{ route('books.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Back
        </a>

        <a href="{{ route('livewire.books.edit', $book->id) }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded">
            Edit
        </a>

    </div>

</div>