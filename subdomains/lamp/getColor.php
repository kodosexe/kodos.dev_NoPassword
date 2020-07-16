<!DOCTYPE html>

<html>
<head>
    <title>Getting Color</title>
</head>

<body>

<?php
    $link = mysqli_connect("REDACTED", "REDACTED", "REDACTED", "REDACTED");

    $username = $_GET["username"];
    $password = $_GET["password"];

    //echo 'USER IS ' . $username;
    //echo 'PASSWORD IS ' . $password;

    /*
    $bright = $_REQUEST['brightness'];
    $red = $_REQUEST['red'];
    $green = $_REQUEST['green'];
    $blue = $_REQUEST['blue'];
    */
    
        // Check Cookie Integrity
        //echo "Value is: " . $_COOKIE[$cookieName];
        
    
        $sql = "SELECT * FROM color WHERE user ='$username'";
        if ($result = mysqli_query($link, $sql)){
            if (mysqli_num_rows($result) == 1) {
                while ($row = mysqli_fetch_array($result)) {
                    if (password_verify($password, $row['password'])) {
                        
                    //echo 'USER FOUND';
                    $username = $row['user'];
                    $email = $row['email'];

                    
                    
                    $brightness = $row['brightness'];
                    $red = $row['red'];
                    $green = $row['green'];
                    $blue = $row['blue'];

                    echo 'rgb(' . ($red/255)*$brightness . ',' . ($green/255)*$brightness . ',' . ($blue/255)*$brightness . ')';
                    

                    
                } else {
                    echo 'Username or Password Incorrect';
                }
                }
                
            } else {
                echo 'Username or Password Incorrect';
                //echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/login';</script>"; exit;
            }
        } else {
            //echo 'Couldnt establish connection';
            //echo "Error: " . $sql . "<br>" . $link->error;
        }



        



?>

</body>
</html>