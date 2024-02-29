<?php
include_once('./middleware/AuthMiddleWare.php');

// Check login status before proceeding
AuthMiddleWare::checkLoginStatus();
?>


<div class="container">
    <h1 class="title">Enter your nickname</h1>
    <span style="font-size: 15px; color: red;">* Letter only
        <?php
        if (isset($_POST["submit-choose-nickname"])) {
            $nickname = trim($_POST["nicknameInput"]);
            $check = 0;
            $nickname_regex = '/^[\p{L}\s]{3,}$/u';
            if (preg_match($nickname_regex, $nickname)) {
                $check = 1;
            } else {
                echo '<span style="color: red; font-size: 14px; margin-left: 120px;">Invalid nickname</span>';
            }
            if ($check == 1) {
                $_SESSION['login-info']['nickname'] = $nickname;
                header('Location: /gd2');
            }
        }
        ?>
    </span>
    <form action="" method="post" id="form-choose-nickname">
        <input placeholder="Enter nickname..." type="text" name="nicknameInput" id="enter-nickname" class="enter-nickname" required>
        <button type="submit" name="submit-choose-nickname" class="confirm-btn">
            <i class="fa-solid fa-arrow-right"></i>
        </button>
    </form>
</div>