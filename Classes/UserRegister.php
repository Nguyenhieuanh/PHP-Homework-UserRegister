<?php
include_once "User.php";

class UserRegister
{
    protected $userList = [];
    protected $filePath;

    public function __construct($filePath)
    {
        return $this->filePath = $filePath;
    }

    public function getDataJson()
    {
        $dataJson = file_get_contents($this->filePath);
        return json_decode($dataJson);
    }

    public function saveDataJson($data)
    {
        $dataJson = json_encode($data);
        file_put_contents($this->filePath, $dataJson);
    }

    public function addNewUser($user)
    {
        $users = $this->getDataJson();
        $data = [
            'fullName' => $user->getFullName(),
            'username' => $user->getUserName(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'password' => $user->getPassword()
        ];
        array_push($users, $data);
        $this->saveDataJson($users);
    }

    public function getUsers()
    {
        $users = $this->getDataJson();
        foreach ($users as $user) {
            $user = new User($user->fullName, $user->username, $user->email, $user->phone, $user->password);
            array_push($this->userList, $user);
        }
        return $this->userList;
    }

    public function getUserByIndex($index)
    {
        $dataArr = $this->getDataJson();
        return new User($dataArr[$index]->fullName,
            $dataArr[$index]->username,
            $dataArr[$index]->email,
            $dataArr[$index]->phone,
            $dataArr[$index]->password);
    }

}