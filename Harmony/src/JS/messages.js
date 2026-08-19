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
        loadSection("index.php?controller=Message&action=LoadMessages&ConvoID=" + convo_id + "&OtherUser=" + other_user, "MessageContainer");
        MessageBoxScrollDown("MessageContainer");
        const messageInput = document.getElementById("messageInput");
        messageInput.value = "";
    });


}

function MessageBoxScrollDown(container){
    const messageBoxContainer = document.getElementById(container);

    messageBoxContainer.scrollTop = messageBoxContainer.scrollHeight;
    console.log("Scrolled to bottom! new");
}


