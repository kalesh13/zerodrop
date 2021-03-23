<header class="header navbar navbar-expand-lg flex-column header-floating">
    <div class="container">
        <a href="/" class="navbar-brand">
        <img src="{{ $settings['logo'] }}" alt="Zerodrop"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-navigation" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="header-navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{url('')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('about')}}">About</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('contact')}}">Contact Us</a>
                </li>
                <li class="nav-item course-button">
                    <a href="{{url('courses')}}">
                        <div class="theme-btn course-button">
                            Courses
                        </div>
                    </a>
                </li>
                <li class="nav-item course-link">
                    <a href="{{url('courses')}}">Courses Offered</a>
                </li>
            </ul>
        </div>
    </div>
</header>
