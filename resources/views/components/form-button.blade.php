@props(['label'])

<div class="text-sm-end text-center position-relative">
    <button type="button" class="btn btn-primary px-7" id="formButton">
        {{ $label }}
        <div class="progress position-absolute" style="top: 0; left: 0; width: 100%; height: 100%; display: none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#formButton').on('click', function() {
            var form = $(this).closest('form')[0];
            var formData = new FormData(form);
            var progressBar = $(this).find('.progress');
            var progressBarStatus = $(this).find('.progress-bar');
            var errorMessage = $('#errorMessage');
            var errorText = $('#errorText');

            $.ajax({
                url: $(form).attr('action'),
                type: $(form).attr('method'),
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
