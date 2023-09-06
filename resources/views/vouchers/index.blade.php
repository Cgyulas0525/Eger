@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary" >
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <div class="form-group col-sm-12">
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>{{ __('Voucher-ek') }}</h4>
                                </div>
                                <div class="mylabel col-sm-1">
                                    <h5 class="text-right">{{ __('Aktív:') }}</h5>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('active', App\Enums\YesNoEnum::values(), 1,
                                            ['class'=>'select2 form-control', 'id' => 'active']) !!}
                                </div>
                                <div class="mylabel col-sm-1">
                                    <h5 class="text-right">{{ __('Partner:') }}</h5>
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::select('partner', App\Http\Controllers\PartnersController::DDDW(), null,
                                            ['class'=>'select2 form-control', 'id' => 'partner']) !!}
                                </div>
                            </div>
                        </div>
                    </section>
                    @include('flash::message')
                    @include('layouts.indextable')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @include('functions.js.ajaxsetup')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup();

            var table = $('.indextable').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[1, 'asc']],
                paging: false,
                buttons: [],
                ajax: "{{ route('vouchers.index') }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('vouchers.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: "{{ __('Név')}}", data: 'name', name: 'name'},
                    {title: "{{ __('Partner')}}", data: 'partnerName', name: 'partnerName'},
                    {title: "{{ __('Típus')}}", data: 'voucherTypeName', name: 'voucherTypeName'},
                    {title: "{{ __('Érvényesség tól') }}", data: 'validityfrom', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'validityfrom'},
                    {title: "{{ __('Érvényesség ig') }}", data: 'validityto', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'validityto'},
                ],
                buttons: [],
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if (aData.active == 0) {
                        $('td', nRow).css('background-color', 'lightgray');
                    }
                }
            });

            function changeTableUrl() {
                let url = '{{ route('vouchersIndex', [":active", ":partner"]) }}';
                url = url.replace(':active', $('#active').val());
                url = url.replace(':partner', $('#partner').val());
                table.ajax.url(url).load();
            }

            $('#active').change(function () {
                changeTableUrl();
            })

            $('#partner').change(function () {
                changeTableUrl();
            })


        });
    </script>
@endsection


