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
                                    <h4>{{ __('Ügyfelek') }}</h4>
                                </div>
                                <div class="mylabel col-sm-1">
                                    <h5 class="text-right">{{ __('Aktív:') }}</h5>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('active', App\Enums\YesNoEnum::values(), 1,
                                            ['class'=>'select2 form-control', 'id' => 'active']) !!}
                                </div>
                                <div class="mylabel col-sm-1">
                                    <h5 class="text-right">{{ __('Validált:') }}</h5>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('validated', App\Enums\YesNoAllEnum::values(), 2,
                                            ['class'=>'select2 form-control', 'id' => 'validated']) !!}
                                </div>
                                <div class="mylabel col-sm-1">
                                    <h5 class="text-right">{{ __('Helyi lakos:') }}</h5>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('local', App\Enums\YesNoAllEnum::values(), 2,
                                            ['class'=>'select2 form-control', 'id' => 'local']) !!}
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
                ajax: "{{ route('clients.index') }}",
                columns: [
                    {{--{title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('clients.create') !!}"><i class="fa fa-plus-square"></i></a>',--}}
                    {{--    data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},--}}
                    {title: '', data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: "{{ __('Név')}}", data: 'name', name: 'name'},
                    {title: 'Cím', data: 'fulladdress', name: 'fulladdress'},
                    {title: 'Email', data: 'email', name: 'email'},
                    {title: 'Telefon', data: 'phonenumber', name: 'phonenumber'},
                ],
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if (aData.active == 0) {
                        $('td', nRow).css('background-color', 'lightgray');
                    }
                    if (aData.validated == 0) {
                        $('td', nRow).css('background-color', 'yellow');
                    }
                }

            });

            function changeTableUrl() {
                let url = '{{ route('clientsIndex', [":active", ":validated", ":local"]) }}';
                url = url.replace(':active', $('#active').val());
                url = url.replace(':validated', $('#validated').val());
                url = url.replace(':local', $('#local').val());

                console.log(url);

                table.ajax.url(url).load();
            }

            $('#active').change(function () {
                changeTableUrl();
            })

            $('#validated').change(function () {
                changeTableUrl();
            })

            $('#local').change(function () {
                changeTableUrl();
            })


        });
    </script>
@endsection


