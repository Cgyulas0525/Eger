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
                                    <h4>{{ __('Voucher típusok') }}</h4>
                                </div>
                                <div class="mylabel col-sm-1">
                                    {!! Form::label('local', 'Helyi:') !!}
                                </div>
                                <div class="col-sm-2">
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
                ajax: "{{ route('vouchertypes.index') }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('vouchertypes.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: "{{ __('Név')}}", data: 'name', name: 'name'},
                    {title: "{{ __('Helyi')}}", data: 'localName', name: 'localName'},
                    {title: "{{ __('Alap')}}", data: 'localFundName', name: 'localFundName'},
                    {title: "{{ __('Ismételhető')}}", data: 'localReplayName', name: 'localReplayName'},
                ]
            });

            $('#local').change(function () {
                let url = '{{ route('vouchertypesIndex', [":local"]) }}';
                url = url.replace(':local', $('#local').val());
                console.log(url);
                table.ajax.url(url).load();
            })


        });
    </script>
@endsection


