
<div class="container-fluid d-flex flex-wrap pt-2 ps-0 pe-0 column-gap-2">
    <div class="container-fluid d-flex flex-column mb-2">
        <div class="bg-color-Lblack d-inline-block p-2 ms-3 rounded-top mb-0 align-self-start">
            <h2 class="bg-color-Lblack text-primary oswald-font border-bottom mb-0 border-primary">QUICK INVITE</h2>
        </div>  
        <div class="d-inline-block p-2 d-flex align-self-start rounded bg-color-Lblack"> 
            <input class="bg-color-black text-color-grayer container-fluid rounded border-0 me-2 " type="text" id="friendInput" placeholder="Username to request">
            <button class="btn btn-primary text-dark oswald-font" onclick="SendRequest(null)">Send</button>
        </div>
        <?php if(isset($_SESSION['errorMsg'])):?>
            <h2 class="oswald-font" style="color: red"><?php echo $_SESSION['errorMsg']?></h2>
        <?php unset($_SESSION['errorMsg']);?>
        <?php endif;?>  
    </div>
          

    <div class="bigbox-horizontal null-padding border-trans">

        <div class="d-flex flex-column col-4 p-2 border border-dark rounded bg-color-Lblack" id="friendlist" style="min-height: 80vh; max-height: 80vh;">
            <h2 class="bg-color-Lblack text-primary oswald-font border-bottom border-primary">FRIENDS HERE</h2>
            <div class="bg-color-black rounded d-flex flex-column p-2" style="height: 100%">
                <?php if($friends->num_rows > 0):?>
                <?php while($friend = $friends->fetch_assoc()):?>
                <li class="container-fluid d-flex flex-wrap bg-color-Lblack rounded p-2 mb-2">
                    <button class="bg-color-Lblack btn d-flex align-items-center justify-content-center" onclick="LoadProfile(<?php echo $friend['ID']?>)">
                        <p class="text-color-grayer oswald-font mb-0"><?php echo $friend['Nickname'] . "(" . $friend['Username'] . ")"?></p>
                    </button>
                    <div class="d-flex ms-auto">
                        <button class="btn btn-primary text-color-Lblack oswald-font" onclick="CreateConvo(<?php echo $friend['ID']?>)">Chat</button>
                        <button class="btn btn-primary text-color-Lblack oswald-font ms-2" onclick="RemoveFriend(<?php echo $friend['ID']?>)">Remove</button>
                    </div>
                </li>
                <?php endwhile;?>    
                <?php endif;?>    
            </div>
        </div>


         <div class="d-flex flex-column col-4 p-2 border border-dark rounded bg-color-Lblack" id="friendlist" style="min-height: 80vh; max-height: 80vh;">
            <h2 class="bg-color-Lblack text-primary oswald-font border-bottom border-primary">INCOMING REQUESTS</h2>
            <div class="bg-color-black rounded d-flex flex-column p-2" style="height: 100%">
                <?php if($incoming->num_rows > 0):?>
                <?php while($income = $incoming->fetch_assoc()):?>
                <li class="container-fluid d-flex flex-wrap bg-color-Lblack rounded p-2 mb-2"> 
                    <button class="bg-color-Lblack btn d-flex align-items-center justify-content-center" onclick="LoadProfile(<?php echo $income['ID']?>)">
                        <p class="text-color-grayer oswald-font mb-0"><?php echo $income['Nickname'] . "(" . $income['Username'] . ")"?></p>
                    </button>
                    <div class="d-flex ms-auto">
                        <button class="btn btn-primary text-color-Lblack oswald-font" onclick="RemoveFriend(<?php echo $income['ID']?>)">Decline</button>
                        <button class="btn btn-primary text-color-Lblack oswald-font ms-2" onclick="AddFriend(<?php echo $income['ID']?>)">Accept</button>
                    </div>  
                </li>
            <?php endwhile;?>    
            <?php endif;?>
            </div>
        </div>


        <div class="d-flex flex-column col-4 p-2 border border-dark rounded bg-color-Lblack" id="friendlist" style="min-height: 80vh; max-height: 80vh;">
            <h2 class="bg-color-Lblack text-primary oswald-font border-bottom border-primary">PENDING FRIENDS</h2>
            <div class="bg-color-black rounded d-flex flex-column p-2" style="height: 100%">
                <?php if($pending->num_rows > 0):?>
                <?php while($pend = $pending->fetch_assoc()):?>
                <li class="bigbox-horizontal bg-color-Lblack box-rounded Tmargin-0p1">
                    <button class="bg-color-Lblack btn d-flex align-items-center justify-content-center" onclick="LoadProfile(<?php echo $pend['ID']?>)">
                        <p class="text-color-grayer oswald-font mb-0"><?php echo $pend['Nickname'] . "(" . $pend['Username'] . ")"?></p>
                    </button>
                    <div class="d-flex ms-auto">
                        <button class="btn btn-primary text-color-Lblack oswald-font" onclick="RemoveFriend(<?php echo $pend['ID']?>)">Cancel</button>
                    </div>
                </li>
                <?php endwhile;?>    
                <?php endif;?> 
            </div>
        </div>
    </div>
</div>