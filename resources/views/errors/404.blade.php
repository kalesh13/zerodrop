@extends('layouts.error_page')

@section('title','Page Not Found | Zerodrop')
@section('description','The Page you requested was not found. You may have typed the address incorrectly or you may have used an outdated link.')
@section('page_url','{{url("/404")}}')
@section('page_name','Page not found')

@section('main_error')
    <div class="main-error bg-danger">
        <span class="fa fa-exclamation-triangle"></span>
    </div>
@stop
@section('error_details')
    <span>Oops! The Page you requested was not found!</span>
@stop
@section('error_desc')
    <div class="error-desc">
        <p>
            You may have typed the address incorrectly or you may have used an outdated link.
            <br/>
            If you found a broken link from another site or from our site, please
            <a href="{{url('/contact')}}"> email us.</a>
        </p>
    </div>
@stop
