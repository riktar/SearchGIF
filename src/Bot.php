<?php

/*
 * Init a Bot
 */

class Bot {

    private $REQUEST;

    function __construct() {
        $this->REQUEST = new Request();
        $this->executeCommand();
    }

    function executeCommand() {
        switch ($this->REQUEST->text) {
            case "/start":
                $mex = "Salve, sono un bot!";
                $this->apiSendMessage($mex);
                break;
            case "/stop":
                $mex = "Arrivederci!";
                $this->apiSendMessage($mex);
                break;

            default:
                break;
        }
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
