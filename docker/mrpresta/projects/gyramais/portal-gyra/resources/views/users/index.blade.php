@extends('layouts.general')
@section('title')
    Contas
@stop
@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li class="active">Contas</li>
    </ol>
@stop
@section('sideBarItems')
    <li class="has-sub active">
        <a class="active" href="javascript:;">
            <i class="ion-ios-pulse-strong"></i>
            <span>Contas</span>
        </a>
    </li>
@stop
@section('pageHeader')
    Contas
@stop
@section('stylesheet')
    <link href="{{ asset('css/owner.css') }}" rel="stylesheet" />
@stop
@section('content')
    <div ng-app="ownerModule">
        <div ng-controller="ownerCtrl as ctrl">
            @if (Session::has('message'))
                <div class="row">
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                        <span class="close" data-dismiss="alert"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="row">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        <span class="close" data-dismiss="alert"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="row">
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                        <span class="close" data-dismiss="alert"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 no-padding">
                    <div class="col-md-10 col-sm-10 col-xs-8 no-padding-left">
                        <p class="accounts-paragraph">Se você quiser adicionar mais informações relevantes à sua conta disponível em nossa plataforma, clique em contas.</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 no-padding-right">
                        <button type="button" class="btn btn-success btn-custom users-btn-contas" data-toggle="modal" data-target="#modal-account"><i class="fa fa-plus"></i> Contas</button>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12 no-padding">
                    <div class="col-md-10 col-sm-10 col-xs-8 no-padding-left">
                        <p class="users-paragraph">Se você quiser adicionar mais proprietários em sua conta e, portanto, para verificar mais detalhe todas as dotações disponíveis em nossa plataforma, clique em proprietário.</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 no-padding-right">
                        <button type="button" class="btn btn-success btn-custom" data-toggle="modal" data-target="#modal-owner"><i class="fa fa-plus"></i> Colaboradores</button>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-6 col-sm-4 col-md-3" ng-repeat="owner in ctrl.owners">
                    <div class="card">

                        <div class="bg-default card-header" heigth="">
                            <img ng-if="owner.social_name.name=='Mercado Libre'" src="{{ asset('assets/img/account/mercadolivre.png') }}" width="45px"/>
                            <img ng-if="owner.social_name.name=='Facebook'" src="{{ asset('assets/img/account/facebook.png') }}" width="45px"/>
                            <img ng-if="owner.social_name.name=='Google'" src="{{ asset('assets/img/account/googleplus.png') }}" width="45px"/>
                            <img ng-if="owner.social_name.name==null" src="{{ asset('assets/img/Gyra-Web-16.png') }}" width="45px"/>

                        </div>
                        <div class="card-image" ng-if="owner.url_image">
                            <img ng-src="@{{owner.url_image}}" class="img-responsive"/>
                        </div>
                        <div class="card-image" ng-if="!owner.url_image">
                            <img src="{{asset('assets/img/anon-user.png')}}" class="img-responsive"/>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title">@{{owner.name | uppercase}}</h4>
                            <p class="card-text">@{{ owner.email | lowercase }}</p>
                            <a ng-click="ctrl.statusOwner(owner.id, $index)" ng-class="{'btn-danger':owner.status==1,'btn-primary':owner.status==0}" class="btn">
                                <span ng-if="owner.status==0">Activar</span>
                                <span ng-if="owner.status==1">Desactivar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals._registerOwner')
    @include('modals._integrateAccount')

@stop

@section('scripts')
    <script src="https://use.fontawesome.com/82019ace81.js"></script>
    <script src="{{ asset('js/angular/owner.js') }}"></script>
@stop