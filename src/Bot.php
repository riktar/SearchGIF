<?php
/*
 * Init a Bot
 */
class Bot {

    private $REQUEST;

    function __construct() {
        $this->REQUEST = new Request();
        $this->apiSendMessage('Salve!');
    }

    function apiSendMessage($text, $params = array()) {
        $params += array(
            'chat_id' => $this->REQUEST->chatId,
            'text' => $text,
        );
        header("Content-Type: application/json");
        $params["method"] = "sendMessage";
        echo json_encode($params);
    }

}
