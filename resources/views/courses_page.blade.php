@extends('layouts.master')

@section('title','Courses | Zerodrop')
@section('description','We have got courses to help you start a career, be it technical or non-technical, we got it covered. We have courses on Valve Engineering, AutoCad, Engineering drawings etc and more courses are added progressively.')
@section('keywords')
    <?php echo $data['meta_keywords']??'courses, about zerodrop, zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design';?>
@stop
@section('page_url',"{{url('/courses')}}")
@section('page_name','Courses')

@section('page-content')
@include('layouts.loading')
    <div class="content-sections">
        <div class="section">
            <div class="container">
                <router-view>
                    <all-courses></all-courses>
                </router-view>
            </div>
        </div>
    </div>
@endsection
