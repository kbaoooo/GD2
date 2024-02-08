

    <div class="container">
        <h1 class="title">Welcome, Login</h1>
        <form id="form-login" action="" method="post">
            <div class="form-content">
                <div class="form-group">
                    <div class="form-control">
                        <label class="login-form-label" for="usernameInput">Username</label>
                        <input class="form-input usernameInput" name="usernameInput" id="usernameInput" type="text" placeholder="Enter username..." required />
                    </div>
                    <div class="form-control">
                        <label class="login-form-label" for="passInput" class="pass">Password</label>
                        <div class="pass">
                            <input type="password" name="passInput" class="form-input passInput" id="passInput" placeholder="Enter password..." required>
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <!-- <i class="fa-solid fa-eye-slash"></i> -->
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
    </div>
