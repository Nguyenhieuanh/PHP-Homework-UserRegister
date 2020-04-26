<?php
session_start();

include_once '../Classes/UserRegister.php';

if (!isset($_SESSION['username'])) {
    header("Location:../index.php");
}

if ($_SERVER['REQUEST_METHOD']) {
    if (isset($_REQUEST['btn-logout'])) {
        session_destroy();
        header("Location:../index.php");
    }
}

$userRegister = new UserRegister("../data/userData.json");
$user = $userRegister->getUserByIndex($_SESSION['index']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
echo "Successful login!!!";
echo "<br>";
echo 'Full Name:' . $user->getFullName();
echo "<br>";
echo 'User Name:' . $user->getUsername();
echo "<br>";
echo 'Email:' . $user->getEmail();
echo "<br>";
echo 'Phone Number:' . $user->getPhone();
?>
<form method="post">
    <button type="submit" name="btn-logout">Log out</button>
</form>

</body>
</html>
