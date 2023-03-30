@extends('emails.layout')
@section('content')

<?php
$templatebody = $template->body;
$templatebody = str_replace('{{$fname}}', $fname, $templatebody);
$templatebody = str_replace('{{$lname}}', $lname, $templatebody);
$templatebody = str_replace('{{$password}}', $password, $templatebody);
$templatebody = str_replace('{{$fcbid}}', $fcbid, $templatebody);
?>

{!! $templatebody !!}

@endsection