<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma première vue</title>
    <style>
		body {
			font-family: Comic Sans MS, arial;
			font-size: 1.2em;
			background-color: cornsilk
		}
	</style>
</head>

<body>

<h1>{{$a}}</h1>

Valeur de n = {{$n}}


<?php
$colors = (object)[];
$colors->red = "#F00";
$colors->slateblue = "#6A5ACD";
$colors->orange = "#FFA500";


foreach ($colors as $key => $value) : ?>
    <p style="background-color:<?= $value ?>">
        <?= ucfirst($key) ?> : <?= $value ?>
    </p>
<?php endforeach; ?>


    
</body>
</html>