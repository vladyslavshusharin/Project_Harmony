<?php 
require "Model/message.php";
require "Model/user.php";

class MessageController{

    public function LoadMessageContainer(){
        require "View/messagecontainer.php";
    }

    public function LoadMessages(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $CONVO_ID = $_GET['ConvoID'];
            $OTHER_USER = $_GET['OtherUser'];
            $messages = Message::getMessages($CONVO_ID);
            $other_user = User::getUser($OTHER_USER)->fetch_assoc();
            if($messages){
                
                require "View/messages.php";
            }else{
                echo "Error loading messages";
            }
        }

        
    }

    public function GetMessageInput(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $CONVO_ID = $_GET['ConvoID'];
            $OTHER_USER = $_GET['OtherUser'];
            require "View/messagesinput.php";
        }
    }

    public function SendMessage(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $SENDER = $_POST['user_ID'];
            $CONVO_ID = $_POST['convo_ID'];
            $MESSAGE_CONT = trim($_POST['message_content']);

            if (!empty($MESSAGE_CONT)){
                $sent = Message::sendMessage($CONVO_ID, $SENDER, $MESSAGE_CONT);
            }
        
        }
    }
    

}



?>