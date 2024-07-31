<?php
$id = get_the_id();
$search_input = 'Search for information within the company...'; 
$topSuggestions = get_top_suggestions();
?>
<div class="px-4 md:px-16 py-4 mx-auto">
    <div class="p-4 rounded-3xl relative bg-cover bg-center bg-custom  flex flex-col justify-center items-center" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/images/bg.png'; ?>');">
        <!-- Overlay -->
        <div class="rounded-3xl absolute inset-0 bg-black opacity-50"></div>
        
        <!-- Content Section -->
        <div class="relative z-[1] px-4 lg:px-6 py-8 w-full max-w-5xl">
            <!-- Container for text and cards -->
            <div class="content-container flex flex-col items-center">
                <!-- Text Section -->
                <div class="text-section mb-8 text-center">
                    <h1 class="text-2xl lg:text-4xl mb-2 font-bold text-white">Discover & Explore</h1>
                    <h1 class="text-2xl lg:text-4xl mb-4 font-bold text-white">Our Unified Search Platform</h1>
                    <h6 class="mb-6 text-gray-300 text-lg">Explore Our Top Suggestions – Delve into a World of Curated Content and Discover What’s Trending and Relevant to Your Needs</h6>
                </div>

                <!-- Top Suggestions Container -->
                <div id="top-suggestions" class="max-w-5xl w-full mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-10">
                    <?php foreach ($topSuggestions as $suggestion): ?>
                        <div class="tooltip-wrapper">
                            <div class="tooltip hidden absolute bg-black text-white text-xs py-1 px-2 rounded">
                                Search Suggestion
                            </div>
                            <div class="suggestion-card h-full grow flex flex-col gap-2 items-center justify-center bg-white border border-gray-200 shadow-lg rounded-lg p-4 text-gray-800 transition-transform duration-300 transform hover:-translate-y-1" data-title="<?php echo esc_attr($suggestion['title']); ?>">
                                <div class="bg-white-500 p-2 text-2xl flex items-center justify-center bg-gray-100 rounded-full">
                                    <?php echo $suggestion['icon']; ?>
                                </div>
                                <div class="text-center">
                                    <h3 class="text-base font-medium"><?php echo $suggestion['title']; ?></h3>
                                    <p class="text-sm text-gray-500">Suggested Search</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Search Form -->
                <form id="search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="w-full mx-auto relative">
                    <div class="relative flex items-center mx-auto w-full lg:w-3/4">
                        <input name="s" id="search-input" class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg text-lg placeholder-gray-400 focus:outline-none focus:border-blue-500" type="text" placeholder="<?php echo esc_attr($search_input); ?>" />
                        <button type="button" id="clear-search" class="absolute right-16 top-1/2 transform -translate-y-1/2 cursor-pointer hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                        <button type="submit" id="search-button" class="absolute right-0 top-0 h-full py-2 px-4 text-white rounded-lg hover:bg-gray-700 flex items-center justify-center transition duration-300 ease-in-out" style="background-color: #808080;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="relative w-full lg:w-3/4 mx-auto mt-4 lg:mt-0">
                        <div id="suggestions" class="hidden absolute w-full bg-white border border-gray-200 shadow-lg rounded-lg mt-1 z-10" style="top: 100%; left: 0;"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const clearSearch = document.getElementById('clear-search');
    const suggestions = document.getElementById('suggestions');

    function fetchSuggestions(query) {
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

    searchForm.addEventListener('submit', function(event) {
        const query = searchInput.value.trim();
        if (query.length === 0) {
            event.preventDefault(); // Prevent form submission
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

    document.querySelectorAll('.tooltip-wrapper').forEach(wrapper => {
        const tooltip = wrapper.querySelector('.tooltip');
        wrapper.addEventListener('mouseover', () => {
            tooltip.classList.remove('hidden');
        });
        wrapper.addEventListener('mouseout', () => {
            tooltip.classList.add('hidden');
        });
    });
});
</script>