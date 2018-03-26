@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card card">
                <div class="card-header">Email confirmation resend</div>

                <div class="card-body">

                    @include('Laraconfirm::emails.partials._alerts');

                    <form class="form-horizontal" method="POST" action="{{ route('email.confirmation.resend') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' :  '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Resend email
                                </button>
                                 <a class="btn btn-link" href="{{ route('login') }}">
                                    Login
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
