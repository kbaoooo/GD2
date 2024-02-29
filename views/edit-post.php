<?php
include_once('./middleware/AuthMiddleWare.php');

// Check login status before proceeding
AuthMiddleWare::checkLoginStatus();
?>

<div class="content-wrapper">
    <h2 class="title">Edit post</h2>
    <form id="form-post" action="" method="post" enctype="multipart/form-data">
        <?php if (isset($post) && $post) { ?>
            <div class="form-control">
                <label class="post-label" for="post-title">Post title</label>
                <input placeholder="Your post title" class="form-input" type="text" name="post-title" id="post-title" value="<?php if ($post['title']) {
                                                                                                                                    echo trim($post['title']);
                                                                                                                                } else {
                                                                                                                                    echo '';
                                                                                                                                } ?>">
            </div>
            <div class="form-control">
                <label class="post-label" for="post-caption">Post caption</label>
                <textarea rows="10" cols="90" required class="form-input" type="text" name="post-caption" id="post-caption">
            <?php if ($post['content']) {
                echo trim($post['content']);
            } else {
                echo '';
            } ?>
            </textarea>
            </div>
            <?php if ($post['img']) { ?>
                <div class="preview">
                    <label class="post-label" for="post-caption">Post image</label>
                    <button class="delete-img"><i class="fa-solid fa-xmark"></i></button>
                    <img src="data:image/*;base64,<?= $post['img'] ?>" alt="" class="preview-img" />
                </div>
            <?php } else {
                echo '';
            } ?>
            <div class="form-control">
                <label class="post-img" for="post-img">
                    <p>Choose post image here</p>
                    <i class="fa-solid fa-upload"></i>
                </label>
                <input class="form-input" type="file" name="post-img" id="post-img">
            </div>
            <button class="update-post-btn" type="submit" name="submit-update-post">Update Post</button>
        <?php } else { ?>
            <h3>Post not found</h3>
        <?php } ?>
    </form>
</div>

<div class="layout"></div>
<div class="pop-up-delete">
    <label class="message">
        <h3 class="message-label">Do you want to delete your image?</h3>
        <div class="btns-delete">
            <button class='btn-delete cancel'>Cancel</button>
            <button class="btn-delete delete">Delete</button>
        </div>
    </label>
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

    const postCaption = document.getElementById('post-caption');
    postCaption.textContent = postCaption.textContent.trim();


    const deleteBtn = document.querySelector('.delete-img');
    const layout = document.querySelector('.layout')
    const popUpDelete = document.querySelector('.pop-up-delete')
    const preview = document.querySelector('.preview')
    const deleteConfirmBtn = document.querySelector('.delete');
    const cancelDeleteBtn = document.querySelector('.cancel');

    deleteBtn.addEventListener('click', (e) => {
        layout.style.display = 'block'
        popUpDelete.style.display = 'block'
        e.preventDefault();
    });

    deleteConfirmBtn.addEventListener('click', () => {
        deleteBtn.name = 'delete-img';
        preview.style.display = 'none';
        layout.style.display = 'none'
        popUpDelete.style.display = 'none'
        e.preventDefault();

    })

    cancelDeleteBtn.addEventListener('click', () => {
        layout.style.display = 'none'
        popUpDelete.style.display = 'none'
        e.preventDefault();
    })

    layout.addEventListener('click', () => {
        layout.style.display = 'none'
        popUpDelete.style.display = 'none'        
    })
</script>