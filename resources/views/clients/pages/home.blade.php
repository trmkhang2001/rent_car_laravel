@extends('clients.layouts.app')
@section('contents')
    @include('clients.layouts.banner')
    <div class="container p-sm-0 bg-white mt-5">
        <div class="row g-sm-4 g-3 px-5 mb-4">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <h2 class="border-3 border-bottom border-primary p-1 text-uppercase">Xe Sẵn Sàng Để Thuê</h2>
                    <a href="/product" class="fw-bold text-uppercase">Xem thêm</a>
                </div>
            </div>
        </div>
        <div class="row g-sm-4 g-3 px-5">
            @foreach ($items as $product)
                <div class="row mb-4">
                    <div class="d-flex flex-stack">
                        <div class="col-4">
                            <a href="{{ route('client.page.detail', $product->id) }}">
                                <img src="{{ $product->img }}" class="card-img-top" alt="...">
                            </a>
                        </div>
                        <div class="col-8 card-body">
                            <a href="{{ route('client.page.detail', $product->id) }}"
                                class="fs-5 fw-bold text-uppercase pd-name tit-pro text-center" style="color: black">
                                {{ $product->name }}</a>
                            <div class="">
                                <p>{{ $product->description }}</p>
                            </div>
                            <div class="d-flex flex-wrap">
                                <p class="fs-6 fw-bold text-danger">Giá thuê : {{ number_format($product->price) . ' đ' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row g-sm-4 g-3 px-5">
            <div class="my-5">
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection
