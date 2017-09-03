@extends('front.layout')

@section('main')

   <!-- content
   ================================================== -->
   <section id="content-wrap" class="site-page">
   	<div class="row">
   		<div class="col-twelve">

   			<section>  

                <div class="primary-content">

						<h1 class="entry-title add-bottom">@lang('Get In Touch With Us')</h1>

						<p class="lead">@lang('Lorem ipsum Deserunt est dolore Ut Excepteur nulla occaecat magna occaecat Excepteur nisi esse veniam dolor consectetur minim qui nisi esse deserunt commodo ea enim ullamco non voluptate consectetur minim aliquip Ut incididunt amet ut cupidatat.')</p>

						<p>@lang('Duis ex ad cupidatat tempor Excepteur cillum cupidatat fugiat nostrud cupidatat dolor sunt sint sit nisi est eu exercitation incididunt adipisicing veniam velit id fugiat enim mollit amet anim veniam dolor dolor irure velit commodo cillum sit nulla ullamco magna amet magna cupidatat qui labore cillum sit in tempor veniam consequat non laborum adipisicing aliqua ea nisi sint ut quis proident ullamco ut dolore culpa occaecat ut laboris in sit minim cupidatat ut dolor voluptate enim veniam consequat occaecat fugiat in adipisicing in amet Ut nulla nisi non ut enim aliqua laborum mollit quis nostrud sed sed.')</p>

						<div class="row">
							<div class="col-six tab-full">
								<h4>@lang('Where to Find Us')</h4>
					  			<p>@lang('1600 Amphitheatre Parkway<br>Mountain View, CA<br>94043 US')</p>
							</div>
							<div class="col-six tab-full">
								<h4>@lang('Contact Info')</h4>
					  			<p>@lang('someone@abstractwebsite.com<br>info@abstractwebsite.com<br>Phone: (+63) 555 1212')</p>
							</div>
						</div>

                        @if (session('ok'))
                            @component('front.components.alert')
                                @slot('type')
                                    success
                                @endslot
                                {!! session('ok') !!}
                            @endcomponent
                        @endif

						<form method="post" action="{{ route('contacts.store') }}">
                            {{ csrf_field() }}
                            @if ($errors->has('name'))
                                @component('front.components.error')
                                    {{ $errors->first('name') }}
                                @endcomponent
                            @endif 
                            <input id="name" placeholder="@lang('Your name')" type="text" class="full-width"  name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('email'))
                                @component('front.components.error')
                                    {{ $errors->first('email') }}
                                @endcomponent
                            @endif 
                            <input id="email" placeholder="@lang('Your email')" type="email" class="full-width"  name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('message'))
                                @component('front.components.error')
                                    {{ $errors->first('message') }}
                                @endcomponent
                            @endif 
                            <textarea name="message" id="message" class="full-width" placeholder="@lang('Your message')" ></textarea>
                            <button type="submit" class="submit button-primary full-width-on-mobile">Submit</button>
  				        </form> <!-- end form -->
                    </div>
			</section>
   		   		
		</div> <!-- end col-twelve -->
   	</div> <!-- end row -->
   </section> <!-- end content --> 
      
@endsection