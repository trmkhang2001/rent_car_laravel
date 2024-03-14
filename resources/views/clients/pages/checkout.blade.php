@extends('clients.layouts.app')
@section('contents')
    <section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
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
                    <h3>Checkout</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section Start -->
    <section class="section-b-space">
        <div class="container">
            <form class="needs-validation" action="" method="POST">
                @csrf
                @if ($infoShip->count() > 0)
                    <div class="row mb-3">
                        <div class="d-flex flex-wrap justify-content-between my-3">
                            <div class="">
                                <h3 class="mb-3 theme-color">Sử dụng thông tin có sẵn</h3>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label for="" class="form-label">Ngày đặt: </label>
                                        <input type="date" name="setDate" class="form-control">
                                    </div>
                                    <div class="me-3">
                                        <label for="" class="form-label">Ngày trả:</label>
                                        <input type="date" name="dropDate" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                {{-- <div class="mb-3">
                                    <input type="radio" name="vnpay" id="flexCheckDefault" value="1"> Thanh toán
                                    VNPAY
                                </div> --}}
                                <div class="mb-3">
                                    <input type="radio" name="vnpay" id="flexCheckDefault" value="0" checked> Lấy
                                    Xe Tại Cửa Hàng
                                </div>
                                <button type="submit" class="btn btn-solid-default "> Đặt hàng </button>
                            </div>
                        </div>
                        @foreach ($infoShip as $index => $info)
                            <div class="col-6 mb-2">
                                <div class="card p-3">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="infoShip"
                                                    id="flexRadioDefault1" value="{{ $info->id }}"
                                                    @if ($index == 0) : {{ 'checked' }} @endif>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Dùng địa chỉ này
                                                </label>
                                            </div>
                                            <span>Tên là: {{ $info->name }}</span>
                                            <span>Số điện thoại: {{ $info->phone }} , Email: {{ $info->email }}</span>
                                            <span>Địa chỉ: {{ $info->address }}, {{ $info->ward }},
                                                {{ $info->district }},{{ $info->province }}</span>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ route('client.delete.info', $info->id) }}"
                                                class="btn btn-danger mb-2">
                                                Xóa
                                            </a>
                                            <a href="" class="btn btn-warning">
                                                Sửa
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-end my-3">
                            <a href="/addinfoship" class="btn btn-primary">Thêm địa chỉ giao hàng !</a>
                        </div>
                    </div>
                @else
                    <div class="row mb-3">
                        <div class="d-flex flex-wrap justify-content-between my-3">
                            <h3 class="mb-3 theme-color">Bạn chưa có địa chỉ giao hàng</h3>
                            <a href="/addinfoship" class="btn btn-primary">Thêm địa chỉ giao hàng !</a>
                        </div>
                    </div>
                @endif
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-8">
                        <img class="img-fluid" src="{{ asset('images/shipping.png') }}" alt="">
                    </div>
                    <div class="col-lg-4">
                        <h3 class="mb-3 theme-color">Thông tin giỏ hàng</h3>
                        <div class="your-cart-box">
                            <h3 class="mb-3 d-flex text-capitalize">Your cart<span
                                    class="badge bg-theme new-badge rounded-pill ms-auto bg-dark">{{ $cartItems->count() }}</span>
                            </h3>
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between lh-condensed active">
                                    <div class="text-dark">
                                        <h6 class="my-0">Tên sản phẩm</h6>
                                        <small></small>
                                    </div>
                                    <span>Thành tiền</span>
                                </li>
                                <?php $total = config('app.ship.PRICE'); ?>
                                @foreach ($cartItems as $item)
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div class="text-dark">
                                            <h6 class="my-0">{{ $item->name }}</h6>
                                            <small></small>
                                        </div>
                                        <span>{{ number_format($item->price * $item->qty) . ' VNĐ' }}</span>
                                    </li>
                                    <?php $total += $item->price * $item->qty; ?>
                                @endforeach
                                <a href="/cart" class="btn btn-solid-default mt-4">Quay về giỏ hàng</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Cart Section End -->
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Id);
            }
            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Id === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Id);
                    }
                }
                var selectedOption = citis.options[citis.selectedIndex];
                var selectedTinh = selectedOption.text;
                var tinh = document.getElementById("tinh");
                tinh.value = selectedTinh;
            };
            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Id === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Id);
                    }
                }
                var selectedOption = district.options[district.selectedIndex];
                var selectedHuyen = selectedOption.text;
                var huyen = document.getElementById("huyen");
                huyen.value = selectedHuyen;
            };
            wards.onchange = function() {
                var selectedOption = wards.options[wards.selectedIndex];
                var selectedPhuong = selectedOption.text;
                var phuong = document.getElementById("phuong");
                phuong.value = selectedPhuong;
            }
        }
    </script>
@endpush
