<?php
//clear cookies
$domain = $_SERVER['HTTP_HOST'];
setcookie('cookie_name', '', time() - 3600, '/', $domain);
// Redirect to index.html
header("Location: index.html");
exit(); // Ensure no further code execution after redirection
?>