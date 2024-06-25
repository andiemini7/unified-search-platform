import $ from 'jquery';

function clearSearchOverlay() {
    document.getElementById("search-input-overlay").value = "";
    document.getElementById("search-results").innerHTML = "";
}

function closeSearchOverlay() {
    document.getElementById("search-overlay").classList.add("hidden");
    clearSearchOverlay();
}

document.getElementById("search-icon").addEventListener("click", function () {
    document.getElementById("search-overlay").classList.remove("hidden");
    document.getElementById("search-input-overlay").focus();
});

document.getElementById("close-search").addEventListener("click", closeSearchOverlay);

document.addEventListener("keydown", function(event) {
    if ((event.ctrlKey && event.key === " ") || (event.metaKey && event.key === " ")) {
        event.preventDefault();
        document.getElementById("search-overlay").classList.remove("hidden");
        document.getElementById("search-input-overlay").focus();
    }
});

document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeSearchOverlay();
    }
});

document.getElementById("search-input-overlay").addEventListener("input", function(event) {
    let query = event.target.value.trim();
    if (query !== "") {
        fetchAndDisplayResults(query);
    } else {
        document.getElementById("search-results").innerHTML = "";
    }
});

function fetchAndDisplayResults(query) {
    let resultsContainer = document.getElementById("search-results");
    resultsContainer.innerHTML = "";

    // Fetch WordPress search results
    $.ajax({
        url: 'http://unified-seach-platform.test/wp-json/myplugin/v1/search/',
        type: 'GET',
        data: { query: query, type: 'wordpress' },
        success: function(response) {
            let categories = { pages: [], posts: [] };

            if (response && response.length > 0) {
                response.forEach((result) => {
                    if (result.post_type === 'page') {
                        categories.pages.push(result);
                    } else if (result.post_type === 'post') {
                        categories.posts.push(result);
                    }
                });

                if (categories.pages.length > 0) {
                    resultsContainer.innerHTML += `<h3 class="text-xl font-bold mb-2">Pages</h3>`;
                    categories.pages.forEach((result) => {
                        resultsContainer.innerHTML += `<div class="mb-2"><a href="${result.link}" class="text-blue-600 hover:underline">${result.title}</a></div>`;
                    });
                }

                if (categories.posts.length > 0) {
                    if (categories.pages.length > 0) {
                        resultsContainer.innerHTML += `<h3 class="text-xl font-bold mt-4 mb-2">Posts</h3>`;
                    } else {
                        resultsContainer.innerHTML += `<h3 class="text-xl font-bold mb-2">Posts</h3>`;
                    }
                    categories.posts.forEach((result) => {
                        resultsContainer.innerHTML += `<div class="mb-2"><a href="${result.link}" class="text-blue-600 hover:underline">${result.title}</a></div>`;
                    });
                }

                if (categories.pages.length === 0 && categories.posts.length === 0) {
                    resultsContainer.innerHTML = `<p class="text-center">No WordPress results found.</p>`;
                }
            } else {
                resultsContainer.innerHTML = `<p class="text-center">No WordPress results found.</p>`;
            }
        },
        error: function() {
            resultsContainer.innerHTML = `<p class="text-center">Error fetching WordPress results.</p>`;
        }
    });

    // Fetch Trello search results
    $.ajax({
        url: 'http://unified-seach-platform.test//wp-json/myplugin/v1/trello-search/',
        type: 'GET',
        data: { query: query },
        success: function(response) {
            if (response && response.length > 0) {
                resultsContainer.innerHTML += `<h3 class="text-xl font-bold mt-4 mb-2">Trello Cards</h3>`;
                response.forEach((result) => {
                    resultsContainer.innerHTML += `
                        <div class="mb-4">
                            <a href="${result.url}" class="text-blue-600 hover:underline text-base mb-2" target="_blank">${result.title}</a>
                            <div class="text-sm text-gray-600">${result.content}</div>
                        </div>`;
                });
            } else {
                resultsContainer.innerHTML += `<p class="text-center mt-4">No Trello results found.</p>`;
            }
        },
        error: function() {
            resultsContainer.innerHTML += `<p class="text-center mt-4">Error fetching Trello results.</p>`;
        }
    });
}
