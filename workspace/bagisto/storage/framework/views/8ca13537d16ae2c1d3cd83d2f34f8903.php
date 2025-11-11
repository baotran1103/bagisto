<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'average' => 0,
    'total'   => 0,
    'rating' => true,
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
    'average' => 0,
    'total'   => 0,
    'rating' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<v-product-ratings
    <?php echo e($attributes->merge(['class' => 'flex w-max items-center rounded-md border border-zinc-200 px-4 py-2'])); ?>

    average="<?php echo e($average); ?>"
    total="<?php echo e($total); ?>"
>
</v-product-ratings>

<?php if (! $__env->hasRenderedOnce('a3eda112-41c1-42f9-b501-95dd6d6b95f8')): $__env->markAsRenderedOnce('a3eda112-41c1-42f9-b501-95dd6d6b95f8');
$__env->startPush("scripts"); ?>
    <script
        type="text/x-template"
        id="v-product-ratings-template"
    >
        <div>
            <span class="text-sm font-medium text-black max-sm:text-xs">
                {{ average }}
            </span>
        
            <span
                class="icon-star-fill -mt-1 text-xl text-amber-500 max-sm:-mt-1 max-sm:text-lg"
                role="presentation"
            >
            </span>
            
            <span class="border-l border-zinc-300 text-sm font-medium text-black max-sm:border-zinc-300 max-sm:text-xs ltr:pl-1 rtl:pr-1">
                {{ abbreviatedTotal }}

                <span v-if="rating"><?php echo app('translator')->get('shop::app.components.products.ratings.title'); ?></span>
            </span>
        </div>
    </script>

    <script type="module">
        app.component("v-product-ratings", {
            template: "#v-product-ratings-template",

            props: {
                average: {
                    type: String,
                    required: true,
                },

                total: {
                    type: String,
                    required: true,
                },

                rating: {
                    type: Boolean,
                    required: false,
                },
            },

            computed: {
                starColorClasses() {
                    return {
                        'text-emerald-600': this.average > 4,
                        'text-emerald-500': this.average >= 4 && this.average < 5,
                        'text-emerald-400': this.average >= 3 && this.average < 4,
                        'text-amber-500': this.average >= 2 && this.average < 3,
                        'text-red-500': this.average >= 1 && this.average < 2,
                        'text-gray-400': this.average <= 0,
                    };
                },

                abbreviatedTotal() {
                    if (this.total >= 1000) {
                        return `${(this.total / 1000).toFixed(1)}k`;
                    }

                    return this.total;
                },
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/products/ratings.blade.php ENDPATH**/ ?>