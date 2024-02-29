<?php
include_once('./middleware/AuthMiddleWare.php');

// Check login status before proceeding
AuthMiddleWare::checkLoginStatus();
?>

<div class="content-wrapper">
    <div class="add-post">
        <h2 class="title">Add new post</h2>
        <form id="form-post" action="" method="post" enctype="multipart/form-data">
            <div class="form-control">
                <label class="post-label" for="post-title">Post title</label>
                <input placeholder="Your post title" class="form-input" type="text" name="post-title" id="post-title">
            </div>
            <div class="form-control">
                <label class="post-label" for="post-caption">Post caption</label>
                <textarea required placeholder="Your post caption" class="form-input" name="post-caption" id="post-caption" rows="10" cols="4"></textarea>
            </div>
            <div class="form-control">
                <label class="post-img" for="post-img">
                    <p>Choose post image here</p>
                    <i class="fa-solid fa-upload"></i>
                </label>
                <input class="form-input" type="file" name="post-img" id="post-img">
            </div>
            <button class="post-btn" type="submit" name="submit-post">Post</button>
        </form>
    </div>
    <?php if (isset($postsList) && $postsList && count($postsList) > 0) { ?>
        <div class="posts">
            <h2 class="title">My posts list</h2>
            <table class="posts-list">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Caption</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($postsList as $post) { ?>
                        <tr>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['content'] ?></td>
                            <td>
                                <?php
                                if ($post['img'] && isset($post['img'])) {
                                    echo '<img src="data:image/*;base64,' . $post['img'] . '" alt="" class="list-img">';
                                }
                                ?>
                            </td>
                            <td>
                                <a class="actions-btn edit-btn" href="?page=edit-post&post-id=<?= $post['id'] ?>&post-title=<?= $post['title'] ?>&post-caption=<?= $post['content'] ?>">Edit</a>
                                <a class="actions-btn delete-btn" href="?page=delete-post&post-id=<?= $post['id'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>

<script>
    const postImg = document.getElementById('post-img')

    postImg.addEventListener('change', function(e) {
        if (e.target.files[0] && e.target.files[0].name) {
            const fileName = e.target.files[0].name;
            const imgContent = document.querySelector('.post-img p');
            imgContent.textContent = fileName;
        } else {
            const imgContent = document.querySelector('.post-img p');
            imgContent.textContent = "Choose post image here";
        }
    })
</script>