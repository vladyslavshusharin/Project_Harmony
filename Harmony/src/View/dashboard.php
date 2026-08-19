<div class="container-fluid d-flex flex-wrap pt-2 ps-0 pe-0 column-gap-2">
    <div class="d-flex flex-column col-4 p-2 border border-dark rounded bg-color-Lblack" id="convoList" style="min-height: 90vh; max-height: 90vh;">
     <h2 class="bg-color-Lblack text-primary oswald-font border-bottom border-primary">Conversations</h2>
     <div class="bg-color-black rounded d-flex flex-column p-2" style="height: 100%">
      <?php if($convos->num_rows > 0):?>
       <?php while($convo_row = $convos->fetch_assoc()):?>
          <li class="container-fluid d-flex flex-wrap bg-color-Lblack rounded p-2 mb-2">
              <button class="bg-color-Lblack btn align-items-center justify-content-center" onclick="LoadProfile(<?php echo $convo_row['User_ID']?>)"><p class="text-color-grayer oswald-font m-0"><?php echo $convo_row['Nickname'] . "(" . $convo_row['Username'] . ")"?></p></button>
              <button class="btn btn-primary text-color-Lblack oswald-font ms-auto" onclick="OpenConvo(<?php echo $convo_row['Conversation_ID']?>, <?php echo $convo_row['User_ID']?>, 'Content'); ">Open</button>
          </li>
       <?php endwhile;?>    
      <?php endif;?>    
     </div>
    </div>

    <div class="d-flex flex-column col-4 p-2 border border-dark rounded bg-color-Lblack" id="friendsList" style="min-height: 90vh; max-height: 90vh;">
     <h2 class="bg-color-Lblack text-primary oswald-font border-bottom border-primary">Friends</h2>
     <div class="bg-color-black rounded d-flex flex-column p-2" style="height: 100%">
      <?php if($friends->num_rows > 0):?>
       <?php while($friend = $friends->fetch_assoc()):?>
          <li class="container-fluid d-flex flex-wrap bg-color-Lblack rounded p-2 mb-2">
              <button class="bg-color-Lblack btn d-flex align-items-center justify-content-center" onclick="LoadProfile(<?php echo $friend['ID']?>)"><p class="text-color-grayer oswald-font m-0"><?php echo $friend['Nickname'] . "(" . $friend['Username'] . ")"?></p></button>
              <div class="d-flex ms-auto">
                  <button class="btn btn-primary text-color-Lblack oswald-font" onclick="RemoveFriend(<?php echo $friend['ID']?>)">Remove</button>
                  <button class="btn btn-primary text-color-Lblack oswald-font ms-2" onclick="CreateConvo(<?php echo $friend['ID']?>)">Chat</button>
              </div>
            
          </li>
       <?php endwhile;?>    
      <?php endif;?>   
     </div>
    </div>

    <div class="d-flex flex-column col p-2 pt-5 align-items-center">
        <img src="<?php echo $user_details['Profile_Pic'] ?>" class="rounded-3 border" width="96" height="96">
        <h1 class="bg-color-Lblack text-primary box-horizontal box-rounded oswald-font mt-3"><?php echo $user_details['Nickname']?></h1>
        <h2 class="bg-color-Lblack text-color-grayer box-horizontal box-rounded mt-2 oswald-font"><?php echo "(" . $user_details['Username'] . ")"?></h2>
        <h2 class="bg-color-Lblack text-color-grayer box-horizontal box-rounded mt-2 oswald-font"><?php echo $user_details['Email']?></h2>
        
    </div>

</div>