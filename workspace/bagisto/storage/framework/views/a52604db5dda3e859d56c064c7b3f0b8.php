<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'isActive' => false,
    'position' => 'right',
    'width'    => '500px',
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
    'isActive' => false,
    'position' => 'right',
    'width'    => '500px',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<v-drawer
    <?php echo e($attributes); ?>

    is-active="<?php echo e($isActive); ?>"
    position="<?php echo e($position); ?>"
    width="<?php echo e($width); ?>"
>
    <?php if(isset($toggle)): ?>
        <template v-slot:toggle>
            <?php echo e($toggle); ?>

        </template>
    <?php endif; ?>

    <?php if(isset($header)): ?>
        <template v-slot:header="{ close }">
            <div <?php echo e($header->attributes->merge(['class' => 'grid gap-y-2.5 p-6 pb-5 max-md:gap-y-1.5 max-md:border-b max-md:border-zinc-200 max-md:p-4 max-md:gap-y-1 max-md:font-semibold'])); ?>>
                <?php echo e($header); ?>


                <div class="absolute top-5 max-sm:top-4 ltr:right-5 rtl:left-5">
                    <span
                        class="icon-cancel cursor-pointer text-3xl max-md:text-2xl"
                        @click="close"
                    >
                    </span>
                </div>
            </div>
        </template>
    <?php endif; ?>

    <?php if(isset($content)): ?>
        <template v-slot:content>
            <div <?php echo e($content->attributes->merge(['class' => 'flex-1 overflow-auto px-6 max-md:px-4'])); ?>>
                <?php echo e($content); ?>

            </div>
        </template>
    <?php endif; ?>

    <?php if(isset($footer)): ?>
        <template v-slot:footer>
            <div <?php echo e($footer->attributes->merge(['class' => 'pb-8 max-md:pb-2'])); ?>>
                <?php echo e($footer); ?>

            </div>
        </template>
    <?php endif; ?>
</v-drawer>

<?php if (! $__env->hasRenderedOnce('bf5aa30a-d749-4f58-ac2d-604c2b6ebcd2')): $__env->markAsRenderedOnce('bf5aa30a-d749-4f58-ac2d-604c2b6ebcd2');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id="v-drawer-template"
    >
        <div>
            <!-- Toggler -->
            <div @click="open">
                <slot name="toggle"></slot>
            </div>

            <!-- Overlay -->
            <transition
                tag="div"
                name="drawer-overlay"
                enter-class="duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-class="duration-200 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    class="fixed inset-0 z-20 bg-gray-500 bg-opacity-50 transition-opacity"
                    v-show="isOpen"
                ></div>
            </transition>

            <!-- Content -->
            <transition
                tag="div"
                name="drawer"
                :enter-from-class="enterFromLeaveToClasses"
                enter-active-class="transform transition duration-200 ease-in-out"
                enter-to-class="translate-x-0"
                leave-from-class="translate-x-0"
                leave-active-class="transform transition duration-200 ease-in-out"
                :leave-to-class="enterFromLeaveToClasses"
            >
                <div
                    class="fixed z-[1000] overflow-hidden bg-white max-md:!w-full"
                    :class="{
                        'inset-x-0 top-0': position == 'top',
                        'inset-x-0 bottom-0 max-sm:max-h-full': position == 'bottom',
                        'inset-y-0 ltr:right-0 rtl:left-0': position == 'right',
                        'inset-y-0 ltr:left-0 rtl:right-0': position == 'left'
                    }"
                    :style="'width:' + width"
                    v-show="isOpen"
                >
                    <div class="pointer-events-auto h-full w-full overflow-auto bg-white">
                        <div class="flex h-full w-full flex-col">
                            <div class="min-h-0 min-w-0 flex-1 overflow-auto">
                                <div class="flex h-full flex-col">
                                    <slot
                                        name="header"
                                        :close="close"
                                    >
                                        Default Header
                                    </slot>

                                    <!-- Content Slot -->
                                    <slot name="content"></slot>

                                    <!-- Footer Slot -->
                                    <slot name="footer"></slot>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </script>

    <script type="module">
        app.component('v-drawer', {
            template: '#v-drawer-template',

            props: [
                'isActive',
                'position',
                'width'
            ],

            data() {
                return {
                    isOpen: this.isActive,
                };
            },

            watch: {
                isActive: function(newVal, oldVal) {
                    this.isOpen = newVal;
                }
            },

            computed: {
                enterFromLeaveToClasses() {
                    if (this.position == 'top') {
                        return '-translate-y-full';
                    } else if (this.position == 'bottom') {
                        return 'translate-y-full';
                    } else if (this.position == 'left') {
                        return 'ltr:-translate-x-full rtl:translate-x-full';
                    } else if (this.position == 'right') {
                        return 'ltr:translate-x-full rtl:-translate-x-full';
                    }
                }
            },

            methods: {
                toggle() {
                    this.isOpen = ! this.isOpen;

                    if (this.isOpen) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow ='auto';
                    }

                    document.body.style.paddingRight = '';

                    this.$emit('toggle', { isActive: this.isOpen });
                },

                open() {
                    this.isOpen = true;

                    const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;

                    document.body.style.overflow = 'hidden';

                    document.body.style.paddingRight = `${scrollbarWidth}px`;

                    this.$emit('open', { isActive: this.isOpen });
                },

                close() {
                    this.isOpen = false;

                    document.body.style.overflow = 'auto';

                    document.body.style.paddingRight = '';

                    this.$emit('close', { isActive: this.isOpen });
                }
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/drawer/index.blade.php ENDPATH**/ ?>