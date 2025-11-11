<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => null,
    'controlName' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'name' => null,
    'controlName' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<v-error-message
    <?php echo e($attributes); ?>

    name="<?php echo e($name ?? $controlName); ?>"
    v-slot="{ message }"
>
    <p
        <?php echo e($attributes->merge(['class' => 'text-red-500 text-xs italic'])); ?>

        v-text="message"
    >
    </p>
</v-error-message>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/form/control-group/error.blade.php ENDPATH**/ ?>