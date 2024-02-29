<header>
    <nav class="nav-menu">
        <div class="menu">
            <li class="menu-item"><a href="/gd2" class="menu-item-link">All posts</a></li>
            <li class="menu-item"><a href="?page=my-post" class="menu-item-link">My posts</a></li>
        </div>
        <div class="search">
            <form action="" method="get" class="search-form">
                <input type="text" name="page" value="search-post" style="display: none;" />
                <input placeholder="Search post" type="text" name="search-request" id="find-input">
                <button type="submit" class="search-icon-btn" name="submit-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="menu-user">
            <span class="name-user">
                <?php
                if (isset($_SESSION['login-info']['nickname'])) {
                    $nickname = $_SESSION['login-info']['nickname'];
                    echo $nickname;
                }
                ?>
            </span>
            <span class="menu-ava">
                <?php
                if (isset($_SESSION['login-info']['avatar'])) {
                    echo '<img src="data:image/*;base64,' . $_SESSION['login-info']['avatar'] . '" alt="" class="ava-header" />';
                }
                ?>
                <ul class="sub-menu">
                    <?php
                    if (isset($_SESSION['isLogin'])) {
                        if ($_SESSION['isLogin'] == true) { ?>
                            <?php if ($_SESSION['login-info']['role'] == "ADMIN") { ?>
                                <li class="sub-menu-item"><a href="?page=manage-users" class="sub-menu-item-link">Manage Users</a></li>
                            <?php } ?>
                            <li class="sub-menu-item"><a href="?page=profile" class="sub-menu-item-link">Profile</a></li>
                            <li class="sub-menu-item"><a href="" class="logout-btn sub-menu-item-link">Logout</a></li>
                            <form method="post" action="" class="form-logout" style="display: none;">
                                <input name="form-logout" />
                            </form>
                            <?php
                            if (isset($_POST['form-logout'])) {
                                unset($_SESSION['login-info']);
                                $_SESSION['isLogin'] = false;
                            }
                        } else { ?>
                            <li class="sub-menu-item"><a href="?page=login" class="sub-menu-item-link">Login</a></li>
                            <li class="sub-menu-item"><a href="?page=register" class="sub-menu-item-link">Register</a></li>
                    <?php }
                    } ?>
                </ul>
            </span>
        </div>
    </nav>
</header>

<script>
    const logoutForm = document.querySelector('.form-logout');
    const logoutBtn = document.querySelector('.logout-btn')
    logoutBtn.addEventListener('click', function(e) {
        logoutForm.submit();
        e.preventDefault();
    })
</script>