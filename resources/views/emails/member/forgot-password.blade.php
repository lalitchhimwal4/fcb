@extends('emails.layout')
@section('content')

<?php
$reset_password_link =  route('member.showresetpassword', ['token' => $token, 'fcbid' => $fcbid]);
$templatebody = $template->body;
$templatebody = str_replace('{{$first_name}}', $fname, $templatebody);
$templatebody = str_replace('{{$last_name}}', $lname, $templatebody);
$templatebody = str_replace('{{$reset_password_link}}', $reset_password_link, $templatebody);
?>

{!! $templatebody !!}

@endsection