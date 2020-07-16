<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Signup Validation</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
</head>

<body>
<div class="wrapper">
<?php
// Check if the form is submitted
if ( isset( $_POST['submit'] ) ) {

// retrieve the form data by using the element's name attributes value as key


$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$name = $_REQUEST['name'];
$lastname = $_REQUEST['lastname'];
$email = $_REQUEST['email'];

$hashedPass = password_hash($password, PASSWORD_BCRYPT);

$link = mysqli_connect("REDACTED", "REDACTED", "REDACTED", "REDACTED");

$id = random_str(13);




 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    exit;
}
 
// Attempt select query execution
$sql = "SELECT * FROM color WHERE user = '$username'";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
            echo "Error: Username taken";
        

    } else{
        $sql = "SELECT * FROM color WHERE user = '$email'";
        if(mysqli_num_rows($result) > 0){
            echo "Error: email taken";
        } else {
            $sql = "INSERT INTO `color`(`id`, `brightness`, `red`, `green`, `blue`, `user`, `password`, `name`, `lastName`, `email`, `serID`, `loginToken`) VALUES ('$id', '', '', '', '', '$username', '$hashedPass', '$name', '$lastname', '$email', '', '')";
            if ($link->query($sql) === TRUE) {
                echo "New record created successfully";
                $link->close();

                echo "<script type='text/javascript'>window.top.location='http://kodos.dev/lamp/login';</script>"; exit;
              } else {
                echo "Error: " . $sql . "<br>" . $link->error;
              }
            }
    }
} else{
    //echo "ERROR: COULD NOT CONTACT THE SERVER. IF ERROR PERSISTS, PLEASE CONTACT kodosexe@gmail.com";
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// exit
$link->close();


exit;


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

<style>
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