@extends('layouts.base')

@section('title', 'Iniciar sesión')

@section('body')
    <body class="pace-top bg-white">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="assets/img/login-bg/bg-5.jpg" data-id="login-cover-image" alt=""/>
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="ion-ios-cloud m-r-15 fa-2x pull-left"></i> Portal do Clientes </h4>
                    <p>
                        Veja tudo sobre o seu empréstimo.
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo">
                            <i>
                                <img src="{{ asset('assets/img/Gyra-Web-16.png') }}"/>
                            </i>
                        </span> Gyramais
                        @if(env('APP_ENTORNO'))<small>{{ env('APP_ENTORNO') }}</small>@endif
                        <small>Capital de giro para nova era digital</small>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-locked"></i>
                    </div>
                </div>
                <!-- end login-header -->

                <!-- begin login-content -->
                <div class="login-content">
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                            <span class="close" data-dismiss="alert"><i class="fa fa-times"></i></span>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                            <span class="close" data-dismiss="alert"><i class="fa fa-times"></i></span>
                        </div>
                    @endif
                    @if (Session::has('errorRedirect'))
                        <div class="alert alert-danger">
                            {{ Session::get('errorRedirect') }}
                            <a href='https://beta.gyramais.com'>Ir a Gyra+</a>
                            <span class="close" data-dismiss="alert"><i class="fa fa-times"></i></span>
                        </div>
                    @endif
                    <!-- begin social login -->
                    <a href="{{ url('auth/mercadolibre/MLB') }}" class="btn btn-block btn-social btn-mercadolibre buttons-back">
                        <i><img src="{{ asset('assets/img/icon-mercadolibre.png') }}" class="btn-mercadolibre-align-vertical"></i>
                        <span>Entre com Mercado Livre</span>
                    </a>
                    <a href="{{ route('login-facebook') }}" class="btn btn-block btn-social btn-facebook buttons-back">
                        <i class="fa fa-facebook fc-goo"></i>
                        <span>Entre com Facebook</span>
                    </a>
                    <a href="{{ route('login-google') }}"
                       class="btn btn-block btn-social btn-google-plus buttons-back">
                        <i class="fa fa-google-plus fc-goo"></i>
                        <span>Entre com Google</span>
                    </a>
                    <!-- end social login -->
                    <hr>
                    <form novalidate class="margin-bottom-0" method="POST" action="{{ route('post-login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  m-b-15">
                                <input id="email" placeholder="E-mail" type="email" class="form-control input-lg" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}  m-b-15">
                                <input id="password" placeholder="Senha" type="password" class="form-control input-lg" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <a class="btn btn-link no-padding-left" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>

                        <!--<a data-toggle="modal" data-target="#forgotPasswordModal" class="btn btn-link no-padding-left">
                            Forgot Your Password?
                        </a>-->
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Entrar</button>
                        </div>
                        <hr/>
                        <p class="text-center">
                            &copy; GYRA+ · TODOS OS DIREITOS RESERVADOS
                        </p>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
    </div>
    <!-- end page container -->
    </body>

@endsection

@section("afterScripts")
    <script>
        $('#flags').on('shown.bs.modal');
    </script>
@endsection
