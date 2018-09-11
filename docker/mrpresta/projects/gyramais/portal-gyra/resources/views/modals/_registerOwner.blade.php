<!-- Modal Owner-->
<div class="modal fade modal-owner" id="modal-owner" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cadastro Colaborador</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('register-owner') }}">
                <div class="modal-body">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label owner-label-text">Nome</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                   required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label owner-label-text">Endereço de E-mail</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                        <label for="nickname" class="col-md-4 control-label owner-label-text">Nickname</label>

                        <div class="col-md-6">
                            <input id="nickname" type="nickname" class="form-control" name="nickname"
                                   value="{{ old('nickname') }}" required>

                            @if ($errors->has('nickname'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('nickname') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label owner-label-text">Senha</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label owner-label-text">Confirmar
                            Senha</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registre-se</button>
                </div>
            </form>
        </div>

    </div>
</div>