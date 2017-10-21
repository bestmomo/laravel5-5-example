@extends('front.layout')

@section('css')

@endsection

@section('main')
<hr>
<div class="maingc7">


	@if ( count($users)>0 )

	<h3>Auteurs de posts</h3>

		<table>

			<th><td>Nom</td><td>Email</td></th>

			@foreach($users as $user)
				<tr>

					<td>{{ $user->id }}</td>

					<td>{{ ucfirst($user->name) }}<br>
					Nombre d'articles: <strong>{{ $user->posts_count }}</strong></td>

					<td><strong>{{ ucfirst($user->email) }}</strong><br>

						@foreach ($user->posts as $post)
							- <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
							 <br>
						@endforeach

					</td>

				</tr>
			@endforeach

		</table>

	@else

		Rien à afficher.

	@endif

	</div>

@endsection
