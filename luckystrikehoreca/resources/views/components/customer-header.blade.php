<header class="customerHeader">
    <a href="{{ url('') }}">
        <img class="logo" src="{{URL::asset('/img/luckystrike.png')}}" alt="">
    </a>
    @if (Auth::check())
        <section>
            <a href="{{ url('reserveren') }}" class="{{ request()->is('reserveren') ? 'active' : '' }}">reserveren</a>
            <a href="{{ url('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">contact</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> uitloggen</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @if (Auth::user()->is_worker)
                <a class="primaryButton" href="{{ url('/employee/orders') }}" class="{{ request()->is('reserveringen') ? 'active' : '' }}">beheer</a>
            @else
                @if (Auth::user()->is_admin)
                    <a class="primaryButton" href="{{ url('admin') }}" class="{{ request()->is('admin') ? 'active' : '' }}">beheer</a>
                @else
                    <a class="primaryButton" href="{{ url('reserveringen') }}" class="{{ request()->is('reserveringen') ? 'active' : '' }}">beheer</a>
                @endif
            @endif
        </section>        
    @endif

</header>