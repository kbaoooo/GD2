<?php
include_once('./middleware/AuthMiddleWare.php');

// Check login status before proceeding
AuthMiddleWare::checkLoginStatus();
?>

<div class="manage-users">
    <a href="?page=add-user" type="button" class="btn btn-primary btn-sm add-new-user-btn">Add new user</a>
    <?php if (isset($listUsers) && $listUsers && count($listUsers) > 0) { ?>
        <table class="table table-users">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nickname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Password</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listUsers as $user) { ?>
                    <tr>
                        <th scope="row"><?= $user['id'] ?></th>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['nickname'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td>*****</td>
                        <td>
                            <?php
                            if ($user['avatar']) { ?>
                                <img src="data:image/*;base64,<?= trim($user["avatar"]); ?>" alt="" class="ava-img" />
                            <?php }  ?>
                        </td>
                        <td>
                            <div class="btns">
                                <a class="btn edit-btn" type="submit" href="?page=edit-user&id=<?= $user['id'] ?>">Edit</a>
                                <a class="btn delete-btn" type="submit" href="?page=delete-user&id=<?= $user['id'] ?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>