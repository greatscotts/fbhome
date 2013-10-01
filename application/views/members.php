<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Members only</title>

	
</head>
<body>

<div id="container">
	<h1>Fwelcome</h1>
<img src="https://graph.facebook.com/<?= $facebook_id ?>/picture?type=large">

<p><?php echo "hello $name"; ?></p>



<p><?php echo "your email add is $name"; ?></p>
	<a href='<?php echo base_url().'main/logout'; ?>'>logout</a>

</div>

</body>
</html>