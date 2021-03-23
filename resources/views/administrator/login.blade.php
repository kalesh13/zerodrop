@extends('administrator.layouts.master')

@section('content')
    @include('administrator.layouts.header')
    @include('layouts.loading')
    <router-view></router-view>
@endsection