@extends('layouts.general')
@section('title')
    Aplicações
@stop
@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Inicio</a></li>
        <li class="active">Aplicações</li>
    </ol>
@stop
@section('pageHeader')
    Aplicações
@stop
{{--@section('pageHeaderText')
    header small text go22es here...
@stop--}}
@section('afterStyles')
    <link href="{{ asset('components/angular-bootstrap/ui-bootstrap-csp.css') }}" rel="stylesheet"/>
@stop
@section('content')
    <div ng-app="applicationModule" ng-controller="applicationCtrl as ctrl">

        <div class="row">
            <div class="col-md-12 no-padding">
                <div class="col-md-10 col-sm-10 col-xs-8 no-padding-left">
                </div>

                <div class="col-md-2 col-sm-2 col-xs-4 no-padding-right">
                    <button type="button" class="btn btn-success btn-custom btn-new-app" ng-click="ctrl.modalNewApp()"><i class="fa fa-plus"></i> Novo Empréstimo
                    </button>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="panel panel-inverse" ng-class="{'panel-loading' : ctrl.loading}"
                 data-sortable-id="table-basic-7">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           ng-click="ctrl.reloadData()"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Oportunidades</h4>
                </div>

                <div class="panel-body">
                    <div class="panel-loader" ng-show="ctrl.loading"><span class="spinner-small"></span></div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Date / Application</th>
                                <th>Amount Request</th>
                                <th>Status</th>
                                <th>Amount Approved</th>
                                <th>Tenor</th>
                                <th>Rate</th>
                                <th>History Changes</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="opportunity in ctrl.opportunities">
                                <td>@{{ opportunity.disburse_date }}</td>
                                <td>@{{ opportunity.amount_requested }}</td>
                                <td>@{{ opportunity.status }}</td>
                                <td>@{{ opportunity.amount_approved }}</td>
                                <td>@{{ opportunity.tenor }} <span ng-show="opportunity.tenor != '-----------'">months</span></td>
                                <td>@{{ opportunity.regular_rate }}</td>
                                <td class="text-center"><a ng-click="ctrl.showModal(opportunity)" ng-show="opportunity.hasChanges"><i
                                                class="fa fa-search"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Emprestimo -->
        <script type="text/ng-template" id="newAppModalContent.html">
            <div class="modal-app" id="modal-app">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Novo Emprestimo</h4>
                    </div>
                    <div class="modal-body">
                        <form name="formApp" class="form-horizontal" novalidate>
                            <div class="row" ng-show="formApp.$invalid && !formApp.$pristine">
                                <div class="alert alert-danger fade in">
                                    <i class="fa fa-times fa-2x-custom pull-left"></i>
                                    <p>Pelo menos um campo não possui o valor correto.</p>
                                </div>
                                <div class="alert alert-danger fade in" ng-show="ctrl.errorApp">
                                    <i class="fa fa-times fa-2x-custom pull-left"></i>
                                    <p>Ocorreu um erro ao registrar o empréstimo, tente novamente.</p>
                                </div>
                            </div>
                            <input type="hidden" ng-model="ctrl.formData.client_id">
                            <div class="form-group" ng-class="{ 'has-error-btn' : formApp.amount.$invalid && !formApp.amount.$pristine }">
                                <label class="col-md-3 control-label">Amount</label>
                                <div class="col-md-9">
                                    <select ng-required="true" class="form-control" ng-model="ctrl.formData.amount">
                                        <option value="">Valor Desejado</option>
                                        <option ng-repeat="item in ctrl.items.amounts" value="@{{item}}">
                                            R$ @{{ item }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{ 'has-error-btn' : formApp.tenor.$invalid && !formApp.tenor.$pristine }">
                                <label class="col-md-3 control-label">Tenor</label>
                                <div class="col-md-9">
                                    <select ng-required="true" class="form-control" ng-model="ctrl.formData.tenor">
                                        <option value="">Prazo</option>
                                        <option ng-repeat="item in ctrl.items.tenors" value="@{{item}}">
                                            @{{ item }} meses
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-disabled="formApp.$invalid" ng-click="ctrl.processForm()">Send App</button>
                        <button type="button" class="btn btn-danger" ng-click="ctrl.cancel()">Cancelar</button>
                    </div>
                </div>
            </div>
        </script>
        <div class="modal-demo">
            <script type="text/ng-template" id="myModalContent.html">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title">History Changes</h3>
                </div>
                <div class="modal-body" id="modal-body">
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                        <ul class="timeline-custom- timeline-custom--horizontal">
                            <li class="timeline-custom--item" ng-repeat="item in ctrl.items.changes">
                                <div class="timeline-custom--badge @{{ item.class }}"><i class="fa @{{ item.icon }}"></i></div>
                                <div class="timeline-custom--panel">
                                    <div class="timeline-custom--heading">
                                        <h4 class="timeline-custom--title">@{{ item.field }}</h4>
                                        <p>
                                            <small class="text-muted"><i class="glyphicon glyphicon-time"></i>
                                                @{{ item.created_at | date:'MM/dd/yyyy @ h:mma'}}
                                            </small>
                                        </p>
                                    </div>
                                    <div class="timeline-custom--body">
                                        <p><strong>Old Value :</strong> @{{ item.old_value }}</p>
                                        <p><strong>New Value :</strong> @{{ item.new_value }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" type="button" ng-click="ctrl.cancel()">Fechar</button>
                </div>
            </script>
            <script type="text/ng-template" id="stackedModal.html">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-@{{name}}">The @{{name}} modal!</h3>
                </div>
                <div class="modal-body" id="modal-body-@{{name}}">
                    Having multiple modals open at once is probably bad UX but it's technically possible.
                </div>
            </script>

            <div ng-show="ctrl.selected">Selection from a modal: @{{ ctrl.selected }}</div>
            <div class="modal-parent">
            </div>
        </div>
    </div>
@stop
@section('afterScripts')
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular-animate.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular-sanitize.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
    <script src="{{ asset('js/angular/application.js') }}"></script>
@stop
