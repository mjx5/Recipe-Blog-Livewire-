<form class="flex flex-col md:flex-row gap-3 mb-6">
    <div class="flex-grow md:w-80"> <!-- Set specific width for larger screens -->
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search for the recipe you like"
            class="w-full px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500">
    </div>

    <select wire:model.live.debounce.500ms="sortBy" id="Type" name="Type"
        class="w-full md:w-auto h-10 border-2 border-sky-500 focus:outline-none focus:border-sky-500 text-sky-500 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
        <option value="" selected>All</option>
        <option value="name">A-Z</option>
        <option value="created_at">Newest</option>
    </select>
</form>
