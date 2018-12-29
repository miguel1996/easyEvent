@extends('layouts.app')
@section('scripts')
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
                    <h4>Manage {{$user->name}}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="/admin/users/{{$user->id}}/edit">
                        @csrf
                        <div class="form-group row">
                            <strong>Name</strong>   
                            <div class="col-md-6">
                               {{$user->name}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <strong>E-mail Adress</strong>

                            <div class="col-md-6">
                                {{$user->email}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input value="{{$user->date_of_birth}}" id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ old('date_of_birth') }}" required>

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
                                <input value="{{$user->address}}" id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>

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
                                <input value="{{$user->phone_number}}" id="phone_number" type="number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>

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
                                @if(strcmp($user->gender,"male") == 0)
                                    <input class="form-check-input" id="gendermale" type="radio" name="gender" value="male" required checked><label>Male</label>
                                    <input class="form-check-input" id="genderfemale" type="radio" name="gender" value="female" required><label>Female</label>
                                @else
                                    <input class="form-check-input" id="gendermale" type="radio" name="gender" value="male" required><label>Male</label>
                                    <input class="form-check-input" id="genderfemale" type="radio" name="gender" value="female" required checked><label>Female</label>
                                @endif
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
                            @php($groups = \App\Group::all())
                            <select id="group_id" name="group_id" required>
                            @foreach($groups as $group)
                            <option value="{{$group->id}}"
                            @if($user->group_id == $group->id) selected @endif
                            >{{$group->name}}</option>
                            @endforeach
                            </select>
                                   
                                @if ($errors->has('group_id'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('group_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password (Optional)') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                <br><strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password (Optional)') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="c_password">
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
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="form-group row mb-0">
                    <div id="submit-button" class="register links">
                    <button type="button" class="btn btn-primary">
                            {{ __('DELETE USER(APARECER UM ALERT PARA CONFIRMAR)') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection