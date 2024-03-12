@extends('clients.layouts.app')
@section('contents')
    <div class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Chi tiết sản phẩm</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.htm">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Section start -->
    <div class="container-fluid bg-white py-5 px-5">
        <div class="row gx-4 gy-5">
            <div class="col-lg-12 col-12">
                <div class="details-items">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <img src="{{ $product->img }}" alt="" class="img-fluid">
                        </div>

                        <div class="col-md-6">
                            <div class="cloth-details-size">

                                <div class="details-image-concept">
                                    <h2>{{ $product->name }}</h2>
                                </div>
                                <div class="details-image-concept">
                                    <h2>So luong : {{ $product->quantity }}</h2>
                                </div>

                                <div class="label-section">
                                    <span class="badge badge-grey-color">#1 Best seller</span>
                                    <span class="label-text">trong Thuê Xe</span>
                                </div>

                                <h3 class="price-detail">{{ number_format($product->price) . ' VNĐ' }}
                                    <del>{{ number_format($product->price - 2000000) . ' VNĐ' }}</del><span>55%
                                        off</span>
                                </h3>
                                <div class="product-buttons">
                                    @if ($product->status == config('app.status.DEACTIVE'))
                                        <a href="" class="btn btn-danger hover-solid btn-animation">
                                            <span>Hết hàng</span>
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="btn btn-solid">
                                            <i class="fa fa-bookmark fz-16 me-2"></i>
                                            <span>Yêu thích</span>
                                        </a>
                                        <a href="javascript:void(0)"
                                            onclick="event.preventDefault();document.getElementById('addtocart').submit();"
                                            id="cartEffect" class="btn btn-solid hover-solid btn-animation">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>Thuê Xe</span>
                                            <form id="addtocart" method="post" action="{{ route('client.add.cart') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}">
                                                <input type="hidden" name="quantity" id="qty" value="1">
                                            </form>
                                        </a>
                                    @endif
                                </div>
                                <div class="" style="height: 250px">
                                    {{ $product->description }}
                                </div>
                                <div class="border-product">
                                    <h6 class="product-title d-block">share it</h6>
                                    <div class="product-icon">
                                        <ul class="product-social">
                                            <li>
                                                <a href="https://www.facebook.com/">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.google.com/">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.instagram.com/">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li class="pe-0">
                                                <a href="https://www.google.com/">
                                                    <i class="fas fa-rss"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="cloth-review">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#desc"
                                type="button">Chi tiết</button>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="desc">
                            <div class="shipping-chart">
                                <div class="part">
                                    <h4 class="inner-title mb-2">⭐ Anh em lưu ý: </h4>
                                    <p class="font-light">
                                        Thuê xê cần gặp mặt trực tiếp thì liên hê: 123456789
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Section end -->
@endsection
