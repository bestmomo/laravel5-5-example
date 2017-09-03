<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-{{ $pannel->color }}">
        <div class="inner">
            <h3>{{ $pannel->nbr }}</h3>

            <p>{{ $pannel->name }}</p>
        </div>
        <div class="icon">
            <span class="fa fa-{{ $pannel->icon }}"></span>
        </div>
        <a href="{{ $pannel->url }}" class="small-box-footer">
            @lang('More info') <span class="fa fa-arrow-circle-right"></span>
        </a>
    </div>
</div>