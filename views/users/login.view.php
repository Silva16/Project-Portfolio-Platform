<?php
use Ainet\Support\HtmlHelper;
?>

<form action="" method="post">
    <div>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value=""/><?= HtmlHelper::error($errors, 'email')?>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value=""/><?= HtmlHelper::error($errors, 'password')?>
    </div>
    <div>
        <label>&nbsp;</label><input type="checkbox" name="autologin" value="1">Remember Me<br />
    </div>
    <div>
        <input type="submit" name="SignIn" value="Sign In" />
        <input type="submit" name="cancel" value="Cancel" />
    </div>
</form>

