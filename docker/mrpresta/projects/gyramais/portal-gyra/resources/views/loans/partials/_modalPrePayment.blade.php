<script type="text/ng-template" id="prePaymentModalContent.html">
    <div class="modal-app" id="modal-app">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Boleto Pre-Pagado</h4>
            </div>
            <div class="modal-body">
                <form name="formPrePayment" class="form-horizontal" novalidate>
                    <div class="alert alert-danger fade in" ng-show="ctrl.loanCustom.invoice_supplemental || ctrl.loanCustom.invoice_without_paying">
                        <i class="fa fa-times fa-2x-custom pull-left"></i>
                        <p>Você já possui uma fatura registrada, você deve efetuar o pagamento para poder emitir uma nova fatura.</p>
                    </div>
                    <input type="hidden" ng-model="ctrl.form.period_id" name="period_id">
                    <div class="row" ng-show="formPrePayment.$invalid && !formPrePayment.$pristine">

                        <div class="alert alert-danger fade in">
                            <i class="fa fa-times fa-2x-custom pull-left"></i>
                            <p>Pelo menos um campo não possui o valor correto.</p>
                        </div>
                        <div class="alert alert-danger fade in" ng-show="ctrl.errorPrePayment">
                            <i class="fa fa-times fa-2x-custom pull-left"></i>
                            <p>Ocorreu um erro ao registrar o empréstimo, tente novamente.</p>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : formPrePayment.amount.$invalid && !formPrePayment.amount.$pristine }">
                        <label class="col-md-3 control-label">Quantidade</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="amount" ng-min="0.01"
                                   ng-model="ctrl.form.amount" ng-required="true"
                                   ng-disabled="ctrl.loanCustom.invoice_supplemental || ctrl.loanCustom.invoice_without_paying"
                                   format="number"
                                   placeholder="Quantidade"/>

                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : formPrePayment.payment_date.$invalid && !formPrePayment.payment_date.$pristine }">
                        <label class="col-md-3 control-label">Data</label>
                        <div class="col-md-9">
                            <p class="input-group" >
                                <input type="text" ng-required="true" class="form-control"
                                       uib-datepicker-popup="dd/MM/yyyy"
                                       ng-model="ctrl.form.payment_date" name="payment_date"
                                       ng-disabled="ctrl.loanCustom.invoice_supplemental || ctrl.loanCustom.invoice_without_paying"
                                       is-open="ctrl.popup1.opened"
                                       datepicker-options="ctrl.dateOptions" ng-required="true" close-text="Close"
                                       alt-input-formats="ctrl.altInputFormats" current-text="Tonight"
                                       clear-text="Reset" close-text="Exit"/>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" ng-class="{ 'has-error-btn' : formPrePayment.payment_date.$invalid && !formPrePayment.payment_date.$pristine }" ng-click="ctrl.openDatePicker()">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </button>
                                </span>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" ng-disabled="formPrePayment.$invalid || ctrl.loanCustom.invoice_supplemental || ctrl.loanCustom.invoice_without_paying"
                        ng-click="ctrl.processForm()">Emitir Boleto
                </button>
                <button type="button" class="btn btn-danger" ng-click="ctrl.cancel()">Cancelar</button>
            </div>
        </div>
    </div>
</script>