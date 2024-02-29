<?php
include_once("./conf/ConnectDb.php");

class Post extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPosts()
    {
        // get all posts
        $query = "SELECT content, title, img, DATE_FORMAT(posts.created_at, '%d-%m-%Y %H:%i') as created_at, DATE_FORMAT(posts.updated_at, '%d-%m-%Y  %H:%i') as updated_at, username, nickname, avatar FROM `posts` JOIN `users` ON posts.users_id = users.id ORDER BY created_at desc";
        $pre = $this->conn->prepare($query);
        $pre->execute();
        $postsList = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $postsList;
    }

    public function getPostsById($id)
    {
        $query = "SELECT * FROM `posts` WHERE id = :id";
        $pre = $this->conn->prepare($query);
        $pre->bindParam(':id', $id);
        if ($pre->execute()) {
            $post = $pre->fetch(PDO::FETCH_ASSOC);
        }
        return $post;
    }

    public function getPostsByIdOfOneUser($id)
    {
        $query = "SELECT * FROM `posts` WHERE users_id = :id";
        $pre = $this->conn->prepare($query);
        $pre->bindParam(':id', $id);
        if ($pre->execute()) {
            $post = $pre->fetchAll(PDO::FETCH_ASSOC);
        }
        return $post;
    }

    public function createPost($id, $postData)
    {
        // insert post to db
        $content = trim($postData["content"]);
        $title = trim($postData["title"]) ? $postData["title"] : NULL;
        $imgBlob = $postData["imgBlob"];

        $query = "INSERT INTO posts (`users_id`,`title`, `content`, `img`) VALUES (:users_id, :title, :content ,:img)";
        $pre = $this->conn->prepare($query);
        $pre->bindParam(':users_id', $id);
        $pre->bindParam(':title', $title);
        $pre->bindParam(':content', $content);
        $pre->bindParam(':img', $imgBlob, PDO::PARAM_LOB);

        if ($pre->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updatePost($id, $postData)
    {
        $content = $postData["content"];
        $title = trim($postData["title"]) ? $postData["title"] : NULL;
        $imgBlob = $postData["imgBlob"];

        $query = "UPDATE `posts` SET title = :title, content = :content, img = :img WHERE id = :id";
        $pre = $this->conn->prepare($query);
        $pre->bindParam(":id", $id);
        $pre->bindParam(":title", $title);
        $pre->bindParam(":content", $content);
        $pre->bindParam(":img", $imgBlob, PDO::PARAM_LOB);
        if ($pre->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function destroyPost($id)
    {
        $query = "DELETE FROM `posts` WHERE id = :id";
        $pre = $this->conn->prepare($query);
        $pre->bindParam(":id", $id);
        if ($pre->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function searchPostModel($keyword)
    {
        $query = "SELECT content, title, img, DATE_FORMAT(posts.created_at, '%d-%m-%Y %H:%i') as created_at, DATE_FORMAT(posts.updated_at, '%d-%m-%Y  %H:%i') as updated_at, username, nickname, avatar FROM `posts` JOIN `users` ON posts.users_id = users.id WHERE content LIKE :keyword OR title LIKE :keyword";
        $pre = $this->conn->prepare($query);
        $keywordWithWildcards = '%' . $keyword . '%'; // Adding wildcards to search for partial matches
        $pre->bindParam(':keyword', $keywordWithWildcards);
        if ($pre->execute()) {
            $postsList = $pre->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postsList = []; // Initialize as empty array in case of failure
        }
        return $postsList;
    }
}
