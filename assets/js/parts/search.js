function clearSearchOverlay() {
  document.getElementById("search-input-overlay").value = "";
  document.getElementById("search-results").innerHTML = "";
}

function handleInputChange() {
  if (document.getElementById("search-input-overlay").value === "") {
    document.getElementById("search-results").innerHTML = "";
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

deleteRecentSearch = function (index) {
  let recentSearches = JSON.parse(localStorage.getItem("recentSearches")) || [];
  recentSearches.splice(index, 1);
  localStorage.setItem("recentSearches", JSON.stringify(recentSearches));
  displayRecentSearches();
};

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

document.getElementById("search-icon").addEventListener("click", function () {
  document.getElementById("search-overlay").classList.remove("hidden");
  document.getElementById("search-input-overlay").focus();
  displayRecentSearches();
});

document
  .getElementById("close-search")
  .addEventListener("click", closeSearchOverlay);

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    closeSearchOverlay();
  }
});

document
  .getElementById("search-input-overlay")
  .addEventListener("input", handleInputChange);

document
  .getElementById("search-input-overlay")
  .addEventListener("focus", displayRecentSearches);

document
  .getElementById("searchform")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    let query = document.getElementById("search-input-overlay").value.trim();
    let resultsContainer = document.getElementById("search-results");

    resultsContainer.innerHTML = "";

    if (query !== "") {
      saveSearch(query);

      let results = [];

      if (results.length > 0) {
        let resultsHTML = `<p class="flex justify-start">Results for "${query}":</p><ul class="flex flex-col list-none">`;
        results.forEach((result) => {
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
