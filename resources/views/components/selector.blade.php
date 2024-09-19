@props(['label', 'selectName', 'options' => []])

    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="{{ $selectName }}Select">{{ $label }}</label>
    <div class="form-floating">
        <select name="{{ $selectName }}" class="form-select" id="{{ $selectName }}Select" aria-label="Floating label select example">
            <option selected>Select Header</option>
            @foreach ($options as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>
        <label for="floatingSelect">{{ $label }}</label>
</div>
