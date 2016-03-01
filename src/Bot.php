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
        switch ($this->REQUEST->text) {
            case "/start":
                $mex = "Salve, sono un bot!";
                $this->apiSendMessage($mex);
                break;
            case "/stop":
                $mex = "Arrivederci!";
                $this->apiSendMessage($mex);
                break;
            case "/search":
                $this->STATE = 1;
                $mex = "Digita le parole chiavi delle gif";
                $this->apiSendMessage($mex);
                break;

            default:
                if ($this->STATE === 1) {
                    $this->giphyApi();
                    $this->STATE = 0;
                } else {
                    $mex = "Sono un po' stupido, ripeti il comando :)";
                    $this->apiSendMessage($mex);
                }
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

    function giphyApi() {
        $mex = file_get_contents('http://api.giphy.com/v1/gifs/search?q=funny+cat&api_key=dc6zaTOxFJmzC');
        $this->apiSendMessage($mex);
    }

}
