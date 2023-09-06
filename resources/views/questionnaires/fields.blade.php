@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection


<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('Név:')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 200,'id' => 'name', 'required' => true]) !!}
    <div class="row">
        <div class="form-group col-sm-3">
            {!! Form::label('validityfrom', __('Érvényes -tól:')) !!}
            {!! Form::date('validityfrom', isset($questionnaires) ? $questionnaires->validityfrom : \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'validityfrom', 'required' => true]) !!}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('validityto', __('Érvényes -ig:')) !!}
            {!! Form::date('validityto', isset($questionnaires) ? $questionnaires->validityto : null, ['class' => 'form-control','id'=>'validityto', 'required' => false]) !!}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('basicpackage', __('Alapcsomag:')) !!}
            {!! Form::select('basicpackage', App\Enums\YesNoEnum::values(), isset($questionnaires) ? $questionnaires->basicpackage : 0,
                    ['class'=>'select2 form-control', 'id' => 'basicpackage']) !!}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('qrcode', __('Qr kód:')) !!}
            {!! Form::text('qrcode', null, ['class' => 'form-control','maxlength' => 500, 'readonly' => true, 'id' => 'qrcode']) !!}
        </div>
    </div>
    {!! Form::label('description', __('Megjegyzés:')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500,'rows' => 4]) !!}
</div>

{!! Form::hidden('active', isset($questionnaires) ? $questionnaires->active : 1, ['class' => 'form-control','id'=>'active']) !!}

@if (isset($questionnaires))
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

@section('scripts')

    @include('functions.js.ajaxsetup')
    @include('functions.js.required')
    @include('functions.js.sweetalert')
    @include('functions.js.dtControl')
    @include('functions.js.readonlyModify')

    <script type="text/javascript">
        $(function () {

            $('[data-widget="pushmenu"]').PushMenu('collapse');

            ajaxSetup();

            RequiredBackgroundModify('.form-control')
            ReadonlyBackgroundModify('.form-control')

            function dateCheck() {
                let from = $('#validityfrom').val();
                let to   = $('#validityto').val();

                if (to != null || to != 0) {
                    if (to < from) {
                        swal.fire( "Hiba",  "A lejárat ig nem lehet hamarabb, mit a tól!",  "error" );
                        $('#validityto').val(null);
                        $('#validityto').focus();
                    }
                }
                console.log(from, to);

            }

            $('#validityfrom').change(function() {
                dateCheck();
            });

            $('#validityto').change(function() {
                dateCheck();
            });

            function trueFalse(value) {
                return (value == 0) ? 'Hamis' : 'Igaz';
            }

            function format(d) {
                // `d` is the original data object for the row
                return (
                    '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' + '<td style="width: 150px;">Required:</td>' + '<td style="width: 150px; text-align: right;">' + trueFalse(d.required) + '</td>' + '</tr>' +
                    '<tr>' + '<td style="width: 150px;">Readonly:</td>' + '<td style="width: 150px; text-align: right;">' + trueFalse(d.readonly) + '</td>' + '</tr>' +
                    '<tr>' + '<td style="width: 150px;">Long:</td>' + '<td style="width: 150px; text-align: right;">'+ d.long + '</td>' + '</tr>' +
                    '<tr>' + '<td style="width: 150px;">RowCount:</td>' + '<td style="width: 150px; text-align: right;">'+ d.rowcount + '</td>' + '</tr>' +
                    '</table>'
                );
            }

            var table = $('.indextable').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[4, 'asc']],
                paging: false,
                select: false,
                buttons: [],
                ajax: "{{ route('qdIndex', $questionnaires->id) }}",
                columns: [
                    {
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                        width: '30px',
                    },

                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('qdCreate', ['id' => $questionnaires->id ]) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '100px', name: 'action', orderable: false, searchable: false},
                    {title: "{{ __('Név')}}", data: 'name', name: 'name'},
                    {title: "{{ __('Típus')}}", data: 'detailtypeName', name: 'detailtypeName'},
                    {title: "{{ __('id')}}", data: 'id', name: 'id', visible: false},
                ],
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if (aData.listing == 1) {
                        $('td', nRow).css('background-color', 'lightgray');
                    }
                }

            });

            $('.indextable tbody').on('click', 'td.dt-control', function () {
                dtControl(this, table, format);
            });
        });
    </script>
@endsection
