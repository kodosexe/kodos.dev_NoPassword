<!DOCTYPE html>

<html>
<head>
    <title>Updating Color</title>
</head>

<body>

<?php
if ( isset( $_POST['submit'] ) ) {

    $link = mysqli_connect("REDACTED", "REDACTED", "REDACTED", "REDACTED");

    $bright = $_REQUEST['brightness'];
    $red = $_REQUEST['red'];
    $green = $_REQUEST['green'];
    $blue = $_REQUEST['blue'];

    $sessionName = "sessionToken";
    $secretName = "secretToken";
    $usrName = "username";

    // VERIFY LOGIN
    if (!isset($_COOKIE[$sessionName]) || !isset($_COOKIE[$secretName]) || !isset($_COOKIE[$usrName])) {
    
        echo "Not Logged in - Redirecting to Login";
        echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/login';</script>"; exit;
    } else {
        // Check Cookie Integrity
        //echo "Value is: " . $_COOKIE[$cookieName];
        
        $sessionToken = $_COOKIE[$sessionName];
        $secretToken = $_COOKIE[$secretName];
        $username = $_COOKIE[$usrName];
    
        $sql = "SELECT * FROM logins WHERE user ='$username' OR email = '$username'";
        if ($result = mysqli_query($link, $sql)){
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $username = $row['user'];
                    $email = $row['email'];
                    
                    $sql = "SELECT * FROM logins WHERE user ='$username' AND email = '$email' AND serID = '$sessionToken' AND loginToken = '$secretToken'";

                    if ($result = mysqli_query($link, $sql)){
                        if (mysqli_num_rows($result) == 1) {

                            $sql = "UPDATE color SET brightness='$bright', red='$red', green='$green', blue='$blue' WHERE user ='$username' AND email = '$email'";
                            if ($link->query($sql) === TRUE) {
                                //echo "Updated Color Successfully";
                                $link->close();
        
                                echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/';</script>"; exit;
                            } else {
                                //echo "Error: " . $sql . "<br>" . $link->error;
                            }

                        } else {
                            //echo 'No records found or too many found in check';
                        }
                    } else {
                        //echo 'Couldnt establish connection in check';
                        //echo "Error: " . $sql . "<br>" . $link->error;
                    }

                    
                }
            } else {
                //echo 'No matches found or too many found';
                //echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/login';</script>"; exit;
            }
        } else {
            echo 'Couldnt establish connection';
            //echo "Error: " . $sql . "<br>" . $link->error;
        }


}


}

?>

</body>
</html>