<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['count' => 0]));

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

foreach (array_filter((['count' => 0]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php for($i = 0;  $i < $count; $i++): ?>
    <div class="grid gap-2.5 relative w-full max-w-[291px] max-sm:grid-cols-1 <?php echo e($attributes["class"]); ?>">
        <div class="shimmer relative w-full rounded max-sm:!rounded-lg">
            <div class="after:content-[' '] relative after:block after:pb-[calc(100%+9px)]"></div>
        </div>

        <div class="grid content-start gap-2.5 max-sm:gap-1">
            <p class="shimmer h-4 w-3/4"></p>
            <p class="shimmer h-4 w-[55%]"></p>

            <!-- Needs to implement that in future -->
            <div class="mt-3 flex hidden gap-4">
                <span class="shimmer block h-[30px] w-[30px] rounded-full"></span>
                <span class="shimmer block h-[30px] w-[30px] rounded-full"></span>
            </div>
        </div>
    </div>
<?php endfor; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/shimmer/products/cards/grid.blade.php ENDPATH**/ ?>