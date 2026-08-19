
    <textarea class="rounded bg-color-black text-color-white Vpixelheight-0p5 col" wrap="hard" placeholder="Message here" id="messageInput"></textarea>
    <button class="bg-primary box-rounded border-trans oswald-font col-auto ps-5 pe-5 Vpixelbox-0p5 text-full-center" onclick="SendMessage(event, <?php echo $_SESSION['user_id']?>, <?php echo $CONVO_ID?>, <?php echo $OTHER_USER?>)">Send</button>
