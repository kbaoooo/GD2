<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        if(isset($_GET["page"])) {
            $page = $_GET["page"];
            switch($page) {
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
            if(isset($_GET["page"])) {
                $page = $_GET["page"];
                switch($page) {
                    case "my-post":
                    case "profile":
                        include_once("./components/header.php");
                        break;
                    case "login":
                    case "register":
                    default:
                        break;
                }
            } else {
                include_once("./components/header.php");
            }
        ?>
        <div class="main-content">
            <?php 
            if(isset($_GET["page"])) {
                $page = $_GET["page"];
                switch($page) {
                    case "my-post":
                        include_once('./Controller/PostController.php');
                        $posts = new PostController();
                        $posts->myPost();
                        break;
                    case "profile":
                        include_once("./views/profile.php");
                        break;
                    case "login":
                        include_once("./views/login.php");
                        break;
                    case "register":
                        include_once("./views/register.php");
                        break;
                    default:
                        echo "Page 404 not found";
                        break;
                }
            } else {
                include_once("./Controller/PostController.php");
                $posts = new PostController();
                $posts->index();
            }
            ?>
        </div>
    </div>
</body>

</html>