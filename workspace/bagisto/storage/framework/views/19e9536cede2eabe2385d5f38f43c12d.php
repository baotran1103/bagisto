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

<div class="container mt-14 max-lg:px-8 max-md:mt-7 max-md:!px-0 max-sm:mt-5">
    <div class="relative">
        <div class="scrollbar-hide flex gap-10 overflow-auto max-lg:gap-4">
            <?php for($i = 0;  $i < $count; $i++): ?>
                <div class="grid min-w-[120px] grid-cols-1 justify-items-center gap-4 max-md:min-w-20 max-md:gap-2.5 max-md:first:ml-4 max-sm:min-w-[60px] max-sm:max-w-[60px] max-sm:gap-1.5">
                    <div class="shimmer relative h-[110px] w-[110px] overflow-hidden rounded-full max-md:h-20 max-md:w-20 max-sm:h-[60px] max-sm:w-[60px]">
                        <img class="rounded-sm bg-zinc-100">
                    </div>

                    <p class="shimmer h-[27px] w-[90px] rounded-2xl max-sm:h-5 max-sm:w-[70px]"></p>
                </div>
            <?php endfor; ?>
        </div>

        <span
            class="shimmer absolute -left-10 top-9 flex h-[50px] w-[50px] rounded-full max-sm:hidden"
            role="presentation"
        ></span>

        <span
            class="shimmer absolute -right-6 top-9 flex h-[50px] w-[50px] rounded-full max-sm:hidden"
            role="presentation"
        ></span>
    </div>
</div>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/shimmer/categories/carousel.blade.php ENDPATH**/ ?>