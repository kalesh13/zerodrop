@extends('layouts.error_page')

@section('title','Subscription | Zerodrop')
@section('description','Subscribe to our email list to receive latest updates and news via email')
@section('page_url','{{url("/subscribe")}}')
@section('page_name','Subscribe')

@section('main_error')
    @php
        $classTrue = isset($success) && $success;
        $displayMessage = isset($message) ? $message : ($classTrue ? 'Success' : 'Error');
    @endphp
    <div class="main-error {{$classTrue?'bg-success':'bg-danger'}}">
        <span class="fa {{$classTrue?'fa-check':'fa-close'}}"></span>
    </div>
@endsection

@section('error_details')
    <span>{{$displayMessage}}</span>
@endsection
