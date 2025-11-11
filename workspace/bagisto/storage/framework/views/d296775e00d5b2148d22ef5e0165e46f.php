<!-- SEO Meta Content -->
<?php $__env->startPush('meta'); ?>
    <meta
        name="description"
        content="<?php echo e(trim($category->meta_description) != "" ? $category->meta_description : \Illuminate\Support\Str::limit(strip_tags($category->description), 120, '')); ?>"
    />

    <meta
        name="keywords"
        content="<?php echo e($category->meta_keywords); ?>"
    />

    <?php if(core()->getConfigData('catalog.rich_snippets.categories.enable')): ?>
        <script type="application/ld+json">
            <?php echo app('Webkul\Product\Helpers\SEO')->getCategoryJsonLd($category); ?>

        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php if (isset($component)) { $__componentOriginal2643b7d197f48caff2f606750db81304 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2643b7d197f48caff2f606750db81304 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.layouts.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::layouts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Page Title -->
     <?php $__env->slot('title', null, []); ?> 
        <?php echo e(trim($category->meta_title) != "" ? $category->meta_title : $category->name); ?>

     <?php $__env->endSlot(); ?>

    <?php echo view_render_event('bagisto.shop.categories.view.banner_path.before'); ?>


    <!-- Hero Image -->
    <?php if($category->banner_path): ?>
        <div class="container mt-8 px-[60px] max-lg:px-8 max-md:mt-4 max-md:px-4">
            <?php if (isset($component)) { $__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.media.images.lazy','data' => ['class' => 'aspect-[4/1] max-h-full max-w-full rounded-xl','src' => ''.e($category->banner_url).'','alt' => ''.e($category->name).'','width' => '1320','height' => '300']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::media.images.lazy'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'aspect-[4/1] max-h-full max-w-full rounded-xl','src' => ''.e($category->banner_url).'','alt' => ''.e($category->name).'','width' => '1320','height' => '300']); ?>
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
        </div>
    <?php endif; ?>

    <?php echo view_render_event('bagisto.shop.categories.view.banner_path.after'); ?>


    <?php echo view_render_event('bagisto.shop.categories.view.description.before'); ?>


    <?php if(in_array($category->display_mode, [null, 'description_only', 'products_and_description'])): ?>
        <?php if($category->description): ?>
            <div class="container mt-[34px] px-[60px] max-lg:px-8 max-md:mt-4 max-md:px-4 max-md:text-sm max-sm:text-xs">
                <?php echo $category->description; ?>

            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php echo view_render_event('bagisto.shop.categories.view.description.after'); ?>


    <?php if(in_array($category->display_mode, [null, 'products_only', 'products_and_description'])): ?>
        <!-- Category Vue Component -->
        <v-category>
            <!-- Category Shimmer Effect -->
            <?php if (isset($component)) { $__componentOriginalaeaf192b2495a2212eb0b0f02a462c7f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaeaf192b2495a2212eb0b0f02a462c7f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.categories.view','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.categories.view'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaeaf192b2495a2212eb0b0f02a462c7f)): ?>
<?php $attributes = $__attributesOriginalaeaf192b2495a2212eb0b0f02a462c7f; ?>
<?php unset($__attributesOriginalaeaf192b2495a2212eb0b0f02a462c7f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaeaf192b2495a2212eb0b0f02a462c7f)): ?>
<?php $component = $__componentOriginalaeaf192b2495a2212eb0b0f02a462c7f; ?>
<?php unset($__componentOriginalaeaf192b2495a2212eb0b0f02a462c7f); ?>
<?php endif; ?>
        </v-category>
    <?php endif; ?>

    <?php if (! $__env->hasRenderedOnce('a54f7d3e-232c-4c44-b99c-49e21ab9a940')): $__env->markAsRenderedOnce('a54f7d3e-232c-4c44-b99c-49e21ab9a940');
