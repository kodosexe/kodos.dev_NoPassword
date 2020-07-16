<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Lamp Control</title>
        <link rel="stylesheet" href="./stylesheets/main.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>

        <div class="header">
        <div class="left" id="headerLeft">
            <p><a href="#">Kodos<br>Lamp<br>Control</a></p>
        </div>
        <div class="middle" id="headerMiddle">
            <h1>KODOS - This is progress</h1>
        </div>
        <div class="right" id="headerRight">
            <p><a href="./account">Account</a></p>
        </div>
        </div>



        <div class="mainWrapper">
        <div class="mainContent">

        <?php
$sessionName = "sessionToken";
$secretName = "secretToken";
$usrName = "username";

$link = mysqli_connect("REDACTED", "REDACTED", "REDACTED", "REDACTED");

if (!isset($_COOKIE[$sessionName]) || !isset($_COOKIE[$secretName]) || !isset($_COOKIE[$usrName])) {
    
    echo "Not Logged in - Redirecting to Login";
    echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/login';</script>"; exit;
} else {
    // Check Cookie Integrity
    //echo "Value is: " . $_COOKIE[$cookieName];
    
    $sessionToken = $_COOKIE[$sessionName];
    $secretToken = $_COOKIE[$secretName];
    $username = $_COOKIE[$usrName];

    $sql = "SELECT * FROM color WHERE user ='$username' OR email = '$username'";
    if ($result = mysqli_query($link, $sql)){
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_array($result)) {
                $username = $row['user'];
                $email = $row['email'];

            }
        } else {
            //echo 'No matches found or too many found';
            echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/login';</script>"; exit;
        }
    } else {
        echo 'Couldnt establish connection';
    }



    $sql = "SELECT * FROM logins WHERE user = '$username' AND email = '$email' AND serID = '$sessionToken' ";

    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            //echo 'numOfRows is ' . mysqli_num_rows($result) . '            ';
            while($row = mysqli_fetch_array($result)){
                //if (password_verify($password, $row['password'])) {
                $dbSession = $row['serID'];
                //echo 'Session is ' . $dbSession;
                $dbToken = $row['loginToken'];
                //echo 'Token is ' . $dbToken;
                if ($sessionToken == $dbSession && $secretToken == $dbToken) {
                    if ($username == $row['user'] || $username == $row['email']) {
                        // Success
                        // Get Colors
                        $sql = "SELECT * FROM color WHERE user = '$username'";
                        if ($result = mysqli_query($link, $sql)) {
                            while ($row = mysqli_fetch_array($result)) {
                                $brightness = $row['brightness'];
                            $red = $row['red'];
                            $green = $row['green'];
                            $blue = $row['blue'];
                            $name = $row['name'];
                            
                            } 
                    }else {
                        echo 'Couldnt fetch data - connection failed';
                    }
                        

                        //echo 'x' . $brightness . 'x' . $red . 'x' . $green . 'x' .$blue . 'x';
                    } else {
                    // Theft

                        //echo 'Cookies dont match in username';
                        //exit();
                        echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/login';</script>"; exit;
                    }
                } else {

                    //echo 'Cookies dont match in cookies \n';
                    //echo 'For username ' . $username;
                    //echo 'SessionID is ' . $sessionToken . ' in Cookies, but ' . $row['sessionID'] . ' in Database \n';
                    //echo 'Secret token is ' . $secretToken . ' in Cookies, but ' . $row['loginToken '] . ' in Database \n';
                    echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/login';</script>"; exit;
                    exit();

                }
    
            }
            // Free result set
            mysqli_free_result($result);
        } else{
            //echo("Password or Username incorrect");
            echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/login';</script>"; exit;
        }
    } else{
        //echo "ERROR: COULD NOT CONTACT THE SERVER. IF ERROR PERSISTS, PLEASE CONTACT kodosexe@gmail.com";
        //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}
    ?>
    <div class="nameIdentifier">
    <h1>Hello, <?= $name; ?> </h1>
    <br>
    </div>
<div class="colorSample" id="colorSample" width="300px" height="300px"></div>
<br>
<div class="formWrapper">
<form action="setColor.php" method="POST">
    <br>
    <input type="range" id="brightness" name="brightness" min="0" max="255" value="<?= $brightness; ?>">
    <label for="brightness">Brightness</label>
    <br>
    <input type="range" id="red" name="red" min="0" max="255" value="<?= $red; ?>">
    <label for="red">Red</label>
    <br>
    <input type="range" id="green" name="green" min="0" max="255" value="<?= $green; ?>">
    <label for="green">Green</label>
    <br>
    <input type="range" id="blue" name="blue" min="0" max="255" value="<?= $blue; ?>">
    <label for="blue">Blue</label>
    <br>
    <input type="submit" name="submit" class="submit" value="Update Color">
</form>
</div>

</div>
</div>

<script>
    var bright = "<?php echo $brightness?>";
    var red = "<?php echo $red?>";
    var green = "<?php echo $green?>";
    var blue = "<?php echo $blue?>";
    document.getElementById("colorSample").style.backgroundColor = "rgb(" + bright*(red/255) + "," + bright*(green/255) + "," + bright*(blue/255) + ")";

    document.getElementById("headerMiddle").style.width = String(window.innerWidth - 400) + "px";

</script>

<style type="text/css">

body{
    height: 100%;
    width: 100%;
    font-family: 'Open Sans Condensed', sans-serif;
    text-align: "center";
    margin: 0;
}

html{
    height: 100%;
}

.colorSample {
    width: 100px;
    height: 100px;
    border-radius: 50px;
    border: 1px solid black;
    margin: 0;
}

.submit {
    padding: 15px;
    background-color: white;
    color: blue;
    border: 2px solid blue;
    border-radius: 5px;
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 15px;
}

.header {
    display: flex;
    background-color: #dddddd;
    width: 100%;
    margin: 0px;
    color: black;
    text-align: center;
    height: 100px;
    justify-content: center;
    align-items: center;
}

.mainContent{
    text-align: center;

    align-items: center;
    height: 1000px;
}

.mainWrapper {
    display:flex;
    justify-content:center;
    align-items:center;
    width:100%;
}

.nameIdentifier {
    display: block;
    width: 100%;
}

.formWrapper {
    text-align: left;
}

.left {
    float: left;
    width: 200px;
    left: 0px;
}

.right {
    float: left;
    width: 200px;
    right: 0px;
}

.middle {
    float: left;
    width: auto;
}

a {
    color: inherit;
    text-decoration: none;
}

</style>

    </body>
</html>