<div class="container-fluid d-flex flex-wrap pt-2 column-gap-2">
 
<div class="bg-color-Lblack col-auto rounded d-flex flex-column p-2">
  <h2 class="d-inline-block bg-color-Lblack text-primary oswald-font p-2 rounded">CONVERSATIONS</h2>
  <ul id="listofconvos" class="bg-color-black rounded d-flex flex-column p-2 overflow-y-auto" style="height: 100%;">

 <?php if($convo->num_rows > 0):?>
     <?php while($convo_row = $convo->fetch_assoc()):?>

         <li class="bigbox-horizontal bg-color-Lblack box-rounded Tmargin-0p1 border-trans">
             <button class="bg-color-Lblack btn d-flex align-items-center justify-content-center" onclick="LoadProfile(<?php echo $convo_row['User_ID']?>)"><p class="text-color-grayer oswald-font m-0"><?php echo $convo_row['Nickname'] . "(" . $convo_row['Username'] . ")"?></p></button>
             <button class="bg-primary text-color-Lblack Lpadding-0p1 Rpadding-0p1 stick-to-right box-rounded oswald-font border-trans" onclick="stopMessages(); OpenConvo(<?php echo $convo_row['Conversation_ID']?>, <?php echo $convo_row['User_ID']?>, 'Content'); ">Open</button>
         </li>
        

     <?php endwhile;?>    
 <?php endif;?>    

   </ul>
     <?php if(isset($_SESSION['errorMsg'])):?>
         <h2 class="oswald-font" style="color: red"><?php echo $_SESSION['errorMsg']?></h2>
       <?php unset($_SESSION['errorMsg']);?>
    <?php endif;?>  
</div>

 <div id="DefaultContainer" class="d-flex flex-column col rounded bg-color-Lblack p-2">

    <div id="MessageContainer" class="d-flex flex-column-reverse overflow-auto rounded p-2 bg-color-black" style="height: 80vh;">   
        <p class="text-primary">Open a conversation to start chatting!</p>
    </div>

    <div id="MessageInput" class="container-fluid d-flex p-0">

    </div> 

 </div>  


</div>









