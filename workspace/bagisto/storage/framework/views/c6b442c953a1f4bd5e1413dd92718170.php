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
    <div class="rounded-xl border border-zinc-200 p-6">
        <div class="flex gap-5">
            <div class="shimmer h-[100px] w-[100px] rounded-xl"></div>

            <div class="flex flex-col gap-0.5">
                <p class="shimmer h-7 w-40"></p
>
                <p class="shimmer mb-2 h-4 w-40"></p>

                <div class="flex items-center gap-0.5">
                    <span class="shimmer h-[30px] w-[30px]"></span>
                    <span class="shimmer h-[30px] w-[30px]"></span>
                    <span class="shimmer h-[30px] w-[30px]"></span>
                    <span class="shimmer h-[30px] w-[30px]"></span>
                    <span class="shimmer h-[30px] w-[30px]"></span>
                </div>
            </div>
        </div>

        <div class="mt-3 flex flex-col gap-4">
            <div class="shimmer h-6 w-[250px]"></div>

            <div class="flex flex-col gap-0.5">
                <p class="shimmer h-6 w-[500px]"></p>
                <p class="shimmer h-6 w-[300px]"></p>
            </div>
        </div>
    </div>
<?php endfor; ?><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/shimmer/products/reviews/card.blade.php ENDPATH**/ ?>