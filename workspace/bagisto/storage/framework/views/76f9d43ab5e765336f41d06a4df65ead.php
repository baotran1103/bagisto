<v-products-carousel
    src="<?php echo e($src); ?>"
    title="<?php echo e($title); ?>"
    navigation-link="<?php echo e($navigationLink ?? ''); ?>"
>
    <?php if (isset($component)) { $__componentOriginal132717af6d5760662131ee7680a588cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal132717af6d5760662131ee7680a588cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.carousel','data' => ['navigationLink' => $navigationLink ?? false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['navigation-link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationLink ?? false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal132717af6d5760662131ee7680a588cf)): ?>
<?php $attributes = $__attributesOriginal132717af6d5760662131ee7680a588cf; ?>
<?php unset($__attributesOriginal132717af6d5760662131ee7680a588cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal132717af6d5760662131ee7680a588cf)): ?>
<?php $component = $__componentOriginal132717af6d5760662131ee7680a588cf; ?>
<?php unset($__componentOriginal132717af6d5760662131ee7680a588cf); ?>
<?php endif; ?>
</v-products-carousel>

<?php if (! $__env->hasRenderedOnce('a9c6353f-5b27-4316-91ce-f1f3b0ca31bf')): $__env->markAsRenderedOnce('a9c6353f-5b27-4316-91ce-f1f3b0ca31bf');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id="v-products-carousel-template"
    >
        <div
            class="container mt-20 max-lg:px-8 max-md:mt-8 max-sm:mt-7 max-sm:!px-4"
            v-if="! isLoading && products.length"
        >
            <div class="flex justify-between">
                <h2 class="font-dmserif text-3xl max-md:text-2xl max-sm:text-xl">
                    {{ title }}
                </h2>

                <div class="flex items-center justify-between gap-8">
                    <a
                        :href="navigationLink"
                        class="hidden max-lg:flex"
                        v-if="navigationLink"
                    >
                        <p class="items-center text-xl max-md:text-base max-sm:text-sm">
                            <?php echo app('translator')->get('shop::app.components.products.carousel.view-all'); ?>

                            <span class="icon-arrow-right text-2xl max-md:text-lg max-sm:text-sm"></span>
                        </p>
                    </a>

                    <template v-if="products.length > 3">
                        <span
                            v-if="products.length > 4 || (products.length > 3 && isScreenMax2xl)"
                            class="icon-arrow-left-stylish rtl:icon-arrow-right-stylish inline-block cursor-pointer text-2xl max-lg:hidden"
                            role="button"
                            aria-label="<?php echo app('translator')->get('shop::app.components.products.carousel.previous'); ?>"
                            tabindex="0"
                            @click="swipeLeft"
                        >
                        </span>

                        <span
                            v-if="products.length > 4 || (products.length > 3 && isScreenMax2xl)"
                            class="icon-arrow-right-stylish rtl:icon-arrow-left-stylish inline-block cursor-pointer text-2xl max-lg:hidden"
                            role="button"
                            aria-label="<?php echo app('translator')->get('shop::app.components.products.carousel.next'); ?>"
                            tabindex="0"
                            @click="swipeRight"
                        >
                        </span>
                    </template>
                </div>
            </div>

            <div
                ref="swiperContainer"
                class="flex gap-8 pb-2.5 [&>*]:flex-[0] mt-10 overflow-auto scroll-smooth scrollbar-hide max-md:gap-7 max-md:mt-5 max-sm:gap-4 max-md:pb-0 max-md:whitespace-nowrap"
            >
                <?php if (isset($component)) { $__componentOriginalce4ea8dd577f45125a0fa9f371a55f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce4ea8dd577f45125a0fa9f371a55f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.products.card','data' => ['class' => 'min-w-[291px] max-md:h-fit max-md:min-w-56 max-sm:min-w-[192px]','vFor' => 'product in products']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::products.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'min-w-[291px] max-md:h-fit max-md:min-w-56 max-sm:min-w-[192px]','v-for' => 'product in products']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce4ea8dd577f45125a0fa9f371a55f23)): ?>
<?php $attributes = $__attributesOriginalce4ea8dd577f45125a0fa9f371a55f23; ?>
<?php unset($__attributesOriginalce4ea8dd577f45125a0fa9f371a55f23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce4ea8dd577f45125a0fa9f371a55f23)): ?>
<?php $component = $__componentOriginalce4ea8dd577f45125a0fa9f371a55f23; ?>
<?php unset($__componentOriginalce4ea8dd577f45125a0fa9f371a55f23); ?>
<?php endif; ?>
            </div>

            <a
                :href="navigationLink"
                class="secondary-button mx-auto mt-5 block w-max rounded-2xl px-11 py-3 text-center text-base max-lg:mt-0 max-lg:hidden max-lg:py-3.5 max-md:rounded-lg"
                :aria-label="title"
                v-if="navigationLink"
            >
                <?php echo app('translator')->get('shop::app.components.products.carousel.view-all'); ?>
            </a>
        </div>

        <!-- Product Card Listing -->
        <template v-if="isLoading">
            <?php if (isset($component)) { $__componentOriginal132717af6d5760662131ee7680a588cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal132717af6d5760662131ee7680a588cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.carousel','data' => ['navigationLink' => $navigationLink ?? false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['navigation-link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationLink ?? false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal132717af6d5760662131ee7680a588cf)): ?>
<?php $attributes = $__attributesOriginal132717af6d5760662131ee7680a588cf; ?>
<?php unset($__attributesOriginal132717af6d5760662131ee7680a588cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal132717af6d5760662131ee7680a588cf)): ?>
<?php $component = $__componentOriginal132717af6d5760662131ee7680a588cf; ?>
<?php unset($__componentOriginal132717af6d5760662131ee7680a588cf); ?>
<?php endif; ?>
        </template>
    </script>

    <script type="module">
        app.component('v-products-carousel', {
            template: '#v-products-carousel-template',

            props: [
                'src',
                'title',
                'navigationLink',
            ],

            data() {
                return {
                    isLoading: true,

                    products: [],

                    offset: 323,

                    isScreenMax2xl: window.innerWidth <= 1440,
                };
            },

            mounted() {
                this.getProducts();
            },

            created() {
                window.addEventListener('resize', this.updateScreenSize);
            },

            beforeDestroy() {
                window.removeEventListener('resize', this.updateScreenSize);
            },

            methods: {
                getProducts() {
                    this.$axios.get(this.src)
                        .then(response => {
                            this.isLoading = false;

                            this.products = response.data.data;
                        }).catch(error => {
                            console.log(error);
                        });
                },

                updateScreenSize() {
                    this.isScreenMax2xl = window.innerWidth <= 1440;
                },

                swipeLeft() {
                    const container = this.$refs.swiperContainer;

                    container.scrollLeft -= this.offset;
                },

                swipeRight() {
                    const container = this.$refs.swiperContainer;

                    // Check if scroll reaches the end
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth) {
                        // Reset scroll to the beginning
                        container.scrollLeft = 0;
                    } else {
                        // Scroll to the right
                        container.scrollLeft += this.offset;
                    }
                },
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/products/carousel.blade.php ENDPATH**/ ?>