<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body class="full-height bigbox-vertical bg-color-black border-trans">

    <div class="full-center box-vertical Hpixelbox-3 Vpixelbox-4 bg-color-Lblack box-rounded">
    <form method="post" action="index.php?controller=User&action=Signup" class="bigbox-vertical border-trans">
        <div class="box-horizontal border-trans text-full-center Bmargin-0p25">
            <img class="Rmargin-0p1" src="HarmonyLogoClear.png" height="50px">
            <img src="HarmonyText.png" height="30px">
        </div>
        <label class="text-pageread text-color-grayer oswald-font" for="usermail" id="usermailtext">E-mail:</label>
        <input class="text-pagebig Bmargin-0p5 bg-color-black box-rounded text-color-grayer" type="email" id="usermail" name="usermail">
        <label class="text-pageread text-color-grayer oswald-font" for="pass" id="passtext">Password:</label>
        <input class="text-pagebig Bmargin-0p5 bg-color-black box-rounded text-color-grayer" type="password" id="pass" name="pass">
        <label class="text-pageread text-color-grayer oswald-font" for="username" id="usernametext">Username:</label>
        <input class="text-pagebig Bmargin-0p5 bg-color-black box-rounded text-color-grayer" type="text" id="username" name="username">
        <label class="text-pageread text-color-grayer oswald-font" for="nickname" id="nicknametext">Nickname:</label>
        <input class="text-pagebig Bmargin-0p5 bg-color-black box-rounded text-color-grayer" type="text" id="nickname" name="nickname">

        <input class="text-pageread Bmargin-0p25 Hpixelbox-2 horizontal-center bg-color-black box-rounded text-color-grayer oswald-font" type="submit" id="signupbutt" value="sign up">
    </form>
    <?php if(isset($errorMsg)){
        echo "<h3 class='oswald-font'>". $errorMsg ."</h3>";
    }?>
    </div>
    
</body>
</html>