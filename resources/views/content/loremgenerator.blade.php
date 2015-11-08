
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
       <div class="row">
            {{-- Text field to specify number of paragraphs to generate  --}} 
            <div class="form-group col-sm-12 col-md-12">

                {!! Form::label('paragraphsNumber', 'Paragraphs (max 99): ') !!}
                {!! Form::input('number', 'paragraphsNumber', $values['paragraphsNumber'], ['min' => '1', 'max' => '99']) !!}
                {!! Form::submit('Generate', array('class' => 'btn btn-primary btn-xs', 'id'=>'generate_lorem')) !!}

                {{-- add buttons to copy to clipboard and download if text is generated  --}}
                @if (isset($paragraphs)) 
                    {!! Form::input('button', 'copy', 'Copy to clipboard', array('class' => 'btn btn-primary btn-xs', 'id'=>'copy') ) !!}
                    {!! Form::input('button', 'copy', 'Download .txt file', array('class' => 'btn btn-primary btn-xs', 'id'=>'download_lorem') ) !!}
                @endif  
                  
            </div>
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








