<?php if($user_exist):?>

<div class="container-fluid d-flex pt-2">
 <div class="d-flex flex-column col">
    <div class="" id="showBox">
    <img src="<?php echo $user_details['Profile_Pic'] ?>" class="rounded-3 border" width="96" height="96" id="ShowPic">
    <div class="box-horizontal bg-color-Lblack box-rounded Tmargin-0p1">
        <h1 class="text-primary oswald-font"><?php echo $user_details['Nickname']?></h1><h2 class="text-primary oswald-font"><?php echo "(" . $user_details['Username'] . ")"?></h2>
    </div>
    <div class="box-horizontal bg-color-Lblack box-rounded Tmargin-0p1 Bmargin-0p1">
        <h2 class="text-primary oswald-font"><?php echo $user_details['Email']?></h2>
    </div>
    <?php if($user_details['ID'] == $_SESSION['user_id']):?>
    <button class="bg-primary text-color-Lblack Lpadding-0p1 Rpadding-0p1 stick-to-right box-rounded Tpadding-0p1 Bpadding-0p1 oswald-font" onclick="ShowHide()">Edit</button>
    <?php endif;?>
    </div>

    <?php if($user_details['ID'] == $_SESSION['user_id']):?>
    <div class="closed" id="editBox">
    <img src="<?php echo $user_details['Profile_Pic'] ?>" class="rounded-3 border" width="96" height="96" id="EditPic">
    <div class="d-flex flex-column">
        <input type="file" id="UploadPicture" class="text-primary" onchange="UpdatePreview(event)">
        <label for="UploadPicture" id="UploadLabel" class="text-primary">Choose a picture</label>
    </div>
    <div class="box-horizontal bg-color-Lblack box-rounded Tmargin-0p1 border-trans">  
        <h1 class="text-primary oswald-font"><input class="bg-color-black text-color-white box-rounded box-horizontal" type="text" id="EditNickname" value="<?php echo $user_details['Nickname']?>"></h1><h2 class="text-primary oswald-font"><?php echo "(" . $user_details['Username'] . ")"?></h2>
    </div>  
    <div class="box-horizontal bg-color-Lblack box-rounded Tmargin-0p1 Bmargin-0p1">
        <h2 class="text-primary oswald-font"><?php echo $user_details['Email']?></h2>
    </div>
    <button class="bg-primary text-color-Lblack Lpadding-0p1 Rpadding-0p1 stick-to-right box-rounded Tpadding-0p1 Bpadding-0p1 oswald-font" onclick="editProfile(<?php echo $_SESSION['user_id']?>)">Update</button>
    <button class="bg-primary text-color-Lblack Lpadding-0p1 Rpadding-0p1 stick-to-right box-rounded Tpadding-0p1 Bpadding-0p1 oswald-font" onclick="ShowHide()">Cancel</button>
    </div>
    <?php endif;?>
 </div>


 <div class="d-flex flex-column col-4 p-2 border border-dark rounded bg-color-Lblack" style="min-height: 40vh; max-height: 80vh;">
    <h2 class="bg-color-Lblack text-primary box-horizontal box-rounded oswald-font Bmargin-0p1">FRIENDS</h2>
    <div class="bg-color-black rounded d-flex flex-column overflow-auto p-2" style="height: 100%">
    <?php if($users_friends->num_rows > 0):?>
        <?php while($users_friend = $users_friends->fetch_assoc()):?>
            <div class="bigbox-horizontal bg-color-Lblack border-trans box-rounded Bmargin-0p1">
             <button class="bg-color-Lblack border-trans" onclick="LoadProfile(<?php echo $users_friend['ID']?>)"><h3 class="text-color-grayer oswald-font"><?php echo $users_friend['Nickname'] . " " . "(" . $users_friend['Username'] . ")"?></h3></button>
             <div class="box-horizontal null-padding stick-to-right text-full-center border-trans">
             <?php if($users_friend['ID'] != $_SESSION['user_id']):?>
             <button class="bg-primary text-color-Lblack Lpadding-0p1 Rpadding-0p1 Rmargin-0p1 box-rounded oswald-font" onclick="CreateConvo(<?php echo $users_friend['ID']?>)">Chat</button>
             <?php if($user_details['ID'] != $_SESSION['user_id'] && $users_friend['is_mutual'] != 1):?>
             <button class="bg-primary text-color-Lblack Lpadding-0p1 Rpadding-0p1 Rmargin-0p1 box-rounded oswald-font" onclick="SendRequestFromProfile('<?php echo $users_friend['Username']?>', <?php echo $user_details['ID']?>)">Add</button>
             <?php endif;?>
             <?php endif;?>
             </div>
            </div>
        <?php endwhile;?>
    <?php endif;?>
    </div>
 </div>


</div>

<?php else:?>

    <h1>User doesn't exist</h1>

<?php endif;?>