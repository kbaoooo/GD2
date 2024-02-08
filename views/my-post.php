
<div class="content-wrapper">
    <div class="add-post">
        <h2 class="title">Add new post</h2>
        <form id="form-post" action="" method="post" enctype="multipart/form-data">
            <div class="form-control">
                <label class="post-label" for="post-title">Post title</label>
                <input placeholder="Your post title" class="form-input" type="text" name="post-title"
                    id="post-title">
            </div>
            <div class="form-control">
                <label class="post-label" for="post-caption">Post caption</label>
                <input required placeholder="Your post caption" class="form-input" type="text" name="post-caption"
                    id="post-caption">
            </div>
            <div class="form-control">
                <label class="post-img" for="post-img">
                    <p>Drag post image here</p>
                    <i class="fa-solid fa-upload"></i>
                </label>
                <input class="form-input" type="file" name="post-img" id="post-img" >
            </div>
            <button class="post-btn" type="submit" name="submit-post">Post</button>
        </form>
    </div>
    <?php if($postsList && count($postsList) > 0) { ?>
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
                    <?php foreach($postsList as $post) { ?>
                        <tr>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['content'] ?></td>
                            <td>
                                <img src="./assets/img/content1.png" alt="" class="list-img">
                            </td>
                            <td>
                                <button class="actions-btn edit-btn" name="submit-edit-post" type="submit">Edit</button>
                                <button class="actions-btn delete-btn" name="submit-delete-post"
                                    type="submit">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>

<script>
    const postImg =document.getElementById('post-img')

    postImg.addEventListener('change', function(e) {
        if(e.target.files[0] && e.target.files[0].name) {
            const fileName = e.target.files[0].name;
            const imgContent =document.querySelector('.post-img p');
            imgContent.textContent = fileName;
        } else {
            const imgContent =document.querySelector('.post-img p');
            imgContent.textContent = "Drag post image here";
        }
    })
</script>