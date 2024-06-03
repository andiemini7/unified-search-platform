jQuery(function ($) {
  var initialPostCount = 8; // Number of initially loaded posts
  var maxPostCount = initialPostCount; // Maximum number of posts to display initially
  var totalPostCount = custom_js_params.found_posts; // Total number of posts in the query

  // Hide posts beyond the initial count
  $(".post-item").slice(initialPostCount).hide();

  $("#see-more").click(function () {
    var button = $(this);

    // Check if there are more posts to show
    if (maxPostCount < totalPostCount) {
      $(".post-item:hidden").slice(0, initialPostCount).show(); // Show additional posts
      maxPostCount += initialPostCount;

      if (maxPostCount >= totalPostCount) {
        button.text("See Less");
      }
    } else {
      $(".post-item").slice(initialPostCount).hide(); // Hide additional posts
      maxPostCount = initialPostCount;
      button.text("See More");

      // Scroll to the top of the page
      $("html, body").animate({ scrollTop: 0 }, "slow");
    }
  });
});
