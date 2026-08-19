<?php 
require "Model/friends.php";

class FriendsController{
    public function FriendList(){
        $friends = Friends::getFriends($_SESSION['user_id']);
        $pending = Friends::getPending($_SESSION['user_id']);
        $incoming = Friends::getIncoming($_SESSION['user_id']);
        require "View/friendlist.php";
    }

    public function removeFriend(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $FRIEND_ID = $_POST['friend_ID'];
            $USER_ID = $_SESSION['user_id'];

            $removed = Friends::removeFriend($USER_ID, $FRIEND_ID);
            if($removed){
                $_SESSION['checkMsg'] = "friend removed";
            }else{
                $_SESSION['errorMsg'] = "Failed to remove friend";
                
            }
            
        }
    }

    public function SendFriendReq(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $FRIEND_NAME = $_POST['friend_username'];
            $USER_ID = $_SESSION['user_id'];

            $sent = Friends::sendRequest($USER_ID, $FRIEND_NAME);
            if($sent){
                $_SESSION['checkMsg'] = "invite sent";
            }else{
                $_SESSION['errorMsg'] = "invite failed (user doesn't exist or status already exists)";
            }
        }
    }

    public function AcceptReq(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $INCOMING_ID = $_POST['incoming_id'];
            $USER_ID = $_SESSION['user_id'];

            $accept = Friends::addFriend($USER_ID, $INCOMING_ID);
            if($accept){
                $_SESSION['checkMsg'] = "Accepted";
            }else{
                $_SESSION['errorMsg'] = "Failed accept";
            }

        }
    }

}



?>