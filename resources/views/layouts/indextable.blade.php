<div class="clearfix"></div>
<div class="box box-primary mt-3">
    @if (isset($tableTitle))
        <h4>{{ __($tableTitle) }}</h4>
    @endif
    <div class="box-body">
        @if (isset($class))
            <table @class([ $class ])></table>
        @else
            <table class="table table-hover table-bordered indextable w-100"></table>
        @endif
    </div>
</div>
<div class="text-center"></div>
