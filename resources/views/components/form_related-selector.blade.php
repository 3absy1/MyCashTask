@props([
    'selectName',
    'label', 
    'options' => [],
    'selectedOptionLabel' => 'Select',
    'selectedOptionValue' => ''
])
<div class="form-floating">
    <select name="{{ $selectName }}" class="form-select" id="floatingSelect" aria-label="Floating label select example">
        <option value="{{ $selectedOptionValue }}" selected>{{ $selectedOptionLabel }}</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
    </select>
    <label for="floatingSelect">{{ $label }}</label>
</div>
