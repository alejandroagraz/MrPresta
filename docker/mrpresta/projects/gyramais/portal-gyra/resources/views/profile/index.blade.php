@extends('layouts.general')
@section('title')
    Perfil
@stop
@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Casa</a></li>
        <li class="active">Perfil</li>
    </ol>
@stop
@section('sideBarItems')
    <li class="has-sub active">
        <a class="active" href="javascript:;">
            <i class="ion-ios-pulse-strong"></i>
            <span>Perfil</span>
        </a>
    </li>
@stop
@section('pageHeader')
    Perfil
@stop
@section('content')
    @if (Session::has('message'))
        <div class="row">
            <div class="alert alert-success">
                {{ Session::get('message') }}
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
    <div ng-app="profileModule" ng-controller="profileCtrl as ctrl">
        <div id="message" class="row">
            <div class="alert alert-@{{ ctrl.typeMessage }}">
                @{{ ctrl.message }}
                <span class="close" ng-click="ctrl.closeMessage()"><i class="fa fa-times"></i></span>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-inverse" ng-class="{'panel-loading' : ctrl.loading}">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Information</h4>
                </div>
                <div class="panel-body">
                    <div class="panel-loader" ng-show="ctrl.loading"><span class="spinner-small"></span></div>
                    <div class="profile-container">
                        <div class="profile-section">
                            <div class="profile-left">
                                <div class="profile-image">
                                    <img ng-src="@{{  ctrl.profile.image }}"/>
                                    <i class="fa fa-user hide"></i>
                                </div>
                                <div class="m-b-10">
                                    <form enctype="multipart/form-data" id="formPicture" name="form-picture" method="POST"
                                          action="{{ route('update-picture') }}">
                                        {{ csrf_field() }}
                                        <label for="file" class="btn btn-warning btn-block btn-sm">Change
                                            Picture</label>
                                        <input type="file" id="file" name="file[test]" ng-model="ctrl.picture" ng-click="ctrl.uploadFile(this)">
                                    </form>
                                </div>
                            </div>
                            <div class="profile-right">
                                <div class="profile-info">
                                    <div class="table-responsive">
                                        <table class="table table-profile">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>
                                                    <h4>@{{ ctrl.name | uppercase }}</h4>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="highlight">
                                                <td class="field about-me">About Me</td>
                                                <td></td>
                                            </tr>
                                            <tr class="divider">
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <td class="field">Name</td>
                                                <td><input type="text" id="name" class="form-control input-about"
                                                           ng-model="ctrl.profile.name"
                                                           ng-change="ctrl.validateInput('name')" maxlength="190"></td>
                                                <td><a class="btn btn-icon btn-circle btn-danger btn-about"
                                                       ng-click="ctrl.emptyInput('name')"><i
                                                                class="fa fa-times"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><span id="nameSpan"
                                                          class="span-red">Debe introducir un nombre.</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="field">Nickname</td>
                                                <td><input type="text" id="nickname" class="form-control input-about"
                                                           ng-model="ctrl.profile.nickname"
                                                           ng-change="ctrl.validateInput('nickname')" maxlength="190"></td>
                                                <td><a class="btn btn-icon btn-circle btn-danger btn-about"
                                                       ng-click="ctrl.emptyInput('nickname')"><i
                                                                class="fa fa-times"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><span id="nicknameSpan"
                                                          class="span-red">Debe introducir un nickname.</span>
                                                </td>
                                            </tr>
                                            @if (Auth::user()->password != null)
                                                <tr>
                                                    <td class="field">Password</td>
                                                    <td><input type="password" id="password"
                                                               class="form-control input-about"
                                                               ng-model="ctrl.profile.password"
                                                               ng-change="ctrl.validateInput('password')" maxlength="190"></td>
                                                    <td><a class="btn btn-icon btn-circle btn-danger btn-about"
                                                           ng-click="ctrl.emptyInput('password')"><i
                                                                    class="fa fa-times"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><span id="passwordSpan"
                                                              class="span-red">Debe introducir un password.</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Confirm Password</td>
                                                    <td><input type="password" id="confirmPassword"
                                                               class="form-control input-about" ng-model="ctrl.confirm"
                                                               ng-change="ctrl.confirmPassword()" maxlength="190"></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><span id="confirmSpan"
                                                              class="span-red">Digite un mesmo password.</span>
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td></td>
                                                <td class="text-center">
                                                    @if (Auth::user()->password != null)
                                                        <button type="button" class="btn btn-success"
                                                                ng-disabled="ctrl.allSend"
                                                                ng-click="ctrl.processForm()">Enviar
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-success"
                                                                ng-disabled="ctrl.notAllSend"
                                                                ng-click="ctrl.processForm()">Enviar
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('afterScripts')
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular-animate.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular-sanitize.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
    <script src="{{ asset('js/angular/profile.js') }}"></script>
@stop