$__env->startPush('scripts'); ?>
        <script
            type="text/x-template"
            id="v-category-template"
        >
            <div class="container px-[60px] max-lg:px-8 max-md:px-4">
                <div class="flex items-start gap-10 max-lg:gap-5 md:mt-10">
                    <!-- Product Listing Filters -->
                    <?php echo $__env->make('shop::categories.filters', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <!-- Product Listing Container -->
                    <div class="flex-1">
                        <!-- Desktop Product Listing Toolbar -->
                        <div class="max-md:hidden">
                            <?php echo $__env->make('shop::categories.toolbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>

                        <!-- Product List Card Container -->
                        <div
                            class="mt-8 grid grid-cols-1 gap-6"
                            v-if="(filters.toolbar.applied.mode ?? filters.toolbar.default.mode) === 'list'"
                        >
                            <!-- Product Card Shimmer Effect -->
                            <template v-if="isLoading">
                                <?php if (isset($component)) { $__componentOriginalf60576d24a4038d681f350c8d30c1046 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf60576d24a4038d681f350c8d30c1046 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.cards.list','data' => ['count' => '12']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.cards.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['count' => '12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf60576d24a4038d681f350c8d30c1046)): ?>
<?php $attributes = $__attributesOriginalf60576d24a4038d681f350c8d30c1046; ?>
<?php unset($__attributesOriginalf60576d24a4038d681f350c8d30c1046); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf60576d24a4038d681f350c8d30c1046)): ?>
<?php $component = $__componentOriginalf60576d24a4038d681f350c8d30c1046; ?>
<?php unset($__componentOriginalf60576d24a4038d681f350c8d30c1046); ?>
<?php endif; ?>
                            </template>

                            <!-- Product Card Listing -->
                            <?php echo view_render_event('bagisto.shop.categories.view.list.product_card.before'); ?>


                            <template v-else>
                                <template v-if="products.length">
                                    <?php if (isset($component)) { $__componentOriginalce4ea8dd577f45125a0fa9f371a55f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce4ea8dd577f45125a0fa9f371a55f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.products.card','data' => [':mode' => '\'list\'','vFor' => 'product in products']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::products.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([':mode' => '\'list\'','v-for' => 'product in products']); ?>
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
                                </template>

                                <!-- Empty Products Container -->
                                <template v-else>
                                    <div class="m-auto grid w-full place-content-center items-center justify-items-center py-32 text-center">
                                        <img
                                            class="max-md:h-[100px] max-md:w-[100px]"
                                            src="<?php echo e(bagisto_asset('images/thank-you.png')); ?>"
                                            alt="<?php echo app('translator')->get('shop::app.categories.view.empty'); ?>"
                                        />

                                        <p
                                            class="text-xl max-md:text-sm"
                                            role="heading"
                                        >
                                            <?php echo app('translator')->get('shop::app.categories.view.empty'); ?>
                                        </p>
                                    </div>
                                </template>
                            </template>

                            <?php echo view_render_event('bagisto.shop.categories.view.list.product_card.after'); ?>

                        </div>

                        <!-- Product Grid Card Container -->
                        <div v-else class="mt-8 max-md:mt-5">
                            <!-- Product Card Shimmer Effect -->
                            <template v-if="isLoading">
                                <div class="grid grid-cols-3 gap-8 max-1060:grid-cols-2 max-md:justify-items-center max-md:gap-x-4">
                                    <?php if (isset($component)) { $__componentOriginal63d85b8bc2d72394bd433a79cbb59384 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal63d85b8bc2d72394bd433a79cbb59384 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.cards.grid','data' => ['count' => '12']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.cards.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['count' => '12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal63d85b8bc2d72394bd433a79cbb59384)): ?>
