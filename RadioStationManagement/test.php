<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery.post demo</title>
  	<script type="text/javascript" src="ajax-upload/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="ajax-upload/js/jquery.form.min.js"></script>
	<script type="text/javascript" src="tt.js"></script>
</head>
<body>
 
<form name="myform" id="myform" action="t.php" method="POST">
	User: <input type="text" value="Ravishanker" name="txt"  /> <br/>
	<input id="send" name="send" type="submit" value="Send" />
</form>

<!-- the result of the search will be rendered inside this div -->
<div id="output" style="font-size: 25px;"></div>
<div id="msg"></div>

<script type="text/javascript">

</script>
</body>
</html>