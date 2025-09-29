@extends('backend.admin.master')

@section('content')
    <!--start page content -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Forms</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Layouts</li>
							</ol>
						</nav>
					</div>
				</div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Back</a>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Add Category</h5>
                        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Category Name">
                            </div>

                            <div class="col-md-6">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
                            </div>

                            <div class="col-md-6">
                                <label for="photo" class="form-label">Image</label>
                                <input type="file" class="form-control" id="photo" name="photo" placeholder="Image">
                            </div>

                            <div class="col-md-6">
                                <img src="" class="form-control" id="photoPreview" width="20" height="160" style="margin-top: 15px; display: none;" />
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 form-control">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end page content -->
@endsection


@push('scripts')
    <script src="{{ asset('customjs/admin/custom.js') }}"></script>
@endpush
