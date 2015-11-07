
@extends('layouts.leftsidebar.master')

@section('title')
    Lorem Ipsum Generator
@stop

@section("heading")
    Lorem Ipsum Generator
@stop

@section("description")
    Write number of paragraphs to generate, copy to clipboard or download and feel free to use it anywhere.
@stop

@section("form")
    <!-- Form for the Lorem Ipsum Generator -->
    <form id="lorem_generator" method="POST" action="/lorem-ipsum-generator">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p class="optionContent">
            <!-- Text field to specify number of paragraphs to generate -->
            <label for="paragraphsNumber">Paragraphs:</label>
            <input id="paragraphsNumber" type="text" name="paragraphsNumber" maxlength="1" size="1" value={{$paragraphsNumber}} >
            
            <input id="generate_lorem" type="submit" class="btn btn-primary btn-xs" value="Generate">
            @if (isset($paragraphs)) 
                <input id="copy" type="button" class="btn btn-primary btn-xs" value="Copy to clipboard" />
                <input id="download_lorem" type="button" class="btn btn-primary btn-xs" value="Download .txt file" />
            @endif    
        </p>
@stop

@section("result")
    {{-- show paragraphs when is set --}}
    @if (isset($paragraphs)) 
        <textarea rows="10" cols="80" id="generated_text" name="generated_text">
            @foreach ($paragraphs as $paragraph)
                {{ $paragraph }}
            @endforeach
        </textarea>
    @endif
    </form>
@stop

@section("footer")
    <script src="{!! URL::asset('js/custom.js'); !!}"></script>
@stop








