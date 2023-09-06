@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ $partners->name }} <img height="40" src={{ URL::asset($partners->logourl)}}/></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            <div class="card-body">
                <div class="row">
                    @include('partners.partnerContactsFields')
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <div class="form-group col-sm-12">
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>{{ __('Felhasználók') }}</h4>
                                </div>
                                <div class="mylabel col-sm-1">
                                    <h5 class="text-right">{{ __('Aktív:') }}</h5>
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('active', App\Enums\YesNoEnum::values(), 1,
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

            <div class="card-footer">
                <a href="{{ route('partners.index') }}" class="btn btn-default">{{ __('Kilép') }}</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
