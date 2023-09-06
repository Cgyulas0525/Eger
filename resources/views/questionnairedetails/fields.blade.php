@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

{!! Form::hidden('questionnaire_id', isset($questionnairedetails) ? $questionnairedetails->questionnaire_id : $questionnaire->id, ['class' => 'form-control','id'=>'questionnaire_id', 'readonly' => true]) !!}
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('Név:')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 200,'required' => true]) !!}
    {!! Form::label('detailtype_id', __('Típus:')) !!}
    {!! Form::select('detailtype_id', App\Http\Controllers\DetailTypesController::DDDW(), isset($questionnairedetails) ? $questionnairedetails->detailtype_id : null,
            ['class'=>'select2 form-control', 'id' => 'detailtype_id','required' => true]) !!}
    <div class="row">
        <div class="form-group col-sm-6">
            {!! Form::label('required', __('Kötelező:')) !!}
            {!! Form::select('required', App\Enums\TrueFalseEnum::values(), 1,
                    ['class'=>'select2 form-control', 'id' => 'required','required' => true]) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::label('readonly', __('Csak olvasható:')) !!}
            {!! Form::select('readonly', App\Enums\TrueFalseEnum::values(), 0,
                    ['class'=>'select2 form-control', 'id' => 'readonly','required' => true]) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            {!! Form::label('long', __('Hossz:')) !!}
            {!! Form::number('long', null, ['class' => 'form-control','id'=>'long']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::label('rowcount', __('Sorok száma:')) !!}
            {!! Form::number('rowcount', null, ['class' => 'form-control','id'=>'rowcount']) !!}
        </div>
    </div>
    {!! Form::label('description', __('Megjegyzés:')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500,'rows' => 4]) !!}
</div>
@if (isset($questionnairedetails))
    @if ($questionnairedetails->detailtype->listing == 1)
        <div class="form-group col-sm-6 ">
            <div class="clearfix"></div>
            <div class="box box-primary mt-3">
                <h4>{{ __('Tételek') }}</h4>
                <div class="box-body"  >
                    <table class="table table-hover table-bordered indextable w-100"></table>
                </div>
            </div>
            <div class="text-center"></div>
        </div>
    @endif
@endif

@section('scripts')

    @include('functions.js.ajaxsetup')
    @include('functions.js.required')
    @include('functions.js.sweetalert')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            RequiredBackgroundModify('.form-control')

            var table = $('.indextable').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[1, 'asc']],
                paging: false,
                buttons: [],
                ajax: "{{ route('qdiIndex', $questionnairedetails->id) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('qdiCreate', ['id' => $questionnairedetails->id ]) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: "{{ __('Érték')}}", data: 'value', name: 'value'},
                ]
            });


        });
    </script>
@endsection
