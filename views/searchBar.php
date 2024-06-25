<div id="main-content" class="max-w-md mx-auto">
    <label for="default-search" class="mb-2 text-sm font-medium text-[#51606F] sr-only dark:text-white">Search</label>
    <div class="flex items-center justify-center">
        <svg id="search-icon" class="w-6 h-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </div>
</div>

<div id="search-overlay" class="fixed inset-0 bg-white bg-opacity-90 z-50 hidden backdrop-blur-lg">
    <div class="flex items-center justify-center h-full px-4">
        <div class="text-center relative w-full max-w-md">
            <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
            <span class="absolute right-5 text-black text-4xl cursor-pointer bottom-28 z-20" id="close-search">&times;</span>
                <div class="flex items-center relative">
                    <input type="search" name="s" id="search-input-overlay" class="px-4 py-2 w-full text-lg border-none rounded-lg pl-10 shadow-inner shadow-md text-[#51606F]" style="outline: none;" placeholder="Search...">
               </div>
            </form>
            <div id="search-results" class="text-[#51606F] bg-white"></div>
            <div id="recent-searches" class="text-[#51606F] bg-white mt-4 shadow-inner shadow-md rounded-b-lg overflow-y-auto max-h-40"></div>
        </div>
    </div>
</div>