<li class='sidebar-item'>
    <router-link to="{{strtolower(str_replace(' ', '', $text))}}">
        <div class="icon text-center">
            <span class="fa {{$icon}}"></span>
        </div>
        <div class="icon-text">
            <span>{{$text}}</span>
        </div>
    </router-link>
</li>
