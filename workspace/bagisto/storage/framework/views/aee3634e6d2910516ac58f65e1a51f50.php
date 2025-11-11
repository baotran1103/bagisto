<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name'     => '',
    'value'    => 1,
    'minValue' => 1,
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
    'name'     => '',
    'value'    => 1,
    'minValue' => 1,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<v-quantity-changer
    <?php echo e($attributes->merge(['class' => 'flex items-center border border-navyBlue'])); ?>

    name="<?php echo e($name); ?>"
    value="<?php echo e($value); ?>"
    min-value="<?php echo e($minValue); ?>"
>
</v-quantity-changer>

<?php if (! $__env->hasRenderedOnce('b3739d05-cb30-468e-a9a4-0e4d806ad22b')): $__env->markAsRenderedOnce('b3739d05-cb30-468e-a9a4-0e4d806ad22b');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id="v-quantity-changer-template"
    >
        <div>
            <span 
                class="icon-minus cursor-pointer text-2xl"
                role="button"
                tabindex="0"
                aria-label="<?php echo app('translator')->get('shop::app.components.quantity-changer.decrease-quantity'); ?>"
                @click="decrease"
            >
            </span>

            <p class="w-2.5 select-none text-center max-sm:text-sm">
                {{ quantity }}
            </p>
            
            <span 
                class="icon-plus cursor-pointer text-2xl"
                role="button"
                tabindex="0"
                aria-label="<?php echo app('translator')->get('shop::app.components.quantity-changer.increase-quantity'); ?>"
                @click="increase"
            >
            </span>

            <v-field
                type="hidden"
                :name="name"
                v-model="quantity"
            ></v-field>
        </div>
    </script>

    <script type="module">
        app.component("v-quantity-changer", {
            template: '#v-quantity-changer-template',

            props:['name', 'value', 'minValue'],

            data() {
                return  {
                    quantity: this.value,
                }
            },

            watch: {
                value() {
                    this.quantity = this.value;
                },
            },

            methods: {
                increase() {
                    this.$emit('change', ++this.quantity);
                },

                decrease() {
                    if (this.quantity > this.minValue) {
                        this.quantity -= 1;

                        this.$emit('change', this.quantity);
                    }
                },
            }
        });
    </script>
<?php $__env->stopPush(); endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/quantity-changer/index.blade.php ENDPATH**/ ?>