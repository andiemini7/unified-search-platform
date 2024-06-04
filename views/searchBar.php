<div class="max-w-md mx-auto">
    <label for="default-search" class="mb-2 text-sm font-medium text-[#51606F] sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="flex gap-4 items-center min-w-[520px] max-w-[520px] justify-center p-4 text-lg text-[#51606F] rounded-none bg-gray-50">
            <img id="search-icon" class="w-4 h-4 cursor-pointer" src="<?php echo get_template_directory_uri(); ?>/assets/images/search.png" alt="test">
        </div>
    </div>
</div>
<div id="search-overlay" class="fixed inset-0 bg-white bg-opacity-90 z-50 hidden">
    <span class="absolute top-5 right-10 text-black text-4xl cursor-pointer" id="close-search">&times;</span>
    <div class="flex items-center justify-center h-full">
        <div class="text-center w-full max-w-md">
            <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="flex items-center relative">
                    <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="search-input-overlay" class="px-4 py-2 w-full text-lg border-none rounded-t-lg pl-10 shadow-inner shadow-md text-[#51606F]" style="outline: none;" placeholder="Search..." >
                    <img id="search-icon-inside" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4" src="<?php echo get_template_directory_uri(); ?>/assets/images/search.png" alt="test">
                </div>
            </form>
            <div id="search-results" class="text-[#51606F] bg-white"></div> 
        </div>
    </div>
</div>

<script>
    function clearSearchOverlay() {
        document.getElementById("search-input-overlay").value = '';
        document.getElementById("search-results").innerHTML = '';
    }

    function handleInputChange() {
        if (document.getElementById("search-input-overlay").value === '') {
            document.getElementById("search-results").innerHTML = '';
        }
    }

    document.getElementById("search-icon").addEventListener("click", function() {
        document.getElementById("search-overlay").classList.remove("hidden");
        document.getElementById("search-input-overlay").focus();
    });

    document.getElementById("close-search").addEventListener("click", function() {
        document.getElementById("search-overlay").classList.add("hidden");
        clearSearchOverlay();
    });

    document.getElementById("search-input-overlay").addEventListener("input", handleInputChange);

    document.getElementById("searchform").addEventListener("submit", function(event) {
        event.preventDefault();
        let query = document.getElementById("search-input-overlay").value.trim();
        let resultsContainer = document.getElementById("search-results");

        resultsContainer.innerHTML = '';

        if (query !== '') {
            let results = []; 

            if (results.length > 0) {
                let resultsHTML = `<p class="flex justify-start">Results for "${query}":</p><ul class="flex flex-col list-none list-disc">`;
                results.forEach(result => {
                    resultsHTML += `<li class="flex justify-start py-2">${result}</li>`;
                });
                resultsHTML += `</ul>`;
                resultsContainer.innerHTML = resultsHTML;
            } else {
                resultsContainer.innerHTML = `<p class="flex justify-start px-4 py-2 w-full text-lg border-none rounded-b-lg pl-10 shadow-inner shadow">No results found.</p>`;
            }
        } else {
            resultsContainer.innerHTML = `<p class="flex justify-start px-4 py-2 w-full text-lg border-none rounded-b-lg pl-10 shadow-inner shadow">No results found.</p>`;
        }
    });
</script>