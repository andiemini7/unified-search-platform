<?php
namespace Hp\UnifiedSearchPlatform\App\Services;

use Unirest\Request;

class TrelloService {
    private $apiKey;
    private $token;
    private $boardId;

    public function __construct($apiKey, $token, $boardId) {
        $this->apiKey = $apiKey;
        $this->token = $token;
        $this->boardId = $boardId;
    }

    public function fetchTrelloData() {
        $query = array(
            'key' => $this->apiKey,
            'token' => $this->token
        );

        $url_board = "https://api.trello.com/1/boards/{$this->boardId}";
        $url_lists = "https://api.trello.com/1/boards/{$this->boardId}/lists";
        $url_cards = "https://api.trello.com/1/boards/{$this->boardId}/cards";
        $url_members = "https://api.trello.com/1/boards/{$this->boardId}/members";

        $response_board = Request::get($url_board, null, $query);
        $response_lists = Request::get($url_lists, null, $query);
        $response_cards = Request::get($url_cards, null, $query);
        $response_members = Request::get($url_members, null, $query);

        if ($response_board->code == 200 && $response_lists->code == 200 && $response_cards->code == 200 && $response_members->code == 200) {
            $board = $response_board->body;
            $lists = $response_lists->body;
            $cards = $response_cards->body;
            $members = $response_members->body;

            $data = [
                'board' => [
                    'id' => $board->id,
                    'name' => $board->name,
                    'desc' => $board->desc
                ],
                'lists' => array_map(function($list) {
                    return [
                        'id' => $list->id,
                        'name' => $list->name
                    ];
                }, $lists),
                'cards' => array_map(function($card) {
                    return [
                        'id' => $card->id,
                        'name' => $card->name,
                        'desc' => $card->desc,
                        'url' => $card->url,
                        'list_id' => $card->idList
                    ];
                }, $cards),
                'members' => array_map(function($member) {
                    return [
                        'id' => $member->id,
                        'username' => $member->username,
                        'fullName' => $member->fullName
                    ];
                }, $members)
            ];

            return json_encode($data);
        } else {
            $errors = [
                'board' => $response_board->code !== 200 ? json_encode($response_board->body) : null,
                'lists' => $response_lists->code !== 200 ? json_encode($response_lists->body) : null,
                'cards' => $response_cards->code !== 200 ? json_encode($response_cards->body) : null,
                'members' => $response_members->code !== 200 ? json_encode($response_members->body) : null,
            ];

            return json_encode(['error' => $errors]);
        }
    }
}
