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
        <div class="col-6 mt-2" id="errorMessage" style="display: none;">
            <div class="alert alert-danger" role="alert" style="font-size: 0.800rem;">
                <span id="errorText"></span>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();

            var form = $(this)[0];
            var formData = new FormData(form);
            var progressBar = $('#uploadButton .progress');
            var progressBarStatus = $('#uploadButton .progress-bar');
            var errorMessage = $('#errorMessage');
            var errorText = $('#errorText');

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    progressBar.show();
                    errorMessage.hide();
                    progressBarStatus.width('0%');
                    progressBarStatus.attr('aria-valuenow', 0);
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total * 100;
                            progressBarStatus.width(percentComplete + '%');
                            progressBarStatus.attr('aria-valuenow', percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    progressBarStatus.width('100%');
                    progressBarStatus.attr('aria-valuenow', 100);
                    // Submit the form after reaching 100%
                    form.submit();
                },
                error: function(xhr) {
                    var response = xhr.responseJSON;
                    var message = 'An error occurred during the file upload.';
                    if (response && response.errors) {
                        message = response.errors.file ? response.errors.file[0] : message;
                    }
                    errorText.text(message);
                    errorMessage.show();
                },
                complete: function() {
                    // Hide progress bar after a delay
                    setTimeout(function() {
                        progressBar.hide();
                        progressBarStatus.width('0%');
                        progressBarStatus.attr('aria-valuenow', 0);
                    }, 2000);
                }
            });
        });
    });
</script>
