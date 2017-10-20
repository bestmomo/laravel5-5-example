@extends('front.layout')

@section('css')
@if (Auth::check())
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
@endif
@endsection

@section('main')
<div class="maingc7">	
	
	<h3>Les 3 derniers users</h3>		
	<ul c	lass="listgc7">	
		@foreach ( $users as $user )
		<li class="listgc7">{{ $user->name . ' ('.$user->id . ' - ' . $user->email.')' }}</li>
		@endforeach
	</ul>

	<hr>

	@isset($oColl)

	Valeur:


	<ul>
		<li><?= $oColl->clef1->id; ?>: <?= $oColl->clef1->couleur; ?></li>
		<li><?= $oColl->clef2->id; ?>: <?= $oColl->clef2->couleur; ?></li>
	</ul>
	<hr>

	@foreach ($oColl as $item => $clef)
	<h3><?= ucfirst( $item ) ?></h3>

	<ul>
	@foreach($clef as $k => $v)
	<li>{{ $k }} : {{ $v }}</li>
	@endforeach
	</ul>

	<ul class="list-group listgc7">
	<li class="list-group-item">Cras justo odio</li>
	<li class="list-group-item">Dapibus ac facilisis in</li>
	<li class="list-group-item">Morbi leo risus</li>
	<li class="list-group-item">Porta ac consectetur ac</li>
	<li class="list-group-item">Vestibulum at eros</li>
	</ul>

	@endforeach

	@endif

	<?php
	$colors = (object) [ ];
	$colors->red = "#F00";
	$colors->slateblue = "#6A5ACD";
	$colors->orange = "#FFA500";

	foreach ($colors as $key => $value) : ?>
	<p style="background-color:<?= $value ?>">
	<?= ucfirst( $key ) ?> : <?= $value ?>
	</p>
	<?php endforeach; ?>
	<br><br>

	{{ (2+3) }}

	</div>
	@endsection
