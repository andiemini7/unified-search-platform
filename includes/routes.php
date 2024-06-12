<?php

namespace Hp\UnifiedSearchPlatform;

require_once __DIR__ . '/../app/endpoints/searchendpoint.php';

use Hp\UnifiedSearchPlatform\App\Endpoints\Search_Endpoint;

class Routes {
    public function register_routes() {
     

        $search_endpoint = new Search_Endpoint();
        $search_endpoint->register_route();

        
    }
}

?>
