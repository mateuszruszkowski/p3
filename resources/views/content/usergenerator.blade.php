@extends('layouts.leftsidebar.master')

@section('title')
    Random User Generator
@stop

@section("heading")
    Random User Generator
@stop

@section("description")
    Write number of users, select information about them, choose data format and copy it to clipboard.
@stop

@section("form")
    <!-- Form for the Lorem Ipsum Generator -->
    <form id="user_generator" method="POST" action="/user-generator">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {{-- Text field for user to specify number of random users to generate  --}} 
        <div class="form-group"> {{-- Number of users --}}
                {!! Form::label('users', 'Users (max 99): ') !!}
                {!! Form::input('number', 'users', $values['users'], ['min' => '1', 'max' => '99']) !!}
        </div>

        {{-- Checkbox include users birthdate  --}} 
        <div class="form-group"> {{-- Add birth date --}}
                {!! Form::label('birthdate', 'Birthdate ') !!}
                {!! Form::checkbox('birthdate', true, $values['birthdate']) !!}
        </div>

        {{-- Checkbox include users profile --}} 
        <div class="form-group"> {{-- Add profile --}}
                {!! Form::label('profile', 'Profile ') !!}
                {!! Form::checkbox('profile', true, $values['profile']) !!}
        </div>

        {{-- Checkbox include users country  --}} 
        <div class="form-group"> {{-- Add country --}}
                {!! Form::label('country', 'Country ') !!}
                {!! Form::checkbox('country', true, $values['country']) !!}
        </div>

        {{-- Checkbox include users gender --}} 
        <div class="form-group"> {{-- Add gender --}}
                {!! Form::label('gender', 'Gender ') !!}
                {!! Form::checkbox('gender', true, $values['gender']) !!}
        </div>

        {{-- Radio to choose data format --}} 
        <div class="form-group"> {{-- Choose data format --}}
                {!! Form::label('format', 'Choose data format: ') !!}
                {!! Form::radio('format', 'Text', $values['formatText']) !!}
                {!! Form::radio('format', 'CSV', $values['formatCSV']) !!}
        </div>

        {!! Form::submit('Generate', array('class' => 'btn btn-primary')) !!}
        
    </form>

@stop

@section("result")
    {{-- show generated users if are they set --}}
    @if (isset($users)) 
        @foreach ($users as $user)
            <p class="text-user">{{ $user['name'] }}</p>
            @if ($values['birthdate']) 
            <p class="text-user">{{ $user['birthdate'] }}</p>
            @endif
            @if ($values['profile'] ) 
            <p class="text-user">{{ $user['profile'] }}</p>
            @endif
            @if ($values['gender'] ) 
            <p class="text-user">{{ $user['gender'] }}</p>
            @endif
            @if ($values['country'] ) 
            <p class="text-user">{{ $user['country'] }}</p>
            @endif
        @endforeach
    @endif
@stop

@section("footer")
    <!-- <script src='/js/'></script> -->
@stop








