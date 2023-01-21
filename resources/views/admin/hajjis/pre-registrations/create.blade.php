<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title" id="toastr-three">Add New Package</h2><hr>

            <form action="{{ route('admin.masterdata.packages.store') }}" method="post" class="needs-validation" id="package-form" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Package name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Type package name" required>
                    <div class="invalid-feedback">
                        This field is required! 
                    </div>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Package price</label>
                    <input name="price" type="number" class="form-control" id="price" placeholder="Type package name" required>
                    <div class="invalid-feedback">
                        This field is required! 
                    </div>
                </div>
                
                <button class="btn btn-success float-end" type="submit"><i class="fa fa-save"></i> SAVE</button>
            </form>
        </div>
    </div> 
</div>