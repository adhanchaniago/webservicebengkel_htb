<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Administrator: KIA - Cars Services Official Website</title>
<link rel="shortcut icon" href="images/logo-kia.png">
<link rel="stylesheet" type="text/css" href="css/style_login.css" />
<script type="text/javascript">
function validasi(form){
if (form.username.value == ""){
alert("Kolom Username Belum Terisi!");
form.username.focus();
return (false);
}
     
if (form.password.value == ""){
alert("Kolom Password Belum Terisi!");
form.password.focus();
return (false);
}
return (true);
}
</script>
<style type="text/css">
<!--
.style1 {
	font-size: 14;
	color: #FFFFFF;
}
.style4 {
	font-size: 24px;
	font-family: "Agency FB";
}
-->
</style>
</head>
<body OnLoad="document.login.username.focus();">
<div id="main">
<!-- Header -->
<div id="header">
<div align="center" class="style4">
<div align="center">Aplikasi Service Bengkel Mobil v.1.0.</div>
</div>
</div>
<!-- Middle -->
<div id="middle">
<form id="form-login" name="login" method="post" action="cek_login.php" onSubmit="return validasi(this)">
<img src="images/images_login/user.png" align="absmiddle" class="img_user" />
<input type="text" name="username" size="30" id="input" />
<br />
<img src="images/images_login/pass.png" align="absmiddle" class="img_pass" />
<input type="password" name="password" size="30" id="input" />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="Submit" type="image" value="Submit" src="images/images_login/login.png" id="submit" />
</form>
</div>
<div class="clear" align="cennter"></div>
<!-- Footer -->
<div id="footer">
<div align="center" class="style1">Copyright &copy; 2018 Developed by Suci - STMIK Nusa Mandiri</div>
</div>
</div>
</body>
</html>