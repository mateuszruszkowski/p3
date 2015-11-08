
@extends('layouts.fullwidth.master')

{{--    `title` contain page title     --}}
@section('title')
    Home
@stop

{{--    `form` contain page form    --}}
@section("content")
          <div class="row">
            <div class="col-sm-6 col-md-4">
              <a href="lorem-ipsum-generator" title="lorem ipsum generator" class="main_link">
                <div class="thumbnail">
                  <img data-src="holder.js/100%x200" alt="100%x200" src="{!! URL::asset('images/loremipsum.jpg'); !!}" data-holder-rendered="true" style="height: 250px; width: 100%; display: block;">
                  <div class="caption">
                    <h3>Generate Paragraphs</h3>
                    <p>That you will never remember</p>
                  </div>
                </div>

            </div>
            <div class="col-sm-6 col-md-4">
              <a href="user-generator" title="user generator" class="main_link">
                <div class="thumbnail">
                  <img data-src="holder.js/100%x200" alt="100%x200" src="{!! URL::asset('images/usergenerator.jpg'); !!}" data-holder-rendered="true" style="height: 250px; width: 100%; display: block;">
                  <div class="caption">
                    <h3>Generate Users</h3>
                    <p>Whom you will never known</p>
                  </div>
                </div>

            </div>
            <div class="col-sm-6 col-md-4">
              <a href="password-generator" title="password generator" class="main_link">
                <div class="thumbnail">
                  <img data-src="holder.js/100%x200" alt="100%x200" src="{!! URL::asset('images/passwordgenerator.jpg'); !!}" data-holder-rendered="true" style="height: 250px; width: 100%; display: block;">
                  <div class="caption">
                    <h3>Generate Password</h3>
                    <p>That can be unbreakable</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
@stop


{{--    `footer` contain page footer scripts    --}}
@section("footer")
@stop








