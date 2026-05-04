<div class="p-6 max-w-2xl mx-auto">

    <h2 class="text-2xl text-white font-bold mb-4">Create Book</h2>

    <form wire:submit.prevent="store" class="space-y-4">

       
        <div>
            <label class="block text-white  font-semibold mb-1">Title</label>
            <input type="text" wire:model="title" class="w-full border p-2 rounded">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-white font-semibold mb-1">Author</label>
            <input type="text" wire:model="author" class="w-full border p-2 rounded">
        </div>

       
        <div>
            <label class="block text-white font-semibold mb-1">ISBN</label>
            <input type="text" wire:model="isbn" class="w-full border p-2 rounded">
        </div>

        
        <div>
            <label class="block text-white font-semibold mb-1">Published Date</label>
            <input type="date" wire:model="published_date" class="w-full border p-2 rounded">
        </div>

      
        <div>
            <label class="block text-white font-semibold mb-1">Pages</label>
            <input type="number" wire:model="pages" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block text-white font-semibold mb-1">Price</label>
            <input type="number" wire:model="price" class="w-full border p-2 rounded">
        </div>

       
        <div>
            <label class="block text-white font-semibold mb-1">Available Copies</label>
            <input type="number" wire:model="available_copies" class="w-full border p-2 rounded">
        </div>

        
        <div>
            <label class="block text-white font-semibold mb-1">Total Copies</label>
            <input type="number" wire:model="total_copies" class="w-full border p-2 rounded">
        </div>

       
        <div>
            <label class="block text-white font-semibold mb-1">Publisher</label>
            <input type="text" wire:model="publisher" class="w-full border p-2 rounded">
        </div>

        
        <div>
            <label class="block text-white font-semibold mb-1">Category</label>
            <select wire:model="category_id" class="w-full border p-2 rounded">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        
            <label class="block text-white font-semibold mb-1">Description</label>
            <textarea wire:model="description" class="w-full border p-2 rounded"></textarea>
        

       
        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Save Book
        </button>

    </form>
</div>