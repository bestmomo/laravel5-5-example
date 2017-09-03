<div class="box box-solid box-{{ $type }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $boxTitle }}</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {{ $slot }}
    </div>
    <!-- /.box-body -->
    @isset($footer)
        <div class="box-footer">
            {{ $footer }}
        </div>
    @endisset
    <!-- box-footer -->
</div>
<!-- /.box -->