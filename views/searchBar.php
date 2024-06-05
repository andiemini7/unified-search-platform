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
    <span class="absolute top-5 right-5 text-black text-4xl cursor-pointer" id="close-search">&times;</span>
    <div class="flex items-center justify-center h-full px-4">
        <div class="text-center w-full max-w-md">
            <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="flex items-center relative">
                    <input type="search" name="s" id="search-input-overlay" class="px-4 py-2 w-full text-lg border-none rounded-lg pl-10 shadow-inner shadow-md text-[#51606F]" style="outline: none;" placeholder="Search...">
                    <img id="search-icon-inside" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 sm:w-3 sm:h-3" src="<?php echo get_template_directory_uri(); ?>/assets/images/search.png" alt="Search">
                </div>
            </form>
            <div id="search-results" class="text-[#51606F] bg-white"></div>
            <div id="recent-searches" class="text-[#51606F] bg-white mt-4 shadow-inner shadow-md rounded-b-lg overflow-y-auto max-h-40"></div>
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

function closeSearchOverlay() {
    document.getElementById("search-overlay").classList.add("hidden");
    clearSearchOverlay();
}

function displayRecentSearches() {
    let recentSearches = JSON.parse(localStorage.getItem("recentSearches")) || [];
    let recentSearchesContainer = document.getElementById("recent-searches");

    if (recentSearches.length > 0) {
        let recentHTML = `<p class="flex justify-start px-4 py-2">Recent Searches:</p><ul class="flex flex-col list-none list-disc px-4">`;
        recentSearches.forEach((search, index) => {
            recentHTML += `<li class="flex justify-between items-center py-2 relative">
                            ${search}
                            <button class="ml-2 text-black hover:text-gray-700 focus:outline-none" onclick="deleteRecentSearch(${index})">&times;</button>
                            </li>`;
        });
        recentHTML += `</ul>`;
        recentSearchesContainer.innerHTML = recentHTML;
    } else {
        recentSearchesContainer.innerHTML = `<p class="flex justify-start px-4 py-2">No recent searches.</p>`;
    }
}

function deleteRecentSearch(index) {
    let recentSearches = JSON.parse(localStorage.getItem("recentSearches")) || [];
    recentSearches.splice(index, 1);
    localStorage.setItem("recentSearches", JSON.stringify(recentSearches));
    displayRecentSearches();
}

function selectRecentSearch(search) {
    document.getElementById("search-input-overlay").value = search;
    document.getElementById("searchform").submit();
}

function saveSearch(query) {
    let recentSearches = JSON.parse(localStorage.getItem("recentSearches")) || [];
    if (!recentSearches.includes(query)) {
        recentSearches.unshift(query); 
        if (recentSearches.length > 5) {
            recentSearches.pop();
        }
        localStorage.setItem("recentSearches", JSON.stringify(recentSearches));
    }
}

document.getElementById("search-icon").addEventListener("click", function() {
    document.getElementById("search-overlay").classList.remove("hidden");
    document.getElementById("search-input-overlay").focus();
    displayRecentSearches();
});

document.getElementById("close-search").addEventListener("click", closeSearchOverlay);

document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        closeSearchOverlay();
    }
});

document.getElementById("search-input-overlay").addEventListener("input", handleInputChange);

document.getElementById("search-input-overlay").addEventListener("focus", displayRecentSearches);

document.getElementById("searchform").addEventListener("submit", function(event) {
    event.preventDefault();
    let query = document.getElementById("search-input-overlay").value.trim();
    let resultsContainer = document.getElementById("search-results");

    resultsContainer.innerHTML = '';

    if (query !== '') {
        saveSearch(query);

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