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

<?php for($i = 0; $i < $count; $i++): ?>
<div class="grid grid-cols-1 gap-6">
    <div class="relative grid max-w-max grid-cols-2 gap-4 max-sm:grid-cols-1">
        <div class="shimmer relative min-h-[258px] min-w-[250px] overflow-hidden rounded"> 
            <img class="rounded-sm bg-zinc-100">
        </div>

        <div class="grid content-start gap-4">
            <p class="shimmer h-6 w-3/4"></p>

            <p class="shimmer h-6 w-[55%]"></p>

            <!-- Needs to implement that in future -->
            <div class="flex hidden gap-4"> 
                <span class="shimmer block h-8 w-8 rounded-full"></span> 

                <span class="shimmer block h-8 w-8 rounded-full"></span> 
            </div>

            <p class="shimmer h-6 w-full"></p>

            <div class="shimmer h-12 w-[168px] rounded-xl"></div>
        </div>
    </div>
</div>
<?php endfor; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/shimmer/products/cards/list.blade.php ENDPATH**/ ?>