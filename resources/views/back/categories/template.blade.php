@extends('back.layout')

@section('css')
    <style>
        textarea { resize: vertical; }
        iframe { background-color: #00acd6;}
    </style>
    <link href="/adminlte/plugins/colorbox/colorbox.css" rel="stylesheet">
@endsection

@section('main')

    @yield('form-open')
        {{ csrf_field() }}

        <div class="row">

            <div class="col-md-12">
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Title'),
                    ],
                    'input' => [
                        'name' => 'title',
                        'value' => isset($category) ? $category->title : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Slug'),
                    ],
                    'input' => [
                        'name' => 'slug',
                        'value' => isset($category) ? $category->slug : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
            </div>

        </div>
        <!-- /.row -->
    </form>

@endsection

@section('js')

    <script src="/adminlte/plugins/colorbox/jquery.colorbox-min.js"></script>
    <script src="/adminlte/plugins/voca/voca.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script>

        $('#slug').keyup(function () {
            $(this).val(v.slugify($(this).val()))
        })

        $('#title').keyup(function () {
            $('#slug').val(v.slugify($(this).val()))
        })

    </script>

@endsection