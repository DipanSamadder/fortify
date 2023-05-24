@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background:red">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <button>logout</button>
                    </form>
                    {{ __('You are logged in!') }}
                    @if (session('status') == 'two-factor-authentication-enabled')
                        <div class="mb-4 font-medium text-sm">
                            Please finish configuring two factor authentication below.
                        </div>
                    @endif
                    <form action="/user/two-factor-authentication" method="post">
                        @csrf
                        @if (auth()->user()->two_factor_secret)
                            Enable
                            <div class="mb-5">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}

                            </div>
                            @method('DELETE')
                            <button class="btn btn-primary">Disable</button>
                        @else
                            Disable
                            <button class="btn btn-primary">Enable</button>
                        @endif
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection