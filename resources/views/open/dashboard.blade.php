@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route(App\Enums\EntityEnums::GET_USER_INFO) }}" target="_blank"
                            class="btn btn-primary">
                            My Tiktok info
                        </a>
                        <br><br>
                        <a href="{{ route(App\Enums\EntityEnums::FIND_USERNAME, 'charlidamelio') }}" target="_blank"
                            class="btn btn-primary">
                            Find <strong>@charlidamelio</strong>
                        </a>
                        <br><br>
                        <a href="{{ route(App\Enums\EntityEnums::FIND_HASHTAG, 'tiktok') }}" target="_blank"
                            class="btn btn-primary">
                            Find <strong>#tiktok</strong>
                        </a>
                        <br><br>
                        <a href="{{ route(App\Enums\EntityEnums::FOLLOW_USER, 'charlidamelio') }}" target="_blank"
                            class="btn btn-primary disabled">
                            Follow <strong>@charlidamelio</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
