<?php
session_start();
include_once "Classes/UserRegister.php";

$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_REQUEST['btn-login'])) {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        if ($username == '' || $password == '') {
            header("Location: profile.php");
        } else {
            $userRegister = new UserRegister('data/userData.json');
            $userList = $userRegister->getUsers();
            foreach ($userList as $index => $user) {
                if ($username == $user->getUsername() && $password == $user->getPassword()) {
                    $_SESSION['username'] = $username;
                    $_SESSION['index'] = $index;
                    header("Location: view/profile.php");
                } else {
                    $msg = "*Username or password incorrect*";
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<form class="login-form" method="post">
    <h1>Login</h1>

    <div class="txtb">
        <input type="text" name="username" required>
        <span data-placeholder="Username"></span>
    </div>

    <div class="txtb">
        <input type="password" name="password" required>
        <span data-placeholder="Password"></span>
    </div>

    <input type="submit" class="logbtn" name="btn-login" value="Login">

    <div class="bottom-text">
        Don't have account? <a href="action/create.php">Sign up</a>
    </div>

    <div class="bottom-text" style="color:red; font-style: italic; font-size: 15px">
        <?php echo $msg; ?>
    </div>

</form>

</body>
</html>