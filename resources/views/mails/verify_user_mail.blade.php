@extends('mails.layout')

@section('title')
	@lang('mail.verify-subject')
@endsection

@section('subject')
	@lang('mail.verify-subject')
@endsection

@section('message')
	@lang('mail.verify_dear') {{$user['name']}}!
	<p>@lang('mail.verify-message-1')</p>
	<p>{{$user['email']}}</p>
	<p>@lang('mail.verify-message-2')</p>
	<p>
		<a href="{{ url(trans('auth.verifyLink'), $user->verifyUser->token) }}">
			<button style="background: #29295e; font-size: 16px; color: #FFFFFF; padding: 20px; border: 1px solid #29295e; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;">@lang('mail.verify-subject')</button>
		</a>
	</p>
	<p style="color: #455A64; font-size: 12px;">@lang('mail.email-link-trouble') {{ url(trans('auth.verify-link'), $user->verifyUser->token) }}</p>
@endsection
