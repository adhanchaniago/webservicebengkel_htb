<?php
// Warning Error To Login Admin Page
$error_login = "Maaf, Anda salah mengisikan Username & Password Login Administrator";
// View Error Message To Browser
echo "
<html>
<head>
<title>Login Administrator</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style_login.css\" />
<link rel=\"shortcut icon\" href=\"images/images_admin/favicon.ico\" />
</head>
<body>
<div id=\"main\" style=\"width:560px;\">
<div id=\"error_login\">
<img src=\"images/images_login/lock.png\" width=\"30\" height=\"31\" align=\"absmiddle\" class=\"img_lock\"/> 
$error_login
<br /><center><a href=\"index.php\" class=\"clickhere\">ULANGI LAGI</a></center>
</div>
<div class=\"clear\"></div>
<div id=\"vertical_effect\">&nbsp;</div>
</div>
</body>
</html>
";
?>
