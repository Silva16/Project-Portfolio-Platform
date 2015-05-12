<?php
    use Ainet\Support\HtmlHelper;
?>

<form action="" method="post">
    <input type="hidden" name="user_id" value="<?= HtmlHelper::e($user->id) ?>" />
    <?php require('views/users/add-edit.view.php') ?>
    <div>
        <input type="submit" name="ok" value="Save" />
        <input type="submit" name="cancel" value="Cancel" />
    </div>
</form>
