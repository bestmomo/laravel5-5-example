@extends('back.layout')

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

    <script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
    <script>

        $('#slug').keyup(function () {
            $(this).val(v.slugify($(this).val()))
        })

        $('#title').keyup(function () {
            $('#slug').val(v.slugify($(this).val()))
        })

    </script>

@endsection