<li class="treeview">
    <a href="#"><i class="fa fa-fw fa-{{ $icon }}"></i> <span>@lang('admin.menu.' . $type . 's')</span>
        <span class="pull-right-container">
            <span class="fa fa-angle-left pull-right"></span>
        </span>
    </a>
    <ul class="treeview-menu">
        @foreach ($items as $item)
            <li><a href="{{ $item['route'] }}"><span class="fa fa-fw fa-circle-o text-{{ $item['color'] }}"></span> <span>@lang('admin.menu.' . $item['command'])</span></a></li>
        @endforeach
    </ul>
</li>