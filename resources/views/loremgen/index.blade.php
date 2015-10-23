
@extends('layouts.master')

@section('title')
    Lorem Ipsum Generator
@stop

@section("heading")
    Lorem Ipsum Generator
@stop

@section("description")
    Write number of paragraphs to generate, copy to clipboard and feel free to use it anywhere.
@stop

@section("form")
    <!-- Form for the Lorem Ipsum Generator -->
    <form id="lorem_generator" method="POST" action="/lorem-ipsum-generator">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p class="optionContent">
            <!-- Text field to specify number of paragraphs to generate -->
            <label for="paragraphsNumber">Paragraphs:</label>
            <input id="paragraphsNumber" type="text" name="paragraphsNumber" maxlength="1" size="1" value={{$paragraphsNumber}} >
            
            <input id="generate_lorem" type="submit" value="Generate">
        </p>
    </form>
@stop

@section("result")
    {{-- show paragraphs when is set --}}
    @if (isset($paragraphs)) 
        <h2 class="text-center">Custom Lorem Ipsum</h2>
            @foreach ($paragraphs as $paragraph)
                <p class="text-lipsum">{{ $paragraph }}</p>
            @endforeach
        </div>
    @endif
@stop

@section("footer")
    <!-- <script src='/js/'></script> -->
@stop








