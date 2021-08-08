@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Accounts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ 'https://tikapi.io/account/authorize?client_id=c_RBN1ZCXSRK&redirect_uri=https://866aa5f79fab.ngrok.io/get-account-key&scope=view_profile%20edit_profile%20media_actions%20follow_actions%20search&state='.Auth::user()->id }}" class="text-center">Connect an  account</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
