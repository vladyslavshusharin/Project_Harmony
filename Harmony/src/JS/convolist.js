
console.log("CONVOoooos LOADED");

if(document.getElementById("listofconvos")){
    console.log("CONVOS EXIST");
}

function OpenConvo(convo_id, other_user, container){
    if(container == "Content"){
        loadSection("index.php?controller=Conversation&action=LoadConvos", container)
        .then(() => {
            LoadMessageInput(convo_id, other_user);
            messagesReload = setTimeout(OpenConvo, 200, convo_id, other_user, "MessageContainer");
            MessageBoxScrollDown("MessageContainer");
        });
        
    }
    else if(container == "MessageContainer"){
        loadSection("index.php?controller=Message&action=LoadMessages&ConvoID=" + convo_id + "&OtherUser=" + other_user, container);
        messagesReload = setTimeout(OpenConvo, 200, convo_id, other_user, "MessageContainer"); 
    }
    
}



function LoadMessageInput(convo_id, other_user){
    fetch("index.php?controller=Message&action=GetMessageInput&ConvoID=" + convo_id + "&OtherUser=" + other_user)
    .then(res => res.text())
    .then(html =>{
        document.getElementById("MessageInput").innerHTML = html;
    });
}


