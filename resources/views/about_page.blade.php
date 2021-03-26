@extends('layouts.master')
@section('title'){{$data['meta_title'] ?? 'About | Zerodrop'}}@endsection
@section('description'){{$data['meta_description'] ?? 'We believe that with the right education and training, any competent industry professional can become proficient in dealing with a whole range of up-stream and down-stream valve and control system issues – even in the world’s most hostile working environments.'}}@endsection
@section('keywords'){{$data['meta_keywords'] ?? 'about zerodrop, zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design'}}@endsection
@section('page_url','{{url("/about")}}')
@section('page_name','About')

@section('page-content')
    <div class="content-sections">
        <div class="section">
            <div class="container content about">
                <div class="title">About ZeroDrop</div>
                @if($data['description'])
                    <div class="desc pt-4 text-justify">
                        {!!$data['description']!!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
