@extends('layouts.app')
@section('scripts')
<script type="text/javascript" src="{{asset('js/scripts/validator.js')}}"></script>
<script type= "text/javascript">
    $(document).ready(function(){$("#admin-button").addClass("active");});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Register a new user') }}</h4>
                </div>

                <div class="card-body">
                    <form name="register_user" method="POST" action="/admin/users/register">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                <p class="span_emsg"><span name="name" class="emsg hidden">Please Enter a Valid Name</span></p>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                <p class="span_emsg"><span name="email" class="emsg hidden">Please Enter a Valid E-mail</span></p>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ old('date_of_birth') }}" required>

                                @if ($errors->has('date_of_birth'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('date_of_birth') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>
                                <p class="span_emsg"><span name="phone_number" class="emsg hidden">Please Enter a Valid Phone Number</span></p>
                                @if ($errors->has('phone_number'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6 col-md-4 col-form-label text-md-center">
                                <input class="form-check-input" id="gendermale" type="radio" name="gender" value="male" required><label>Male</label>
                                <input class="form-check-input" id="genderfemale" type="radio" name="gender" value="female" required><label>Female</label>
                                @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="group_id" class="col-md-4 col-form-label text-md-right">{{ __('Group/Permissions') }}</label>

                            <div class="col-md-6">
                                <select id="group_id" name="group_id" required>
                                    <option style="display:none"></option>
                                    <option value="1">admin</option>
                                    <option value="2">member</option>
                                    <option value="3">event manager</option>
                                </select>
                                @if ($errors->has('group_id'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('group_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="c_password" required>
                                <p class="span_emsg"><span name="c_password" class="emsg hidden">Not the same as password!</span></p>
                                @if ($errors->has('c_password'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('c_password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div id="submit-button" class="register links">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register new user') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection