<?php
$id = get_the_id();

$search_input = get_field('search_input', $id);
?>

<div class="search-container flex justify-center items-center">
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="max-w-lg mx-auto relative w-full">
        <div class="relative flex items-center w-full">
            <button type="submit" id="search-icon" class="absolute left-2 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="28" viewBox="0 0 24 24" fill="#ffffff" stroke="#000000">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
            <input name="s" id="search-input" class="w-full pl-12 pr-10 py-3 border border-gray-300 rounded-lg text-lg placeholder-gray-400 focus:outline-none focus:border-blue-500" type="text" placeholder="<?php echo esc_attr($search_input); ?>" />
            <button type="button" id="clear-search" class="absolute right-2 cursor-pointer hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" stroke="#000000">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div id="suggestions" class="hidden absolute w-full bg-white border border-gray-200 shadow-lg rounded-lg mt-1 z-10"></div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const clearSearch = document.getElementById('clear-search');
    const suggestions = document.getElementById('suggestions');

    searchInput.addEventListener('input', function() {
        const query = searchInput.value.trim();

        if (query.length === 0) {
            clearSearch.classList.add('hidden');
            clearSuggestions();
            return;
        } else {
            clearSearch.classList.remove('hidden');
        }

        fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=autosuggest&term=${encodeURIComponent(query)}`)
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
});
</script>
