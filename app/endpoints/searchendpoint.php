<?php
namespace Hp\UnifiedSearchPlatform\App\Endpoints;

use WP_Query;
use WP_REST_Response;
use Hp\UnifiedSearchPlatform\App\Services\TrelloService;

class Search_Endpoint {

    private $trelloService;

    public function __construct() {
        $this->trelloService = new TrelloService('6aed2d150a591dca58353b661d95caa8', 'ATTAe2feed6e60b5066661d3bc8d189f032e70cd4c795b208ac0a9367bde1a258330841BD090', '666c435626396c522a35355f');
    }

    public function register_routes() {
        register_rest_route('myplugin/v1', '/search', array(
            'methods' => 'GET',
            'callback' => array($this, 'handle_search'),
        ));
    }

    public function handle_search($request) {
        $search_query = $request->get_param('query');
        $data = array();

        $args = array(
            'post_type' => 'any',
            's' => $search_query,
            'posts_per_page' => -1,
        );

        $query = new WP_Query($args);

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
                    'source' => 'wordpress',
                );
            }
            wp_reset_postdata();
        }

        $trelloData = $this->trelloService->fetchTrelloData();

        if (!empty($trelloData)) {
            $trelloData = json_decode($trelloData, true); // Decode JSON data

            if (isset($trelloData['cards']) && is_array($trelloData['cards'])) {
                foreach ($trelloData['cards'] as $card) {
                    if (stripos($card['name'], $search_query) !== false || stripos($card['desc'], $search_query) !== false) {
                        $data[] = array(
                            'id' => $card['id'],
                            'title' => $card['name'],
                            'content' => $card['desc'],
                            'url' => $card['url'],
                            'post_type' => 'trello_card',
                            'website' => 'Trello',
                            'source' => 'trello',
                        );
                    }
                }
            }
        }

        return new WP_REST_Response($data, 200);
    }
    
}
