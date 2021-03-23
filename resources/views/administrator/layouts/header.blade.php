<header class="header navbar navbar-expand-lg header-floating floating">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar_menu"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand mr-auto ml-3" href="{{url('/admin')}}">
            <img src="{{$settings['logo']}}" alt="Zerodrop Technical Training Center"/>
        </a>
        <div id="header-navigation" class="collapse navbar-collapse">
            <ul class="nav navbar-nav ml-auto">
                @if(!auth()->check())
                    <li class="nav-item">
                        <a href="{{url('/admin/login')}}">
                            <i class="fa fa-lock"></i>
                            <span>LOGIN/SIGN UP</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</header>
<div class="header-floating-anchor"></div>
