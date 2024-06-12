<?php

namespace Hp\UnifiedSearchPlatform\App\Endpoints;

use WP_Query;
use WP_REST_Response;

class Search_Endpoint {

    public function register_route() {
        register_rest_route('myplugin/v1', '/search/', array(
            'methods' => 'GET',
            'callback' => array($this, 'handle_search'),
        ));
    }

    public function handle_search($request) {
        $search_query = $request->get_param('query');

        $args = array(
            'post_type' => 'any', 
            's' => $search_query,
            'posts_per_page' => -1, 
        );

        $query = new WP_Query($args);

       
        $data = array();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_type = get_post_type();
                $link = get_permalink();
                $website = get_bloginfo('name'); 

                $data[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'content' => get_the_excerpt(),
                    'post_type' => $post_type,
                    'link' => $link,
                    'website' => $website,
                    // Add more fields as needed
                );
            }
            wp_reset_postdata();
        }

        return new WP_REST_Response($data, 200);
    }
}