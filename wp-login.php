<?php
$redirect_to = ''; // Define the variable
?>
<form name="loginform" id="loginform" action="<?php echo site_url( '/wp-login.php' ); ?>" method="post">
<p>Username: <input id="user_login" type="text" size="20" value="" name="log"></p>
<p>Password: <input id="user_pass" type="password" size="20" value="" name="pwd"></p>
<p><input id="rememberme" type="checkbox" value="forever" name="rememberme"></p>

<p><input id="wp-submit" type="submit" value="Login" name="wp-submit"></p>

<input type="hidden" value="<?php echo esc_attr( $redirect_to ); ?>" name="redirect_to">
<input type="hidden" value="1" name="testcookie">
</form>
