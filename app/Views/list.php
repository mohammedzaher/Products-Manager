<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $data['title']?></title>
</head>
<body>
	<h1>Welcome to my <?= $data['title']?>!</h1>
		<pre>
		<?php var_dump($data); ?>
		</pre>
</body>
</html>