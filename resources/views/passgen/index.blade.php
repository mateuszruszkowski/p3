@extends('layouts.master')

@section('title')
    xkcd Password Generator
@stop

@section("heading")
    xkcd Password Generator
@stop

@section("description")
This Web App generates random passwords which are really difficult to break.<br />
If you need you can add numbers and/or specials chars to your new password.<br />
You can also change a separator char and transform words by uppercase or lowercase them.<br />
<br />
When you generate your password, you can bookmark page's link to generate similar password in the future.<br />
@stop

@section("form")
    <form method="POST" action="/password-generator" class="form-horizontal">
    			<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group"> {{-- Words number --}}
              		{!! Form::label('words_number', 'Number of words (max 99)') !!}
              		{!! Form::input('number', 'words_number', $values['words_number'], ['min' => '1', 'max' => '99']) !!}
              	</div>
				
				<div class="form-group"> {{-- Number of numbers :) --}}
              		{!! Form::label('numbers', 'Numbers (max 10) ') !!}
              		{!! Form::input('number', 'numbers', $values['numbers'], ['min' => '0', 'max' => '10']) !!}
              	</div>

              	<div class="form-group"> {{-- Number of symbols :) --}}
              		{!! Form::label('symbols', 'Symbols (max 10) ') !!}
              		{!! Form::input('number', 'symbols', $values['symbols'], ['min' => '0', 'max' => '10']) !!}
              	</div>

              	<div class="form-group"> {{-- Max length :) --}}
              		{!! Form::label('max_length', 'Max length (max 99) ') !!}
              		{!! Form::input('number', 'max_length', $values['max_length'], ['min' => '1', 'max' => '99']) !!}
              	</div>

              	<div class="form-group"> {{-- Separator --}}
              		{!! Form::label('separator', 'Separator') !!}
              		{!! Form::input('test', 'separator', $values['separator']) !!}
              	</div>

				{!! Form::submit('Generate', array('class' => 'btn btn-primary')) !!}
				
			</form>

			<br />
			<br />
			<p>
				<a href="/password-generator">Reset form to default</a>
			</p>
@stop

@section("result")
    {{-- show generated users if they are set --}}
    @if (isset($passString)) 
		<p class="bg-primary"><?=$passString?></p>
	@endif

	@if (isset($error)) 
		<p class="bg-danger"><?=$error?> </p>
	@endif
@stop

@section("footer")
    <!-- <script src='/js/'></script> -->
@stop


