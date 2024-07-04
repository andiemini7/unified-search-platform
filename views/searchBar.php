<div id="main-content" class="max-w-md mx-auto">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-500 sr-only">Search</label>
    <div class="flex items-center justify-center">
        <div id="search-icon" class="w-7 h-7 cursor-pointer">
<svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 width="100%" height="100%" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
<path d="M8,15c-3.9,0-7-3.1-7-7s3.1-7,7-7s7,3.1,7,7S11.9,15,8,15z M8,3C5.2,3,3,5.2,3,8s2.2,5,5,5s5-2.2,5-5S10.8,3,8,3z"/>
<path d="M17.3,18.7l-3-3c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l3,3c0.4,0.4,0.4,1,0,1.4C18.3,19.1,17.7,19.1,17.3,18.7z"/>
</svg>
        </div>
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