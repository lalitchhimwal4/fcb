@extends('emails.layout')
@section('content')

<?php
$templatebody = $template->body;
$templatebody = str_replace('{{$name}}', $name, $templatebody);
$templatebody = str_replace('{{$email}}', $email, $templatebody);
$templatebody = str_replace('{{$subject}}', $subject, $templatebody);
$templatebody = str_replace('{{$messagecontent}}', $messagecontent, $templatebody);
?>

{!! $templatebody !!}

@endsection