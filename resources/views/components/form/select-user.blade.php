@props([
    'id' => uniqid('select-'),
    'class' => null,
    'label' => null,
    'value' => '',
    'multiple' => false,
    'options' => select_user_options(),
])
@component('components.form.select', get_defined_vars())
@endcomponent
