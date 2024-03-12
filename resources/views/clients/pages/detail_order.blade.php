<?php $total = 0; ?>
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
                    <h3>Theo dõi đơn hàng</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.htm">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Order</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Section start -->
    <div class="container-fluid bg-white py-5">
        <div class="container">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10 mb-4">
                    <!--begin::Shipping address-->
                    <div class="col-6 card card-flush py-4 flex-row-fluid position-relative p-3">
                        <!--begin::Background-->
                        <div class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                            <i class="ki-solid ki-delivery" style="font-size: 13em">
                            </i>
                        </div>
                        <!--end::Background-->

                        <!--begin::Card header-->
                        <div class="card-header mb-4">
                            <div class="card-title">
                                <h2>Địa chỉ giao hàng:</h2>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0 fw-bold">
                            {{ $order->address }},<br>
                            {{ $order->ward }},<br>
                            {{ $order->district }},<br>
                            {{ $order->province }}.
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Shipping address-->
                    <!--begin::Khach hang info-->
                    <div class="col-6 card card-flush py-4 flex-row-fluid position-relative p-3">
                        <!--begin::Background-->
                        <div class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                            <i class="ki-solid ki-delivery" style="font-size: 13em">
                            </i>
                        </div>
                        <!--end::Background-->

                        <!--begin::Card header-->
                        <div class="card-header mb-4">
                            <div class="card-title">
                                <h2>Thông tin khách hàng:</h2>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0 fw-bold">
                            {{ $order->name }},<br>
                            {{ $order->phone }},<br>
                            {{ $order->email }}.<br>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Khach hang info-->
                </div>

                <!--begin::Product List-->
                <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ 'Order #' . $order->id }}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-175px">Tên sản phẩm</th>
                                        <th class="min-w-100px ">SKU</th>
                                        <th class="min-w-70px ">Số lượng</th>
                                        <th class="min-w-100px ">Giá</th>
                                        <th class="min-w-100px">Ngày lấy xe </th>
                                        <th class="min-w-100px">Ngày trả xe </th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach ($products as $product)
                                        <?php $total += $product->price; ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Thumbnail-->
                                                    <a href="{{ '/product/' . $product->id }}">
                                                        <img src="{{ asset($product->img) }}" class="blur-up lazyloaded"
                                                            alt="" style="height: 75px; width:75px;">
                                                    </a>
                                                    <!--end::Thumbnail-->

                                                    <!--begin::Title-->
                                                    <div class="ms-5">
                                                        <a href="{{ '/product/' . $product->id }}"
                                                            class="fw-bold text-gray-600 text-hover-primary">{{ $product->name }}</a>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                            </td>
                                            <td class="">
                                                {{ $product->sku }} </td>
                                            <td class="">
                                                {{ $product->quantity }}
                                            </td>
                                            <td class="">
                                                {{ number_format($product->price) . ' VNĐ' }}
                                            </td>
                                            <td>
                                                {{ date('d/m/Y', strtotime($product->setDate)) }}
                                            </td>
                                            <td>
                                                {{ date('d/m/Y', strtotime($product->dropDate)) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="">
                                            Tổng giá sản phẩm
                                        </td>
                                        <td class="">
                                            {{ number_format($total) . ' VNĐ' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="">
                                            VAT (0%)
                                        </td>
                                        <td class="">
                                            0 VNĐ
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="">
                                            Phí ship
                                        </td>
                                        <td class="">
                                            {{ number_format(config('app.ship.PRICE')) . ' VNĐ' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="fs-3 text-gray-900 ">
                                            Tổng giá:
                                        </td>
                                        <td class="text-gray-900 fs-3 fw-bolder ">
                                            {{ number_format($order->total) . ' VNĐ' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Product List-->
            </div>
        </div>
    </div>
@endsection
