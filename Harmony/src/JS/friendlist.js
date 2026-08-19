console.log("Function loaded");

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

console.log("SendRequest loaded");

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

console.log("Add loaded");

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
            OpenConvo(convo_id, other_user, "Content");
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


