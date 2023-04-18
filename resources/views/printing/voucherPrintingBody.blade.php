<div class="row w-100">
    <div class="row text-center w-100">
        <p class="text-center w-100 fs-6 mt-3">
            <strong>{{ $voucher->partner->name }} voucher {{ $client->name }} részére</strong>
        </p>
        <p class="text-center w-100 mt-3">
            <strong>{{ $voucher->name }}</strong>
        </p>
    </div>
    <!-- /.col -->
</div>

<div class="row w-100 text-center mt-6">
    <div class="col-xs-6 w-50">
        Kiállító:
        <address>
            <strong>{{ $voucher->partner->name }}</strong><br>
        </address>
    </div>
    <!-- /.col -->
    <div class="col-xs-6 w-50">
        Kedvezményezett:
        <address>
            <strong>{{ $client->name }}</strong><br>
        </address>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- info row -->
<!-- Table row -->
<div class="row mt-6">
    <div class="col-xs-12 text-center">
        <p class="text-bold 600">{{ $voucher->partner->name }} az Ön számára vouchert állított ki.</p>
        <strong>A voucher QR kódja:</strong>
        <br/>
        <br/>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate($voucher->qrcode)) !!} ">
    </div>
</div>
<div class="row mt-6">
    <div class="col-xs-12 text-center">
        <h3>A voucher felhasználható: {{ !empty($voucher->validityto) ? $voucher->validityto : __('korlátlan ideig') }}</h3>
    </div>
</div>


<div class="row">
    <div class="col-xs-12">
        <p class="h6">Készült: {{ date('Y.m.d', strtotime('today')) }}</p>
    </div>
</div>
