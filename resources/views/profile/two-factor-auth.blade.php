@extends('profile.layout')

@section('index-route')
{{ route('profile') }}
@endsection

@section('main')
<h4>Two Factor Authentication</h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="#" method="post">
    @csrf

    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control">
            @foreach (config('twoFactorAuth.types') as $key => $value)
                <option value="{{ $key }}" {{ old('type') == $key || auth()->user()->hasTwoFactor($key) ? 'Selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-3">
        <label for="phone_number">Phone_number</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Please add your number" value="{{ old('phone_number') ?? auth()->user()->phone_number }}">
    </div>

    <div class="form-group mt-4">
        <button class="btn btn-primary">
            Update
        </button>
    </div>
</form>

@endsection


