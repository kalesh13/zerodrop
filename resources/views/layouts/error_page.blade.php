@extends('layouts.master')

@section('page-content')
    <div class="section error-section">
        <div class="container text-center">
            <div class="error-block">
                @yield('main_error')
            </div>
            <div class="col-md-12 error">
                @yield('error_details')
            </div>
            @yield('error_desc')
        </div>
    </div>
@stop
