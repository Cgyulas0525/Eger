@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ $clientvoucherused->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($clientvoucherused, ['route' => ['clientvoucheruseds.update', $clientvoucherused->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('clientvoucheruseds.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('Ment'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('clientvoucheruseds.index') }}" class="btn btn-default">{{ __('Kilép') }}</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
