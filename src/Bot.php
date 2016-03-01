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
        //$this->giphyApi();
    }

    function executeCommand() {
        if ($this->REQUEST->text === "/start") {
            $mex = "Salve, sono GIFBot! usa il comando /search seguito dalle parole chiavi delle gif che vuoi trovare! (es. /search dicaprio)";
            $this->apiSendMessage($mex);
        } elseif ($this->REQUEST->text === "/stop") {
            $mex = "Arrivederci!";
            $this->apiSendMessage($mex);
        } elseif (strpos($this->REQUEST->text, "/search") === 0) {
            //$this->apiSendMessage("sto cercando...");
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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api.giphy.com/v1/gifs/random?tag=funny+cat&api_key=dc6zaTOxFJmzC");
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $resp = trim(curl_exec($ch));
        curl_close($ch);

        if (curl_errno($ch)) {
            $this->apiSendMessage(curl_errno($ch));
        } else {
            $mex = "Ok! \n";
            $result = json_decode($resp);
            //var_dump($result->data);
            $mex .= $result->data->url . " \n\n";
            $this->apiSendMessage($mex);
        }
    }

}
