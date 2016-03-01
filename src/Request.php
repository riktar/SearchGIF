<?php
/**
 * Track the Telegram Mex
 */
class Request {

    public $update;
    public $message;
    public $messageId;
    public $chatId;
    public $senderId;
    public $firstname;
    public $lastname;
    public $username;
    public $date;
    public $text;

    function __construct() {
        echo 'qui';
        $this->update = json_decode(file_get_contents("php://input"), true);
        if (!$this->update) {
            exit;
        }
        
        $this->message = isset($update['message']) ? $update['message'] : "";
        $this->messageId = isset($this->message['message_id']) ? $this->message['message_id'] : "";
        $this->chatId = isset($this->message['chat']['id']) ? $this->message['chat']['id'] : "";
        $this->senderId = isset($this->message['chat']['id']) ? $this->message['chat']['id'] : "";
        $this->firstname = isset($this->message['chat']['first_name']) ? $this->message['chat']['first_name'] : "";
        $this->lastname = isset($this->message['chat']['last_name']) ? $this->message['chat']['last_name'] : "";
        $this->username = isset($this->message['chat']['username']) ? $this->message['chat']['username'] : "";
        $this->date = isset($this->message['date']) ? $this->message['date'] : "";
        $this->text = isset($this->message['text']) ? $this->message['text'] : "";
        $this->text = trim($this->text);
        $this->text = strtolower($this->text);
    }

}
