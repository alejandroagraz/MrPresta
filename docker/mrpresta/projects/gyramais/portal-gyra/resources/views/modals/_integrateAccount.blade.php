<!-- Modal Accounts -->
<div class="modal fade modal-account" id="modal-account" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Selecione a Conta</h4>
            </div>
            <div class="modal-body">
                <a href="{{ url('auth/mercadolibre/MLB') }}" class="account-img">
                    <img class="account-img" src="{{ asset('assets/img/account/mercadolivre.png') }}"/>
                </a>

                {{--<a href="{{ route('login-b2w') }}"  class="account-img">--}}
                    {{--<img class="account-img" src="{{ asset('assets/img/account/b2w.png') }}"/>--}}
                {{--</a>--}}

                {{--<a href="{{ route('login-squidfacil') }}"  class="account-img">--}}
                    {{--<img class="account-img" src="{{ asset('assets/img/account/squidfacil.png') }}"/>--}}
                {{--</a>--}}

                <a href="{{ route('login-facebook') }}"  class="account-img">
                    <img class="account-img" src="{{ asset('assets/img/account/facebook.png') }}"/>
                </a>

                <a href="{{ route('login-google') }}" class="account-img">
                    <img class="account-img" src="{{ asset('assets/img/account/googleplus.png') }}"/>
                </a>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>