<?php 


require_once "db_conn.php";

class Friends{

    public static function getFriends($user_id){
        global $db;
        $SQL = "SELECT Users.* FROM Users
                    JOIN Friends ON (
                        (Friends.User_ID = Users.ID AND Friends.Friend_ID = ?)
                        OR
                        (Friends.Friend_ID = Users.ID AND Friends.User_ID = ?)
                    )
                    WHERE Friends.Status = ?";

        $result = $db->query($SQL, [$user_id, $user_id, "accepted"]);
        return $result;
    }

    public static function getProfilesFriends($profile_id){
        global $db;
        $SQL = "SELECT users.*, 
	                CASE
		                WHEN logged_user_friends.Friend_ID IS NOT NULL THEN 1
                        ELSE 0
	                END AS is_mutual
                FROM friends AS profile_friends
                JOIN users
	                ON (users.ID = profile_friends.Friend_ID AND profile_friends.User_ID = ?)
                    OR (users.ID = profile_friends.User_ID AND profile_friends.Friend_ID = ?)
                LEFT JOIN friends AS logged_user_friends
	                ON (
                        (logged_user_friends.User_ID = ?  AND logged_user_friends.Friend_ID = users.ID)
                        OR
                        (logged_user_friends.Friend_ID = ? AND logged_user_friends.User_ID = users.ID)
                        )
                WHERE users.ID != ?";
        $result = $db->query($SQL, [$profile_id, $profile_id, $_SESSION['user_id'], $_SESSION['user_id'], $profile_id]);
        return $result;
    }

    public static function getPending($user_id){
        global $db;
        $SQL = "SELECT Friends.Friend_ID, Users.* FROM Friends 
                JOIN Users ON Users.ID = Friends.Friend_ID 
                WHERE  Friends.User_ID = ? AND Friends.Status = ?";
        $result = $db->query($SQL, [$user_id, "pending"]);
        return $result;
    }

    public static function getIncoming($user_id){
        global $db;
        $SQL = "SELECT Friends.User_ID, Users.* FROM Friends 
                JOIN Users ON Users.ID = Friends.User_ID 
                WHERE Friends.Friend_ID = ? AND Friends.Status = ?";
        $result = $db->query($SQL, [$user_id, "pending"]);
        return $result;
    }

     public static function addFriend($user_id, $incoming_id){
        global $db;
        $SQL = "UPDATE Friends SET Friends.Status = ? WHERE Friends.User_ID = ? AND Friends.Friend_ID = ?";

        $result = $db->query($SQL, ["accepted", $incoming_id, $user_id]);
        return $result;
    }

    public static function removeFriend($user_id, $friend_id){
        global $db;
        $SQL = "DELETE FROM Friends WHERE (User_ID = ? AND Friend_ID = ?) 
                                                       OR (User_ID = ? AND Friend_ID = ?)";
        $result = $db->query($SQL, [$user_id, $friend_id, $friend_id, $user_id]);
        return $result;
    }

    public static function sendRequest($user_id, $friend_name){
        global $db;
        $SQL1 = "SELECT ID FROM Users WHERE Username = ? AND ID != ?";
        $friend_id = $db->query($SQL1, [$friend_name, $user_id])->fetch_assoc();
        $CHECK = "SELECT Friends.User_ID, Friends.Friend_ID from Friends WHERE (User_ID = ? AND Friend_ID = ?) 
                                                                            OR (User_ID = ? AND Friend_ID = ?)";
        $exists = $db->query($CHECK, [$user_id, $friend_id['ID'], $friend_id['ID'], $user_id]);                                                                    

        if($exists->num_rows === 0){
        $SQL2 = "INSERT INTO Friends (`Status`, `User_ID`, `Friend_ID`) VALUES (?, ?, ?)";
        $result = $db->query($SQL2, ["pending", $user_id, $friend_id['ID']]);
        return $result;
        }else{
            return false;
        }
    }



}








?>