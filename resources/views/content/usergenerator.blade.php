@extends('layouts.leftsidebar.master')

@section('title')
    Random User Generator
@stop

@section("heading")
    Random User Generator
@stop

@section("description")
    <b>Write</b> number of users
    <b>Select</b> useful information about them
    <b>Choose</b> data format and click generate button
    <b>Copy</b> to clipboard or <b>download</b> file with content.<br />
    <small><b>(Downloading doesn't generate new content, just used text from textarea)</b></small>
    <br /><br />
@stop

@section("form")
    <!-- Form for the Lorem Ipsum Generator -->
    <form id="user_generator" method="POST" action="/user-generator">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            {{-- Text field for user to specify number of random users to generate  --}} 
            <div class="form-group col-sm-6 col-md-4"> {{-- Number of users --}}
                    {!! Form::label('users', 'Users (max 99): ') !!}
                    {!! Form::input('number', 'users', $values['users'], ['min' => '1', 'max' => '99']) !!}
            </div>

            {{-- Checkbox include users birthdate  --}} 
            <div class="form-group col-sm-6 col-md-4"> {{-- Add birth date --}}
                    {!! Form::label('birthdate', 'Birthdate ') !!}
                    {!! Form::checkbox('birthdate', true, $values['birthdate']) !!}
            </div>

            {{-- Checkbox include users profile --}} 
            <div class="form-group col-sm-6 col-md-4"> {{-- Add profile --}}
                    {!! Form::label('profile', 'Profile ') !!}
                    {!! Form::checkbox('profile', true, $values['profile']) !!}
            </div>
        </div>
        <div class="row">
            {{-- Checkbox include users country  --}} 
            <div class="form-group col-sm-6 col-md-4"> {{-- Add country --}}
                    {!! Form::label('country', 'Country ') !!}
                    {!! Form::checkbox('country', true, $values['country']) !!}
            </div>

            {{-- Checkbox include users gender --}} 
            <div class="form-group col-sm-6 col-md-4"> {{-- Add gender --}}
                    {!! Form::label('gender', 'Gender ') !!}
                    {!! Form::checkbox('gender', true, $values['gender']) !!}
            </div>

            {{-- Radio to choose data format --}} 
            <div class="form-group col-sm-6 col-md-4"> {{-- Choose data format --}}
                    {!! Form::label('format', 'Choose data format: ') !!} <br />
                    {!! Form::radio('format', 'txt', (($values['format']=='txt') ? true : false )) !!} {!! Form::label('format', 'Text') !!}
                    {!! Form::radio('format', 'csv', (($values['format']=='csv') ? true : false )) !!} {!! Form::label('format', 'CSV') !!}
                    {!! Form::radio('format', 'json', (($values['format']=='json') ? true : false )) !!} {!! Form::label('format', 'JSON') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12"> {{-- Generate button --}}
                {!! Form::submit('Generate', array('class' => 'btn btn-primary btn-xs', 'id'=>'generate')) !!}
                 @if (!empty($users))
                    <input id="copy" type="button" class="btn btn-primary btn-xs" value="Copy to clipboard" />
                    <input id="download" type="button" class="btn btn-primary btn-xs" value="Download file" />
                @endif
            </div>
        </div>

    

@stop

@section("result")
    {{-- show generated users if are they set --}}
    @if (!empty($users))      
<br />{{-- No spaces to avoid empty space in textarea --}} 
<textarea rows="10" cols="80" id="generated_text" name="generated_text">
@if ($values['format']=='json')
{{$users}}
@else
@foreach ($users as $user)
{{ $user }} 
@endforeach
@endif
</textarea>
    @endif


    </form>    
@stop

@section("footer")
    @if (isset($users)) 
        <script src="{!! URL::asset('js/custom.js'); !!}"></script>
    @endif
@stop








