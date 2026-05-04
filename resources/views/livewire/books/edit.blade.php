<div class="p-6 max-w-2xl mx-auto">

    <h2 class="text-2xl text-white font-bold mb-4 text-gray-800">
        Edit Book
    </h2>

    <form wire:submit.prevent="update" class="space-y-4">

    
        <div>
            <label class="font-semibold text-white">Title</label>
            <input type="text" wire:model="title" class="w-full border p-2 rounded">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

     
        <div>
            <label class="font-semibold text-white">Author</label>
            <input type="text" wire:model="author" class="w-full border p-2 rounded">
        </div>

   
        <div>
            <label class="font-semibold text-white">ISBN</label>
            <input type="text" wire:model="isbn" class="w-full border p-2 rounded">
            @error('isbn') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

       
        <div>
            <label class="font-semibold text-white">Published Date</label>
            <input type="date" wire:model="published_date" class="w-full border p-2 rounded">
        </div>

        
        <div>
            <label class="font-semibold text-white">Pages</label>
            <input type="number" wire:model="pages" class="w-full border p-2 rounded">
        </div>

        
        <div>
            <label class="font-semibold text-white">Price</label>
            <input type="number" wire:model="price" class="w-full border p-2 rounded">
        </div>

       
        <div>
            <label class="font-semibold text-white">Available Copies</label>
            <input type="number" wire:model="available_copies" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="font-semibold text-white">Total Copies</label>
            <input type="number" wire:model="total_copies" class="w-full border p-2 rounded">
        </div>

    
        <div>
            <label class="font-semibold text-white">Publisher</label>
            <input type="text" wire:model="publisher" class="w-full border p-2 rounded">
        </div>

     
        <div>
            <label class="font-semibold text-white">Category</label>
            <select wire:model="category_id" class="w-full border p-2 rounded">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

       
        <div>
            <label class="font-semibold text-white">Description</label>
            <textarea wire:model="description" class="w-full border p-2 rounded"></textarea>
        </div>

     
        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
            Update Book
        </button>

    </form>

</div>