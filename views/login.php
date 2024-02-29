<h1 class="title">Welcome, Login</h1>
<form id="form-login" action="" method="post">
    <?php
    if (isset($_POST["submit-login"])) {
        $username = trim($_POST["usernameInput"]);
        $password = trim($_POST["passInput"]);
        $check = 0;
        $userIsExisted = 0;

        foreach ($users as $user) {
            if ($user["username"] == $username) {
                $userIsExisted = 1;

                if (password_verify($password, $user["password"])) {
                    $check = 1;
                    $_SESSION["login-info"]['nickname'] = $user["nickname"];
                    $_SESSION["login-info"]['id'] = $user["id"];
                    $_SESSION["login-info"]['avatar'] = $user["avatar"];
                    $_SESSION["login-info"]['role'] = $user['role'];
                    $_SESSION['isLogin'] = true;
                    break;
                }
            }
        }

        if ($check == 1 && !$_SESSION["login-info"]['nickname'] && $_SESSION['isLogin'] == true) {
            header("Location: ?page=choose-nickname");
        }
        if ($check == 1 && $_SESSION["login-info"]['nickname'] && $_SESSION['isLogin'] == true) {
            header("Location: /gd2");
        }
    }
    ?>
    <div class="form-content">
        <div class="form-group">
            <div class="form-control">
                <label class="login-form-label" for="usernameInput">Username</label>
                <input value="<?= isset($_POST['usernameInput']) ? $username : "" ?>" class="form-input usernameInput" name="usernameInput" id="usernameInput" type="text" placeholder="Enter username..." required />
            </div>
            <div class="form-control">
                <label class="login-form-label" for="passInput" class="pass">Password</label>
                <div class="pass">
                    <input type="password" name="passInput" class="form-input passInput" id="passInput" placeholder="Enter password..." required>
                    <i class="fa-solid fa-eye" onclick="handleToggleIcon(this)"></i>
                </div>
                <?php
                if (isset($_POST["submit-login"])) {
                    if ($userIsExisted == 0 || !password_verify($password, $user["password"])) {
                        echo "<span style='color:red; font-size: 13px;'>Invalid username or password!</span>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="form-control">
                <button name="submit-login" class="btn btn-login" type="submit">Login</button>
            </div>
            <div class="form-control">
                <label class="login-form-label">Don't have an account</label>
                <a href="?page=register" name="register" class="btn btn-register">Register</a>
            </div>
        </div>
    </div>
</form>


<script>
    function handleToggleIcon(e) {
        if (e.classList[1] === 'fa-eye') {
            const inputPass = e.previousElementSibling;
            inputPass.type = "text"
            e.classList.remove('fa-eye')
            e.classList.add('fa-eye-slash')
        } else {
            const inputPass = e.previousElementSibling;
            inputPass.type = "password"
            e.classList.add('fa-eye')
            e.classList.remove('fa-eye-slash')
        }
    }
</script>