<?php $attributes = $__attributesOriginal63d85b8bc2d72394bd433a79cbb59384; ?>
<?php unset($__attributesOriginal63d85b8bc2d72394bd433a79cbb59384); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal63d85b8bc2d72394bd433a79cbb59384)): ?>
<?php $component = $__componentOriginal63d85b8bc2d72394bd433a79cbb59384; ?>
<?php unset($__componentOriginal63d85b8bc2d72394bd433a79cbb59384); ?>
<?php endif; ?>
                                </div>
                            </template>

                            <?php echo view_render_event('bagisto.shop.categories.view.grid.product_card.before'); ?>


                            <!-- Product Card Listing -->
                            <template v-else>
                                <template v-if="products.length">
                                    <div class="grid grid-cols-3 gap-8 max-1060:grid-cols-2 max-md:justify-items-center max-md:gap-x-4">
                                        <?php if (isset($component)) { $__componentOriginalce4ea8dd577f45125a0fa9f371a55f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce4ea8dd577f45125a0fa9f371a55f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.products.card','data' => [':mode' => '\'grid\'','vFor' => 'product in products']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::products.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([':mode' => '\'grid\'','v-for' => 'product in products']); ?>
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
                                </template>

                                <!-- Empty Products Container -->
                                <template v-else>
                                    <div class="m-auto grid w-full place-content-center items-center justify-items-center py-32 text-center">
                                        <img
                                            class="max-md:h-[100px] max-md:w-[100px]"
                                            src="<?php echo e(bagisto_asset('images/thank-you.png')); ?>"
                                            alt="<?php echo app('translator')->get('shop::app.categories.view.empty'); ?>"
                                        />

                                        <p
                                            class="text-xl max-md:text-sm"
                                            role="heading"
                                        >
                                            <?php echo app('translator')->get('shop::app.categories.view.empty'); ?>
                                        </p>
                                    </div>
                                </template>
                            </template>

                            <?php echo view_render_event('bagisto.shop.categories.view.grid.product_card.after'); ?>

                        </div>

                        <?php echo view_render_event('bagisto.shop.categories.view.load_more_button.before'); ?>


                        <!-- Load More Button -->
                        <button
                            class="secondary-button mx-auto mt-14 block w-max rounded-2xl px-11 py-3 text-center text-base max-md:rounded-lg max-sm:mt-6 max-sm:px-6 max-sm:py-1.5 max-sm:text-sm"
                            @click="loadMoreProducts"
                            v-if="links.next && ! loader"
                        >
                            <?php echo app('translator')->get('shop::app.categories.view.load-more'); ?>
                        </button>

                        <button
                            v-else-if="links.next"
                            class="secondary-button mx-auto mt-14 block w-max rounded-2xl px-[74.5px] py-3.5 text-center text-base max-md:rounded-lg max-md:py-3 max-sm:mt-6 max-sm:px-[50.8px] max-sm:py-1.5"
                        >
                            <!-- Spinner -->
                            <img
                                class="h-5 w-5 animate-spin text-navyBlue"
                                src="<?php echo e(bagisto_asset('images/spinner.svg')); ?>"
                                alt="Loading"
                            />
                        </button>

                        <?php echo view_render_event('bagisto.shop.categories.view.grid.load_more_button.after'); ?>

                    </div>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-category', {
                template: '#v-category-template',

                data() {
                    return {
                        isMobile: window.innerWidth <= 767,

                        isLoading: true,

                        isDrawerActive: {
                            toolbar: false,

                            filter: false,
                        },

                        filters: {
                            toolbar: {
                                default: {},

                                applied: {},
                            },

                            filter: {},
                        },

                        products: [],

                        links: {},

                        loader: false,
                    }
                },

                computed: {
                    queryParams() {
                        let queryParams = Object.assign({}, this.filters.filter, this.filters.toolbar.applied);

                        return this.removeJsonEmptyValues(queryParams);
                    },

                    queryString() {
                        return this.jsonToQueryString(this.queryParams);
                    },
                },

                watch: {
                    queryParams() {
                        this.getProducts();
                    },

                    queryString() {
                        window.history.pushState({}, '', '?' + this.queryString);
                    },
                },

                methods: {
                    setFilters(type, filters) {
                        this.filters[type] = filters;
                    },

                    clearFilters(type, filters) {
                        this.filters[type] = {};
                    },

                    getProducts() {
                        this.isDrawerActive = {
                            toolbar: false,

                            filter: false,
                        };

                        document.body.style.overflow ='scroll';

                        this.$axios.get("<?php echo e(route('shop.api.products.index', ['category_id' => $category->id])); ?>", {
                            params: this.queryParams
                        })
                            .then(response => {
                                this.isLoading = false;

                                this.products = response.data.data;

                                this.links = response.data.links;
                            }).catch(error => {
                                console.log(error);
                            });
                    },

                    loadMoreProducts() {
                        if (! this.links.next) {
                            return;
                        }

                        this.loader = true;

                        this.$axios.get(this.links.next)
                            .then(response => {
                                this.loader = false;

                                this.products = [...this.products, ...response.data.data];

                                this.links = response.data.links;
                            }).catch(error => {
                                console.log(error);
                            });
                    },

                    removeJsonEmptyValues(params) {
                        Object.keys(params).forEach(function (key) {
                            if ((! params[key] && params[key] !== undefined)) {
                                delete params[key];
                            }

                            if (Array.isArray(params[key])) {
                                params[key] = params[key].join(',');
                            }
                        });

                        return params;
                    },

                    jsonToQueryString(params) {
                        let parameters = new URLSearchParams();

                        for (const key in params) {
                            parameters.append(key, params[key]);
                        }

                        return parameters.toString();
                    }
                },
            });
        </script>
    <?php $__env->stopPush(); endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2643b7d197f48caff2f606750db81304)): ?>
<?php $attributes = $__attributesOriginal2643b7d197f48caff2f606750db81304; ?>
<?php unset($__attributesOriginal2643b7d197f48caff2f606750db81304); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2643b7d197f48caff2f606750db81304)): ?>
<?php $component = $__componentOriginal2643b7d197f48caff2f606750db81304; ?>
<?php unset($__componentOriginal2643b7d197f48caff2f606750db81304); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/categories/view.blade.php ENDPATH**/ ?>