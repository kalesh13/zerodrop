@extends('administrator.layouts.master')

@section('content')
    @include('administrator.layouts.header')
    @include('administrator.layouts.sidebar')
    <div class="dash-area pull-right">
        @include('layouts.loading')
        <router-view></router-view>
        @include('administrator.layouts.footer')
    </div>
@endsection