<?php
session_start();
include_once '../Classes/UserRegister.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $index = $_SESSION['index'];
    $fullName = $_REQUEST['fullName'];
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $img = $_FILES['image']['name'];

    $userRegister = new UserRegister('../data/userData.json');
    $user = $userRegister->getUserByIndex($index);

    if (!empty($img)) {
        $target_dir = "../upload/";
        if ($user->getImage() !== 'default-avatar.png') {
            $imageDelete = $target_dir . basename($user->getImage());
            unlink($imageDelete);
            $image_name = basename(time() . '-' . $img);
            $target_file = $target_dir . $image_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            $user->setImage($image_name);
        } else {
            $image_name = basename(time() . '-' . $img);
            $target_file = $target_dir . $image_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            $user->setImage($image_name);
        }
    }

    $user->setFullName($fullName);
    $user->setUsername($username);
    $user->setEmail($email);
    $user->setPhone($phone);
    $userRegister->updateUser($index, $user);
    header("Location:../view/profile.php");
}

