<!-- Modal -->
<form method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    <div class="modal fade" id="forgotPasswordModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">FORGOT PASSWORD</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-sm btn-primary" value="Send Password Reset Link">
                </div>
            </div>
        </div>
    </div>
</form>

@section('scripts')
    @if ($errors->has('email'))
        <script>
            $('#forgotPasswordModal').modal("show");
        </script>
    @endif
@endsection
