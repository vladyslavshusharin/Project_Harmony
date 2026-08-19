<?php 
require "Model/conversation.php";
require "Model/user.php";
require "Model/message.php";

class ConversationController{
    public function LoadConvos(){
        $convo = Conversation::getUserConvos($_SESSION['user_id']);

        require "View/convolist.php";
    }

    public function LoadSidebar(){
        $side = Conversation::getUserConvos($_SESSION['user_id']);

        require "View/sidebar.php";
    }

    public function CreateConvo(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $FRIEND_ID = $_POST['Friend_ID'];
            $USER_ID = $_SESSION['user_id'];
            $convoExist = Conversation::checkUserConvo($FRIEND_ID, $USER_ID);
            if(!$convoExist && $FRIEND_ID != $USER_ID){
                $convo_id = Conversation::createConvo();
                if($convo_id > 0){
                    $adduser = Conversation::addUserToConvo($USER_ID, $convo_id);
                    $addfriend = Conversation::addUserToConvo($FRIEND_ID, $convo_id);
                    if($adduser && $addfriend){
                        header('Content-Type: application/json');
                        $resp = [
                            'status' => 'success',
                            'other_user' => $FRIEND_ID,
                            'convo_id' => $convo_id
                        ];
                        echo json_encode($resp);
                    }   
                }
            }else{
                $convo_id = $convoExist;
                header('Content-Type: application/json');
                $resp = [
                    'status' => 'success',
                    'other_user' => $FRIEND_ID,
                    'convo_id' => $convoExist
                ];
                echo json_encode($resp);
            }

            
        }

        
    }

}



?>