<?php

namespace Src;

class Bot {

    private $REQUEST;

    function __construct() {
        $this->REQUEST = new Request();
        var_dump($this->REQUEST);
        $this->apiSendMessage('Salve!');
    }

    protected function apiSendMessage($text, $params = array()) {
        $params += array(
            'chat_id' => $this->REQUEST->chatId,
            'text' => $text,
        );
        header("Content-Type: application/json");
        $params["method"] = "sendMessage";
        echo json_encode($params);
    }

}
