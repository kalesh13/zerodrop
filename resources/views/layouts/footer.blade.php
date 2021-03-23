<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-section col-lg-4">
                <a href="/" class="navbar-brand">
                    <img src="{{$settings['logo']}}" alt="Zerodrop"/>
                </a>
                <div class="links">
                    <ul>
                        <li><a href="{{url('about')}}">About Us</a></li>
                        <li><a href="{{url('contact')}}">Contact Us</a></li>
                        <li><a href="{{url('courses')}}">Courses Offered</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-section col-lg-5">
                <div class="title">
                    Subscribe to our newsletter
                </div>
                <div class="widget-content">
                    <span class="text">
                        Get latest news and updates on your email address
                    </span>
                    <form class="subscribe-form" action="{{url('/subscribe')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="submit" class="submit-btn theme-btn float-right" value="Subscribe"/>
                            <div class="single-line-input">
                                <input type="email" class="form-control" name="email" placeholder="Email address">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-section col-lg-3">
                <div class="title">
                    Connect with us
                </div>
                <div class="widget-content">
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
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer copyright-section py-3">
    <div class="container">
        <div class="copyright-legal">
            © 2017-{{date('Y',strtotime(now()))}} ZeroDrop.in - All Rights Reserved
        </div>
    </div>
</div>
