@section('css')
    @include('layouts.costumcss')
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
    <link
        href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css"
        rel="stylesheet"
    />

@endsection

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', __('Név:')) !!}
    {!! Form::text('username', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('Email:')) !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

@if (!isset($users))
    <!-- Email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('password', __('Jelszó:')) !!}
        {!! Form::text('password', null, ['class' => 'form-control']) !!}
    </div>
@endif


<!-- Usertypes Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usertypes_id', __('Típus:')) !!}
    {!! Form::select('usertypes_id', \App\Http\Controllers\UsertypesController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'usertypes_id', 'required' => true]) !!}
</div>

<!-- Commit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('commit', __('Megjegyzés:')) !!}
    {!! Form::textarea('commit', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>

<div class="form-group col-sm-6">
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('image_url', __('Kép:')) !!}
        </div>
        <div class="mylabel col-sm-4">
{{--            <label class="image__file-upload">{{ __('Válasszon') }}--}}
{{--            <input type="file"--}}
{{--                   class="filepond"--}}
{{--                   name="filepond"--}}
{{--                   accept="image/png, image/jpeg, image/gif"/>--}}
{{--            {!! Form::file('image_url',['class'=>'filepond']) !!}--}}
            {!! Form::file('image_url', ['class' => 'filepond', "name" => "image_url", "accept" => "image/png, image/jpeg, image/gif", 'id' => 'image_url']) !!}

{{--            <p class="help-block">{{ $errors->first('image_url') }}</p>--}}
{{--            </label>--}}
        </div>
    </div>
</div>

@if (isset($users))
    <div class="form-group col-sm-6">
        {!! Form::hidden('password', __('Jelszó:')) !!}
        {!! Form::hidden('password', $users->password, ['class' => 'form-control']) !!}
    </div>
@endif

@section('scripts')

    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>


    <script type="text/javascript">

        FilePond.registerPlugin(
            // FilePondPluginFileValidateType,
            // FilePondPluginImageExifOrientation,
            // FilePondPluginImagePreview,
            // FilePondPluginImageCrop,
            // FilePondPluginImageResize,
            // FilePondPluginImageTransform,
            // FilePondPluginImageEdit
            FilePondPluginFileEncode,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize,
            FilePondPluginImageExifOrientation,
            FilePondPluginImagePreview,
            FilePondPluginImageCrop,
            FilePondPluginImageResize,
            FilePondPluginImageTransform,

            FilePondPluginFilePoster,
            // FilePondPluginImageEditor /* for use with Pintura */
        );

        const inputElement = document.querySelector('input[id="image_url"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement,
            {
                files: [
                    {
                        // the server file reference
                        source: '12345',

                        // set type to limbo to tell FilePond this is a temp file
                        options: {
                            type: 'local',

                            // file: {
                            //     name: '/public/img/administrator.jpg',
                            // }
                        },
                    },
                ],
                labelIdle: `Húzza ide a képet vagy <span class="filepond--label-action">Keressen</span>`,
                imagePreviewHeight: 170,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 200,
                stylePanelLayout: 'compact circle',
                styleLoadIndicatorPosition: 'center bottom',
                styleProgressIndicatorPosition: 'right bottom',
                styleButtonRemoveItemPosition: 'left bottom',
                styleButtonProcessItemPosition: 'right bottom',
            }
        );

        FilePond.setOptions({
            server: {
                url: '{{url('filepondupload')}}',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                }
            }
        });

        {{--FilePond.registerPlugin(--}}
        {{--    // FilePondPluginFileValidateType,--}}
        {{--    // FilePondPluginImageExifOrientation,--}}
        {{--    // FilePondPluginImagePreview,--}}
        {{--    // FilePondPluginImageCrop,--}}
        {{--    // FilePondPluginImageResize,--}}
        {{--    // FilePondPluginImageTransform,--}}
        {{--    // FilePondPluginImageEdit--}}
        {{--    FilePondPluginFileEncode,--}}
        {{--    FilePondPluginFileValidateType,--}}
        {{--    FilePondPluginFileValidateSize,--}}
        {{--    FilePondPluginImageExifOrientation,--}}
        {{--    FilePondPluginImagePreview,--}}
        {{--    FilePondPluginImageCrop,--}}
        {{--    FilePondPluginImageResize,--}}
        {{--    FilePondPluginImageTransform,--}}

        {{--    FilePondPluginFilePoster,--}}
        {{--    // FilePondPluginImageEditor /* for use with Pintura */--}}
        {{--);--}}

        {{--// Set default FilePond options--}}
        {{--FilePond.setOptions({--}}
        {{--    server: {--}}
        {{--        --}}{{--url: "{{ config('filepond.server.url') }}",--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': "{{ @csrf_token() }}",--}}
        {{--        }--}}
        {{--    }--}}
        {{--});--}}

        {{--// Create the FilePond instance--}}
        // FilePond.create(document.querySelector('input[name="image_url"]'),
        //      {
        //             files: [
        //             {
        //                 // the server file reference
        //                 source: 'localhost/Laravel/Eger/public/img/administrator.jpg',
        //
        //                 // set type to limbo to tell FilePond this is a temp file
        //                 options: {
        //                     type: 'limbo',
        //                 },
        //             },
        //         ],
        //          labelIdle: `Húzza ide a képet vagy <span class="filepond--label-action">Keressen</span>`,
        //          imagePreviewHeight: 170,
        //          imageCropAspectRatio: '1:1',
        //          imageResizeTargetWidth: 200,
        //          imageResizeTargetHeight: 200,
        //          stylePanelLayout: 'compact circle',
        //          styleLoadIndicatorPosition: 'center bottom',
        //          styleProgressIndicatorPosition: 'right bottom',
        //          styleButtonRemoveItemPosition: 'left bottom',
        //          styleButtonProcessItemPosition: 'right bottom',
        //      });


        {{--$(function () {--}}

        {{--   // const inputElement = document.querySelector('input[type="file"]');--}}
        {{--   //--}}
        {{--   //  // Create a FilePond instance--}}
        {{--   //  const pond = FilePond.create(inputElement,--}}
        {{--   //      {--}}
        {{--   //          labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,--}}
        {{--   //          imagePreviewHeight: 170,--}}
        {{--   //          imageCropAspectRatio: '1:1',--}}
        {{--   //          imageResizeTargetWidth: 200,--}}
        {{--   //          imageResizeTargetHeight: 200,--}}
        {{--   //          stylePanelLayout: 'compact circle',--}}
        {{--   //          styleLoadIndicatorPosition: 'center bottom',--}}
        {{--   //          styleProgressIndicatorPosition: 'right bottom',--}}
        {{--   //          styleButtonRemoveItemPosition: 'left bottom',--}}
        {{--   //          styleButtonProcessItemPosition: 'right bottom',--}}
        {{--   //      });--}}
        {{--});--}}
    </script>
@endsection
