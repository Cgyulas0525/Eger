<div class="row">
    <div class="col-md-4">

        <div class="card card-widget widget-user-2 shadow">

            <div class="widget-user-header bg-warning">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src={{ URL::asset('/img/41011177-clients-icon.jpg') }} alt="Client">
                </div>

                <h3 class="widget-user-desc shadow text-black text-bold">{{ __('Ügyfelek') }}</h3>
                <h5 class="widget-user-desc text-black">{{ __('') }}</h5>
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-black text-bold">
                            {{ __('Összesen') }} <span class="float-right badge bg-primary">{{ App\Models\Clients::count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-black text-bold">
                            {{ __('Aktív') }} <span class="float-right badge bg-info">{{ App\Models\Clients::where('active', 1)->get()->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-black text-bold">
                            {{ __('Helyi') }} <span class="float-right badge bg-success">{{ App\Models\Clients::where('local', 0)->get()->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-red text-bold">
                            {{ __('Validálandó') }} <span class="float-right badge bg-danger">{{ App\Models\Clients::where('active', 1)->where('validated', 0)->get()->count() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="col-md-4">

        <div class="card card-widget widget-user-2 shadow">

            <div class="widget-user-header bg-success">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src={{ URL::asset('/img/partnership.png') }} alt="Client">
                </div>

                <h3 class="widget-user-desc shadow text-black text-bold">{{ __('Partnerek') }}</h3>
                <h5 class="widget-user-desc text-black">{{ __('') }}</h5>
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-black text-bold">
                            {{ __('Összesen') }} <span class="float-right badge bg-primary">{{ App\Models\Partners::count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-black text-bold">
                            {{ __('Aktív') }} <span class="float-right badge bg-info">{{ App\Models\Partners::where('active', 1)->get()->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-black text-bold">
                            {{ __('Helyi') }} <span class="float-right badge bg-success">{{ App\Models\Clients::where('local', 0)->get()->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-red text-bold">
                            {{ __('Validálandó') }} <span class="float-right badge bg-danger">{{ App\Models\Clients::where('active', 1)->where('validated', 0)->get()->count() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="col-md-4">

        <div class="card card-widget widget-user-2 shadow">

            <div class="widget-user-header bg-info">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src={{ URL::asset('/img/voucher.png') }} alt="Client">
                </div>

                <h3 class="widget-user-desc shadow text-black text-bold">{{ __('Űrlapok') }}</h3>
                <h5 class="widget-user-desc text-black">{{ __('') }}</h5>
{{--                <h5 class="widget-user-desc text-black">{{ __('A rendszerbe regisztrált voucherek') }}</h5>--}}
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-black text-bold">
                            {{ __('Összesen') }} <span class="float-right badge bg-primary">{{ App\Models\Clients::count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-black text-bold">
                            {{ __('Aktív') }} <span class="float-right badge bg-info">{{ App\Models\Clients::where('active', 1)->get()->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-black text-bold">
                            {{ __('Helyi') }} <span class="float-right badge bg-success">{{ App\Models\Clients::where('local', 0)->get()->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link text-red text-bold">
                            {{ __('Validálandó') }} <span class="float-right badge bg-danger">{{ App\Models\Clients::where('active', 1)->where('validated', 0)->get()->count() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
