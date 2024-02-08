<?php 
    include_once("./Models/Post.php");

    class PostController extends Post {
        public function __construct() {
            parent::__construct();
        }

        // index page
        public function index() {
            // model tra ve ket qua va do ve views
            $postsList = parent::getAllPosts();
            include_once("./views/all-posts.php");
        }

        //my post page
        public function myPost() {
            $postsList = parent::getAllPosts();
            include_once("./views/my-post.php");
            if(isset($_POST['submit-post'])) {
                $image = $_FILES["post-img"]["tmp_name"];
                $imgContent = file_get_contents($image);
                $title = $_POST["post-title"];
                $content = $_POST["post-caption"];

                $postData = array(
                    "title"=> $title,
                    "content"=> $content,
                    "imgBlob"=> $imgContent
                );

                parent::createPost($postData);
            }
        }
    }