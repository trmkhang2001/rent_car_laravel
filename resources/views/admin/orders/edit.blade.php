<?php $total = 0; ?>
@extends('admin.layouts.app')
@section('title_page')
    <div class="app-navbar-item ms-1 ms-md-3">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Order Edit</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Admin</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Order Edit</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
    </div>
@endsection
@section('contents')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="card m-5 mb-xxl-8 p-5">
            <div class="d-flex justify-content-end">
                <a href="/admin/order" class="btn btn-light">Quay lại</a>
            </div>
            <form class="needs-validation" method="POST" action="">
                @csrf
                <div id="billingAddress" class="row g-4">
                    <h3 class="mb-3 theme-color">Thông tin giao hàng</h3>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên"
                            value="{{ $order->name }}">
                        @error('name')
                            <p class="text-danger mt-2">Vui lòng nhập họ và tên</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại"
                            value="{{ $order->phone }}">
                        @error('phone')
                            <p class="text-danger mt-2">Vui lòng nhập số điện thoại</p>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="phone" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ $order->email }}">
                        @error('email')
                            <p class="text-danger mt-2">Vui lòng nhập email</p>
                        @enderror
                    </div>
                    <div class="col-md-12 fw-bold">
                        Địa chỉ giao hàng:
                        {{ $order->address . ',' . $order->ward . ',' . $order->district . ',' . $order->province }}
                        <a class="btn btn-primary btn-sm ms-5" data-bs-toggle="collapse" href="#collapseExample"
                            role="button" aria-expanded="false" aria-controls="collapseExample">
                            Cập nhật địa chỉ
                        </a>
                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="col-md-12 mb-5">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ"
                                value="{{ $order->address }}">
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
                    </div>
                </div>
                <div class="" hidden>
                    <input type="text" name="province" id="tinh" value="{{ $order->province }}" hidden>
                    <input type="text" name="district" id="huyen" value="{{ $order->district }}" hidden>
                    <input type="text" name="ward" id="phuong" value="{{ $order->ward }}" hidden>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mt-4" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
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
