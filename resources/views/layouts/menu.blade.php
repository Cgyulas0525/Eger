<li class="nav-item">
    <a href="{{ route('dashboard') }}"
       class="nav-link {{ Request::is('dashb*') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i>
        <p>{{ __('Indító pult') }}</p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link {{ Request::is('detailTypes*') ||
                                   Request::is('logitemtypes*') ||
                                   Request::is('vouchertypes*') ||
                                   Request::is('admin*') ||
                                   Request::is('partnerTypes*') ? 'active' : '' }}">
        <i class="fas fa-university"></i>
        <p>{{ __('Szótár') }}<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('partnerTypes.index') }}"
               class="nav-link {{ Request::is('partnerTypes*') ? 'active' : '' }}">
                <i class="fas fa-hands-helping"></i>
                <p>{{ __('Partner típus') }}</p>
            </a>
        </li>

        @if (myUser::user()->usertypes_id === 3 || myUser::user()->usertypes_id === 2 )

            <li class="nav-item">
                <a href="{{ route('adminIndex') }}"
                   class="nav-link {{ Request::is('admin*') ? 'active' : '' }}">
                    <i class="fas fa-tools"></i>
                    <p>{{ __('Adminisztratori feladatok') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('detailTypes.index') }}"
                   class="nav-link {{ Request::is('detailTypes*') ? 'active' : '' }}">
                    <i class="fas fa-share-alt-square"></i>
                    <p>{{ __('Űrlap sor típus') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logitemtypes.index') }}"
                   class="nav-link {{ Request::is('logitemtypes*') ? 'active' : '' }}">
                    <i class="fas fa-sign-in-alt"></i>
                    <p>{{ __('Log típusok') }}</p>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a href="{{ route('vouchertypes.index') }}"
               class="nav-link {{ Request::is('vouchertypes*') ? 'active' : '' }}">
                <i class="fas fa-check-square"></i>
                <p>{{ __('Voucher típusok') }}</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('partners.index') }}"
       class="nav-link {{ Request::is('partners*') ? 'active' : '' }}">
        <i class="fas fa-handshake"></i>
        <p>{{ __('Partnerek') }}</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('clients.index') }}"
       class="nav-link {{ Request::is('clients*') ? 'active' : '' }}">
        <i class="fas fa-user-cog"></i>
        <p>{{ __('Ügyfelek') }}</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('vouchers.index') }}"
       class="nav-link {{ Request::is('vouchers*') ? 'active' : '' }}">
        <i class="fas fa-ticket-alt"></i>
        <p>{{ __('Voucher-ek') }}</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('questionnaires.index') }}"
       class="nav-link {{ Request::is('questionnaires*') ? 'active' : '' }}">
        <i class="fas fa-question-circle"></i>
        <p>{{ __('Űrlapok') }}</p>
    </a>
</li>
{{--<li class="nav-item">--}}
{{--    <a href="{{ route('lotteries.index') }}"--}}
{{--       class="nav-link {{ Request::is('lotteries*') ? 'active' : '' }}">--}}
{{--        <i class="fas fa-money-check-alt"></i>--}}
{{--        <p>{{ __('Sorsolások') }}</p>--}}
{{--    </a>--}}
{{--</li>--}}

<li class="nav-item has-treeview">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>{{ __('Riportok') }}<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
    </ul>
</li>

@if (myUser::user()->usertypes_id !== 1)
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link ">
            <i class="fas fa-users"></i>
            <p>{{ __('Felhasználók') }}<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('usertypes.index') }}"
                   class="nav-link {{ Request::is('usertypes*') ? 'active' : '' }}">
                    <i class="fas fa-user-tag"></i>
                    <p>{{ __('Felhasználó típusok') }}</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                   class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <p>{{ __('Felhasználók') }}</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link {{ Request::is('settingIndex*') ||
                                       Request::is('validpostcodes*') ||
                                       Request::is('communicationIndex*')  ? 'active' : '' }}">
            <i class="fas fa-cogs"></i>
            <p>
                {{ __('Beállítások') }}
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('validpostcodes.index') }}"
                   class="nav-link {{ Request::is('validpostcodes*') ? 'active' : '' }}">
                    <i class="fas fa-laptop-house"></i>
                    <p>{{ __( 'Érvényességi körzetek') }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('settingIndex') }}"
                   class="nav-link {{ Request::is('settingIndex*') ? 'active' : '' }}">
                    <i class="far fa-envelope-open"></i>
                    <p> {{ __('Email') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('communicationIndex') }}"
                   class="nav-link {{ Request::is('communicationIndex*') ? 'active' : '' }}">
                    <i class="fas fa-broadcast-tower"></i>
                    <p> {{ __('Kommunikáció') }}</p>
                </a>
            </li>
        </ul>
    </li>
@endif

