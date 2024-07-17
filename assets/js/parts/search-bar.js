// assets/js/parts/search-bar.js

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const clearSearch = document.getElementById('clear-search');
    const suggestions = document.getElementById('suggestions');

    function fetchSuggestions(query) {
        fetch(`http://localhost/wp-admin/admin-ajax.php?action=autosuggest&term=${encodeURIComponent(query)}`)
            .then(response => response.text())
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    clearSuggestions();
                    if (data.success && data.data.length > 0) {
                        data.data.forEach(item => {
                            const suggestionItem = document.createElement('div');
                            suggestionItem.classList.add('suggestion-item', 'p-2', 'cursor-pointer', 'hover:bg-gray-100', 'rounded-lg');
                            suggestionItem.innerHTML = `<a href="${item.link}" class="block">${item.title}</a>`;
                            suggestions.appendChild(suggestionItem);
                        });
                        suggestions.classList.remove('hidden');
                    } else {
                        suggestions.innerHTML = '<p class="p-2 text-sm">No results found</p>';
                        suggestions.classList.remove('hidden');
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error, text);
                    suggestions.innerHTML = '<p class="p-2 text-sm">Error fetching suggestions</p>';
                    suggestions.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error fetching suggestions:', error);
                suggestions.innerHTML = '<p class="p-2 text-sm">Error fetching suggestions</p>';
                suggestions.classList.remove('hidden');
            });
    }

    searchInput.addEventListener('input', function() {
        const query = searchInput.value.trim();

        if (query.length === 0) {
            clearSearch.classList.add('hidden');
            clearSuggestions();
            return;
        } else {
            clearSearch.classList.remove('hidden');
        }

        fetchSuggestions(query);
    });

    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        clearSearch.classList.add('hidden');
        clearSuggestions();
    });

    const searchIcon = document.getElementById('search-icon');
    searchIcon.addEventListener('click', function(event) {
        event.preventDefault();
        const query = searchInput.value.trim();
        if (query.length > 0) {
            searchInput.closest('form').submit();
        }
    });

    function clearSuggestions() {
        suggestions.innerHTML = '';
        suggestions.classList.add('hidden');
    }

    document.addEventListener('click', function(event) {
        const searchContainer = document.querySelector('.search-container');
        if (searchContainer && !searchContainer.contains(event.target)) {
            clearSuggestions();
        }
    });

    const suggestionCards = document.querySelectorAll('.suggestion-card');
    suggestionCards.forEach(card => {
        card.addEventListener('click', function() {
            const title = card.getAttribute('data-title');
            searchInput.value = title;
            fetchSuggestions(title);
        });
    });
});
