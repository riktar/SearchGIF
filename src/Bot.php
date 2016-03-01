<?php
/*
 * Init a Bot
 */
class Bot {

    private $REQUEST;

    function __construct() {
        echo 'bot init';
        //$this->REQUEST = new Request();
        //echo 'bot request';
        //var_dump($this->REQUEST);
    //        $this->apiSendMessage('Salve!');
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
