<?php
include_once('./middleware/AuthMiddleWare.php');

// Check login status before proceeding
AuthMiddleWare::checkLoginStatus();
?>

<div class="content-wrapper">
    <div class="add-user">
        <h2 class="title">Add new user</h2>
        <form id="form-user" action="" method="post" enctype="multipart/form-data">
            <?php
            if (isset($_POST['submit-add-user'])) {
                $username = trim($_POST['username']);
                $nickname = trim($_POST['nickname']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $role = trim($_POST['role']);

                $check = 0;
                $isUserExisted = 0;
                $isEmailRegisted = 0;

                foreach ($listUsers as $user) {
                    if ($user["username"] == $username && $user["email"] == $email) {
                        $isUserExisted = 1;
                        $isEmailRegisted = 1;
                        break;
                    }
                }

                // validate username
                $username_regex = "/^\w{5,}$/";
                // Validate password
                $password_regex = "/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";
                //validate nickname
                $nickname_regex = '/^[\p{L}\s]{3,}$/u';

                if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match($nickname_regex, $nickname) && preg_match($password_regex, $password) && preg_match($username_regex, $username) && !$isEmailRegisted && !$isUserExisted) {
                    $check = 1;
                }
            }
            ?>
            <div class="form-control">
                <label class="user-label" for="username">Username <span style="font-size: 14px; color: red;">(Required) </span>
                    <?php
                    if (isset($_POST['submit-add-user'])) {
                        if ($isUserExisted) {
                            echo "<span style='color:red; font-size: 13px;'>Username has been used!</span>";
                        }

                        if (!preg_match($username_regex, $username)) {
                            echo "<span style='color:red; font-size: 13px;'>Invalid username!</span>";
                        }
                    }
                    ?>
                </label>
                <input required placeholder="Username..." class="form-input" type="text" name="username" id="username" value="<?php
                                                                                                                                if (isset($_POST['submit-add-user'])) {
                                                                                                                                    if (isset($_POST['username'])) {
                                                                                                                                        if (!$isUserExisted && preg_match($username_regex, $username)) {
                                                                                                                                            echo $_POST['username'];
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                }
                                                                                                                                ?>">
            </div>
            <div class="form-control">
                <label class="user-label" for="nickname">Nickname <span style="font-size: 14px; color: red;">(Required) </span></label>
                <input required placeholder="Nickname..." class="form-input" type="text" name="nickname" id="nickname" value="<?php
                                                                                                                                if (isset($_POST['submit-add-user'])) {
                                                                                                                                    if (isset($_POST['nickname'])) {
                                                                                                                                        if (preg_match($nickname_regex, $nickname)) {
                                                                                                                                            echo $_POST['nickname'];
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                }
                                                                                                                                ?>">
            </div>
            <div class="form-control">
                <label class="user-label" for="email">Email <span style="font-size: 14px; color: red;">(Required) </span>
                    <?php
                    if (isset($_POST['submit-add-user'])) {
                        if ($isEmailRegisted) {
                            echo "<span style='color:red; font-size: 13px;'>Email has been registed!</span>";
                        }
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "<span style='color:red; font-size: 13px;'>Invalid email!</span>";
                        }
                    }
                    ?>
                </label>
                <input required placeholder="Email..." class="form-input" type="text" name="email" id="email" value="<?php
                                                                                                                        if (isset($_POST['submit-add-user'])) {
                                                                                                                            if (isset($_POST['email'])) {
                                                                                                                                if (!$isEmailRegisted && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                                                                                                    echo $_POST['email'];
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                        ?>">
            </div>
            <div class="form-control">
                <label class="user-label" for="password">Password <span style="font-size: 14px; color: red;">(Required) </span>
                    <?php
                    if (isset($_POST['submit-add-user'])) {
                        if (!preg_match($password_regex, $password)) {
                            echo "<span style='color:red; font-size: 13px;'>Invalid password!</span>";
                        }
                    }
                    ?>
                </label>
                <input required placeholder="Password..." class="form-input" type="password" name="password" id="password">
            </div>
            <div class="form-control">
                <label class="user-label" for="">Role</label>
                <select name="role" id="role">
                    <option value="ADMIN" <?php
                                            if (isset($_POST["submit-add-user"])) {
                                                if ($_POST['role'] == "ADMIN") {
                                                    echo "selected";
                                                }
                                            }
                                            ?>>Admin</option>
                    <option value="USER" <?php
                                            if (isset($_POST['submit-add-user'])) {
                                                if ($_POST['role'] == "USER") {
                                                    echo "selected";
                                                }
                                            }
                                            ?>>User</option>
                </select>
            </div>
            <div class="form-control" style="margin-top: 15px;">
                <label class="user-img" for="user-img">
                    <p>Choose user avatar here</p>
                    <i class="fa-solid fa-upload"></i>
                </label>
                <input class="form-input" type="file" name="avatar" id="user-img">
            </div>
            <button class="user-btn" type="submit" name="submit-add-user">Add user</button>
        </form>
    </div>
</div>

<script>
    const postImg = document.getElementById('user-img')

    postImg.addEventListener('change', function(e) {
        if (e.target.files[0] && e.target.files[0].name) {
            const fileName = e.target.files[0].name;
            const imgContent = document.querySelector('.user-img p');
            imgContent.textContent = fileName;
        } else {
            const imgContent = document.querySelector('.user-img p');
            imgContent.textContent = "Choose user avatar here";
        }
    })
</script>