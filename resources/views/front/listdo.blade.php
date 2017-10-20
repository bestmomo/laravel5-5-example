@extends('front.layout')

@section('css')

@endsection

@section('main')
<hr>
	<div class="maingc7">

<h3>Auteurs de posts</h3>

<table>
	<th><td>Nom</td><td>Email</td></th>

	@foreach($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ ucfirst($user->name) }}</td>
			<td><strong>{{ ucfirst($user->email) }}</strong><br>

				@foreach ($user->posts as $post)
					- {{$post->title}}<br>
				@endforeach

			</td>
		</tr>
	@endforeach

</table>

	</div>

@endsection
