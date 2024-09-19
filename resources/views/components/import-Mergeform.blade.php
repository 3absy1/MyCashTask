@props(['action', 'method' => 'POST'])

<form action="{{ $action }}" method="{{ $method }}" enctype="multipart/form-data" id="uploadForm">
    @csrf
    <div class="col-12 col-lg-12 col-xl-8">
        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2 col-4" for="mainAdminLogo">Import Excel</label>
        {{ $slot }}
        <div class="col-6">
            <input class="form-control @error('file') is-invalid @enderror" name="file" id="mainAdminLogo" type="file" />
            @error('file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-5 mb-4 mt-3 position-relative">
            <button type="submit" class="btn btn-primary" id="uploadButton" style="width: 100%;">
                Import
                <div class="progress position-absolute" style="top: 0; left: 0; width: 100%; height: 100%; display: none;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </button>
        </div>
    </div>
</form>
