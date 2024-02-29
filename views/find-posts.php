<?php
include_once('./middleware/AuthMiddleWare.php');

// Check login status before proceeding
AuthMiddleWare::checkLoginStatus();
?>

<div class=" posts">
    <?php
    foreach ($resultPost as $post) { ?>
        <div class="post">
            <div class="post-header">
                <div class="post-user">
                    <img src="data:image/*;base64,<?php echo $post['avatar']; ?>" alt="" class="ava">
                    <div class="post-user-name"><?php echo $post['nickname'] ?></div>
                </div>
                <span class="time">
                    <?php
                    if ($post['updated_at'] != $post['created_at']) {
                        echo $post['updated_at'];
                    } else {
                        echo $post['created_at'];
                    }
                    ?>
                </span>
            </div>
            <h3 class="title"><?php echo $post['title'] ?></h3>
            <div class="content">
                <?php echo $post['content'] ?>
            </div>
            <?php if ($post['img'] && $post['img'] != "NULL") { ?>
                <div class="post-img">
                    <img src="data:image/*;base64,<?php echo $post['img']; ?>" alt="" class="img-content">
                </div>
            <?php } ?>
        </div>
        <div class="divider"></div>
    <?php } ?>
</div>