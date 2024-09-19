@props(['selectName','label','options' => [],])

<div class="form-floating">
    <select name="{{ $selectName }}" class="form-select" id="{{ $selectName }}Select"
        aria-label="Floating label select example">
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
    <label for="{{ $selectName }}Select">{{ $label }}</label>
</div>
