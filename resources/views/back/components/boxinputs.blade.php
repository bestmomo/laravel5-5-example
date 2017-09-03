<div class="box box-{{ $boxtype }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $boxtitle }}</h3>
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
</div>
<!-- /.box -->

