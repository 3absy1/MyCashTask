@props(['label', 'selectName', 'options' => []])

<div class="col-12 col-lg-6 col-xl-4">
    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">{{ $label }}</label>
    <div class="form-floating">
        <select name="{{ $selectName }}" class="form-select header-select"  aria-label="Floating label select example">
            <option selected>Select Header</option>
            @foreach ($options as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>
        <label for="floatingSelect">Headers</label>
    </div>
</div>
