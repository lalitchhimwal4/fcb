@extends('emails.layout')
@section('content')

<?php
$templatebody = $template['body'];

?>

{!! $templatebody !!}

@endsection