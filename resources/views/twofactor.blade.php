@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Two factor authentication settings</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings/twofactor') }}">
                            <div class="form-group{{ $errors->has('two_factor_type') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <select name="two_factor_type" id="two_factor_type" class="form-control">
                                            <option value="">Off</option>
                                        </select>

                                        @if ($errors->has('two_factor_type'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('two_factor_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone_number_dialling_code') ? ' has-error' : '' }}">
                                <label for="phone_number_dialling_code" class="col-md-4 control-label">Dialling code</label>

                                <div class="col-md-6">
                                    <select name="phone_number_dialling_code" id="phone_number_dialling_code" class="form-control">
                                        <option value="">United Kingdom (+44)</option>
                                    </select>

                                    @if ($errors->has('phone_number_dialling_code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone_number_dialling_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label for="phone_number" class="col-md-4 control-label">Phone number</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control" name="phone_number">

                                    @if ($errors->has('phone_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> Update
                                    </button>
                                </div>
                            </div>

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
