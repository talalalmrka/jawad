@props([
    'id' => uniqid('alert-'),
    'type' => 'info',
    'class' => '',
    'message' => '',
])
@php
    $message = $message ?: $slot;
@endphp

<div
    {{ $attributes->merge([
        'id' => $id,
        'class' => css_classes(['alert', "alert-$type", $class => $class]),
    ]) }}>
    {{ $message }}</div>
