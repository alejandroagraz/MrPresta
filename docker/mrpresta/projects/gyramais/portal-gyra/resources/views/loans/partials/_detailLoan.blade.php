<div class="table-responsive">
    <table class="table" ng-show="loan.balance.msg == undefined">
        <tbody>
        <tr class="titulos-consolidados">
            <th class="text-center">Saldo Devedor</th>
            <th class="text-center">Juros não vencidos</th>
            <th class="text-center">Saldo Vencido</th>
            <th class="text-center" colspan="4">Penalidades: @{{
                loan.balance.intereses_vencidos_total | number:2 }}
            </th>
            <th class="text-center">IOF Extra</th>
            <th class="text-center">Total a Pagar</th>
            <th class="text-center">Total Deuda</th>
            <th class="text-center">Atualização</th>
        </tr>
        <tr>
            <td class="montos-consolidados text-center"><strong>Principal</strong>
                <br>@{{ loan.balance.saldo_insoluto_total | number:2 }}
            </td>

            <td class="montos-separador montos-consolidados text-center"><strong>Insolutos</strong>
                <br>@{{ loan.balance.intereses_regulares | number:2 }}
            </td>

            <td class="montos-separador montos-consolidados text-center"><strong>Principal</strong>
                <br>@{{ loan.balance.exigibles_total | number:2 }}
            </td>

            <td class="montos-separador montos-consolidados text-center"><strong>Juros
                    Vencidos</strong>
                <br>@{{ loan.balance.intereses_regulares_exigibles | number:2}}
            </td>
            <td class="montos-consolidados text-center"><strong>Juros
                    Remuneratorios</strong> <br>@{{ loan.balance.intereses_mora |
                number:2}}
            </td>
            <td class="montos-consolidados text-center"><strong>Juros
                    Atrasos</strong> <br>@{{
                loan.balance.intereses_atrasos_acumulados | number:2}}
            </td>
            <td class="montos-consolidados text-center"><strong>Multa</strong> <br>@{{
                loan.balance.intereses_compensatorios | number:2}}
            </td>

            <td class="montos-separador montos-consolidados text-center"><strong>Quantidade</strong>
                <br>@{{ loan.balance.iof_extra | number:2 }}
            </td>
            <td class="montos-separador montos-consolidados text-center"><strong>Exigible</strong>
                <br>@{{ loan.balance.totalAPagar | number:2 }}
            </td>

            <td class="montos-separador montos-consolidados text-center"><strong>Quantidade</strong>
                <br>@{{ loan.balance.total | number:2}}
            </td>

            <td class="montos-separador montos-consolidados text-center"><strong>Data</strong>
                <br>@{{ loan.balance.fecha_actualizacion }}
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <div id="fixedTable">
        <table id="fixTable" class="table">
            <thead>
            <tr>
                <th class="text-right"><span>Per.</span></th>

                <th class="text-right"><span>Data Compromisso</span>
                </th>

                <th class="text-right saldoInsoInicial "
                    id="th_pago_saldo_insoluto_inicial"><span
                            ng-click="saldoInsolutoInicialPagos();">Saldo Inicial.</span>
                </th>
                <th class="text-right amortEsp"
                    id="th_pago_amortizacion"><span ng-click="amortizacionPagos();">Princ. Esp.</span>
                </th>
                <th class="text-right intereses" id="th_intereses"><span><a
                                href="#th_intereses"
                                ng-click="Intereses()">Juros </a></span></th>
                <th class="text-right intereses"
                    ng-show="columnas_intereses"><span>Int. Reg.</span></th>
                <th class="text-right intereses"
                    ng-show="columnas_intereses">
                    <span>Int. sobre Saldo Exigible.</span></th>
                <th class="text-right intereses"
                    ng-show="columnas_intereses"><span>Penalidad.</span></th>

                <th class="text-right" ng-show="columnas_intereses">
                    <span>Juros Atrasos</span></th>

                <th class="text-right iof" id="th_iof"><span><a
                                href="#th_iof" ng-click="Iof()">IOF E.</a></span>
                </th>
                <th class="text-right iof" ng-show="columnas_iof"><span>IOF</span>
                </th>
                <th class="text-right iof" ng-show="columnas_iof"><span>IOF Extra</span>
                </th>

                <th class="text-right amortApli" id="th_pagos"><span
                            ng-click="Pagos();">Princ. Apli. </span></th>

                <th class="text-right anticipo" id="th_pagos"><span
                            ng-click="Anticipo();">Anticipo</span></th>
                <th class="text-right"><span>Monto Cuota/Pago </span>
                </th>
                <th class="text-right saldoInsoFinal"
                    id="th_pago_saldo_insoluto_final"><span
                            ng-click="saldoInsolutoFinal();">Saldo Ins. Fin. </span>
                </th>
                <th class="text-right"><span>Boleto</span></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="projection in loan.credit_projection"
                ng-show="projection.periodo > 0">
                <!-- Periodos -->
                <td class="text-right"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)">
                    @{{ projection.periodo }}
                </td>

                <!-- Fecha Compromiso y Fecha de Pago -->
                <td class="text-right"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="projection.pago!=1 && projection.fecha_pago==''">@{{
                    projection.fecha_corte | limitTo:10 }}
                </td>
                <td class="text-right"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="projection.pago==1 && projection.fecha_pago!=''">@{{
                    projection.fecha_pago | limitTo:10 }}
                </td>

                <!-- Saldo Insoluto Inicial -->
                <td class="text-right saldoInsoInicial"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="projection.pago!=1">@{{ projection.saldo_principal |
                    number:2 }}
                </td>
                <td class="text-right saldoInsoInicial"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="projection.pago==1"></td>
                <!-- Amortizacion Esperada -->
                <td class="text-right amortEsp"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)">
                    @{{ projection.amortizacion_principal | number:2 }}
                </td>

                <!-- Intereses -->
                <td class="text-right intereses"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)">
                    @{{ projection.intereses | number:2 }}
                </td>
                <!-- Intereses Regular -->
                <td class="text-right intereses"
                    ng-class="ctrl.cellClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="columnas_intereses">@{{ projection.intereses_regulares
                    | number:2 }}
                </td>
                <!-- Intereses Mora -->
                <td class="text-right intereses"
                    ng-class="ctrl.cellClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="columnas_intereses">@{{ projection.intereses_mora |
                    number:2 }}
                </td>
                <!-- Intereses Comision -->
                <td class="text-right intereses"
                    ng-class="ctrl.cellClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="columnas_intereses">@{{
                    projection.intereses_compensatorios | number:2 }}
                </td>

                <td class="text-right"
                    ng-class="ctrl.cellClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="columnas_intereses">@{{ projection.intereses_atrasos |
                    number:2 }}
                </td>
                <!-- IOF -->
                <td class="text-right iof"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)">
                    @{{ projection.iof + projection.iof_extra | number:2 }}
                </td>
                <!-- IOF -->
                <td class="text-right iof"
                    ng-class="ctrl.cellClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="columnas_iof">@{{ projection.iof | number:2 }}
                </td>
                <!-- IOF Extra -->
                <td class="text-right iof"
                    ng-class="ctrl.cellClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="columnas_iof">@{{ projection.iof_extra | number:2 }}
                </td>

                <!-- Amortizacion Aplicada -->
                <td class="text-right amortApli"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)">
                    @{{ projection.pagos | number:2 }}
                </td>

                <!-- Anticipo -->
                <td class="text-right anticipo"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)">
                    @{{ projection.anticipo_total | number:2 }}
                </td>

                <!-- Monto Cuota y Monto Pago -->
                <td class="text-right"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="projection.pago!=1">@{{ projection.monto_cuota |
                    number:2 }}
                </td>
                <td class="text-right"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)"
                    ng-show="projection.pago==1">@{{ projection.monto_pago |
                    number:2 }}
                </td>

                <!-- Saldo Insoluto Final -->
                <td class="text-right saldoInsoFinal"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)">
                    @{{ projection.saldo_principal_final | number:2 }}
                </td>
                <td class="text-right"
                    ng-class="ctrl.rowClass(projection.pago, projection.pago_parcial, projection.periodo_vencido)">
                    <div class="text-right">
                        <a target="_blank" ng-show="projection.invoice_id != null"
                           href="https://faturas.iugu.com/@{{projection.invoice_id}}">
                            <i class="fa fa-search"></i>
                        </a>
                        @{{ (projection.pago == 1)? projection.status_invoice : ( (projections[$index +
                        1].periodo_vencido == 1 && projection.periodo_vencido == 1) || projections[$index + 1].pago ==
                        1)? '' : projection.status_invoice}}
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>