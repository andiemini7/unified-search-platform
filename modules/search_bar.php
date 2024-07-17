<?php
$id = get_the_id();
$search_input = get_field('search_input', $id);
$topSuggestions = get_top_suggestions();
?>
<div class="min-h-screen bg-gradient-to-b from-white to-gray-200 flex flex-col justify-center items-center w-full">
    <!-- Top Suggestions Container -->
    <div id="top-suggestions" class="max-w-5xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 px-4 lg:px-0">
        <?php foreach ($topSuggestions as $suggestion): ?>
            <div class="suggestion-card flex flex-col items-start bg-white border border-gray-200 shadow-lg rounded-lg p-6 text-gray-800" data-title="<?php echo esc_attr($suggestion['title']); ?>">
                <div class="icon mb-2"><?php echo $suggestion['icon']; ?></div>
                <div class="text-left">
                    <h3 class="text-xl font-medium mb-2"><?php echo $suggestion['title']; ?></h3>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Search Form -->
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="w-full mx-auto relative mt-10">
        <div class="relative flex items-center justify-center mx-auto w-3/4">
            <button type="submit" id="search-icon" class="absolute left-4 cursor-pointer">
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
        <div class="w-3/4 mx-auto">
            <div id="suggestions" class="hidden w-3/4 absolute bg-white border border-gray-200 shadow-lg rounded-lg mt-1 z-10"></div>
        </div>
    </form>
</div>

<script>
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

</script>