@props([
    'id' => uniqid('input-'),
    'type' => 'text',
    'class' => null,
    'label' => null,
])
@if ($label)
    <label for="{{ $id }}"
        class="{{ css_classes([
            'error' => $errors->has($id),
        ]) }}">{{ $label }}</label>
@endif
<input
    {{ $attributes->merge([
        'id' => $id,
        'type' => $type,
        'class' => css_classes(['form-control', $class => $class]),
    ]) }}
    class="form-control">
@error($id)
    <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
@enderror
