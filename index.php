<?php
ob_start();
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./assets/css/header.css">
    <?php
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        switch ($page) {
            case "index":
                echo '<link rel="stylesheet" href="./assets/css/index.css">';
                echo '<title>Posts</title>';
                break;
            case "my-post":
                echo '<link rel="stylesheet" href="./assets/css/my-post.css">';
                echo '<title>My Post</title>';
                break;
            case "profile":
                echo '<link rel="stylesheet" href="./assets/css/profile.css">';
                echo '<title>Profile</title>';
                break;
            case "login":
                echo '<link rel="stylesheet" href="./assets/css/login.css">';
                echo '<title>Login</title>';
                break;
            case "register":
                echo '<link rel="stylesheet" href="./assets/css/register.css">';
                echo '<title>Register</title>';
                break;
            case "choose-nickname":
                echo '<link rel="stylesheet" href="./assets/css/choose-nickname.css">';
                echo '<title>Choose nickname</title>';
                break;
            case "edit-post":
                echo '<link rel="stylesheet" href="./assets/css/edit-post.css">';
                echo '<title>Edit Post</title>';
                break;
            case "search-post":
                echo '<link rel="stylesheet" href="./assets/css/find-posts.css">';
                echo '<title>Find Post</title>';
                break;
            case 'manage-users':
                echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
                echo '<link rel="stylesheet" href="./assets/css/manage-users.css">';
                echo '<title>Manage Users</title>';
                break;
            case 'add-user':
                echo '<link rel="stylesheet" href="./assets/css/add-user.css">';
                echo '<title>Add new user</title>';
                break;
            case 'edit-user':
                echo '<link rel="stylesheet" href="./assets/css/edit-user.css">';
                echo '<title>Edit user</title>';
                break;
        }
    } else {
        echo '<link rel="stylesheet" href="./assets/css/index.css">';
        echo '<title>Posts</title>';
    }
    include_once("./includes/head.php");
    ?>
</head>

<body>
    <div class="container">
        <!-- header -->
        <?php
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            switch ($page) {
                case "index":
                case "my-post":
                case "profile":
                case "edit-post":
                case "search-post":
                case "manage-users":
                case "add-user":
                case "edit-user":
                    include_once("./components/header.php");
                    break;
                case "login":
                case "register":
                case "choose-nickname":
                default:
                    break;
            }
        } else {
            include_once("./components/header.php");
        }
        ?>
        <div class="main-content">
            <?php
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
                switch ($page) {
                    case "index":
                        include_once("./Controller/PostController.php");
                        $postController = new PostController();
                        $postController->index();
                        break;
                    case "my-post":
                        include_once('./Controller/PostController.php');
                        $postController = new PostController();
                        $postController->myPosts();
                        break;
                    case "profile":
                        include_once("./Controller/UserController.php");
                        $userController = new UserController();
                        $userController->profile();
                        break;
                    case "login":
                        include_once("./Controller/UserController.php");
                        $userController = new UserController();
                        $userController->login();
                        break;
                    case "register":
                        include_once("./Controller/UserController.php");
                        $userController = new UserController();
                        $userController->register();
                        break;
                    case "choose-nickname":
                        include_once("./Controller/UserController.php");
                        $userController = new UserController();
                        $userController->chooseNickname();
                        break;
                    case "edit-post":
                        include_once("./Controller/PostController.php");
                        $postController = new PostController();
                        $postController->editPost();
                        break;
                    case "delete-post":
                        include_once("./Controller/PostController.php");
                        $postController = new PostController();
                        $postController->deletePost();
                        break;
                    case "search-post":
                        include_once("./Controller/PostController.php");
                        $postController = new PostController();
                        $postController->searchPostController();
                        break;
                    case "manage-users":
                        include_once("./Controller/UserController.php");
                        $userController = new UserController();
                        $userController->manageUsers();
                        break;
                    case "add-user":
                        include_once("./Controller/UserController.php");
                        $userController = new UserController();
                        $userController->addUser();
                        break;
                    case "edit-user":
                        include_once("./Controller/UserController.php");
                        $userController = new UserController();
                        $userController->editUser();
                        break;
                    case "delete-user":
                        include_once("./Controller/UserController.php");
                        $userController = new UserController();
                        $userController->deleteUser();
                        break;
                    default:
                        echo "Page 404 not found";
                        break;
                }
            } else {
                include_once("./Controller/PostController.php");
                $postController = new PostController();
                $postController->index();
            }
            ?>
        </div>
    </div>
</body>
<script src=""></script>

</html>