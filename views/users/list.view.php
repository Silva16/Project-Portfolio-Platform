<?php
    use \Ainet\Support\HtmlHelper;
    use \Ainet\Support\AuthenticationHelper;
    use \Ainet\Models\User;

    echo $_SESSION['message'];

    if (AuthenticationHelper::verifyType("add")){
        ?><div><a href="users-add.php">Add user</a></div><?php
    }
?>


<?php if (count($users)) { ?>
    <table class="users">
    <thead>
        <tr>
            <th>Email</th>
            <th>Fullname</th>
            <th>Registered At</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= HtmlHelper::e($user->email) ?></td>
            <td><?= HtmlHelper::e($user->fullname) ?></td>
            <td><?= HtmlHelper::e($user->registeredAt) ?></td>
            <td><?= HtmlHelper::e($user->type) ?></td>
            <td>
                <?php if (AuthenticationHelper::verifyType("edit", $user->id)){?>
                <form action="users-edit.php?>" method="get">
                    <input type="hidden" name="id" value="<?= $user->id; ?>">
                    <input type="submit" name="edit" value="Edit" />
                </form>
                <?php } ?>
                <?php if (AuthenticationHelper::verifyType("remove")){?>
                <form action="users-delete.php" method="post">
                    <input type="hidden" name="id" value="<?= $user->id; ?>">
                    <input type="submit" name="submit" value="Delete">
                </form>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </table>

    <form action="login.php" method="post">
        <input type="submit" name="logout" value="Logout" />
    </form>
<?php } else { ?>
    <h2>No users found</h2>
<?php } ?>
