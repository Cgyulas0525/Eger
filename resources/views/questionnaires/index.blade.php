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
                                    <h4>{{ __('Űrlapok') }}</h4>
                                </div>
                                <div class="mylabel col-sm-1">
                                    <h5 class="text-right">{{ __('Aktív:') }}</h5>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('active', App\Enums\YesNoEnum::values(), 1,
                                            ['class'=>'select2 form-control', 'id' => 'active']) !!}
                                </div>
                                <div class="mylabel col-sm-2">
                                    <h5 class="text-right">{{ __('Alap csomag:') }}</h5>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('basicpackage', App\Enums\YesNoAllEnum::values(), 2,
                                            ['class'=>'select2 form-control', 'id' => 'basicpackage']) !!}
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
                ajax: "{{ route('questionnaires.index') }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('questionnaires.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: "{{ __('Név')}}", data: 'name', name: 'name'},
                    {title: "{{ __('Érvényesség tól') }}", data: 'validityfrom', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'validityfrom'},
                    {title: "{{ __('Érvényesség ig') }}", data: 'validityto', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'validityto'},
                ]
            });

            function changeTableUrl() {
                let url = '{{ route('questionnairesIndex', [":active", ":basicpackage"]) }}';
                url = url.replace(':active', $('#active').val());
                url = url.replace(':basicpackage', $('#basicpackage').val());
                table.ajax.url(url).load();
            }

            $('#active').change(function () {
                changeTableUrl();
            })

            $('#basicpackage').change(function () {
                changeTableUrl();
            })


        });
    </script>
@endsection


