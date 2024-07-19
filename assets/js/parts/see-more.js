function seeMore($) {
    var loadMoreButton = $('#see-more');
    var pageContainer = $('#page-container');
    var postContainer = $('#posts-container');
    var trelloContainer = $('#trello-container');
    var endpoint1 = loadMoreButton.data('endpoint1');
    var endpoint2 = loadMoreButton.data('endpoint2');
    var endpoint3 = loadMoreButton.data('endpoint3');
    var currentPage1 = 1;
    var currentPage2 = 1;
    var currentPage3 = 1;
    var loadedPages = [];
    var loadedPosts = [];
    var loadedTrellos = [];
    var noMorePages = false;
    var noMorePosts = false;
    var noMoreTrellos = false;
    var pageTitle = false;
    var postTitle = false;
    var trelloTitle = false;
    var defaultImg = '/wp-content/themes/unified-search-platform/assets/images/coming_pic.jpg';

    if (loadMoreButton.length) {
        var loadPosts = function(endpoint, page, container, loadedItems, titleAdded, containerTitle, callback) {
            $.ajax({
                url: endpoint,
                dataType: 'json',
                data: {
                    page: page,
                },
                beforeSend: function() {
                    loadMoreButton.attr('disabled', true).text('Loading...');
                },
                success: function(response) {
                    var data = response.results;
                    var totalPages = response.total_pages;

                    if (data.length) {
                        if (!titleAdded) {
                            container.prepend('<h1 class="w-full text-[#001D33] text-xl font-medium mt-2 text-center">' + containerTitle + '</h1>');
                            if (endpoint === endpoint1) pageTitle = true;
                            if (endpoint === endpoint2) postTitle = true;
                            if (endpoint === endpoint3) trelloTitle = true;
                        }
                        appendPosts(data, container);
                        callback(null, data, totalPages);
                    } else {
                        callback('No more data available');
                    }
                    if (page >= totalPages) {
                        if (endpoint === endpoint1) noMorePages = true;
                        if (endpoint === endpoint2) noMorePosts = true;
                        if (endpoint === endpoint3) noMoreTrellos = true;
                    }
                },
                error: function(jqXHR) {
                    console.log('Error:', jqXHR.status + ' ' + jqXHR.statusText);
                    callback(jqXHR.statusText);
                },
                complete: function() {
                    checkAllPostsLoaded();
                    loadMoreButton.attr('disabled', false).text('Show More');
                }
            });
        };

        var appendPosts = function(data, container) {
            data.forEach(post => {
                var html = '';
                if (post.type === 'Trello Card') {
                    html += '<a href="' + post.url + '" class="post-item h-[388px] w-[330px] bg-[#F7F9FF] shadow-md hover:shadow-[#51606F]/30 p-4 rounded-2xl transition ease-in-out delay-10 hover:scale-105">';
                    html += '<div id="post-' + post.id + '" class="post-search">';
                    html += '<img class="w-full h-[180px] rounded-lg object-cover" src="' + defaultImg + '" alt="' + post.title + '">';
                    html += '<div class="mt-4">';
                    html += '<p class="text-[#2F628C] font-medium">' + post.type + '</p>';
                    html += '<h4 class="text-[#001D33] text-lg font-medium mt-2">' + post.title + '</h4>';
                    if (post.content) {
                        html += '<p class="text-[#51606F] text-sm mt-2">' + post.content + '</p>';
                    }
                    html += '<p class="text-[#51606F] text-sm font-medium mt-3">' + post.website + '</p>';
                    html += '</div></div></a>';
                } else {
                    html += '<a href="' + post.link + '" class="post-item h-[388px] w-[330px] bg-[#F7F9FF] shadow-md hover:shadow-[#51606F]/30 p-4 rounded-2xl transition ease-in-out delay-10 hover:scale-105">';
                    html += '<div id="post-' + post.id + '" class="post-search">';
                    if (post.thumbnail) {
                        html += '<img class="w-full h-[180px] rounded-lg object-cover" src="' + post.thumbnail + '" alt="' + post.title + '">';
                    } else {
                        html += '<img class="w-full h-[180px] rounded-lg object-cover" src="' + defaultImg + '" alt="' + post.title + '">';
                    }
                    html += '<div class="mt-4">';
                    if (post.category) {
                        html += '<p class="text-[#2F628C] font-medium">' + post.category + '</p>';
                    }
                    html += '<h4 class="text-[#001D33] text-lg font-medium mt-2">' + post.title + '</h4>';
                    if (post.excerpt) {
                        html += '<p class="text-[#51606F] text-sm mt-2">' + post.excerpt + '</p>';
                    }
                    if (post.author) {
                        html += '<p class="text-[#51606F] text-sm font-medium mt-3">' + post.author + '</p>';
                    }
                    html += '</div></div></a>';
                }
                container.append(html);
            });
        };

        var loadMorePosts = function() {
            if (!noMorePages) {
                loadPosts(endpoint1, currentPage1, pageContainer, loadedPages, pageTitle, 'Pages', function(error, data, totalPages) {
                    if (error) {
                        noMorePages = true;
                    } else {
                        currentPage1++;
                    }
                });
            }

            if (!noMorePosts) {
                loadPosts(endpoint2, currentPage2, postContainer, loadedPosts, postTitle, 'Posts', function(error, data, totalPages) {
                    if (error) {
                        noMorePosts = true;
                    } else {
                        currentPage2++;
                    }
                });
            }

            if (!noMoreTrellos) {
                loadPosts(endpoint3, currentPage3, trelloContainer, loadedTrellos, trelloTitle, 'Trello', function(error, data, totalPages) {
                    if (error) {
                        noMoreTrellos = true;
                    } else {
                        currentPage3++;
                    }
                });
            }
        };

        var checkAllPostsLoaded = function() {
            if (noMorePages && noMorePosts && noMoreTrellos) {
                loadMoreButton.remove();
            } else {
                loadMoreButton.attr('disabled', false).text('Show More');
            }
        };

        loadMoreButton.on('click', function() {
            loadMorePosts();
        });

        loadMorePosts();
    }
}

export default seeMore;
