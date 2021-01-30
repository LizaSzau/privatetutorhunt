<?php

$js_file = 'home';
$css_file = 'home';

?>

@extends('index.index')

@section('title')
	@lang('home.title')
@endsection

@section('description')
	@lang('home.description')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>
	
<h1>@lang('home.title-h1')</h1>
<hr>

<div class="under-construction rounded">
	THIS SITE IS UNDER CONSTRUCTION.
	<br>IT IS EXPECTED TO START IN JANUARY OF 2021.
</div>
	
<div class="categ-flex-frame">

@foreach($dataCategories as $cat)

	@if ($cat->subjects != '')
		<div style="background: url({{ asset('images/tiles/'.$cat->slug.'.jpg') }})" class="tile">
			<div class="color color-{{ $cat->id }}">
				<div class="categ"><h2>{{ $cat->category_name }}</h2></div>
				<div class="subjects">{!! $cat->subjects !!}</div>
			</div>
		</div>
	@else
		<div style="background: url({{ asset('images/tiles/'.$cat->slug.'.jpg') }})" class="tile tile-gray">
			<div class="color color-gray">
				<div class="categ"><h2>{{ $cat->category_name }}</h2></div>
			</div>
		</div>
	@endif
@endforeach 

</div>

@endsection

