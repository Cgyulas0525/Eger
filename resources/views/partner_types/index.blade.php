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
                        <h4>{{ __('Partner típus') }}</h4>
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
                ajax: "{{ route('partnerTypes.index') }}",
                paging: false,
                buttons: [],
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('partnerTypes.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Név', data: 'name', width: '400px', name: 'name'},
                    {title: 'Megjegyzés', data: 'description', name: 'description'},
                ]
            });

        });
    </script>
@endsection


