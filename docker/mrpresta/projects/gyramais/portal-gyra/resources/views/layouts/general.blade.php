@extends('layouts.base')

@section('body')
    <body>
        <div ng-app="globalModule">
            <div ng-controller="globalCtrl as ctrl">
            <!-- begin #page-loader -->
            <div id="page-loader" class="fade in"><span class="spinner"></span></div>
            <!-- end #page-loader -->

            <!-- begin #page-container -->
            <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
                <!-- begin #header -->
                <div id="header" class="header navbar navbar-default navbar-fixed-top">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        <!-- begin mobile sidebar expand / collapse button -->
                        <div class="navbar-header">
                            <a href="" class="navbar-brand"><span class="navbar-logo"><i
                                            class="ion-ios-cloud"></i></span> <b>Portal</b> do Clientes</a>
                            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- end mobile sidebar expand / collapse button -->

                        <!-- begin header navigation right -->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown navbar-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                    @if (!Auth::check())
                                        <span class="user-image online">
                                            <img src="assets/img/user-13.jpg" alt=""/>
                                        </span>
                                            <span class="hidden-xs">Test Login</span> <b class="caret"></b>
                                        @else
                                        <span class="user-image online">
                                            <img src="{{ Auth::user()->url_image }}" alt=""/>
                                        </span>
                                        <span id="spanNickname" class="hidden-xs">{{ Auth::user()->nickname }}</span> <b class="caret"></b>
                                    @endif
                                </a>
                                <ul class="dropdown-menu animated fadeInLeft">
                                    <li class="arrow"></li>
                                    <li><a href="{{ route('profile') }}">Editar Perfil</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Log Out
                                        </a>
                                        <form id="logout-form" class="invisible" method="POST" action="{{ route('logout') }}">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown navbar-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                    @if (!Auth::check())
                                        <span class="user-image online">
                                            <img src="assets/img/user-13.jpg" alt=""/>
                                        </span>
                                            <span class="hidden-xs">Test Login</span> <b class="caret"></b>
                                        @else
                                        <span class="user-image online">
                                            <img src="https://meu.gyramais.app/assets/img/account/mercadolivre.png" alt=""/>
                                        </span>
                                        <span id="spanNickname" class="hidden-xs">ML ACCOUNTS {{ Session::get('ML')}}</span> <b class="caret"></b>
                                    @endif
                                </a>
                                <ul class="dropdown-menu animated fadeInLeft">
                                    <li class="arrow"></li>
                                    <li ng-repeat="account in ctrl.mlAccountsRegistered">
                                        <a href="/set/ml/@{{account.client_id}}">@{{account.nickname}}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- end header navigation right -->
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- end #header -->

                <!-- begin #sidebar -->
                <div id="sidebar" class="sidebar">
                    <!-- begin sidebar scrollbar -->
                    <div data-scrollbar="true" data-height="100%">
                        <!-- begin sidebar user -->
                        <ul class="nav">
                            <li class="nav-profile">
                                <div class="image">
                                    <a href="javascript:;">
                                        @if (!Auth::check())
                                            <img src="assets/img/user-13.jpg" alt=""/>
                                        @else
                                            <img src="{{ Auth::user()->url_image }}" alt=""/>
                                        @endif
                                    </a>
                                </div>
                                <div class="info">
                                    @yield('profileName')
                                </div>
                            </li>
                        </ul>
                        <!-- end sidebar user -->
                        <!-- begin sidebar nav -->
                        <ul class="nav">
                            <li class="nav-header">Navigation</li>
                            @include('layouts.partials._menu')
                            <!-- begin sidebar minify button -->
                            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                                            class="ion-ios-arrow-left"></i> <span>Collapse</span></a></li>
                            <!-- end sidebar minify button -->
                        </ul>
                        <!-- end sidebar nav -->
                    </div>
                    <!-- end sidebar scrollbar -->
                </div>
                <div class="sidebar-bg"></div>
                <!-- end #sidebar -->

                <!-- begin #content -->
                <div id="content" class="content">
                    <!-- begin breadcrumb -->
                    @yield('breadcrumb')
                    <!-- end breadcrumb -->
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        @yield('pageHeader')
                        <small>@yield('pageHeaderText')</small>
                    </h1>
                    <!-- end page-header -->

                    <!-- begin row -->
                    @yield('content')
                    <!-- end row -->
                </div>
                <!-- end #content -->
                <!-- begin scroll to top btn -->
                <a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade"
                   data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
            </div>
            <!-- end page container -->
        </div>
    </div>
    </body>
@stop