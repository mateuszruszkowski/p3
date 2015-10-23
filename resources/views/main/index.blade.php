
@extends('layouts.master')

{{--    `title` contain page title     --}}
@section('title')
    Home
@stop


{{--    `customHead` contain specific CSS and JavaScript files.     --}}

@section('customHead')

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style> 
@stop

@section('header')
<!-- for menu  -->
@stop


@section('content')
        <h1>Random generator for developers use</h1>
    <hr>        <p>
        Generate Paragraphs <a class="btn btn-info" href="/lorem-ipsum/create">HERE</a>
        <p>
        Generate Users <a class="btn btn-info" href="/user-generator/create">HERE</a>
        <p>
        Generate Password <a class="btn btn-info" href="/xkcd-password">HERE</a>
@stop

