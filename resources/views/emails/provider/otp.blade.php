@extends('emails.layout')
@section('content')

<?php
$templatebody = $template->body;
$templatebody = str_replace('{{$new_password}}', $new_password, $templatebody);
?>

{!! $templatebody !!}

@endsection