<?php

$js_file = 'search';
$css_file = 'search';

?>

@extends('index.index')

@section('title')
	@lang('search.title')
@endsection

@section('description')
	@lang('search.description')
@endsection

@section('content')

<div class="preloader">
	<!--<img src="{{ asset('images/preloader.svg') }}" alt="preloader">-->
</div>

<h1>@lang('search.title-h1')</h1>
<hr>

<div class="search-frame">

@foreach($dataCategories as $cat)
	<div>
		<div class="category"><a href="{{ $cat->category_id }}"><h2>{{ $cat->category_name }}</h2></a><hr></div>
		<div class="subject">
		@php
		
			$subjects = explode(';', $cat->subjects);
			
			foreach($subjects as $sub) {
				$subject = explode('*', $sub);
				echo '<a href="'.$subject[2].'">
						<span class="cloud rounded">
							<h3>'.$subject[0].'</h3>
							<span class="number">'.$subject[1].'</span>
						</span>
					</a>';
			}
			
		@endphp
		</div>
	</div>
@endforeach 

</div>

@endsection