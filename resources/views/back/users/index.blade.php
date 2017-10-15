@extends('back.layout')

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    <style>
        input, th span {
            cursor: pointer;
        }
    </style>
@endsection

@section('main')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <strong>@lang('Roles') :</strong> &nbsp;
                    <input type="radio" name="role" value="all" checked> @lang('All')&nbsp;
                    <input type="radio" name="role" value="admin"> @lang('Administrator')&nbsp;
                    <input type="radio" name="role" value="redac"> @lang('Redactor')&nbsp;
                    <input type="radio" name="role" value="user"> @lang('User')&nbsp;<br>
                    <strong>@lang('Status') :</strong> &nbsp;
                    <input type="checkbox" name="new" @if(request()->new) checked @endif> @lang('New')&nbsp;
                    <input type="checkbox" name="valid"> @lang('Valid')&nbsp;
                    <input type="checkbox" name="confirmed"> @lang('Confirmed')
                    <div id="spinner" class="text-center"></div>
                </div>
                <div class="box-body table-responsive">
                    <table id="users" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('Name')<span id="name" class="fa fa-sort pull-right"
                                                              aria-hidden="true"></span></th>
                            <th>@lang('Email')<span id="email" class="fa fa-sort pull-right"
                                                               aria-hidden="true"></span></th>
                            <th>@lang('Role')<span id="role" class="fa fa-sort pull-right"
                                                              aria-hidden="true"></span></th>
                            <th>@lang('New')</th>
                            <th>@lang('Valid')</th>
                            <th>@lang('Confirmed')</th>
                            <th>@lang('Creation')<span id="created_at" class="fa fa-sort-desc pull-right"
                                                                  aria-hidden="true"></span></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Role')</th>
                            <th>@lang('New')</th>
                            <th>@lang('Valid')</th>
                            <th>@lang('Confirmed')</th>
                            <th>@lang('Creation')</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody id="pannel">
                            @include('back.users.table', compact('users'))
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div id="pagination" class="box-footer">
                    {{ $links }}
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection

@section('js')
    <script src="{{ asset('adminlte/js/back.js') }}"></script>
    <script>

        var user = (function () {

            var url = '{{ route('users.index') }}'
            var swalTitle = '@lang('Really destroy user ?')'
            var confirmButtonText = '@lang('Yes')'
            var cancelButtonText = '@lang('No')'
            var errorAjax = '@lang('Looks like there is a server issue...')'

            var onReady = function () {
                $('#pagination').on('click', 'ul.pagination a', function (event) {
                    back.pagination(event, $(this), errorAjax)
                })
                $('#pannel').on('change', ':checkbox[name="seen"]', function () {
                        back.seen(url, $(this), errorAjax)
                    })
                    .on('click', 'td a.btn-danger', function (event) {
                        back.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
                    })
                $('th span').click(function () {
                    back.ordering(url, $(this), errorAjax)
                })
                $('.box-header :radio, .box-header :checkbox').click(function () {
                    back.filters(url, errorAjax)
                })
            }

            return {
                onReady: onReady
            }

        })()

        $(document).ready(user.onReady)

    </script>
@endsection