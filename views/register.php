

    <div class="container">
        <h1 class="title">Register</h1>
        <form id="form-register" action="" method="post">
            <div class="form-content">
                <div class="form-group">
                    <div class="form-control">
                        <label class="login-form-label" for="usernameInput">Username</label>
                        <input name="usernameInput" class="form-input usernameInput" id="usernameInput" type="text" placeholder="Enter username..." required />
                    </div>
                    <div class="form-control">
                        <label class="login-form-label" for="emailInput">Email</label>
                        <input name="emailInput" class="form-input emailInput" id="emailInput" type="email" placeholder="Enter email..." required />
                    </div>
                    <div class="form-control">
                        <label class="login-form-label" for="passInput" class="pass">Password</label>
                        <div class="pass">
                            <input name="passInput" type="password" class="form-input passInput" id="passInput" placeholder="Enter password..." required>
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <!-- <i class="fa-solid fa-eye-slash"></i> -->
                    </div>
                    <div class="form-control">
                        <label class="login-form-label" for="passInput" class="pass">Repeat Password</label>
                        <div class="pass">
                            <input name="repeatInput" type="password" class="form-input repeatPassInput" id="repeatPassInput" placeholder="Enter repeat password..." required>
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <!-- <i class="fa-solid fa-eye-slash"></i> -->
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-control">
                        <button name="submit-resgister" class="btn btn-register" type="submit">Register</button>
                    </div>
                    <div class="form-control">
                        <label class="login-form-label">Already have an account</label>
                        <a href="?page=login" name="login" class="btn btn-login">Login</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
