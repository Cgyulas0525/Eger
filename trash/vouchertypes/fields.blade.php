<!-- Name Field -->
<div class="row col-lg-6 col-sm-12">
    <div class="col-sm-8">
        {!! Form::label('name', __('Név:')) !!}
        {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 200,'required' => true, 'id' => 'name']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('local', __('Helyi:')) !!}
        {!! Form::select('local', App\Enums\YesNoEnum::values(), isset($vouchertypes) ? $vouchertypes->local : 0,
                ['class'=>'select2 form-control', 'id' => 'local','required' => true]) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('localfund', __('Alap:'), ['id' => 'localfund_text']) !!}
        {!! Form::select('localfund', App\Enums\YesNoEnum::values(), isset($vouchertypes) ? $vouchertypes->localfund : 0,
                ['class'=>'select2 form-control', 'id' => 'localfund']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('localreplay', __('Ismételhető:'), ['id' => 'localreplay_text']) !!}
        {!! Form::select('localreplay', App\Enums\YesNoEnum::values(), isset($vouchertypes) ? $vouchertypes->localreplay : 0,
                ['class'=>'select2 form-control', 'id' => 'localreplay']) !!}
    </div>
    <div class="row col-sm-12">
        {!! Form::label('description', __('Megjegyzés:')) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500,'rows' => 4]) !!}
    </div>
</div>

@section('scripts')

    @include('functions.js.ajaxsetup')
    @include('functions.js.required')
    @include('functions.js.sweetalert')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            RequiredBackgroundModify('.form-control')

            // function localOtherHide(local) {
            //     if (local == 0) {
            //         $('#localfund').val(0);
            //         $('#localreplay').val(0);
            //
            //         $('#localfund').hide();
            //         $('#localfund_text').hide();
            //         $('#localreplay').hide();
            //         $('#localreplay_text').hide();
            //
            //         $('#otherfund').show();
            //         $('#otherfund_text').show();
            //         $('#otherreplay').show();
            //         $('#otherreplay_text').show();
            //     } else {
            //         $('#otherfund').val(0);
            //         $('#otherreplay').val(0);
            //
            //         $('#localfund').show();
            //         $('#localfund_text').show();
            //         $('#localreplay').show();
            //         $('#localreplay_text').show();
            //
            //         $('#otherfund').hide();
            //         $('#otherfund_text').hide();
            //         $('#otherreplay').hide();
            //         $('#otherreplay_text').hide();
            //     }
            // }
            //
            // $('#local').change(function () {
            //     localOtherHide($('#local').val());
            // })
            //
            // localOtherHide($('#local').val());


        });
    </script>
@endsection
