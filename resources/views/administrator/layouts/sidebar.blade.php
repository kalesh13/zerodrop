<div id="sidebar_menu" class="sidebar collapse collapse-menu">
    <ul>
        @php
            $rows = [
                ["fa-cart-arrow-down", "Courses"],
                ["fa-paper-plane", "Pages", ['Home','About','Contact']],
                ["fa-wrench", "Settings"],
                ["fa-vcard", "Profiles",['Team','Administrators']]
            ];
        @endphp
        @foreach ($rows as $row)
            @if(count($row)==3)
                @include('administrator.layouts.sidebar_sub_item_list',['icon'=>$row[0],'text'=>$row[1],'sub_menu'=>$row[2]])
            @else
                @include('administrator.layouts.sidebar_item',['icon'=>$row[0],'text'=>$row[1]])
            @endif
        @endforeach
    </ul>
    <ul class='px-4 mt-5'>
        <li class="mb-3">
            <a href="/" target="_blank" class="text-white">
                <span class="fa fa-external-link mr-2"></span>
                View Site
            </a>
        </li>
        <li class="mb-3">
            <a href="{{url('http://webmail.zerodrop.in')}}" target="_blank" class="text-white">
                <span class="fa fa-envelope mr-2"></span>
                Emails
            </a>
        </li>
        <li class="mb-3">
            <form id="logout" action="{{url('admin/logout')}}" method="post">
                @csrf
                <a href="javascript:{}" class="text-white" onclick="document.getElementById('logout').submit();">
                    <span class="fa fa-lock mr-2"></span>
                    Logout
                </a>
            </form>
        </li>
    </ul>
</div>
