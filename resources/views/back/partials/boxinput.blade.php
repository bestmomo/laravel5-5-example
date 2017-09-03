<div class="box {{ $box['type'] }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $box['title'] }}</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @include('back.partials.input')
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

