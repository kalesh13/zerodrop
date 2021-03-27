@extends('layouts.master')
@section('title'){{$data['meta_title'] ?? 'Zerodrop - Technical Training Center'}}@endsection
@section('description'){{$data['meta_description'] ?? 'The increasing demand for Valve expertise in the industries and lack of persons with the right knowledge and skills forced us to create an educational program that helps you to stand ahead of others in the market. The Valve Engineer Certification program is tailored to meet the educational needs of the next generation'}}@endsection
@section('keywords'){{$data['meta_keywords'] ?? 'zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design'}}@endsection
@section('page_url','{{url()}}')
@section('page_name','Zerodrop - Technical Training Center')

@section('page-content')
    <div class="carousel" style="background-image:{{url($data['feature_image'])}}">
        <div class="carousel-overlay"></div>
        @if($data['carousal_text'])
            <div class="carousel-inner">
                <div class="animated bounceInUp">
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
        @if($course)
            <div class="section featured">
                <div class="container content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="title text-left">{{$course['title']}}</div>
                            <div class="featured-content">
                                <div class="desc-container">
                                    <div class="desc text-left">
                                        {!!$course['description']!!}
                                    </div>
                                </div>
                                <div class="actions">
                                    <a href="{{$course['url']}}">
                                        <div class="theme-btn reverse all-btn">
                                            Details
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img class="curved-img"
                                src="{{$course['course_image'] ?:'/images/featured_course.jpg'}}"
                                alt="{{$course['title']}}">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="section courses">
            <div class="title">Courses</div>
            @if($data['course_description'])
                <div class="desc">
                    {{$data['course_description']}}
                </div>
            @endif
            <div class="container content">
                <router-view>
                    <home-courses></home-courses>
                </router-view>
                <div class="text-center">
                    <a href="{{url('courses')}}">
                        <div class="theme-btn all-btn">View All</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="section contact">
            <div class="title">Contact Us</div>
            @if($data['contact_description'])
                <div class="desc">
                    {{$data['contact_description']}}
                </div>
            @endif
            <div class="container content">
                <div class="row">
                    <div class="col-md-6">
                        @include('layouts.contact_form')
                        <div class="text-center mt-5">
                            @if($data['contact_phone'])
                                <div class="call">Or, Call us at</div>
                                <div class="phone">
                                    <span class="fa fa-phone"></span>
                                    {{$data['contact_phone']}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 desktop-only">
                        @if($contact && $contact['map'])
                            {!!$contact['map']!!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
