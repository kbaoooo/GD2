<?php
include_once("./Models/Post.php");

class PostController extends Post
{
    public function __construct()
    {
        parent::__construct();
    }

    // index page
    public function index()
    {
        // model tra ve ket qua va do ve views
        $postsList = parent::getAllPosts();
        include_once("./views/all-posts.php");
    }

    //my post page
    public function myPosts()
    {
        if (isset($_SESSION['login-info']['id'])) {
            $id = $_SESSION['login-info']['id'];
            $postsList = parent::getPostsByIdOfOneUser($id);
        }
        include_once("./views/my-post.php");
        if (isset($_POST['submit-post'])) {
            if ($_FILES["post-img"]["tmp_name"]) {
                $image = $_FILES["post-img"]["tmp_name"];
                $imgContent = file_get_contents($image);
                $base64Img = base64_encode($imgContent);
            }

            $title = $_POST["post-title"];
            $content = $_POST["post-caption"];

            $postData = array(
                "title" => $title,
                "content" => $content,
                "imgBlob" => isset($base64Img) ? $base64Img : ""
            );

            if (parent::createPost($id, $postData)) {
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    }

    public function editPost()
    {
        if (isset($_GET['post-id'])) {
            $id = $_GET['post-id'];
            $post = parent::getPostsById($id);
        }
        include_once('./views/edit-post.php');
        if (isset($_POST['submit-update-post'])) {
            if ($_FILES["post-img"]["tmp_name"]) {
                $image = $_FILES["post-img"]["tmp_name"];
                $imgContent = file_get_contents($image);
                $base64Img = base64_encode($imgContent);
            }
            $title = $_POST["post-title"];
            $content = $_POST["post-caption"];
            $id = $_GET["post-id"];

            if (isset($base64Img)) {
                $img = $base64Img;
            } else if (!isset($base64Img) && isset($_POST['delete-img'])) {
                $img = '';
            } else {
                $img = '';
            }

            $postData = array(
                "title" => $title,
                "content" => $content,
                "imgBlob" => $img
            );

            if (parent::updatePost($id, $postData)) {
                header("Location: ?page=my-post");
            }
        }
    }

    public function deletePost()
    {
        include_once("./views/delete-post.php");
        if (isset($_GET["post-id"]) && $_GET["post-id"]) {
            $id = $_GET["post-id"];
        }
        if (parent::destroyPost($id)) {
            header("Location: ?page=my-post");
        }
    }

    public function searchPostController()
    {
        if (isset($_GET['submit-search'])) {
            $keyword = $_GET["search-request"];
            $resultPost = parent::searchPostModel($keyword);
            if ($resultPost) {
                $_SESSION["find-post"] = $resultPost;
            }
        }
        include_once('./views/find-posts.php');
    }
}
