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
                                    <h4>{{ __('Partnerek') }}</h4>
                                </div>
                                <div class="mylabel col-sm-1">
                                    {!! Form::label('active', 'Aktív:') !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('active', ToolsClass::yesNoDDDW(), 1,
                                            ['class'=>'select2 form-control', 'id' => 'active']) !!}
                                </div>
                            </div>
                        </div>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body"  >
                            <table class="table table-hover table-bordered indextable w-100"></table>
                        </div>
                    </div>
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.indextable').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                paging: false,
                order: [[1, 'asc']],
                ajax: "{{ route('partners.index') }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('partners.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Név', data: 'name', name: 'name'},
                    {title: 'Típus', data: 'partnerTypesName', name: 'partnerTypesName'},
                    {title: 'Email', data: 'email', name: 'email'},
                    {title: 'Telefon', data: 'phonenumber', name: 'phonenumber'},
                ],
                buttons: [],
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if (aData.active == 0) {
                        $('td', nRow).css('background-color', 'lightgray');
                    }
                }

            });

            $('#active').change(function () {
                let url = '{{ route('partnersIndex', [":active"]) }}';
                url = url.replace(':active', $('#active').val());
                table.ajax.url(url).load();
            })


        });
    </script>
@endsection

