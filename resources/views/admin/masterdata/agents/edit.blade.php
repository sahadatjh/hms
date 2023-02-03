<h2 class="header-title" >Agent Update</h2><hr>
<form action="{{ route('admin.masterdata.agents.update') }}" method="post" class="needs-validation agent-form" id="agent-form" novalidate>
    @csrf
    <input type="hidden" name="id" value="{{ $agent->id }}">
    <div class="mb-1">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="name" value="{{ $agent->name }}" required>
        <div class="invalid-feedback">This field is required! </div>
    </div>
    <div class="mb-1">
        <label for="mobile" class="form-label">Mobile No. </label>
        <input name="mobile" type="number" class="form-control" id="mobile" value="{{ $agent->mobile }}" required>
        <div class="invalid-feedback">This field is required! </div>
    </div>
    <div class="mb-1">
        <label for="district_id" class="form-label">District </label>
        <select name="district_id" id="district_id" class="form-control select2" data-toggle="select2" required>
            <option value="" disabled selected>Select District</option>
            @foreach ($districts as $item)
                <option value="{{ $item->id }}" {{ $item->id === $agent->district_id ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">This field is required! </div>
    </div>
    <div class="mb-1">
        <label for="Address" class="form-label">Address. </label>
        <input name="address" type="text" class="form-control" id="address" value="{{ $agent->address }}" required>
        <div class="invalid-feedback">This field is required! </div>
    </div>
    {{-- <div class="mb-1">
        <label for="photo" class="form-label">Photo </label>
        <input name="photo" type="file" class="dropify" data-default-file="{{ asset('/dynamic-assets/agents'.'/'.$agent->photo) }}" data-height="150" data-allowed-file-extensions="jpg jpeg png svg"/>
    </div> --}}
    <hr>
    <button class="btn btn-success float-end" type="submit"><i class="fa fa-save"></i> Update</button>
</form>