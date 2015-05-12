<?php
    use Ainet\Support\HtmlHelper;
?>

<form action="" method="post">
    <?php require('views/users/add-edit.view.php') ?>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value=""/><?= HtmlHelper::error($errors, 'password')?>
    </div>
    <div>
        <label for="passwordConfirmation">Password confirmation:</label>
        <input type="password" name="passwordConfirmation" id="passwordConfirmation"  />
    </div>
    <div>
        <input type="submit" name="ok" value="Add" />
        <input type="submit" name="cancel" value="Cancel" />
    </div>
</form>