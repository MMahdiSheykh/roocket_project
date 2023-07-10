@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Active Phone Number
                </div>

                <div class="card-body">
                    <form action="{{ route('twoFactorAuth.token') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="token" class="col-form-label">Token</label>
                        <input type="text" class="form-control @error('token') is-invalid @enderror" name="token" placeholder="Enter your token">
                        @error('token')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary mt-4">Validate token</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
