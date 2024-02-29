<?php
include_once("./conf/ConnectDb.php");

class User extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        // get all users
        $query = "Select * from `users`";
        $pre = $this->conn->prepare($query);
        if ($pre->execute()) {
            $users = $pre->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $users = [];
        }

        return $users;
    }

    public function getUserById($id)
    {
        $query = 'Select * from `users` where id = :id';
        $pre = $this->conn->prepare($query);
        $pre->bindParam(':id', $id);
        $pre->execute();
        $user = $pre->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }

    public function addNewUserInfo($data)
    {
        // add new user when registed success
        $username = $data["username"];
        $email = $data["email"];
        $password = $data["password"];

        $query = "INSERT INTO users (`username`,`email`, `password`) VALUES (:username, :email, :password)";
        $pre = $this->conn->prepare($query);
        $pre->bindParam(':username', $username);
        $pre->bindParam(':email', $email);
        $pre->bindParam(':password', $password);
        if ($pre->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function addUserNickname($id, $nickname)
    {
        $query = "UPDATE users SET `nickname` = :nickname WHERE id = :id";
        $pre = $this->conn->prepare($query);
        $pre->bindParam(":nickname", $nickname);
        $pre->bindParam(":id", $id);
        if ($pre->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updateUserProfile($id, $data)
    {
        if ($data['avatar']) {
            $query = "UPDATE `users` SET avatar = :avatar, nickname = :nickname WHERE id = :id";
            $pre = $this->conn->prepare($query);
            $pre->bindParam(":avatar", $data["avatar"]);
        } else {
            $query = "UPDATE `users` SET nickname = :nickname WHERE id = :id";
            $pre = $this->conn->prepare($query);
        }
        $pre->bindParam(":id", $id);
        $pre->bindParam(":nickname", $data["nickname"]);
        if ($pre->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function addUserAdmin($data)
    {
        if ($data['avatar']) {
            $query = "INSERT INTO users (`username`, `nickname`, `avatar`, `password`, `email`, `role`) VALUES (:username, :nickname, :avatar, :password, :email, :role)";
            $pre = $this->conn->prepare($query);
            $pre->bindParam(":avatar", $data["avatar"]);
        } else {
            $query = "INSERT INTO users (`username`, `nickname`, `password`, `email`, `role`) VALUES (:username, :nickname, :password, :email, :role)";
            $pre = $this->conn->prepare($query);
        }
        $pre->bindParam(":username", $data["username"]);
        $pre->bindParam(":nickname", $data["nickname"]);
        $pre->bindParam(":password", $data["password"]);
        $pre->bindParam(":email", $data["email"]);
        $pre->bindParam(":role", $data["role"]);
        if ($pre->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updateUserAdmin($id, $data)
    {
        $username = $data['username'];
        $nickname = $data['nickname'];
        $email = $data['email'];
        $role = $data['role'];
        $avatar = $data['avatar'];
        $password = $data['password'];

        $query = "UPDATE `users` SET avatar = :avatar, nickname = :nickname, username = :username, password = :password, email = :email, role = :role WHERE id = :id";
        $pre = $this->conn->prepare($query);
        $pre->bindParam(':id', $id);
        $pre->bindParam(':username', $username);
        $pre->bindParam(':nickname', $nickname);
        $pre->bindParam(':email', $email);
        $pre->bindParam(':role', $role);
        $pre->bindParam(':password', $password);
        $pre->bindParam(':avatar', $avatar);
        if($pre->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function deleteUserAdmin($id)
    {
        if ($id) {
            $query = "DELETE from users WHERE id = :id";
            $pre = $this->conn->prepare($query);
            $pre->bindParam(":id", $id);
            if ($pre->execute()) {
                return 1;
            } else {
                return 0;
            }
        } else {
            echo "User id not existed!";
        }
    }
}
