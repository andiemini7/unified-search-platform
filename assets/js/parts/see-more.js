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
        var loadPosts = function(endpoint, page, container, loadedPosts, titleAdded, containerTitle, callback) {
            $.ajax({
                url: endpoint,
                dataType: 'json',
                data: {
                    page: page,
                },
                beforeSend: function() {
                    loadMoreButton.attr('disabled', true).text('Loading...');
                },
                success: function(data) {
                    if (data.length) {
                        if (!titleAdded) {
                            container.prepend('<h1 class="w-full text-[#001D33] text-xl font-medium mt-2 text-center">' + containerTitle + '</h1>');
                            if (endpoint === endpoint1) pageTitle = true;
                            if (endpoint === endpoint2) postTitle = true;
                            if (endpoint === endpoint3) trelloTitle = true;
                        }
                        appendPosts(data, container, endpoint, loadedPosts);
                        callback(null, data);
                    } else {
                        callback('No more data available');
                    }
                },
                error: function(jqXHR) {
                    console.log('Error:', jqXHR.status + ' ' + jqXHR.statusText);
                    callback(jqXHR.statusText);
                },
                complete: function() {
                    loadMoreButton.attr('disabled', false);
                }
            });
        };

        var appendPosts = function(data, container, currentEndpoint, loadedPosts) {
            data.forEach(post => {
                if (loadedPosts.includes(post.id)) {
                    return;
                }

                loadedPosts.push(post.id);

                var html = '';
                // Trello html
                if (currentEndpoint === endpoint3) {
                    html += '<a href="' + post.url + '" class="post-item h-[388px] w-[330px] bg-[#F7F9FF] shadow-md hover:shadow-[#51606F]/30 p-4 rounded-2xl transition ease-in-out delay-10 hover:scale-105">';
                    html += '<div id="post-' + post.id + '" class="post-search">';
                    if (post.cover) {
                        html += '<img class="w-full h-[180px] rounded-lg object-cover" src="' + post.cover + '" alt="' + post.title + '">';
                    }else {
                        html += '<img class="w-full h-[180px] rounded-lg object-cover" src="' + defaultImg + '" alt="' + post.title + '">';
                    }
                    html += '<div class="mt-4">';
                    if (post.type) {
                        html += '<p class="text-[#2F628C] font-medium">' + post.type + '</p>';
                    }
                    html += '<h4 class="text-[#001D33] text-lg font-medium mt-2">' + post.title + '</h4>';
                    if (post.content) {
                        html += '<p class="text-[#51606F] text-sm mt-2">' + post.content + '</p>';
                    }
                    html += '<p class="text-[#51606F] text-sm font-medium mt-3">' + post.website +'</p>';
                    html += '</div></div></a>';
                } 
                // Standart html
                else {
                    html += '<a href="' + post.link + '" class="post-item h-[388px] w-[330px] bg-[#F7F9FF] shadow-md hover:shadow-[#51606F]/30 p-4 rounded-2xl transition ease-in-out delay-10 hover:scale-105">';
                    html += '<div id="post-' + post.id + '" class="post-search">';
                    if (post.thumbnail) {
                        html += '<img class="w-full h-[180px] rounded-lg object-cover" src="' + post.thumbnail + '" alt="' + post.title + '">';
                    }else {
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
                loadPosts(endpoint1, currentPage1, pageContainer, loadedPages, pageTitle, 'Pages', function(error, data) {
                    if (error) {
                        noMorePages = true;
                    } else {
                        currentPage1++;
                    }
                    checkAllPostsLoaded();
                });
            }

            if (!noMorePosts) {
                loadPosts(endpoint2, currentPage2, postContainer, loadedPosts, postTitle, 'Posts', function(error, data) {
                    if (error) {
                        noMorePosts = true;
                    } else {
                        currentPage2++;
                    }
                    checkAllPostsLoaded();
                });
            }

            if (!noMoreTrellos) {
                loadPosts(endpoint3, currentPage3, trelloContainer, loadedTrellos, trelloTitle, 'Trello Cards', function(error, data) {
                    if (error) {
                        noMoreTrellos = true;
                    } else {
                        currentPage3++;
                    }
                    checkAllPostsLoaded();
                });
            }
        };

        var checkAllPostsLoaded = function() {
            if (noMorePages && noMorePosts && noMoreTrellos) {
                loadMoreButton.prop('disabled', true).text('No more posts');
            } else {
                if (noMorePages && noMorePosts && noMoreTrellos) {
                    loadMoreButton.prop('disabled', true).text('No more posts');
                } else {
                    loadMoreButton.attr('disabled', false).text('Show More');
                }
            }
        };

        loadMoreButton.on('click', function() {
            loadMorePosts();
        });

        loadMorePosts();
    }
}

export default seeMore;