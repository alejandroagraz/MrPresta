@php ($routeName = Route::current()->getName())

<li class="has-sub {!! ($routeName == 'home') ? 'active': '' !!}">
    <a class="active" href="#">
        <i class="ion-ios-pulse-strong"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="has-sub {!! ($routeName == 'applications') ? 'active': '' !!}">
    <a class="" href="{{ route('applications') }}">
        <i class="ion-clipboard"></i>
        <span>Aplicações</span>
    </a>
</li>
<li class="has-sub {!! ($routeName == 'loans') ? 'active': '' !!}">
    <a class="" href="{{ route('loans') }}">
        <i class="ion-speedometer"></i>
        <span>Emprestimos</span>
    </a>
</li>
<li class="has-sub {!! ($routeName == 'usuarios') ? 'active': '' !!}">
    <a class="" href="{{ route('usuarios') }}">
        <i class="ion-person-stalker"></i>
        <span>Contas</span>
    </a>
</li>

