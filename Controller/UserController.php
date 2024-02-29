<?php
include_once("./Models/User.php");

class UserController extends User
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {
        include_once('./views/register.php');
        if (isset($_POST['submit-register']) && $check && $check == 1) {
            $username = $_POST["usernameInput"];
            $email = $_POST["emailInput"];
            $password = $_POST["passInput"];
            $hashed_password = password_hash($password, PASSWORD_ARGON2ID);

            $data = array(
                "username" => $username,
                "email" => $email,
                "password" => $hashed_password,
            );

            parent::addNewUserInfo($data);
        }
    }

    public function login()
    {
        $users = parent::getAllUsers();
        include_once("./views/login.php");
    }

    public function chooseNickname()
    {
        include_once("./views/choose-nickname.php");
        if (isset($_SESSION["login-info"]["id"])) {
            $id = $_SESSION["login-info"]["id"];
        }
        if (isset($_POST["submit-choose-nickname"])) {
            parent::addUserNickname($id, $nickname);
        }
    }

    public function profile()
    {
        if (isset($_SESSION["login-info"]["id"])) {
            $id = $_SESSION["login-info"]["id"];
        }
        $user = parent::getUserById($id);
        include_once("./views/profile.php");
        if (isset($_POST["submit-info"])) {
            $nickname = $_POST["nickname"];
            $currentAva = $_SESSION["login-info"]["avatar"];

            if ($_FILES["input-ava"]["tmp_name"]) {
                $avatarContent = file_get_contents($_FILES["input-ava"]["tmp_name"]);
                $base64Img = base64_encode($avatarContent);
            }

            if (isset($base64Img) && $base64Img) {
                $avatar = $base64Img;
            } else if (isset($_POST['delete-ava'])) {
                $avatar = '/9j/4AAQSkZJRgABAQEBLAEsAAD/4QCpRXhpZgAASUkqAAgAAAADAA4BAgBfAAAAMgAAABoBBQABAAAAkQAAABsBBQABAAAAmQAAAAAAAABQaWN0dXJlIHByb2ZpbGUgaWNvbi4gSHVtYW4gb3IgcGVvcGxlIHNpZ24gYW5kIHN5bWJvbCBmb3IgdGVtcGxhdGUgZGVzaWduLiBWZWN0b3IgaWxsdXN0cmF0aW9uLiwBAAABAAAALAEAAAEAAAD/4QV2aHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/Pgo8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIj4KCTxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+CgkJPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczpJcHRjNHhtcENvcmU9Imh0dHA6Ly9pcHRjLm9yZy9zdGQvSXB0YzR4bXBDb3JlLzEuMC94bWxucy8iICAgeG1sbnM6R2V0dHlJbWFnZXNHSUZUPSJodHRwOi8veG1wLmdldHR5aW1hZ2VzLmNvbS9naWZ0LzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGx1cz0iaHR0cDovL25zLnVzZXBsdXMub3JnL2xkZi94bXAvMS4wLyIgIHhtbG5zOmlwdGNFeHQ9Imh0dHA6Ly9pcHRjLm9yZy9zdGQvSXB0YzR4bXBFeHQvMjAwOC0wMi0yOS8iIHhtbG5zOnhtcFJpZ2h0cz0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3JpZ2h0cy8iIHBob3Rvc2hvcDpDcmVkaXQ9IkdldHR5IEltYWdlcyIgR2V0dHlJbWFnZXNHSUZUOkFzc2V0SUQ9IjEzNDEwNDY2NjIiIHhtcFJpZ2h0czpXZWJTdGF0ZW1lbnQ9Imh0dHBzOi8vd3d3LmlzdG9ja3Bob3RvLmNvbS9sZWdhbC9saWNlbnNlLWFncmVlbWVudD91dG1fbWVkaXVtPW9yZ2FuaWMmYW1wO3V0bV9zb3VyY2U9Z29vZ2xlJmFtcDt1dG1fY2FtcGFpZ249aXB0Y3VybCIgPgo8ZGM6Y3JlYXRvcj48cmRmOlNlcT48cmRmOmxpPlByYWV3cGFpbGluPC9yZGY6bGk+PC9yZGY6U2VxPjwvZGM6Y3JlYXRvcj48ZGM6ZGVzY3JpcHRpb24+PHJkZjpBbHQ+PHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ij5QaWN0dXJlIHByb2ZpbGUgaWNvbi4gSHVtYW4gb3IgcGVvcGxlIHNpZ24gYW5kIHN5bWJvbCBmb3IgdGVtcGxhdGUgZGVzaWduLiBWZWN0b3IgaWxsdXN0cmF0aW9uLjwvcmRmOmxpPjwvcmRmOkFsdD48L2RjOmRlc2NyaXB0aW9uPgo8cGx1czpMaWNlbnNvcj48cmRmOlNlcT48cmRmOmxpIHJkZjpwYXJzZVR5cGU9J1Jlc291cmNlJz48cGx1czpMaWNlbnNvclVSTD5odHRwczovL3d3dy5pc3RvY2twaG90by5jb20vcGhvdG8vbGljZW5zZS1nbTEzNDEwNDY2NjItP3V0bV9tZWRpdW09b3JnYW5pYyZhbXA7dXRtX3NvdXJjZT1nb29nbGUmYW1wO3V0bV9jYW1wYWlnbj1pcHRjdXJsPC9wbHVzOkxpY2Vuc29yVVJMPjwvcmRmOmxpPjwvcmRmOlNlcT48L3BsdXM6TGljZW5zb3I+CgkJPC9yZGY6RGVzY3JpcHRpb24+Cgk8L3JkZjpSREY+CjwveDp4bXBtZXRhPgo8P3hwYWNrZXQgZW5kPSJ3Ij8+Cv/tAKJQaG90b3Nob3AgMy4wADhCSU0EBAAAAAAAhRwCUAALUHJhZXdwYWlsaW4cAngAX1BpY3R1cmUgcHJvZmlsZSBpY29uLiBIdW1hbiBvciBwZW9wbGUgc2lnbiBhbmQgc3ltYm9sIGZvciB0ZW1wbGF0ZSBkZXNpZ24uIFZlY3RvciBpbGx1c3RyYXRpb24uHAJuAAxHZXR0eSBJbWFnZXMA/9sAQwAKBwcIBwYKCAgICwoKCw4YEA4NDQ4dFRYRGCMfJSQiHyIhJis3LyYp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/wD/AH//AP8A/wD/AP8A/wA//wD/AP8A/wD/AP8A/wD/APv/AP8A+/8A/wD/AP8A/wD/AL//AP8Az/8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AO//AP8A+/8A/wD/AP8A/wD/AH//AP8A3/8A/wD/AP8A/wD/AP8A/wD/AH//AP8A/wD/AP8A/wD/AP8A+/8A/wD/AP8A/wD/AP8A/wD/AN//AP8A/wD/AP8A7/8A/wD/AP8A/wD/AP8A/wD/AL//AP8A9/8A/wD/AP8A/wD9/wD/AP8Af/8A/wD/AP8A/wDv/wD/APv/AP8A/wD/AP8A/wA//wD/AP8A/wD/AP8A/wD/APX/AP8A/f8A/wD/AP8A/wD/AL//AP8A/wD/AP8A/wD/AP8A/f8A/wD/AP8A/wD/AP8A/wD/AO//AP8A/wD/AP8A/wD/AP8A/wB//wD/AO//AP8A/wD/AP8A+/8A/wD/AP8A/wD/AP8A/wD/AO//AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD4/wD/AP3/AP8A/wD/AP8A/wD/AP8A/wDv/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wB//wD/AP8A/wD/AP8A/wD/APf/AP8A/wD/AP8A/wD/AP8A/wC//wD/AP8A/wD/AP8A/wD/APv/AP8A/wD/AP8A/wD/AN//AP8A/wD/AP8A/wD/AP8A/f8A/wD/AP8A/wD/AP8A/wD/AP8A/wD3/wD/AP8A/wD/AP8A/wB//wC//wD/AP8A/wD/AP8A/wD/AP7/AP8A/wD/AP8A/wD/AL//APf/AP8A/wD/AP8A/wDz/wD/ANf/AP8A/wD/AP8A/v8A/wD/AP8A/wD/AP8A/wD/AMf/AP8A/wC//wD/AP8A/wD5/wD/AP8A/wA//wD/AP8A/wB//wD/AP8A/wDf/wD/AP8Af/8A/wD/AP8A/r//AP8A9/8A/wD/AP8A/wD+P/8A/f8A/wD/AP8A/wD/AP3/AP8A7/8A/wD/AP8A/wD/APn/APz/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8Av/8A/wD/AP8A/wD/AP8A/wD9/wD3/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AL//AP8A/wD/AP8A/wD/AP8A/f8A/wD/AP8A/wD/AP8A/wD/AO/+/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP3/AH//AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8Af/8A/wD/AP8A/wD/AP8A/wD9/v8A/wD/AP8A/wD/AP8A/wD/APf/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A+/8A/wD/AP8A/wD/AP8A/wD/AN/f/wD/AP8A/wD/AP8A/wD/AH4AAAAAAAAAAAf/AP/EACsQAQABBAEDBAEEAgMAAAAAAAERACExQFEgQWEwUGBxgRCRocGx0eHw8f/aAAgBAQABPxD4Zh7KAu8AM2I/m9DKLEBF1mIP2pGApScAzTsASqLhzTCgEEHIz+2PZMPZHFAMsTDmCgtCbEBHNu5vi9IxiNgkl/5KcPIBy8QOMRNvzQuywMuW77Jh7LAcsIuzalxaQglMH5+qDXC1G7hz9TUPHI0EirCZf+8+yYfDcPhuHw3D4bh8Nw+G4eyoQFeCrjA+c0H/AElBd7+Wlu4+mu+j7KvNjm72LD2DLn0K/wDOpWE+x+kJJwd2oUR1888lmrso8d6QgI8O/hvRibl7FXD+tQAgAPH6ICEE4ahAjx29MGCavjDhzSKhETs7uG7Gz8Hdo0AB2NIGy/ZM0jLfsG5htgglcFHH9KaqARJHtV8M9xxt4bdoODwbEmG/JxtYbUqYy/WyDBIkNIr2dnDa+5MG1eLvZ2cNr7KTteel9nDa8QAbXmQisbGGyIHKbgg8LYw2RIeG4I2Jhsifu90DDZkX03FKeWxhsjCJkojGEnaWBXtSkeXYw2os7qNqV92xs4bUw8H+dr/NOzhtMYyM0RnCTszPsMGzhsgglcFGuPgbUcNUMT22PCZWdnDZGFzg2siTjmndgx5rDGxhs4Pt3DBHLYw2ZC43CkeWxhsx88nbUjwTSyrzsYbMlYmHbnvJGzhtRK4WdqAXe7s4bV34t/O1DGCxs4bSQGRkomUuX8UjKgm2vIpwG1huSns2dYzEGCaKMCMBtYbgwyUYvc1BR7E0qquXbw3ZAypPrUjRlS/W5huzxw2dPBLXGuD63MN6cOSzpX0/pN3DeuFt/noomsUwzO7hvCjJkpKHKE6F08Jjew3zBePbqw3hIOXRN7w72G9APDR+pMb2G9Odg0bcyX3sN69p3HRSSGkbsyPjdw3AlgphAxj/AG08FEw8VAjbsmHcw21bIOWKvp9jVRAI9mkJ/cUigInZ2sNlCGfNRay47UAEBBsGR+buVdP7VJDDsYa+Ji5sq+qfGCgEAA7G5zVyZq9ROGzTUN9jWw03oZeCuyD5vWe/wViM8x7CgkIJ5rn78K/0gq4rHJfTw0b6QOW1XxL4wULAB49o7QvJZq+AeGzSsMvOhh6yMIvBV8QeMtX2R5b+2mwQ81fkXDcriHkueth6ma45cUS8zgxRUEPHuV5ZObKvdv8AmkVCI8Pp4elbSDuqvKeZrHuwsE04UXypEYSH0cPRbEHLzQIIDt70LgP80iIhMnoYeghnGV4KNBAY98t3yeT0MPQjVO4+/TIch14dcccF33+cGb+vDrgR3Qe/oIjhp1ezHVh1+Fy/wCN7B1YdXlZv8BjeTqw6peC+A+djqw6p3k+BeNm3Th1eFj4FGcHTh0+Uk+By81HTh03XhPwOH+J6cOmPnsfA0kh71NnZjow6fvt/gn7sdGHQEoHeoAdiPgn8b6MOiO8M/BZV5D0YdEvFI+C+Wh6MOiHmPg3h5frhUKhUKIE4+DB9gVCoUEV//9k=';
            } else {
                $avatar = $currentAva;
            }

            $data = array(
                "nickname" => $nickname,
                "avatar" => $avatar,
            );

            if (parent::updateUserProfile($id, $data)) {
                $_SESSION["login-info"]["nickname"] = $nickname;
                $_SESSION["login-info"]["avatar"] = $avatar;
                header("Location: ?page=profile");
            }
        }
    }

    public function manageUsers()
    {
        if (parent::getAllUsers()) {
            $listUsers = parent::getAllUsers();
        }
        include_once("./views/manage-users.php");
    }

    public function addUser()
    {
        if (parent::getAllUsers()) {
            $listUsers = parent::getAllUsers();
        }
        include_once('./views/add-user.php');
        if (isset($_POST['submit-add-user'])) {
            echo "<pre>";
            print_r($_POST['submit-add-user']);
            echo "</pre>";
            if ($_FILES["avatar"]["tmp_name"]) {
                $avatar = $_FILES["avatar"]["tmp_name"];
                $avatarContent = file_get_contents($avatar);
                $base64Img = base64_encode($avatarContent);
            }

            $hashed_password = password_hash($password, PASSWORD_ARGON2ID);
            if ($check) {
                $data = array(
                    "username" => $username,
                    "nickname" => $nickname,
                    "password" => $hashed_password,
                    "email" => $email,
                    "role" => $role,
                    "avatar" => $base64Img ? $base64Img : NULL,
                );

                if (parent::addUserAdmin($data)) {
                    header("Location: ?page=manage-users");
                }
            }
        }
    }

    public function editUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = parent::getUserById($id);
        }
        include_once('./views/edit-user.php');
        if (isset($_POST["submit-update-user"])) {
            $nickname = $_POST["nickname"];
            $username = $_POST['username'];
            $email = $_POST["email"];
            $role = $_POST["role"];
            $currentAva = $_SESSION['updated-user']['avatar'];
            $currentPass = $_SESSION['updated-user']['password'];

            if ($_POST['password']) {
                $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);
            } else {
                $password = $currentPass;
            }

            if ($_FILES["input-ava"]["tmp_name"]) {
                $avatarContent = file_get_contents($_FILES["input-ava"]["tmp_name"]);
                $base64Img = base64_encode($avatarContent);
            }

            if (isset($base64Img) && $base64Img) {
                $avatar = $base64Img;
            } else if (isset($_POST['delete-ava'])) {
                $avatar = '/9j/4AAQSkZJRgABAQEBLAEsAAD/4QCpRXhpZgAASUkqAAgAAAADAA4BAgBfAAAAMgAAABoBBQABAAAAkQAAABsBBQABAAAAmQAAAAAAAABQaWN0dXJlIHByb2ZpbGUgaWNvbi4gSHVtYW4gb3IgcGVvcGxlIHNpZ24gYW5kIHN5bWJvbCBmb3IgdGVtcGxhdGUgZGVzaWduLiBWZWN0b3IgaWxsdXN0cmF0aW9uLiwBAAABAAAALAEAAAEAAAD/4QV2aHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/Pgo8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIj4KCTxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+CgkJPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczpJcHRjNHhtcENvcmU9Imh0dHA6Ly9pcHRjLm9yZy9zdGQvSXB0YzR4bXBDb3JlLzEuMC94bWxucy8iICAgeG1sbnM6R2V0dHlJbWFnZXNHSUZUPSJodHRwOi8veG1wLmdldHR5aW1hZ2VzLmNvbS9naWZ0LzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGx1cz0iaHR0cDovL25zLnVzZXBsdXMub3JnL2xkZi94bXAvMS4wLyIgIHhtbG5zOmlwdGNFeHQ9Imh0dHA6Ly9pcHRjLm9yZy9zdGQvSXB0YzR4bXBFeHQvMjAwOC0wMi0yOS8iIHhtbG5zOnhtcFJpZ2h0cz0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3JpZ2h0cy8iIHBob3Rvc2hvcDpDcmVkaXQ9IkdldHR5IEltYWdlcyIgR2V0dHlJbWFnZXNHSUZUOkFzc2V0SUQ9IjEzNDEwNDY2NjIiIHhtcFJpZ2h0czpXZWJTdGF0ZW1lbnQ9Imh0dHBzOi8vd3d3LmlzdG9ja3Bob3RvLmNvbS9sZWdhbC9saWNlbnNlLWFncmVlbWVudD91dG1fbWVkaXVtPW9yZ2FuaWMmYW1wO3V0bV9zb3VyY2U9Z29vZ2xlJmFtcDt1dG1fY2FtcGFpZ249aXB0Y3VybCIgPgo8ZGM6Y3JlYXRvcj48cmRmOlNlcT48cmRmOmxpPlByYWV3cGFpbGluPC9yZGY6bGk+PC9yZGY6U2VxPjwvZGM6Y3JlYXRvcj48ZGM6ZGVzY3JpcHRpb24+PHJkZjpBbHQ+PHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ij5QaWN0dXJlIHByb2ZpbGUgaWNvbi4gSHVtYW4gb3IgcGVvcGxlIHNpZ24gYW5kIHN5bWJvbCBmb3IgdGVtcGxhdGUgZGVzaWduLiBWZWN0b3IgaWxsdXN0cmF0aW9uLjwvcmRmOmxpPjwvcmRmOkFsdD48L2RjOmRlc2NyaXB0aW9uPgo8cGx1czpMaWNlbnNvcj48cmRmOlNlcT48cmRmOmxpIHJkZjpwYXJzZVR5cGU9J1Jlc291cmNlJz48cGx1czpMaWNlbnNvclVSTD5odHRwczovL3d3dy5pc3RvY2twaG90by5jb20vcGhvdG8vbGljZW5zZS1nbTEzNDEwNDY2NjItP3V0bV9tZWRpdW09b3JnYW5pYyZhbXA7dXRtX3NvdXJjZT1nb29nbGUmYW1wO3V0bV9jYW1wYWlnbj1pcHRjdXJsPC9wbHVzOkxpY2Vuc29yVVJMPjwvcmRmOmxpPjwvcmRmOlNlcT48L3BsdXM6TGljZW5zb3I+CgkJPC9yZGY6RGVzY3JpcHRpb24+Cgk8L3JkZjpSREY+CjwveDp4bXBtZXRhPgo8P3hwYWNrZXQgZW5kPSJ3Ij8+Cv/tAKJQaG90b3Nob3AgMy4wADhCSU0EBAAAAAAAhRwCUAALUHJhZXdwYWlsaW4cAngAX1BpY3R1cmUgcHJvZmlsZSBpY29uLiBIdW1hbiBvciBwZW9wbGUgc2lnbiBhbmQgc3ltYm9sIGZvciB0ZW1wbGF0ZSBkZXNpZ24uIFZlY3RvciBpbGx1c3RyYXRpb24uHAJuAAxHZXR0eSBJbWFnZXMA/9sAQwAKBwcIBwYKCAgICwoKCw4YEA4NDQ4dFRYRGCMfJSQiHyIhJis3LyYp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/wD/AH//AP8A/wD/AP8A/wA//wD/AP8A/wD/AP8A/wD/APv/AP8A+/8A/wD/AP8A/wD/AL//AP8Az/8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AO//AP8A+/8A/wD/AP8A/wD/AH//AP8A3/8A/wD/AP8A/wD/AP8A/wD/AH//AP8A/wD/AP8A/wD/AP8A+/8A/wD/AP8A/wD/AP8A/wD/AN//AP8A/wD/AP8A7/8A/wD/AP8A/wD/AP8A/wD/AL//AP8A9/8A/wD/AP8A/wD9/wD/AP8Af/8A/wD/AP8A/wDv/wD/APv/AP8A/wD/AP8A/wA//wD/AP8A/wD/AP8A/wD/APX/AP8A/f8A/wD/AP8A/wD/AL//AP8A/wD/AP8A/wD/AP8A/f8A/wD/AP8A/wD/AP8A/wD/AO//AP8A/wD/AP8A/wD/AP8A/wB//wD/AO//AP8A/wD/AP8A+/8A/wD/AP8A/wD/AP8A/wD/AO//AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD4/wD/AP3/AP8A/wD/AP8A/wD/AP8A/wDv/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wB//wD/AP8A/wD/AP8A/wD/APf/AP8A/wD/AP8A/wD/AP8A/wC//wD/AP8A/wD/AP8A/wD/APv/AP8A/wD/AP8A/wD/AN//AP8A/wD/AP8A/wD/AP8A/f8A/wD/AP8A/wD/AP8A/wD/AP8A/wD3/wD/AP8A/wD/AP8A/wB//wC//wD/AP8A/wD/AP8A/wD/AP7/AP8A/wD/AP8A/wD/AL//APf/AP8A/wD/AP8A/wDz/wD/ANf/AP8A/wD/AP8A/v8A/wD/AP8A/wD/AP8A/wD/AMf/AP8A/wC//wD/AP8A/wD5/wD/AP8A/wA//wD/AP8A/wB//wD/AP8A/wDf/wD/AP8Af/8A/wD/AP8A/r//AP8A9/8A/wD/AP8A/wD+P/8A/f8A/wD/AP8A/wD/AP3/AP8A7/8A/wD/AP8A/wD/APn/APz/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8Av/8A/wD/AP8A/wD/AP8A/wD9/wD3/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AL//AP8A/wD/AP8A/wD/AP8A/f8A/wD/AP8A/wD/AP8A/wD/AO/+/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP3/AH//AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8Af/8A/wD/AP8A/wD/AP8A/wD9/v8A/wD/AP8A/wD/AP8A/wD/APf/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A/wD/AP8A+/8A/wD/AP8A/wD/AP8A/wD/AN/f/wD/AP8A/wD/AP8A/wD/AH4AAAAAAAAAAAf/AP/EACsQAQABBAEDBAEEAgMAAAAAAAERACExQFEgQWEwUGBxgRCRocGx0eHw8f/aAAgBAQABPxD4Zh7KAu8AM2I/m9DKLEBF1mIP2pGApScAzTsASqLhzTCgEEHIz+2PZMPZHFAMsTDmCgtCbEBHNu5vi9IxiNgkl/5KcPIBy8QOMRNvzQuywMuW77Jh7LAcsIuzalxaQglMH5+qDXC1G7hz9TUPHI0EirCZf+8+yYfDcPhuHw3D4bh8Nw+G4eyoQFeCrjA+c0H/AElBd7+Wlu4+mu+j7KvNjm72LD2DLn0K/wDOpWE+x+kJJwd2oUR1888lmrso8d6QgI8O/hvRibl7FXD+tQAgAPH6ICEE4ahAjx29MGCavjDhzSKhETs7uG7Gz8Hdo0AB2NIGy/ZM0jLfsG5htgglcFHH9KaqARJHtV8M9xxt4bdoODwbEmG/JxtYbUqYy/WyDBIkNIr2dnDa+5MG1eLvZ2cNr7KTteel9nDa8QAbXmQisbGGyIHKbgg8LYw2RIeG4I2Jhsifu90DDZkX03FKeWxhsjCJkojGEnaWBXtSkeXYw2os7qNqV92xs4bUw8H+dr/NOzhtMYyM0RnCTszPsMGzhsgglcFGuPgbUcNUMT22PCZWdnDZGFzg2siTjmndgx5rDGxhs4Pt3DBHLYw2ZC43CkeWxhsx88nbUjwTSyrzsYbMlYmHbnvJGzhtRK4WdqAXe7s4bV34t/O1DGCxs4bSQGRkomUuX8UjKgm2vIpwG1huSns2dYzEGCaKMCMBtYbgwyUYvc1BR7E0qquXbw3ZAypPrUjRlS/W5huzxw2dPBLXGuD63MN6cOSzpX0/pN3DeuFt/noomsUwzO7hvCjJkpKHKE6F08Jjew3zBePbqw3hIOXRN7w72G9APDR+pMb2G9Odg0bcyX3sN69p3HRSSGkbsyPjdw3AlgphAxj/AG08FEw8VAjbsmHcw21bIOWKvp9jVRAI9mkJ/cUigInZ2sNlCGfNRay47UAEBBsGR+buVdP7VJDDsYa+Ji5sq+qfGCgEAA7G5zVyZq9ROGzTUN9jWw03oZeCuyD5vWe/wViM8x7CgkIJ5rn78K/0gq4rHJfTw0b6QOW1XxL4wULAB49o7QvJZq+AeGzSsMvOhh6yMIvBV8QeMtX2R5b+2mwQ81fkXDcriHkueth6ma45cUS8zgxRUEPHuV5ZObKvdv8AmkVCI8Pp4elbSDuqvKeZrHuwsE04UXypEYSH0cPRbEHLzQIIDt70LgP80iIhMnoYeghnGV4KNBAY98t3yeT0MPQjVO4+/TIch14dcccF33+cGb+vDrgR3Qe/oIjhp1ezHVh1+Fy/wCN7B1YdXlZv8BjeTqw6peC+A+djqw6p3k+BeNm3Th1eFj4FGcHTh0+Uk+By81HTh03XhPwOH+J6cOmPnsfA0kh71NnZjow6fvt/gn7sdGHQEoHeoAdiPgn8b6MOiO8M/BZV5D0YdEvFI+C+Wh6MOiHmPg3h5frhUKhUKIE4+DB9gVCoUEV//9k=';
            } else {
                $avatar = $currentAva;
            }

            $data = array(
                "nickname" => $nickname,
                "username" => $username,
                "avatar" => $avatar,
                "role" => $role,
                "email" => $email,
                "password" => $password
            );

            if (parent::updateUserAdmin($id, $data)) {
                unset($_SESSION['updated-user']);
                header("Location: ?page=manage-users");
            }
        }
    }

    public function deleteUser()
    {
        include_once("./views/delete-user.php");
        if (isset($_GET["id"]) && $_GET["id"]) {
            $id = $_GET["id"];
        }
        if (parent::deleteUserAdmin($id)) {
            header("Location: ?page=manage-users");
        }
    }
}
