<?php

class AuthMiddleWare
{
    public static function checkLoginStatus()
    {
        if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
            ob_start();
            header('Location: ?page=login');
            ob_end_flush();
            exit();
        }
    }
}
