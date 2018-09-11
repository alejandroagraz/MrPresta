<link href="{{ asset('css/pdfDetailContract.css') }}" rel="stylesheet"/>
<table class="table-detail" cellspacing="0" cellpadding="5">
    <tbody>
    <tr>
        <td><strong>Conta:</strong> {{ $detail->nombre_cuenta }}</td>
        <td><strong>Oportunidade:</strong> {{ $detail->oportunidad_nombre }}</td>
        <td><strong>Nome do Usuario:</strong> {{ $detail->nombre_usuario }}</td>
        <td><strong>Status:</strong> {{ $detail->estatus }}</td>

    </tr>
    <tr>
        <td><strong>Nominal:</strong> {{ $detail->monto_preaprobado | number_format(2) }}</td>
        <td><strong>Taxa de Juros:</strong> {{ $detail->tasa_regular }}%</td>
        <td><strong>Taxa de Juros Atrasos:</strong> {{ $detail->tasa_mora }}%</td>
        <td><strong>Comissão:</strong> {{ $detail->comision }}%</td>
    </tr>
    <tr>
        <td><strong>Valor de Principal:</strong>
            {{ $detail->monto_preaprobado  | number_format(2) }}
        </td>
        <td><strong>Prazo - Meses:</strong> {{ $detail->plazo }}</td>
        <td><strong>Tipo Pessoa:</strong> {{ $detail->tipo_persona }}</td>
        <td><strong>Data de Pagamento:</strong> {{ $detail->f_desembolso }}</td>
    </tr>
    <tr>
        <td><strong>Valor Transf. a Ins.:</strong> {{ $detail->monto_preaprobado  | number_format(2)}}</td>
        <td><strong>IOF Total:</strong> {{ $detail->iof_total | number_format(2) }}</td>
        <td><strong>Portfólio:</strong> {{ $detail->portafolio }}</td>
        <td><strong>Ins. Parceiro:</strong> {{ $detail->partner_institution }}</td>
    </tr>
    <tr>
        <td><strong>Código da Proposta:</strong> {{ $detail->cod_prestamo | number_format(2) }}</td>
        <td><strong>Número de CCB:</strong> {{ $detail->num_ccb }}</td>
    </tr>
    </tbody>
</table>

<br><br>
<table class="table-detail" cellspacing="0" cellpadding="5">
    <tbody>
    <tr class="titulos-consolidados">
        <th>Saldo Devedor</th>
        <th>Juros não vencidos</th>
        <th>Saldo Vencido</th>
        <th colspan="4">Penalidades: {{ $consolidated->intereses_vencidos_total | number_format(2) }}</th>
        <th>IOF Extra</th>
        <th>Total a Pagar</th>
        <th>Total Deuda</th>
        <th>Atualização</th>
    </tr>
    <tr class="montos-consolidados">
        <td><strong>Principal</strong> <br>{{ $consolidated->saldo_insoluto_total | number_format(2) }}</td>

        <td class="montos-separador"><strong>Insolutos</strong>
            <br>{{ $consolidated->intereses_regulares | number_format(2) }}</td>

        <td class="montos-separador"><strong>Principal</strong>
            <br>{{ $consolidated->exigibles_total | number_format(2) }}</td>

        <td class="montos-separador"><strong>Juros Vencidos</strong>
            <br>{{ $consolidated->intereses_regulares_exigibles | number_format(2)}}</td>
        <td><strong>Juros Remuneratorios</strong> <br>{{ $consolidated->intereses_mora | number_format(2)}}</td>
        <td><strong>Juros Atrasos</strong> <br>{{ $consolidated->intereses_atrasos_acumulados | number_format(2)}}</td>
        <td><strong>Multa</strong> <br>{{ $consolidated->intereses_compensatorios | number_format(2)}}</td>

        <td class="montos-separador"><strong>Quantidade</strong> <br>{{ $consolidated->iof_extra | number_format(2) }}
        </td>
        <td class="montos-separador"><strong>Exigible</strong>
            <br>{{ $consolidated->totalAPagar | number_format(2) }}</td>

        <td class="montos-separador"><strong>Quantidade</strong> <br>{{ $consolidated->total | number_format(2)}}</td>

        <td class="montos-separador"><strong>Data</strong> <br>{{ $consolidated->fecha_actualizacion }}
        </td>
    </tr>
    </tbody>
</table>


<br><br>
<table class="table-detail" cellspacing="0" cellpadding="5">
    <thead>
    <tr>
        <th>Per.</th>
        <th>Data Compromisso</th>
        <th>Saldo Inicial</th>
        <th>Principal esp.</th>
        <th>Juros</th>
        <th>IOF E.</th>
        <th>Princ. Apli.</th>
        <th>Anticipo</th>
        <th>Monto Cuota/Pago</th>
        <th>Saldo Ins. Fin.</th>

    </tr>
    </thead>
    <tbody>
    @foreach ($proyection as $p)
        @if ($p->periodo!=0)
            <tr class="@if ($p->pago == 0) periodo-pendiente @else periodo-pago @endif @if ($p->pago_parcial == 1) pago-parcial @endif @if ($p->pago_parcial ==1) periodo-vencido @endif"
            >
                <td>{{ $p->periodo }}</td>
                <td>
                    @if ($p->pago != 1 && $p->fecha_pago =='')
                        {{ $p->fecha_corte }}
                    @elseif ($p->pago == 1 && $p->fecha_pago !='')
                        {{ $p->fecha_pago }}
                    @endif
                </td>
                <td>{{ $p->saldo_principal }}</td>
                <td>{{ $p->amortizacion_principal }}</td>
                <td>{{ $p->intereses }}</td>
                <td>{{ $p->pagos}}</td>
                <td>{{ $p->pagos}}</td>
                <td>{{ $p->anticipo_total}}</td>
                <td>{{ $p->monto_cuota}}</td>
                <td>{{ $p->saldo_principal_final}}</td>

            </tr>
        @endif
    @endforeach
    </tbody>
</table>