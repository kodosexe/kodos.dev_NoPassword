<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Login Validation</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
</head>

<body>

<div class="wrapper">

<h1>Logging you in...</h1>

<?php
// Check if the form is submitted
if ( isset( $_POST['submit'] ) ) {

// retrieve the form data by using the element's name attributes value as key


$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$link = mysqli_connect("REDACTED", "REDACTED", "REDACTED", "REDACTED");

$sessionToken = random_str(10);
$secretToken = random_str(15);

$hashedToken = password_hash($secretToken, PASSWORD_BCRYPT);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    exit;
}
 
// Attempt select query execution
$sql = "SELECT * FROM color WHERE user = '$username' OR email = '$username'";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_array($result)){
            if (password_verify($password, $row['password'])) {
                if (isset($_REQUEST['rememberMe'])) {
                    //echo "Setting cookie for a year";
                    setcookie("sessionToken", "$sessionToken", time() + (864010*365), "/");
                    setcookie("secretToken", "$hashedToken", time() + (864010*365), "/");
                    setcookie("username", "$username", time() + (864010*365), "/");
                } else {
                    //echo "Setting cookie until timeout";
                    setcookie("sessionToken", "$sessionToken", 0, "/");
                    setcookie("secretToken", "$hashedToken", 0, "/");
                    setcookie("username", "$username", 0, "/");
                }
                $email = $row['email'];
                $username = $row['user'];
                $sql = "INSERT INTO logins VALUES ('$username','$email','$sessionToken','$hashedToken')";

                if ($result = mysqli_query($link, $sql)) {
                    echo "Login Successful.";
                } else{
                    //echo "ERROR: COULD NOT CONTACT THE SERVER. IF ERROR PERSISTS, PLEASE CONTACT kodosexe@gmail.com";
                    //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    exit();
                }
                

                echo 'Password is valid!';
            } else {
                echo 'Password or Username incorrect. Reload The page to try again.';
            }

        }
        
        // Free result set
        mysqli_free_result($result);
    } else{
        echo("Password or Username incorrect. Reload The page to try again.");
    }
} else{
    //echo "ERROR: COULD NOT CONTACT THE SERVER. IF ERROR PERSISTS, PLEASE CONTACT kodosexe@gmail.com";
    //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// display the results


echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp';</script>"; exit;

}


function random_str(
    int $length = 64,
    string $keyspace = '0123456789'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

?>

</div>

<style type="text/css">
    html {
    display:flex;
    justify-content:center;
    align-items:center;
    width:100%;
    height:100%;
    font-family: 'Open Sans Condensed', sans-serif;
}

</style>

</body>
</html>