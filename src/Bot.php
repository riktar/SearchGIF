<?php

/*
 * Init a Bot
 */

class Bot {

    private $REQUEST;
    private $STATE = 0;

    function __construct() {
        $this->REQUEST = new Request();
        $this->executeCommand();
    }

    function executeCommand() {
        if ($this->REQUEST->text === "/start") {
            $mex = "Salve, sono un bot!";
            $this->apiSendMessage($mex);
        } elseif ($this->REQUEST->text === "/stop") {
            $mex = "Arrivederci!";
            $this->apiSendMessage($mex);
        } elseif (strpos($this->REQUEST->text, "/search") == 0) {
            $this->giphyApi();
        } else {
            $mex = "Sono un po' stupido, ripeti il comando :)";
            $this->apiSendMessage($mex);
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

    function giphyApi() {
        $mex = file_get_contents('http://api.giphy.com/v1/gifs/search?q=funny+cat&api_key=dc6zaTOxFJmzC');
        $this->apiSendMessage($mex);
    }

}
