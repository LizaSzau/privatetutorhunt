@extends('mails.layout')

@section('title')
	PrivateTutorHunt - New subject is suggested
@endsection

@section('subject')
	New subject is suggested
@endsection

@section('message')
	New subject is suggested.
	<p><br>
	Tutor ID: {{ $data->tutorID }}<br >
	Subject: {{ $data->newSubject }}
@endsection
