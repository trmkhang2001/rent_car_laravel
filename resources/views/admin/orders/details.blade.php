<?php $total = 0; ?>
@extends('admin.layouts.app')
@section('title_page')
    <div class="app-navbar-item ms-1 ms-md-3">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Order Detail</h1>
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
                <li class="breadcrumb-item text-muted">Order Detail</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
    </div>
@endsection
@section('contents')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="card m-5 mb-xxl-8 p-5">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                    <!--begin::Button-->
                    <a href="/admin/order" class="btn btn-light btn-active-secondary btn-sm ms-auto"><i
                            class="ki-duotone ki-left fs-2"></i>Quay
                        lại</a>
                    <!--end::Button-->
                </div>
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                <!--begin::Shipping address-->
                                <div class="card card-flush py-4 flex-row-fluid position-relative">
                                    <!--begin::Background-->
                                    <div
                                        class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                        <i class="ki-solid ki-delivery" style="font-size: 13em">
                                        </i>
                                    </div>
                                    <!--end::Background-->

                                    <!--begin::Card header-->
                                    <div class="card-header">
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
                                <div class="card card-flush py-4 flex-row-fluid position-relative">
                                    <!--begin::Background-->
                                    <div
                                        class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                        <i class="ki-solid ki-delivery" style="font-size: 13em">
                                        </i>
                                    </div>
                                    <!--end::Background-->

                                    <!--begin::Card header-->
                                    <div class="card-header">
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
                                                    <th class="min-w-100px">Ngày mua </th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @foreach ($products as $product)
                                                    <?php $total += $product->price; ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Thumbnail-->
                                                                <a href="#" class="symbol symbol-50px">
                                                                    <span class="symbol-label"
                                                                        style="background-image:url({{ $product->img }});"></span>
                                                                </a>
                                                                <!--end::Thumbnail-->

                                                                <!--begin::Title-->
                                                                <div class="ms-5">
                                                                    <a href="#"
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
                                                            {{ date('d/m/Y', strtotime($product->created_at)) }}
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
                        <!--end::Orders-->
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->
            </div>
        </div>
    </div>
@endsection
