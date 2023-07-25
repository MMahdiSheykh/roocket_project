@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($products->chunk(4) as $row)
                    <div class="row">
                        @foreach($row as $product)
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <a href="/product/{{ $product->id }}" class="btn btn-primary center">Detail . . .</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
