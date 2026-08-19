<?php 


require_once "db_conn.php";

class Message{

    public static function getMessages($convo_id){
        global $db;
        $SQL = "SELECT Messages.*, Users.Username, Users.Nickname, Users.Profile_Pic FROM Messages 
                JOIN Users 
                ON Messages.Sender_ID = Users.ID
                WHERE Messages.Conversation_ID = ? ORDER BY ID DESC";
        $result = $db->query($SQL, [$convo_id]);
        return $result;
    }

    public static function sendMessage($convo_id, $sender_id, $message){
        global $db;
        $SQL = "INSERT INTO Messages (`Conversation_ID`, `Sender_ID`, `Message_content`) VALUES (?, ?, ?)";

        $result = $db->query($SQL, [$convo_id, $sender_id, $message]);
        return $result;
    }



}








?>