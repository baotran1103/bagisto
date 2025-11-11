<v-categories-carousel
    src="<?php echo e($src); ?>"
    title="<?php echo e($title); ?>"
    navigation-link="<?php echo e($navigationLink ?? ''); ?>"
>
    <?php if (isset($component)) { $__componentOriginal0bde9fdb3483da82e92e4a518d73fb0e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0bde9fdb3483da82e92e4a518d73fb0e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.categories.carousel','data' => ['count' => 8,'navigationLink' => $navigationLink ?? false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.categories.carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['count' => 8,'navigation-link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationLink ?? false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0bde9fdb3483da82e92e4a518d73fb0e)): ?>
<?php $attributes = $__attributesOriginal0bde9fdb3483da82e92e4a518d73fb0e; ?>
<?php unset($__attributesOriginal0bde9fdb3483da82e92e4a518d73fb0e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0bde9fdb3483da82e92e4a518d73fb0e)): ?>
<?php $component = $__componentOriginal0bde9fdb3483da82e92e4a518d73fb0e; ?>
<?php unset($__componentOriginal0bde9fdb3483da82e92e4a518d73fb0e); ?>
<?php endif; ?>
</v-categories-carousel>

<?php if (! $__env->hasRenderedOnce('948e7c41-fec7-494e-83cd-b978518aa880')): $__env->markAsRenderedOnce('948e7c41-fec7-494e-83cd-b978518aa880');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id="v-categories-carousel-template"
    >
        <div
            class="container mt-14 max-lg:px-8 max-md:mt-7 max-md:!px-0 max-sm:mt-5"
            v-if="! isLoading && categories?.length"
        >
            <div class="relative">
                <div
                    ref="swiperContainer"
                    class="scrollbar-hide flex gap-10 overflow-auto scroll-smooth max-lg:gap-4"
                >
                    <div
                        class="grid min-w-[120px] max-w-[120px] grid-cols-1 justify-items-center gap-4 font-medium max-md:min-w-20 max-md:max-w-20 max-md:gap-2.5 max-md:first:ml-4 max-sm:min-w-[60px] max-sm:max-w-[60px] max-sm:gap-1.5"
                        v-for="category in categories"
                    >
                        <a
                            :href="category.slug"
                            class="h-[110px] w-[110px] rounded-full bg-zinc-100 max-md:h-20 max-md:w-20 max-sm:h-[60px] max-sm:w-[60px]"
                            :aria-label="category.name"
                        >
                            <?php if (isset($component)) { $__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.media.images.lazy','data' => [':src' => 'category.logo?.large_image_url || \''.e(bagisto_asset('images/small-product-placeholder.webp')).'\'','width' => '110','height' => '110','class' => 'w-full rounded-full max-sm:h-[60px] max-sm:w-[60px]',':alt' => 'category.name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::media.images.lazy'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([':src' => 'category.logo?.large_image_url || \''.e(bagisto_asset('images/small-product-placeholder.webp')).'\'','width' => '110','height' => '110','class' => 'w-full rounded-full max-sm:h-[60px] max-sm:w-[60px]',':alt' => 'category.name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848)): ?>
<?php $attributes = $__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848; ?>
<?php unset($__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848)): ?>
<?php $component = $__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848; ?>
<?php unset($__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848); ?>
<?php endif; ?>
                        </a>

                        <a
                            :href="category.slug"
                            class=""
                        >
                            <p
                                class="text-center text-lg text-black max-md:text-base max-md:font-normal max-sm:text-sm"
                                v-text="category.name"
                            >
                            </p>
                        </a>
                    </div>
                </div>

                <span
                    class="icon-arrow-left-stylish absolute -left-10 top-9 flex h-[50px] w-[50px] cursor-pointer items-center justify-center rounded-full border border-black bg-white text-2xl transition hover:bg-black hover:text-white max-lg:-left-7 max-md:hidden"
                    role="button"
                    aria-label="<?php echo app('translator')->get('shop::components.carousel.previous'); ?>"
                    tabindex="0"
                    @click="swipeLeft"
                >
                </span>

                <span
                    class="icon-arrow-right-stylish absolute -right-6 top-9 flex h-[50px] w-[50px] cursor-pointer items-center justify-center rounded-full border border-black bg-white text-2xl transition hover:bg-black hover:text-white max-lg:-right-7 max-md:hidden"
                    role="button"
                    aria-label="<?php echo app('translator')->get('shop::components.carousel.next'); ?>"
                    tabindex="0"
                    @click="swipeRight"
                >
                </span>
            </div>
        </div>

        <!-- Category Carousel Shimmer -->
        <template v-if="isLoading">
            <?php if (isset($component)) { $__componentOriginal0bde9fdb3483da82e92e4a518d73fb0e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0bde9fdb3483da82e92e4a518d73fb0e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.categories.carousel','data' => ['count' => 8,'navigationLink' => $navigationLink ?? false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.categories.carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['count' => 8,'navigation-link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationLink ?? false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0bde9fdb3483da82e92e4a518d73fb0e)): ?>
<?php $attributes = $__attributesOriginal0bde9fdb3483da82e92e4a518d73fb0e; ?>
<?php unset($__attributesOriginal0bde9fdb3483da82e92e4a518d73fb0e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0bde9fdb3483da82e92e4a518d73fb0e)): ?>
<?php $component = $__componentOriginal0bde9fdb3483da82e92e4a518d73fb0e; ?>
<?php unset($__componentOriginal0bde9fdb3483da82e92e4a518d73fb0e); ?>
<?php endif; ?>
        </template>
    </script>

    <script type="module">
        app.component('v-categories-carousel', {
            template: '#v-categories-carousel-template',

            props: [
                'src',
                'title',
                'navigationLink',
            ],

            data() {
                return {
                    isLoading: true,

                    categories: [],

                    offset: 323,
                };
            },

            mounted() {
                this.getCategories();
            },

            methods: {
                getCategories() {
                    this.$axios.get(this.src)
                        .then(response => {
                            this.isLoading = false;

                            this.categories = response.data.data;
                        }).catch(error => {
                            console.log(error);
                        });
                },

                swipeLeft() {
                    const container = this.$refs.swiperContainer;

                    container.scrollLeft -= this.offset;
                },

                swipeRight() {
                    const container = this.$refs.swiperContainer;

                    container.scrollLeft += this.offset;
                },
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/categories/carousel.blade.php ENDPATH**/ ?>