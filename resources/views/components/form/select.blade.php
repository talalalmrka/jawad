@props([
    'id' => uniqid('select-'),
    'class' => null,
    'label' => null,
    'value' => '',
    'multiple' => false,
    'options' => [],
])
@if ($label)
    <label for="{{ $id }}"
        class="{{ css_classes(['form-label', 'error' => $errors->has($id)]) }}">{{ $label }}</label>
@endif
<select
    {{ $attributes->merge([
        'id' => $id,
        'class' => css_classes(['form-control', 'error' => $errors->has($id), $class => $class]),
    ]) }}
    class="form-control form-select" @if ($multiple) multiple @endif>
    @foreach ($options as $option)
        <option value="{{ $option['value'] }}" @if ($option['value'] == $value) selected @endif>
            {{ $option['label'] }}
        </option>
    @endforeach
</select>
@error($id)
    <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
@enderror
