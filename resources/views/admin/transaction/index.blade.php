@extends('admin.layouts.app')
@section('title_page')
    <div class="app-navbar-item ms-1 ms-md-3">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Transactions</h1>
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
                <li class="breadcrumb-item text-muted">Transactions</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
    </div>
@endsection
@section('contents')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span
                                class="path2"></span></i> <input type="text" data-kt-ecommerce-order-filter="search"
                            class="form-control form-control-solid w-250px ps-12" placeholder="Search Transaction">
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">

                <!--begin::Table-->
                <div id="kt_ecommerce_sales_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                            id="kt_ecommerce_sales_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-175px sorting" tabindex="0" aria-controls="kt_ecommerce_sales_table"
                                        rowspan="1" colspan="1"
                                        aria-label="Customer: activate to sort column ascending" style="width: 169.075px;">
                                        Mã hóa đơn</th>
                                    <th class=" min-w-70px sorting" tabindex="0" aria-controls="kt_ecommerce_sales_table"
                                        rowspan="1" colspan="1" style="width: 97.0375px;">
                                        Số tiền thanh toán</th>
                                    <th class=" min-w-70px sorting" tabindex="0" aria-controls="kt_ecommerce_sales_table"
                                        rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending"
                                        style="width: 97.0375px;">
                                        Nội dung</th>
                                    <th class=" min-w-100px sorting" tabindex="0" aria-controls="kt_ecommerce_sales_table"
                                        rowspan="1" colspan="1" style="width: 132.663px;">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($items as $transaction)
                                    <tr class="odd">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <!--begin::Title-->
                                                    <span
                                                        class="text-gray-900 fw-bold text-hover-primary d-block fs-6">{{ $transaction->order_id }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class=" pe-0">
                                            <!--begin::Badges-->
                                            <span
                                                class="text-gray-900 fw-bold text-hover-primary d-block fs-6">{{ number_format($transaction->amout) . ' VNĐ' }}</span>
                                            <!--end::Badges-->
                                        </td>
                                        <td>
                                            <span
                                                class="text-gray-900 fw-bold text-hover-primary d-block fs-6">{{ $transaction->noidung }}</span>
                                        </td>
                                        <td class=" pe-0" data-order="Expired">
                                            <!--begin::Badges-->
                                            @if ($transaction->status == true)
                                                <div class="badge badge-light-success">Đã thanh toán</div>
                                                <!--end::Badges-->
                                            @elseif ($transaction->status == false)
                                                <div class="badge badge-light-danger">Thanh toán thách bại</div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        {{ $items->links() }}
                    </div>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
    </div>
@endsection
