@extends('template', ['title'=> "Dev GC7"])

@section('contenu')
<div class="maingc7">
    @if ( isset($v) )
  <pre>
  @php print_r($v)
  @endphp
  </pre>
@endif
</div>
	<br>
@endsection
