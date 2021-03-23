@php
    $sub_menu_id=str_replace(' ','',$text);
@endphp

<li class='sidebar-item collapsed arrow' data-toggle="collapse" data-target="#{{$sub_menu_id}}">
    <a href='#' @click.prevent>
        <div class="icon text-center">
            <span class="fa {{$icon}}"></span>
        </div>
        <div class="icon-text">
            <span>{{$text}}</span>
        </div>
    </a>
</li>
<ul class="sub-menu collapse" id="{{$sub_menu_id}}">
    @foreach ($sub_menu as $menu)
        @php
            $page = strtolower(str_replace(' ', '', $menu));
        @endphp
        <li>
            <router-link to="{{$page}}">
                {{$menu}}
            </router-link>
        </li>
    @endforeach
</ul>
