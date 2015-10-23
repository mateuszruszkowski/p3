
@extends('layouts.master')

@section('title')
    User Generator
@stop

@section("heading")
    User Generator
@stop

@section("description")
    for paragraphs
@stop

@section("form")
    <!-- Form for the Lorem Ipsum Generator -->
    <form id="user_generator" method="POST" action="/user-generator">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p class="optionContent">
            <!-- Text field for user to specify number of random users to generate -->
            <label for="users">Users:</label>
            <input id="users" type="text" name="users" maxlength="3" size="1" value=
                <?php
                    if (!isset($_POST["users"]))
                        echo "3"; //defaulted # of users, if empty
                    else
                        echo $_POST["users"];
                ?>>

            <!-- Checkbox for including random user birthdate -->
            <input id="birthdate" type="checkbox" name="birthdate"
                <?php
                    if (isset($_POST["birthdate"]))
                        echo "checked";
                ?>>
            <label for="birthdate">Birthdate</label>

            <!-- Checkbox for including random user profile description -->
            <input id="profile" type="checkbox" name="profile"
                <?php
                    if (isset($_POST["profile"]))
                        echo "checked";
                ?>>
            <label for="profile">Profile Description</label>
            
            <input type="submit" value="Generate">
        </p>
    </form>
    </form>
@stop

@section("result")
    {{-- show generated users if they are set --}}
    @if (isset($users)) 
        @foreach ($users as $user)
            <p class="text-user">{{ $user['name'] }}</p>
            @if (isset($birthdate) ) 
            <p class="text-user">{{ $user['birthdate'] }}</p>
            @endif
            @if (isset($profile) ) 
            <p class="text-user">{{ $user['profile'] }}</p>
            @endif
        @endforeach
    @endif
@stop

@section("footer")
    <!-- <script src='/js/'></script> -->
@stop








