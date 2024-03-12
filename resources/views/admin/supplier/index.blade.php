@extends('admin.layouts.app')
@section('title_page')
    <div class="app-navbar-item ms-1 ms-md-3">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Supplier</h1>
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
                <li class="breadcrumb-item text-muted">Supplier</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
    </div>
@endsection
@section('contents')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Supplier Menu</span>

                    <span class="text-muted mt-1 fw-semibold fs-7">Over 500 product</span>
                </h3>
                <div class="">
                    <a href="/admin/supplier/add" class="btn btn-sm btn-light btn-active-primary">
                        <i class="ki-duotone ki-plus fs-2"></i> New supplier
                    </a>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="w-25px">
                                </th>
                                <th class="min-w-25px">ID</th>
                                <th>IMG</th>
                                <th class="min-w-150px">NAME</th>
                                <th class="min-w-150px">Status</th>
                                <th class="min-w-100px">ACTIONS</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            @if ($suppliers->count() > 0)
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <span
                                                class="text-gray-900 fw-bold text-hover-primary d-block fs-6">{{ $supplier->id }}</span>
                                        </td>
                                        <td> <a href="#" class="symbol symbol-100px">
                                                <span class="symbol-label"
                                                    style="background-image:url({{ $supplier->img }});"></span>
                                            </a></td>
                                        <td>
                                            <span
                                                class="text-gray-900 fw-bold text-hover-primary d-block fs-6">{{ $supplier->name }}</span>
                                        </td>
                                        <td>
                                            <span class="text-gray-900 fw-bold text-hover-primary d-block fs-6">
                                                @if ($supplier->status == 1)
                                                    {{ 'Active' }}
                                                    @else{{ 'Deactive' }}
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-shrink-0">
                                                <a href="{{ route('admin.page.supllier.edit', $supplier->id) }}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span
                                                            class="path2"></span></i> </a>
                                                <form action="{{ route('admin.page.supllier.delete', $supplier->id) }}"
                                                    method="POST" type="button"
                                                    onsubmit="return confirm('Bạn chắc chắn muốn xóa ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                        <i class="ki-duotone ki-trash fs-2"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span><span class="path4"></span><span
                                                                class="path5"></span></i> </a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">NOT FOUND supplier</td>
                                </tr>
                            @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    </div>
@endsection
