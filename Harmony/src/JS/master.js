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
    console.log("EDIT SENT");
    let nickname = document.getElementById("EditNickname").value;
    if(nickname){
        fetch("index.php?controller=User&action=UpdateProfile", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'new_nickname=' + encodeURIComponent(nickname)
        }).
        then(res=>res.text()).
        then(() => {
            loadSection("index.php?controller=User&action=LoadProfile&UserID=" + user_id, "Content");
        });

    }
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

function SendMessage(event, user_id, convo_id, other_user){
    if(event) event.preventDefault();
    
    const messageContent = document.getElementById("messageInput").value;
    fetch("index.php?controller=Message&action=SendMessage", {
        method: 'POST',
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'user_ID=' + encodeURIComponent(user_id) + 
              '&convo_ID=' + encodeURIComponent(convo_id) +
              '&message_content=' + encodeURIComponent(messageContent)
    }).
    then(res=>res.text()).
    then(() => {
        loadSection("index.php?controller=Message&action=LoadMessages&ConvoID=" + convo_id + "&OtherUser=" + other_user, "MessageBox");
        const messageInput = document.getElementById("messageInput");
        messageInput.value = "";
    });


}



if(document.getElementById("friendInput")){
    console.log("FRIEND INPUT EXIST");
}

function RemoveFriend(Friend_ID){

    fetch("index.php?controller=Friends&action=removeFriend", {
        method: 'POST',
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'friend_ID=' + encodeURIComponent(Friend_ID)
    }).
    then(res=>res.text()).
    then(() => {
        loadSection("index.php?controller=Friends&action=FriendList", "Content");
    });

}



function SendRequest(){
    console.log("REQUEST SENT?");
    let friendName = document.getElementById("friendInput").value;
    if(friendName){
        fetch("index.php?controller=Friends&action=SendFriendReq", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'friend_username=' +encodeURIComponent(friendName)
        }).
        then(res=>res.text()).
        then(() => {
            loadSection("index.php?controller=Friends&action=FriendList", "Content");
        });

    }

}


function AddFriend(incoming_id){

    fetch("index.php?controller=Friends&action=AcceptReq", {
        method: 'POST',
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'incoming_id=' + encodeURIComponent(incoming_id)
    }).
    then(res=>res.text()).
    then(() => {
        loadSection("index.php?controller=Friends&action=FriendList", "Content");
    });

}


function CreateConvo(Friend_ID){
    fetch("index.php?controller=Conversation&action=CreateConvo", {
        method: 'POST',
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'Friend_ID=' + encodeURIComponent(Friend_ID)
    }).
    then(response => {
        if(!response.ok){
            throw new Error ("Message data receiving fucked up");
        }

        console.log("new function working");
        return response.json();
        
    }).then(data => {
        if (data.status === 'success') {
            const convo_id = data.convo_id;
            const other_user = data.other_user;
            loadSection("index.php?controller=Conversation&action=LoadConvos", "Content");
            OpenConvo(convo_id, other_user);
            LoadMessageInput(convo_id, other_user);
        }
    });

}

function LoadProfile(Friend_ID){
    stopMessages();
    const user_id = Friend_ID;
    loadSection("index.php?controller=User&action=LoadProfile&UserID=" + user_id, "Content");
    document.getElementById("AdditionalContent").innerHTML = "";
    document.getElementById("Content").classList.remove("Scroll-box-6");
}


if(document.getElementById("listofconvos")){
    console.log("CONVOS EXIST");
}

function OpenConvo(convo_id, other_user){
    loadSection("index.php?controller=Message&action=LoadMessages&ConvoID=" + convo_id + "&OtherUser=" + other_user, "MessageBox");
    messagesReload = setTimeout(OpenConvo, 1000, convo_id, other_user);
}



function LoadMessageInput(convo_id, other_user){
    fetch("index.php?controller=Message&action=GetMessageInput&ConvoID=" + convo_id + "&OtherUser=" + other_user)
    .then(res => res.text())
    .then(html =>{
        document.getElementById("AdditionalContent").innerHTML = html;
    });
}

console.log("master.js loadded");




