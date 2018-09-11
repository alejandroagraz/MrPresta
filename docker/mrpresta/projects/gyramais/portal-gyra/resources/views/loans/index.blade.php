@extends('layouts.general')
@section('title')
    Emprestimos
@stop
@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Inicio</a></li>
        <li class="active">Emprestimos</li>
    </ol>
@stop
@section('pageHeader')
    Emprestimos
@stop
{{--@section('pageHeaderText')
    header small text go22es here...
@stop--}}
@section('afterStyles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet"/>
    <link href="{{ asset('components/angular-bootstrap/ui-bootstrap-csp.css') }}" rel="stylesheet"/>
@stop
@section('content')
    <div ng-app="loanModule" ng-controller="loanCtrl as ctrl">
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
                    <h4 class="panel-title">Emprestimos</h4>
                </div>

                <div class="panel-body">
                    <div class="panel-loader" ng-show="ctrl.loading"><span class="spinner-small"></span></div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr class="text-align">
                                <th></th>
                                <th># Loan</th>
                                <th>Disburse / Date</th>
                                <th>Amount</th>
                                <th>Rate</th>
                                <th>Tenor</th>
                                <th>Installment</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat-start="loan in ctrl.loans">
                                <td class="icon-loans align-middle" ng-click="loan.slideToggle=!loan.slideToggle"><i
                                            ng-class="{'ion-chevron-up': loan.slideToggle, 'ion-chevron-down': !loan.slideToggle}"
                                            class="ion-chevron-down"></i></td>
                                <td class="align-middle">@{{ loan.contract_number }}</td>
                                <td class="align-middle">@{{ loan.disburse_date }}</td>
                                <td class="align-middle">@{{ loan.amount }}</td>
                                <td class="align-middle">@{{ loan.rate }}%</td>
                                <td class="align-middle">@{{ loan.tenor }} months</td>
                                <td class="align-middle">R$ @{{ loan.installment }}</td>
                                <td class="align-middle">@{{ loan.status }}</td>
                                <td class="align-middle actions-icons">
                                    <div class="text-center">
                                        <a data-toggle="tooltip" title="Pre-Payment" ng-click="ctrl.showModalPrePayment(loan)">
                                            <i class="ion-cash fa-2x"></i>
                                        </a>
                                        <a ng-click="ctrl.generateDetailContractPDF(loan.contract_id)">
                                            &nbsp;&nbsp;<i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                        <form id="pdf" name="pdf" method="POST" action="{{ route('generate.pdf') }}">
                                            <input type="hidden" name="idContract" value="@{{ctrl.idContract}}">
                                            <input type="hidden" name="token" value="@{{ctrl.token}}">
                                            <input type="hidden" name="detailContract" value="@{{ctrl.contractDetail}}">
                                            <input type="hidden" name="consolidatedContract" value="@{{ctrl.contractConsolidated}}">
                                            <input type="hidden" name="proyectionContract" value="@{{ctrl.contractProyection}}">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr ng-repeat-end id="loans-@{{ loan.contract_id }}" class="slide-toggle"
                                ng-show="loan.slideToggle">
                                <td colspan="9" class="no-padding no-padding-top">
                                    @include('loans/partials/_detailLoan')
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Pre-Payments -->
        @include('loans/partials/_modalPrePayment')
    </div>
@stop
@section('afterScripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="//code.angularjs.org/1.6.5/i18n/angular-locale_pt-br.js"></script>
     <script src="{{ asset('js/angular/loan.js') }}"></script>
@stop
