<div id="main-content" class="max-w-md mx-auto">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-500 sr-only">Search</label>
    <div class="flex items-center justify-center">
        <svg id="search-icon" class="w-6 h-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </div>
</div>

<div id="search-overlay" class="fixed inset-0 bg-white bg-opacity-90 z-50 hidden backdrop-blur-lg flex items-center justify-center">
    <div class="relative w-full max-w-md">
        <form role="search" method="get" id="searchform">
            <span class="flex justify-end text-black text-4xl cursor-pointer mb-4" id="close-search">&times;</span>
            <div class="flex items-center relative mb-4">
                <input type="search" name="s" id="search-input-overlay" class="px-4 py-2 w-full text-lg border-none rounded-lg shadow-inner text-gray-500 placeholder-gray-400 focus:outline-none" placeholder="Search...">
            </div>
        </form>
        <div id="search-results" class="text-gray-500 bg-white rounded-lg shadow-md p-4 max-h-96 overflow-y-auto"></div>
    </div>
</div>