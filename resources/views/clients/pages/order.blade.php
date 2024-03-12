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
            @if ($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                        id="kt_ecommerce_products_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th>Mã đơn hàng</th>
                                <th>Tên người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Thay đổi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($orders as $order)
                                <tr class="odd">
                                    <td>
                                        <span class="fw-bold">{{ $order->id }}</span>
                                    </td>
                                    <td>
                                        {{ $order->name }}
                                    </td>
                                    <td>
                                        {{ $order->phone }}
                                    </td>
                                    <td>{{ $order->address . ', ' . $order->ward . ', ' . $order->district . ', ' . $order->province }}
                                    </td>
                                    <td>
                                        @if ($order->status == config('app.order_status.ORDER'))
                                            <span class="fw-bold stt stt-order">Order</span>
                                            <!--end::Badges-->
                                        @elseif ($order->status == config('app.order_status.SHIPPING'))
                                            <span class="fw-bold stt stt-shipping">Shipping</span>
                                        @elseif($order->status == config('app.order_status.DONE'))
                                            <span class="fw-bold stt stt-done">Done</span>
                                        @elseif ($order->status == config('app.order_status.CANCEL'))
                                            <span class="fw-bold stt stt-cancel"> Cancel</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-stuck">
                                            @if ($order->status != config('app.order_status.CANCEL'))
                                                <a href="{{ route('client.order.detail', $order->id) }}" class="m-2"><svg
                                                        xmlns="http://www.w3.org/2000/svg" height="26" width="28"
                                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path fill="#0066FF"
                                                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                    </svg></a>
                                            @endif
                                            @if ($order->status == config('app.order_status.ORDER'))
                                                <a href="{{ route('client.order.cancel', $order->id) }}" class="m-2"><svg
                                                        xmlns="http://www.w3.org/2000/svg" height="26" width="24"
                                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path fill="#FF0000"
                                                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                    </svg></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Đơn hàng đang trống</h2>
                        <h5 class="mt-3">Mua sắm ngay</h5>
                        <a href="/product" class="btn btn-warning mt-5">Shop Now</a>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
