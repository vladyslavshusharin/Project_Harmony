function ShowHide(){
    const showBox = document.getElementById("showBox");
    const editBox = document.getElementById("editBox");
    if(showBox.classList.contains("closed")){
        showBox.classList.remove("closed");
        editBox.classList.add("closed");
    }
    else if(editBox.classList.contains("closed")){
        editBox.classList.remove("closed");
        showBox.classList.add("closed");
    }
}

function editProfile(user_id){
    let nickname = document.getElementById("EditNickname").value;
    let image_input = document.getElementById("UploadPicture");
    if(nickname || (image_input.files && image_input.files[0])){
        const newData = new FormData();
        newData.append('new_nickname', nickname);
        newData.append('profile_picture', image_input.files[0]);
        fetch("index.php?controller=User&action=UpdateProfile", {
            method: 'POST',
            body: newData
        }).
        then(res=>res.text()).
        then(() => {
            console.log("EDIT SENT");
            loadSection("index.php?controller=User&action=LoadProfile&UserID=" + user_id, "Content");
        });

    }
}

function UpdatePreview(event){
    const input = event.target;
    const ProfilePicPreview = document.getElementById("EditPic");
    if(input.files && input.files[0]){
        const pictureFile = input.files[0];
        const tempObjURL = URL.createObjectURL(pictureFile);
        ProfilePicPreview.src = tempObjURL;
    }
    console.log("preview updated");
}

function SendRequestFromProfile(friend, user_id){
    console.log("REQUEST SENT?");
    let friendName = friend;
    if(friendName){
        fetch("index.php?controller=Friends&action=SendFriendReq", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'friend_username=' + encodeURIComponent(friendName)
        }).
        then(res=>res.text()).
        then(() => {
            loadSection("index.php?controller=Friends&action=FriendList", "Content");
        });

    }

}