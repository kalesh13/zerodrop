@extends('layouts.master')
@section('title'){{$data['meta_title'] ?? 'Zerodrop - Technical Training Center'}}@endsection
@section('description'){{$data['meta_description'] ?? 'The increasing demand for Valve expertise in the industries and lack of persons with the right knowledge and skills forced us to create an educational program that helps you to stand ahead of others in the market. The Valve Engineer Certification program is tailored to meet the educational needs of the next generation'}}@endsection
@section('keywords'){{$data['meta_keywords'] ?? 'zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design'}}@endsection
@section('page_url','{{url()}}')
@section('page_name','Zerodrop - Technical Training Center')

@section('page-content')
    <div class="carousel" style="background-image:{{url($data['feature_image']||'')}}">
        <div class="carousel-overlay"></div>
        @if($data['carousal_text'])
            <div class="carousel-inner">
                <div class="animate__animated animate__bounceInUp">
                    {{$data['carousal_text']}}
                </div>
            </div>
        @endif
    </div>
    <div class="content-sections">
        <div class="section features">
            <div class="container content feature-list">
                <ul>
                    <li>
                        <span class="fa fa-calendar"></span>
                        <span>Batches throughout the year</span>
                    </li>
                    <li>
                        <span class="fa fa-user"></span>
                        <span>Experienced faculities</span>
                    </li>
                    <li>
                        <span class="fa fa-wrench"></span>
                        <span>Technical & Non-Technical Courses</span>
                    </li>
                </ul>
            </div>
        </div>
        <router-view :page-data="{{json_encode($data)}}">
            @include('layouts.contact_form')
        </router-view>
    </div>
@endsection
