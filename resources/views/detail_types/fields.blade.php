<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('Név:')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100]) !!}
    {!! Form::label('listing', __('Tételek:')) !!}
    {!! Form::select('listing', App\Enums\YesNoEnum::values(), isset($detailTypes) ? $detailTypes->listing : 0,
                                            ['class'=>'select2 form-control', 'id' => 'listing']) !!}
    {!! Form::label('description', __('Megjegyzés:')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>

