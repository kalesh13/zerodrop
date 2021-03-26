@extends('layouts.master')
@section('title'){{$data['meta_title'] ?? 'Course | Zerodrop'}}@endsection
@section('description'){{$data['meta_description'] ?? 'The increasing demand for Valve expertise in the industries and lack of persons with the right knowledge and skills forced us to create an educational program that helps you to stand ahead of others in the market. The Valve Engineer Certification program is tailored to meet the educational needs of the next generation - or anyone who needs a primer on the Valve Industry.'}}@endsection
@section('keywords'){{$data['meta_keywords'] ?? 'courses, about zerodrop, zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design'}}@endsection
@section('page_url','{{url()->current()}}')
@section('page_name'){{$data['meta_title'] ?? 'Course | Zerodrop'}}@endsection

@section('page-content')
<div class="content-sections course-content">
    <div class="container-fluid content title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 column">
                    <div class="title-field">
                        <h1>
                            {{$data['title']}}
                        </h1>
                        <div class="desc">
                            {{$data['snippet']}}
                        </div>
                        <div class="duration mt-5">
                            Starts on {{$data['startDateText']}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 column">
                    <div class="image-field">
                        @if($data['course_image'])
                        <div class="course-image">
                            <img src="{{$data['course_image']}}" alt="{{$data['title']}}">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container content">
            <div class="row">
                <div class="col-lg-9 course-details">
                    @if($data['description'])
                    <h2 class="title">Course Details</h2>
                    <div class="desc">
                        {!!$data['description']!!}
                        <h3>Eligibility</h3>
                        <p>{!!$data['eligibility']!!}</p>
                    </div>
                    @endif
                </div>
                <div class="col-lg-3 course-downloads">
                    @if($data['application_file'])
                    <div class="link">
                        <a href="{{$data['application_file']}}" class="application-form" target="_blank">Application Form</a>
                    </div>
                    @endif @if($data['brochure_file'])
                    <div class="link">
                        <a href="{{$data['brochure_file']}}" class="brochure" target="_blank">Brochure</a>
                    </div>
                    @endif
                    <div class="link">
                        <div class="duration">Course Duration</div>
                        <div class="desc text-left">{{$data['durationText']}}</div>
                    </div>
                    <div class="link">
                        <div class="course-fees">
                            Course Fees
                        </div>
                        <div class="desc text-left">
                            {{$data['course_fees'] ?? 'Contact us to know about the fees structure.'}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
