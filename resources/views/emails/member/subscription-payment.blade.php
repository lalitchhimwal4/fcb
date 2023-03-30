@extends('emails.layout')
@section('content')

<?php
$templatebody = $template->body;
$templatebody = str_replace('{{$fname}}', $fname, $templatebody);
$templatebody = str_replace('{{$lname}}', $lname, $templatebody);
$templatebody = str_replace('{{$payment_link}}', $payment_link, $templatebody);
?>

{!! $templatebody !!}

@endsection