@extends('admin.layouts.app')
@section('title_page')
    <div class="app-navbar-item ms-1 ms-md-3">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Promotion</h1>
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
                <li class="breadcrumb-item text-muted">Promotion</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
    </div>
@endsection

@section('contents')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Update Promotion</span>
                </h3>
            </div>
            <div class="card-body py-3">
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column">
                        <div class="row">
                            <div class="col-xxl-8">
                                <label class="required form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                    @if (isset($promotion)) {{ 'value=' . $promotion->name }} @endif>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xxl-4">
                                <label class="required form-label">Percent</label>
                                <input type="text" name="percent" class="form-control" placeholder="Percent"
                                    @if (isset($promotion)) {{ 'value=' . $promotion->percent }} @endif>
                                @error('percent')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xxl-6 mt-5">
                                <label class="required form-label">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    @if (isset($promotion)) {{ 'value=' . date('Y-m-d', strtotime($promotion->start_date)) }} @endif>
                                @error('start_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xxl-6 mt-5">
                                <label class="required form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    @if (isset($promotion)) {{ 'value=' . date('Y-m-d', strtotime($promotion->end_date)) }} @endif>
                                @error('end_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5 d-flex justify-content-end">
                            @if (isset($promotion))
                                <div class="mx-5">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            @else
                                <div class="mx-5">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            @endif
                            <div class="mx-5">
                                <a type="submit" href="/admin/promotion" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
