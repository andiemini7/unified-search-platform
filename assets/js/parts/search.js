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

    $.ajax({
        url: '/wp-json/myplugin/v1/search/',
        type: 'GET',
        data: { query: query },
        success: function(response) {
            let categories = { pages: [], posts: [], trello: [] };

            if (response && response.length > 0) {
                response.forEach((result) => {
                    if (result.post_type === 'page') {
                        categories.pages.push(result);
                    } else if (result.post_type === 'post') {
                        categories.posts.push(result);
                    } else if (result.post_type === 'trello_card') {
                        categories.trello.push(result);
                    }
                });

                let resultsHtml = '';

                if (categories.pages.length > 0) {
                    resultsHtml += `<h3 class="text-xl font-bold mb-2">Pages</h3>`;
                    categories.pages.forEach((result) => {
                        resultsHtml += `<div class="mb-2"><a href="${result.link}" class="text-blue-600 hover:underline">${result.title}</a></div>`;
                    });
                }

                if (categories.posts.length > 0) {
                    resultsHtml += `<h3 class="text-xl font-bold mt-4 mb-2">Posts</h3>`;
                    categories.posts.forEach((result) => {
                        resultsHtml += `<div class="mb-2"><a href="${result.link}" class="text-blue-600 hover:underline">${result.title}</a></div>`;
                    });
                }

                if (categories.trello.length > 0) {
                    resultsHtml += `<h3 class="text-xl font-bold mt-4 mb-2">Trello Cards</h3>`;
                    categories.trello.forEach((result) => {
                        resultsHtml += `
                            <div class="mb-4">
                                <a href="${result.url}" class="text-blue-600 hover:underline text-base mb-2" target="_blank">${result.title}</a>
                                <div class="text-sm text-gray-600">${result.content}</div>
                            </div>`;
                    });
                }

                if (resultsHtml === '') {
                    resultsHtml = `<p class="text-center">No results found.</p>`;
                }

                resultsContainer.innerHTML = resultsHtml;
            } else {
                resultsContainer.innerHTML = `<p class="text-center">No results found.</p>`;
            }
        },
        error: function() {
            resultsContainer.innerHTML = `<p class="text-center">Error fetching results.</p>`;
        }
    });
}
