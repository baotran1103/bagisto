<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name'  => '',
    'entity' => null,
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
    'name'  => '',
    'entity' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="mt-[34px] flex justify-start max-lg:hidden">
    <div class="flex items-center gap-x-3.5">        
        <?php echo e(Breadcrumbs::view('shop::partials.breadcrumbs', $name, $entity)); ?>

    </div>
</div>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/breadcrumbs/index.blade.php ENDPATH**/ ?>