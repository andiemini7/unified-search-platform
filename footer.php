<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid gap-y-8 lg:grid-cols-5 lg:gap-x-36 ">

        
            <div class="block lg:hidden  col-span-2 mb-4 ">
                <h1 class="text-2xl font-normal mb-2 ">Logo here</h1>
                <p class="text-sm font-normal leading-5 text-gray-200">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>


            <div class="hidden lg:block ">
                <h1 class="text-2xl font-normal mb-2 ">Logo here</h1>
                <p class="text-sm font-normal leading-5 text-gray-200">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>

        
            <div > 
               <h2 class="text-sm font-medium mb-2 leading-5">Product</h2>
                <ul class="text-sm font-normal leading-5 text-gray-200">
                   <?php
                  
                      $product_links = array(
                          array("Enterprise", "#"),
                          array("Pricing plan", "#"),
                          array("Features", "#"),
                          array("How it works", "#")
                      );
                      
                    
                      foreach ($product_links as $link) {
                          echo "<li class='mb-2'><a href='" . $link[1] . "' class='hover:underline'>" . $link[0] . "</a></li>";
                      }
                   ?>
                </ul>
            </div>

         
            <div >
                <h2 class="text-sm font-medium mb-2 leading-5">Company</h2>
                <ul class="text-sm font-normal leading-5 text-gray-200">
                    <?php
                     
                      $company_links = array(
                          array("About us", "#"),
                          array("Careers", "#"),
                          array("Legal", "#"),
                          array("Gallery", "#")
                      );
                     
                      foreach ($company_links as $link) {
                          echo "<li class='mb-2'><a href='" . $link[1] . "' class='hover:underline'>" . $link[0] . "</a></li>";
                      }
                   ?>
                </ul>
            </div>
          

            <div >
                <h2 class="text-sm font-medium mb-2 leading-5 text-gray-200">Legals</h2>
                <ul class="text-sm font-normal leading-5 ">
                    <?php
                      
                      $legal_links = array(
                          array("Privacy", "#"),
                          array("Licenses", "#"),
                          array("Terms", "#"),
                          array("Refunds", "#")
                      );

                      

                      // Loop për të shfaqur lidhjet
                      foreach ($legal_links as $link) {
                          echo "<li class='mb-2'><a href='" . $link[1] . "' class='hover:underline'>" . $link[0] . "</a></li>";
                      }
                   ?>
                </ul>
            </div>
            
          
            <div>
    <h2 class="text-sm font-medium mb-2 leading-5 text-gray-200">Social Media</h2>
    <ul class="text-sm font-normal leading-5 ">
        <?php
           
            $social_media_links = array(
                array("Instagram", "#"),
                array("LinkedIn", "#"),
                array("Facebook", "#"),
                array("Twitter", "#")
            );
          
            foreach ($social_media_links as $link) {
                echo "<li class='mb-2'><a href='" . $link[1] . "' class='hover:underline'>" . $link[0] . "</a></li>";
            }
        ?>
    </ul>
</div>
        </div>
    </div>
 

    <div class="text-center mt-6 lg:mt-8">
        <p class="text-sm text-gray-600">&copy; <?php echo date("Y"); ?> All Rights Reserved.</p>
    </div>

</footer>
<?php wp_footer(); ?>
</body>
</html>
