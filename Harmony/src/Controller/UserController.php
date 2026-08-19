<?php 
require "Model/user.php";
require "Model/conversation.php";
require "Model/friends.php";
require "upload_image.php";

class UserController{
    public function ShowDashboard(){
        $user_details = User::getUserDetails($_SESSION['user_id'])->fetch_assoc();
        $friends = Friends::getFriends($_SESSION['user_id']);
        $convos = Conversation::getUserConvos($_SESSION['user_id']);
        require "View/harmony.php";
    }

    public function Signin(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $EMAIL = trim($_POST['usermail']);
            $PASS = trim($_POST['pass']);

            $data = User::Login($EMAIL);
            if($data->num_rows === 1){
                $USER_DETAILS = $data->fetch_assoc();
                if(password_verify($PASS, $USER_DETAILS['Password'])){
                    $_SESSION['user_id'] = $USER_DETAILS['ID'];
                    $_SESSION['username'] = $USER_DETAILS['Username'];
                    $_SESSION['usermail'] = $USER_DETAILS['Email'];
                    $_SESSION['nickname'] = $USER_DETAILS['Nickname'];
                    $_SESSION['profile_pic'] = $USER_DETAILS['Profile_Pic'];

                    header("Location: index.php");
                }else{
                    $_SESSION['errorMsg'] = "Incorrect credentials";
                    require "View/login.php";
                }
            }else{
                $_SESSION['errorMsg'] = "Incorrect credentials";
                require "View/login.php";
            }
        }else{
            
            require "View/login.php";
        }
        
        
    }

    public function Logout(){
        unset($_SESSION); //Odstraneni sessionu
        session_destroy();
        session_write_close();
        header("Location: index.php");
        die;
    }

    public function LoadDashboard(){
        $user_details = User::getUserDetails($_SESSION['user_id'])->fetch_assoc();
        $friends = Friends::getFriends($_SESSION['user_id']);
        $convos = Conversation::getUserConvos($_SESSION['user_id']);
        require "View/dashboard.php";
    }

    public function LoadSearch(){
        require "View/search.php";
    }

    public function LoadProfile(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $USER_ID = $_GET['UserID'];

            $user = User::getUserDetails($USER_ID);
            $users_friends = Friends::getProfilesFriends($USER_ID);
            $friends = Friends::getFriends($_SESSION['user_id']);

            if($user->num_rows === 1){
                $user_exist = true;
                $user_details = $user->fetch_assoc();
                require "View/profile.php";
            }else{
                $user_exist = false;
                require "View/profile.php";
            }
        }
        
    }

    public function Signup(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $EMAIL = $_POST['usermail'];
            $USERNAME = $_POST['username'];
            $PASS = $_POST['pass'];
            $NICKNAME = $_POST['nickname'];

            if(!empty($EMAIL) && !empty($USERNAME) && !empty($PASS) && !empty($NICKNAME)){
            $userExist = User::existingUser($EMAIL, $USERNAME);
            if($userExist){
                $errorMsg = "User or email already exists";
                require "View/signup.php";
            }else{
                $HASHPASS = password_hash($PASS, PASSWORD_DEFAULT);
                $createUser = User::CreateUser($USERNAME, $EMAIL, $HASHPASS, $NICKNAME);
                if($createUser){
                    $this->Signin();
                }else{
                    $errorMsg = "Failed creating account";
                    require "View/signup.php";
                }
            }
            }else{
                $errorMsg = "Fill out all fields!";
                require "View/signup.php";
            }

        }else{
            require "View/signup.php";
        }
    }


    public function UpdateProfile(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $NICKNAME = $_POST['new_nickname'];
            $EMAIL = "";
            $USER_ID = $_SESSION['user_id'];

            if(isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] !== UPLOAD_ERR_NO_FILE){
                $uploadPhoto = uploadFile($_FILES['profile_picture']);
        
                if(!$uploadPhoto['success']){
                    $_SESSION['image_error'] = "Error uploading image: " . $uploadPhoto['message'];
                    $PATH_TO_PIC = "";
                    $errorMsg = "Failed to upload photo";
                } else{
                    $PATH_TO_PIC = $uploadPhoto['path'];
                }
            } else{ $PATH_TO_PIC = "";}

            if(!empty($NICKNAME) || !empty($PATH_TO_PIC) || !empty($EMAIL)){ 
                $update = User::setUserDetails($NICKNAME, $PATH_TO_PIC, $EMAIL, $USER_ID);
            }else{
                $update = false;
            }

            if($update){
                $updatedMsg = "Updated profile";
            }else{
                $errorMsg = "Failed to update";
             }
        }
    }

}

    



?>