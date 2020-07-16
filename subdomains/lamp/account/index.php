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
            <p><a href="/lamp">Kodos<br>Lamp<br>Control</a></p>
        </div>
        <div class="middle" id="headerMiddle">
            <h1>KODOS - This is progress</h1>
        </div>
        <div class="right" id="headerRight">
            <p><a href="#">Account</a></p>
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
                            $lastname = $row['lastName'];
                            $email = $row['email'];
                            $user = $row['user'];
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
                    // Theft

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

    <button class="logoutButton" onclick="logOut()">Log Out</button>

    <h2>Account Settings</h2>
    <p>I'm sorry, but changing your Account information is not possible at this time. If there is an urgent change needed, please contact me at info@kodos.dev</p>

    <div class="accountInfo">
        <h2 class="accountInfoIdentifier">First Name</h2>
        <hr>
        <input disabled value="<?php echo $name; ?>" />
        <br>
        <br>

        <h2 class="accountInfoIdentifier">Last Name</h2>
        <hr>
        <input disabled value="<?php echo $lastname; ?>" />
        <br>
        <br>

        <h2 class="accountInfoIdentifier">Username</h2>
        <hr>
        <input disabled value="<?php echo $user; ?>" />
        <br>
        <br>

        <h2 class="accountInfoIdentifier">Email Address</h2>
        <hr>
        <input disabled value="<?php echo $email; ?>" />
        <br>
        <br>
    
    </div>



<script>
    document.getElementById("headerMiddle").style.width = String(window.innerWidth - 400) + "px";

    function logOut() {
        document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "sessionToken=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "secretToken=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        location.reload();
    }
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

.accountInfo {
    text-align: left;
}

.accountInfoIdentifier {
    margin-bottom: 3px;
}

a {
    color: inherit;
    text-decoration: none;
}

.logoutButton {
    background-color: rgb(0,0,0,0);
    color: red;
    border: 3px solid red;
    border-radius: 15px;
    padding: 20px;
    cursor: pointer;
}

</style>

    </body>
</html>