@extends('emails.layout')
@section('content')

<?php
$templatebody = $template->body;
$templatebody = str_replace('{{$first_name}}', $first_name, $templatebody);
$templatebody = str_replace('{{$last_name}}', $last_name, $templatebody);
$templatebody = str_replace('{{$link}}', $link, $templatebody);
$templatebody = str_replace('{{$app}}', $app, $templatebody);
$templatebody = str_replace('{{$content}}', $content, $templatebody);
?>

{!! $templatebody !!}

@endsection