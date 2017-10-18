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

	Valeur:
<ul>
	<li><?= $oColl->clef1->id; ?>: <?= $oColl->clef1->couleur; ?></li>
	<li><?= $oColl->clef2->id; ?>: <?= $oColl->clef2->couleur; ?></li>
</ul>
    <hr>

@foreach ($oColl as $item => $clef)
	<h3><?= ucfirst($item) ?></h3>

<ul>
	@foreach($clef as $k => $v)
		<li>{{ $k }} : {{ $v }}</li>
	@endforeach
</ul>




@endforeach



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
<br><br>

{{ (2+3) }}

    
</body>
</html>