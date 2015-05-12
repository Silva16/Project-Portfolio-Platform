<?php
    use Ainet\Support\HtmlHelper;
    use Ainet\Models\User;
?>

<div>
    <label for="fullname">Fullname:</label>
    <input type="text" name="fullname" id="fullname" value="<?= HtmlHelper::e($user->fullname) ?>" /><?= HtmlHelper::error($errors, 'fullname')?>
</div>
<div>
    <label for="type">Type:</label>

    <select name="type"><?= HtmlHelper::selectBox(User::$types) ?></select><?= HtmlHelper::error($errors, 'type')?>
</div>
<div>
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" value="<?= HtmlHelper::e($user->email) ?>"/><?= HtmlHelper::error($errors, 'email')?>
</div>
