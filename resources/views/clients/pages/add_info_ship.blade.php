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
                            <li class="breadcrumb-item active" aria-current="page">Info Ships</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section Start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form class="needs-validation" method="POST" action="">
                        @csrf
                        <div id="billingAddress" class="row g-4">
                            <h3 class="mb-3 theme-color">Thông tin giao hàng</h3>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Họ và tên">
                                @error('name')
                                    <p class="text-danger mt-2">Vui lòng nhập họ và tên</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Số điện thoại">
                                @error('phone')
                                    <p class="text-danger mt-2">Vui lòng nhập số điện thoại</p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="phone" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email">
                                @error('email')
                                    <p class="text-danger mt-2">Vui lòng nhập email</p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Địa chỉ">
                                @error('address')
                                    <p class="text-danger mt-2">Vui lòng nhập địa chỉ</p>
                                @enderror
                            </div>
                            <div class="col-md-12 d-flex flex-stuck justify-content-between">
                                <div class="col-md-4 me-2">
                                    <select class="form-control form-select form-select-sm mb-3" id="city"
                                        aria-label=".form-select-sm">
                                        <option value="" selected>Chọn tỉnh thành</option>
                                    </select>
                                    @error('province')
                                        <p class="text-danger mt-2">Vui lòng chọn tỉnh thành</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 me-2">
                                    <select class="form-control form-select form-select-sm mb-3" id="district"
                                        aria-label=".form-select-sm">
                                        <option value="" selected>Chọn quận huyện</option>
                                    </select>
                                    @error('district')
                                        <p class="text-danger mt-2">Vui lòng chọn quận huyện</p>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control form-select form-select-sm" id="ward"
                                        aria-label=".form-select-sm">
                                        <option value="" selected>Chọn phường xã</option>
                                    </select>
                                    @error('ward')
                                        <p class="text-danger mt-2">Vui lòng chọn phường xã</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="" hidden>
                                <input type="text" name="province" id="tinh" hidden>
                                <input type="text" name="district" id="huyen" hidden>
                                <input type="text" name="ward" id="phuong">
                            </div>
                        </div>
                        <button class="btn btn-solid-default mt-4" type="submit">Thêm thông tin giao hàng</button>
                    </form>
                </div>
            </div>
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
