@extends('layouts.leftsidebar.master')

@section('title')
xkcd Password Generator
@stop

@section("heading")
xkcd Password Generator
@stop

@section("description")
Set <b>passwords properties</b> and click button <b>"Generate"</b>.<br />
Now you can <b>copy it to clipboard</b> and <b>save as a bookmark</b>.<br /><br />
In properties you can change a separator char, number of numbers and special chars and transform words by uppercase or lowercase them.<br />
@stop

@section("form")
     {!!  Form::open(array('action'=>'PassGenController@getGenerated', 'method' => 'get')) !!} 

        <div class="row">
  				<div class="form-group col-sm-6 col-md-4"> {{-- Words number --}}
          		{!! Form::label('words_number', 'Number of words (max 99)') !!}
          		{!! Form::input('number', 'words_number', $values['words_number'], ['min' => '1', 'max' => '99']) !!}
        	</div>
  				
  				<div class="form-group col-sm-6 col-md-4"> {{-- Number of numbers :) --}}
          		{!! Form::label('numbers', 'Numbers (max 10) ') !!}
              {!! Form::input('number', 'numbers', $values['numbers'], ['min' => '0', 'max' => '10']) !!}
          </div>

        	<div class="form-group col-sm-6 col-md-4"> {{-- Number of symbols :) --}}
        	   {!! Form::label('symbols', 'Symbols (max 10) ') !!}
        	   {!! Form::input('number', 'symbols', $values['symbols'], ['min' => '0', 'max' => '10']) !!}
        	</div>

        </div>
        <div class="row">

          <div class="form-group col-sm-6 col-md-4"> {{-- Max length :) --}}
          	{!! Form::label('max_length', 'Max length (max 99) ') !!}
          	{!! Form::input('number', 'max_length', $values['max_length'], ['min' => '1', 'max' => '99']) !!}
          </div>

          <div class="form-group col-sm-6 col-md-4"> {{-- Separator --}}
          	{!! Form::label('separator', 'Separator') !!}
          	{!! Form::input('text', 'separator', $values['separator'], array('maxlength' => 2 )) !!}
          </div>

          <div class="form-group col-sm-6 col-md-4"> {{-- Cases --}}
            {!! Form::label('cases', 'Cases') !!}
            {!! Form::select('cases', ['0' => 'First Letter', '1' => 'Upper Case', '2' => 'Lower Case'], $values['cases'] ) !!}
          </div>

        </div>
        <div class="row">
        <br />
          <div class="form-group col-sm-12 col-md-12"> {{-- Buttons --}}
            {!! Form::submit('Generate', array('class' => 'btn btn-primary btn-xs', 'id'=>'generatePass') ) !!}
            @if (isset($passString)) 
              {!! Form::input('button', 'copyPass', 'Copy to clipboard', array('class' => 'btn btn-primary btn-xs', 'id'=>'copyPass') ) !!}
              {!! Form::input('button', 'addBookmark', 'Add Bookmark', array('class' => 'btn btn-primary btn-xs', 'id'=>'addBookmark') ) !!}
              {!! Form::input('text', 'bookmark_name', '', array('placeholder' => 'Enter bookmark name', 'id'=>'bookmark_name')) !!}
            @endif
				  </div>

        </div>
				
			{!! Form::close()  !!}  

      <br />
@stop

@section("result")
    {{-- show generated users if they are set --}}
    @if (isset($passString)) 
      {!! Form::input('text', 'toCopy', $passString, ['id' => 'toCopy']) !!}
    <p>
      <a href="/password-generator">Reset form to default</a>
    </p>
	@endif

	@if (isset($error)) 
		<p class="bg-danger"><?=$error?> </p>
	@endif
@stop

@section("footer")
    @if (isset($passString))  
        <script src="{!! URL::asset('js/custom.js'); !!}"></script>
    @endif
@stop


