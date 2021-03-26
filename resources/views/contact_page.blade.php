@extends('layouts.master')
@section('title'){{$data['meta_title'] ?? 'Contact | Zerodrop'}}@endsection
@section('description'){{$data['meta_description'] ?? "Zerodrop started its operation on August, 2018 and the main office is located at Nettoor Junction in Ernakulam District. Please use the form given below for any enquiry or you could visit us at our office during office hours"}}@endsection
@section('keywords'){{$data['meta_keywords'] ?? 'contact zerodrop, zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design'}}@endsection
@section('page_url','{{url("/contact")}}')
@section('page_name','Contact')

@section('page-content')
<div class="content-sections">
    <div class="section map">
        <div class="container content">
            <div class="title">Contact</div>
            @if($data['description'])
            <div class="desc">
                {{$data['description']}}
            </div>
            @endif
            <div class="container content px-0">
                {!!$data['map']!!}
            </div>
        </div>
    </div>
    <div class="section pt-0">
        <div class="container content">
            <div class="row">
                <div class="col-md-6">
                    @include('layouts.contact_form')
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <div class="heading">
                            <h3><span class="fa fa-map-marker"></span>Office Address</h3>
                        </div>
                        <p class="ml-4">
                            @if($settings['address_line_1'])
                                {{$settings['address_line_1']}}
                            @endif
                            @if($settings['street_address'])
                                <br> {{$settings['street_address']}}
                            @endif
                            @if($settings['city'])
                                <br> {{$settings['city']}} @endif
                            @if($settings['state'])
                                <?php echo ($settings['city']?', ':'').$settings['state']?>
                            @endif
                            @if($settings['country'])
                                <br> {{$settings['country']}} @endif
                            @if($settings['pin'])
                                <?php echo ($settings['country']?' ':'').$settings['pin']?>
                            @endif
                        </p>
                        @if($settings['phone_1']||$settings['phone_2'])
                            <p class="ml-4 mb-2">
                                <span class="fa fa-phone"></span>
                                <span>{{$settings['phone_1']}}</span>
                            </p>
                            @if($settings['phone_2'])
                                <p class="ml-4">
                                    <span class="ml-3">
                                        {{$settings['phone_2']}}
                                    </span>
                                </p>
                            @endif
                        @endif
                    </div>
                    <div>
                        <div class="heading">
                            <h3><span class="fa fa-retweet"></span>We're on Social Media</h3>
                        </div>
                        <p class="ml-4">
                            <a class="social-link" href="{{$settings['fb_url']}}">
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a class="social-link" href="{{$settings['insta_url']}}">
                                <span class="fa fa-instagram"></span>
                            </a>
                            <a class="social-link" href="{{$settings['twitter_url']}}">
                                <span class="fa fa-twitter"></span>
                            </a>
                            <a class="social-link" href="{{$settings['youtube_url']}}">
                                <span class="fa fa-youtube"></span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
