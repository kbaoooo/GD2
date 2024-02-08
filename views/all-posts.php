<div class=" posts">
    <?php 
        foreach ($postsList as $post) { ?>
            <div class="post">
                <div class="post-header">
                    <div class="post-user">
                        <img src="./assets/img/ava1.png" alt="" class="ava">
                        <div class="post-user-name"><?php echo $post['username'] ?></div>
                    </div>
                    <span class="time">
                        <?php 
                            if($post['updated_at'] != $post['created_at']) {
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
                <div class="post-img">
                    <img src="./assets/img/content1.png" alt="" class="img-content">
                </div>
            </div>
    <?php } ?>
</div>
       