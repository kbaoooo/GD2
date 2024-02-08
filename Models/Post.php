<?php
include_once("./conf/ConnectDb.php");

class Post extends Connect {
    public function __construct() {
        parent::__construct();
    }

    public function getAllPosts() {
        // get all posts
        $query = "Select content, title, img, DATE_FORMAT(posts.created_at, '%d-%m-%Y %H:%i') as created_at, DATE_FORMAT(posts.updated_at, '%d-%m-%Y  %H:%i') as updated_at, username from `posts` join `users` on posts.users_id = users.id";
        $pre = $this->conn->prepare($query);
        $pre->execute();
        $postsList = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $postsList;
    }

    public function createPost($postData) {
        // insert post to db
        $content = $postData["content"];
        $title = trim($postData["title"]) ? $postData["title"] : NULL;
        $imgBlob = $postData["imgBlob"];
        $users_id = 1;

        $query = "INSERT INTO posts (`users_id`,`title`, `content`, `img`) VALUES (:users_id, :title, :content ,:img)";
        $pre = $this->conn->prepare($query);
        $pre->bindParam(':users_id', $users_id);
        $pre->bindParam(':title', $title);
        $pre->bindParam(':content', $content);
        $pre->bindParam(':img', $imgBlob, PDO::PARAM_LOB);

        $pre->execute();
    }
}
