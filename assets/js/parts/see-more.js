
function seeMore($) {
    var loadMoreButton = $('#see-more');
    var loadMoreContainer = $('#posts-container');
    var loadedPostIds = new Set(); 
  
    if (loadMoreButton.length) {
        var endpoint = loadMoreButton.data('endpoint');
        var page = 1; 
  
        var loadPosts = function(page) {
            $.ajax({
                url: endpoint,
                dataType: 'json',
                data: {
                    page: page,
                    type: 'post',
                },
                beforeSend: function() {
                    loadMoreButton.attr('disabled', true).text('Loading...');
                },
                success: function(data) {
                    if (data.length) {
                        var newPosts = data.filter(post => !loadedPostIds.has(post.id));
  
                        if (newPosts.length) {
                            newPosts.forEach(post => {
                                loadedPostIds.add(post.id); 
  
                                var html = '<a href="' + post.link + '" class="post-item h-[388px] w-[330px] bg-[#F7F9FF] shadow-md hover:shadow-[#51606F]/30 p-4 rounded-2xl transition ease-in-out delay-10 hover:scale-105">';
                                html += '<div id="post '+ post.id +'" class="post-search">';
                                if (post.thumbnail) {
                                    html += '<img class="w-full h-[180px] rounded-lg object-cover" src="' + post.thumbnail + '" alt="' + post.title + '">';
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
                                loadMoreContainer.append(html);
                            });
  
                            loadMoreButton.prop('disabled', false).text('Show More');
                        } else {
                            loadMoreButton.prop('disabled', true).text('No more posts');
                        }
                    } else {
                        loadMoreButton.prop('disabled', true).text('No post found!');
                    }
                },
                error: function(jqXHR) {
                    console.log('Error:', jqXHR.status + ' ' + jqXHR.statusText);
                }
            });
        };
  
        loadMoreButton.on('click', function() {
            loadPosts(page);
            page++;
        });
  
        loadMoreButton.trigger('click');
    }
  }
  
  export default seeMore;

{
    seeMore(jQuery);
  }