@extends('admin.layouts.app')
@section('title_page')
    <div class="app-navbar-item ms-1 ms-md-3">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Category</h1>
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
                <li class="breadcrumb-item text-muted">Category</li>
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
                    <span class="card-label fw-bold fs-3 mb-1">Category Menu</span>

                    <span class="text-muted mt-1 fw-semibold fs-7">Over 500 product</span>
                </h3>
                <div class="">
                    <a href="/admin/category/add" class="btn btn-sm btn-light btn-active-primary">
                        <i class="ki-duotone ki-plus fs-2"></i> New Category
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
                                <th></th>
                                <th class="min-w-25px">ID</th>
                                <th class="min-w-150px">NAME</th>
                                <th class="min-w-100px">ACTIONS</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            @if ($categorys->count() > 0)
                                @foreach ($categorys as $category)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <span
                                                class="text-gray-900 fw-bold text-hover-primary d-block fs-6">{{ $category->id }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-gray-900 fw-bold text-hover-primary d-block fs-6">{{ $category->name }}</span>
                                        </td>

                                        <td>
                                            <div class="d-flex flex-shrink-0">
                                                <a href="{{ route('admin.page.category.edit', $category->id) }}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span
                                                            class="path2"></span></i> </a>
                                                <form action="{{ route('admin.page.category.delete', $category->id) }}"
                                                    method="POST" type="button">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modalDelete">
                                                        <i class="ki-duotone ki-trash fs-2"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span><span class="path4"></span><span
                                                                class="path5"></span></i> </a> </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modalDelete" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Cảnh báo
                                                                        !</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div
                                                                    class="modal-body d-flex flex-column justify-content-center">
                                                                    <div class="">
                                                                        <span>Bạn vấn muốn xóa danh mục ?</span>
                                                                    </div>
                                                                    <div class="">
                                                                        <span class="text-danger">Các sản phẩm
                                                                            trong danh mục, các sản phẩm củng sẽ bị xóa khỏi
                                                                            cơ
                                                                            sở dữ liệu ! !</span>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">NOT FOUND CATEGORY</td>
                                </tr>
                            @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <div class="">
                        {{ $categorys->links() }}
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    </div>
@endsection
