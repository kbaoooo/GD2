<h1 class="title">Register</h1>
<form id="form-register" action="" method="post">
    <?php
    if (isset($_POST['submit-register'])) {
        $check = 0;

        $username = trim($_POST['usernameInput']);
        $email = trim($_POST['emailInput']);
        $password = trim($_POST['passInput']);
        $repeatPass = trim($_POST['repeatPassInput']);

        // validate username
        $username_regex = "/^\w{5,}$/";
        // Validate password
        $password_regex = "/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";

        if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match($password_regex, $password) && preg_match($username_regex, $username) && $repeatPass == $password) {
            $check = 1;
        }

        if ($check == 1) {
            header("Location: ?page=login");
        }
    }
    ?>
    <div class="form-content">
        <div class="form-group">
            <div class="form-control">
                <label class="login-form-label" for="usernameInput">Username
                    <?php
                    if (isset($_POST["submit-register"])) {
                        if (!preg_match($username_regex, $username)) {
                            echo "<span style='color: red; font-size: 13px;'>Invalid username</span>";
                        }
                    }
                    ?>
                </label>
                <input value="<?= isset($_POST['usernameInput']) ? $username : "" ?>" name="usernameInput" class="form-input usernameInput" id="usernameInput" type="text" placeholder="Enter username..." required />
            </div>
            <div class="form-control">
                <label class="login-form-label" for="emailInput">Email
                    <?php
                    if (isset($_POST["submit-register"])) {
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "<span style='color: red; font-size: 13px;'>Invalid email</span>";
                        }
                    }
                    ?>
                </label>
                <input value="<?= isset($_POST['emailInput']) ? $email : "" ?>" name="emailInput" class="form-input emailInput" id="emailInput" type="email" placeholder="Enter email..." required />
            </div>
            <div class="form-control">
                <label class="login-form-label" for="passInput" class="pass">Password
                    <?php
                    if (isset($_POST["submit-register"])) {
                        if (!preg_match($password_regex, $password)) {
                            echo "<span style='color: red; font-size: 13px;'>Invalid password</span>";
                        }
                    }
                    ?>
                </label>
                <ul class="pass-condition">
                    <li>* Has minimum 8 characters in length</li>
                    <li>* At least one lowercase English letter</li>
                    <li>* At least one digit</li>
                </ul>
                <div class="pass">
                    <input name="passInput" type="password" class="form-input passInput" id="passInput" placeholder="Enter password..." required>
                    <i class="fa-solid fa-eye" onclick="handleToggleIcon(this)"></i>
                </div>
            </div>
            <div class="form-control">
                <label class="login-form-label" for="passInput" class="pass">Repeat Password
                    <?php
                    if (isset($_POST["submit-register"])) {
                        if ($repeatPass != $password) {
                            echo "<span style='color: red; font-size: 13px;'>Password doesn't match</span>";
                        }
                    }
                    ?>
                </label>
                <div class="pass">
                    <input name="repeatPassInput" type="password" class="form-input repeatPassInput" id="repeatPassInput" placeholder="Enter repeat password..." required>
                    <i class="fa-solid fa-eye" onclick="handleToggleIcon(this)"></i>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-control">
                <button name="submit-register" class="btn btn-register" type="submit">Register</button>
            </div>
            <div class="form-control">
                <label class="login-form-label">Already have an account</label>
                <a href="?page=login" name="login" class="btn btn-login">Login</a>
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