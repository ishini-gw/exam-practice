<div>
    <div class="grid grid-cols-4 gap-4 mb-6">

        <div class="bg-blue-500 text-white p-4 rounded">
            Total Books: {{ $totalBooks }}
        </div>

        <div class="bg-red-500 text-white p-4 rounded">
            Out of Stock: {{ $outOfStock }}
        </div>

        <div class="bg-green-500 text-white p-4 rounded">
            Total Value: Rs. {{ $totalValue }}
        </div>

    </div>

    <div class="bg-white p-4 rounded shadow mb-6">
        <h3 class="font-bold mb-2">Books by Category</h3>

        @foreach($booksByCategory as $cat)
            <div class="flex justify-between border-b py-1">
                <span>{{ $cat->name }}</span>
                <span>{{ $cat->books_count }}</span>
            </div>
        @endforeach
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-bold mb-2">Recent Books</h3>

        @foreach($recentBooks as $book)
            <div class="border-b py-2">
                {{ $book->title }} - {{ $book->author }}
            </div>
        @endforeach
    </div>

    
</div>
