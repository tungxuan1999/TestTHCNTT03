<!DOCTYPE html>
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Cloud-Php-Ex000</title>
  <meta charset="utf-8">
</head>
<body>
  <h1>Cloud-Php-Ex000 Echo Msg</h1>
  <?php
	if(isset($_GET['param']) && !empty($_GET['param'])){
		echo "Param = ".$_GET['param'];
	} else {
		echo "no Param !"; 
	}
  ?>  
</body>
</html>
