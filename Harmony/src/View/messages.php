<?php if($messages->num_rows > 0):?>
    <?php while($message = $messages->fetch_assoc()):?>

        <div class="d-flex flex-column">
            <div class="d-inline-flex my-1 text-color-white rounded align-self-start align-items-center w-auto">
                <div class="d-inline-flex p-2 my-1 text-color-white rounded align-self-start align-items-center bg-color-Lblack w-auto">
                    <img src="<?php echo $message['Profile_Pic'] ?>" class="rounded-3 border" width="48" height="48" id="ShowPic">
                    <p class="text-primary m-0 ms-2 d-flex align-items-center"><?php echo $message['Nickname']?></p>
                </div>
                <div class="container-fluid d-flex align-items-end">
                    <p class="text-color-white m-0"><?php echo $message['Sent_at']?></p>
                </div>
            </div>
            <div class="d-inline-flex p-2 my-1 text-color-white rounded align-self-start bg-color-Lblack text-break" style="max-width: 60%; width: fit-content;">
                <p><?php echo $message['Message_content']?></p>
            </div>
        </div>
            

        
    <?php endwhile;?>    
    

<?php endif;?>    







