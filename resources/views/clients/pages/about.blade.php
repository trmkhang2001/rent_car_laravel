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
                    <h3>Giới thiệu</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.htm">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">About</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Section start -->
    <div class="container-fluid bg-white py-5">
        <div class="container">
            <div style="display: inline-block">
                <h3 class="fw-bold border-3 border-bottom border-primary p-1 text-uppercase">GIỚI THIỆU VỀ THUÊ XE 123</h3>
            </div>
            <div class="d-flex flex-column fs-5">
                <span class="mt-4">Tên công ty: Thuê Xe 123</span>
                <span>Tên viết tắt: Thuê Xe 123</span>
                <span>MST: 123456789</span>
                <span>Trụ sở (Địa chỉ đăng ký): 123 NTV, Phường 4, Quận 1, Tp. Hồ Chí Minh</span>
                <span>
                    Showroom :
                </span>
                <span>Trung tâm bảo hành : </span>
            </div>
            <div class="mt-4">
                <img class="d-block w-100" src="{{ asset('images/showroom.jpg') }}" alt="">
            </div>
        </div>
    </div>
@endsection
