
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Harmony</title>
</head>
<body class="full-height bg-color-black border-trans">
    
<main>

 <div class="container-fluid d-flex vh-10 bg-color-Lblack rounded-bottom p-2 flex-wrap">
    <div class="col-12 col-md-auto d-flex">
        <button onclick="stopMessages()" class="btn btn-link" type="button" id="dashboard">
            <img src="HarmonyLogoClear.png" height="35px">
            <img class="Lmargin-0p1" src="HarmonyText.png" height="20px">
        </button>
    </div>
    <div class="col-12 col-md d-flex justify-content-end">

        <div class="d-flex col-6 justify-content-start">
            <button onclick="stopMessages()" class="oswald-font btn btn-primary text-dark ms-3" type="button" id="friends">Friends</button>
            <button onclick="stopMessages()" class="oswald-font btn btn-primary text-dark ms-3" type="button" id="conversations">Conversations</button>
        </div>

        <div class="d-flex col-6 justify-content-end">
            <button class="btn-primary oswald-font btn btn-primary" type="button" id="logoutbutt">Logout</button>
            <button class="btn-primary oswald-font btn btn-primary ms-3" onclick="stopMessages()" type="button" id="profile">
            <span class="text-color-black"><?php echo $_SESSION['nickname']?></span>
            </button>
        </div>
     
    </div>
 </div>

 <div id="Main" class="container-fluid d-flex" style="max-width: 2560px; margin-inline: auto;">


    <div id="Content" class="container-fluid">
        <?php require "View/dashboard.php"; ?>
    </div>

    <div id="AdditionalContent">
        
    </div>

 </div>

</main>


</body>


<script>

let dashboardBT = document.getElementById("dashboard");
let friendsBT = document.getElementById("friends");
let conversationsBT = document.getElementById("conversations");
let searchBT = document.getElementById("search");
let profileBT = document.getElementById("profile");
let logBT = document.getElementById("logoutbutt");

var messagesReload = null;

function loadSection(neededURL, elementID){
    console.log("Reloaded");

    return fetch(neededURL)
    .then(res => res.text())
    .then(html =>{
        if(elementID != null){
        document.getElementById(elementID).innerHTML = html;
        
        }
    });
}

function stopMessages(){
    if(messagesReload !== null){
        clearTimeout(messagesReload);
        messagesReload = null;
    }
}

conversationsBT.addEventListener('click', () => {
    stopMessages();
    loadSection("index.php?controller=Conversation&action=LoadConvos", "Content");
    document.getElementById("AdditionalContent").innerHTML = "";
    document.getElementById("Content").classList.remove("Scroll-box-6");
});
friendsBT.addEventListener('click', () => {
    stopMessages();
    loadSection("index.php?controller=Friends&action=FriendList", "Content");
    document.getElementById("AdditionalContent").innerHTML = "";
    document.getElementById("Content").classList.remove("Scroll-box-6");
});
profileBT.addEventListener('click', () => {
    stopMessages();
    const user_id = <?php echo json_encode($_SESSION['user_id']); ?>;
    loadSection("index.php?controller=User&action=LoadProfile&UserID=" + user_id, "Content");
    document.getElementById("AdditionalContent").innerHTML = "";
    document.getElementById("Content").classList.remove("Scroll-box-6");
});
dashboardBT.addEventListener('click', () => {
    stopMessages();
    loadSection("index.php?controller=User&action=LoadDashboard", "Content");
    document.getElementById("AdditionalContent").innerHTML = "";
    document.getElementById("Content").classList.remove("Scroll-box-6");
});
logBT.addEventListener('click', () => {
    console.log("halo");
    window.location.href = "index.php?controller=User&action=Logout";
});




</script>

<script src="../JS/profile.js"></script>       
<script src="../JS/convolist.js"></script>  
<script src="../JS/friendlist.js"></script>  
<script src="../JS/messages.js"></script>  



</html>