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
                    <a href="{{ route('admin.subcategories.index') }}" class="btn btn-primary">Back</a>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Edit Subcategory</h5>
                        <form method="POST" action="{{ route('admin.subcategories.update', $subcategory->id) }}" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $subcategory->name }}" placeholder="Subcategory Name">
                            </div>

                            <div class="col-md-6">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ $subcategory->slug }}" placeholder="Slug">
                            </div>

                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category By</label>
                                <select class="form-select" id="category_id" name="category">
                                    <option selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 form-control">Save Changes</button>
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
