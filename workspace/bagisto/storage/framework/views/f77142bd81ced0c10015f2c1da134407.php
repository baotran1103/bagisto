<?php echo view_render_event('bagisto.shop.categories.view.toolbar.before'); ?>


<v-toolbar @filter-applied='setFilters("toolbar", $event)'></v-toolbar>

<?php echo view_render_event('bagisto.shop.categories.view.toolbar.after'); ?>


<?php $toolbar = app('Webkul\Product\Helpers\Toolbar'); ?>

<?php if (! $__env->hasRenderedOnce('bcde12a6-a47f-4632-82cc-a5af651d8a41')): $__env->markAsRenderedOnce('bcde12a6-a47f-4632-82cc-a5af651d8a41');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id='v-toolbar-template'
    >
        <div>
            <!-- Desktop Toolbar -->
            <div class="flex justify-between max-md:hidden">
                <?php echo view_render_event('bagisto.shop.categories.toolbar.filter.before'); ?>


                <!-- Product Sorting Filters -->
                <?php if (isset($component)) { $__componentOriginal6eb652d0a4a36e6466d8d4f363feb553 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6eb652d0a4a36e6466d8d4f363feb553 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.dropdown.index','data' => ['class' => 'z-[1]','position' => 'bottom-left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'z-[1]','position' => 'bottom-left']); ?>
                     <?php $__env->slot('toggle', null, []); ?> 
                        <!-- Dropdown Toggler -->
                        <button class="flex w-full max-w-[200px] cursor-pointer items-center justify-between gap-4 rounded-lg border border-zinc-200 bg-white p-3.5 text-base transition-all hover:border-gray-400 focus:border-gray-400 max-md:w-[110px] max-md:border-0 max-md:pl-2.5 max-md:pr-2.5">
                            {{ sortLabel ?? "<?php echo app('translator')->get('shop::app.products.sort-by.title'); ?>" }}

                            <span
                                class="icon-arrow-down text-2xl"
                                role="presentation"
                            ></span>
                        </button>
                     <?php $__env->endSlot(); ?>

                    <!-- Dropdown Content -->
                     <?php $__env->slot('menu', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginalb61dc971083484c78229c771be09733d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb61dc971083484c78229c771be09733d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.dropdown.menu.item','data' => ['vFor' => '(sort, key) in filters.available.sort',':class' => '{\'bg-gray-100\': sort.value == filters.applied.sort}','@click' => 'apply(\'sort\', sort.value)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::dropdown.menu.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['v-for' => '(sort, key) in filters.available.sort',':class' => '{\'bg-gray-100\': sort.value == filters.applied.sort}','@click' => 'apply(\'sort\', sort.value)']); ?>
                            {{ sort.title }}
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb61dc971083484c78229c771be09733d)): ?>
<?php $attributes = $__attributesOriginalb61dc971083484c78229c771be09733d; ?>
<?php unset($__attributesOriginalb61dc971083484c78229c771be09733d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb61dc971083484c78229c771be09733d)): ?>
<?php $component = $__componentOriginalb61dc971083484c78229c771be09733d; ?>
<?php unset($__componentOriginalb61dc971083484c78229c771be09733d); ?>
<?php endif; ?>
                     <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6eb652d0a4a36e6466d8d4f363feb553)): ?>
<?php $attributes = $__attributesOriginal6eb652d0a4a36e6466d8d4f363feb553; ?>
<?php unset($__attributesOriginal6eb652d0a4a36e6466d8d4f363feb553); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6eb652d0a4a36e6466d8d4f363feb553)): ?>
<?php $component = $__componentOriginal6eb652d0a4a36e6466d8d4f363feb553; ?>
<?php unset($__componentOriginal6eb652d0a4a36e6466d8d4f363feb553); ?>
<?php endif; ?>

                <?php echo view_render_event('bagisto.shop.categories.toolbar.filter.after'); ?>


                <?php echo view_render_event('bagisto.shop.categories.toolbar.pagination.before'); ?>


                <!-- Product Pagination Limit -->
                <div class="flex items-center gap-10">
                    <!-- Product Pagination Limit -->
                    <?php if (isset($component)) { $__componentOriginal6eb652d0a4a36e6466d8d4f363feb553 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6eb652d0a4a36e6466d8d4f363feb553 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.dropdown.index','data' => ['position' => 'bottom-right']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['position' => 'bottom-right']); ?>
                         <?php $__env->slot('toggle', null, []); ?> 
                            <!-- Dropdown Toggler -->
                            <button class="flex w-full max-w-[200px] cursor-pointer items-center justify-between gap-4 rounded-lg border border-zinc-200 bg-white p-3.5 text-base transition-all hover:border-gray-400 focus:border-gray-400 max-md:w-[110px] max-md:border-0 max-md:pl-2.5 max-md:pr-2.5">
                                {{ filters.applied.limit ?? "<?php echo app('translator')->get('shop::app.categories.toolbar.show'); ?>" }}

                                <span
                                    class="icon-arrow-down text-2xl"
                                    role="presentation"
                                ></span>
                            </button>
                         <?php $__env->endSlot(); ?>

                        <!-- Dropdown Content -->
                         <?php $__env->slot('menu', null, []); ?> 
                            <?php if (isset($component)) { $__componentOriginalb61dc971083484c78229c771be09733d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb61dc971083484c78229c771be09733d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.dropdown.menu.item','data' => ['vFor' => '(limit, key) in filters.available.limit',':class' => '{\'bg-gray-100\': limit == filters.applied.limit}','@click' => 'apply(\'limit\', limit)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::dropdown.menu.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['v-for' => '(limit, key) in filters.available.limit',':class' => '{\'bg-gray-100\': limit == filters.applied.limit}','@click' => 'apply(\'limit\', limit)']); ?>
                                {{ limit }}
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb61dc971083484c78229c771be09733d)): ?>
<?php $attributes = $__attributesOriginalb61dc971083484c78229c771be09733d; ?>
<?php unset($__attributesOriginalb61dc971083484c78229c771be09733d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb61dc971083484c78229c771be09733d)): ?>
<?php $component = $__componentOriginalb61dc971083484c78229c771be09733d; ?>
<?php unset($__componentOriginalb61dc971083484c78229c771be09733d); ?>
<?php endif; ?>
                         <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6eb652d0a4a36e6466d8d4f363feb553)): ?>
<?php $attributes = $__attributesOriginal6eb652d0a4a36e6466d8d4f363feb553; ?>
<?php unset($__attributesOriginal6eb652d0a4a36e6466d8d4f363feb553); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6eb652d0a4a36e6466d8d4f363feb553)): ?>
<?php $component = $__componentOriginal6eb652d0a4a36e6466d8d4f363feb553; ?>
<?php unset($__componentOriginal6eb652d0a4a36e6466d8d4f363feb553); ?>
<?php endif; ?>

                    <!-- Listing Mode Switcher -->
                    <div class="flex items-center gap-5">
                        <span
                            class="cursor-pointer text-2xl"
                            role="button"
                            aria-label="<?php echo app('translator')->get('shop::app.categories.toolbar.list'); ?>"
                            tabindex="0"
                            :class="(filters.applied.mode === 'list') ? 'icon-listing-fill' : 'icon-listing'"
                            @click="changeMode('list')"
                        >
                        </span>

                        <span
                            class="cursor-pointer text-2xl"
                            role="button"
                            aria-label="<?php echo app('translator')->get('shop::app.categories.toolbar.grid'); ?>"
                            tabindex="0"
                            :class="(filters.applied.mode === 'grid') ? 'icon-grid-view-fill' : 'icon-grid-view'"
                            @click="changeMode('grid')"
                        >
                        </span>
                    </div>
                </div>

                <?php echo view_render_event('bagisto.shop.categories.toolbar.pagination.after'); ?>

            </div>

            <!-- Mobile Toolbar -->
            <div class="md:hidden">
                <ul>
                    <li
                        class="px-4 py-2.5"
                        :class="{'bg-gray-100': sort.value == filters.applied.sort}"
                        v-for="(sort, key) in filters.available.sort"
                        @click="apply('sort', sort.value)"
                    >
                        {{ sort.title }}
                    </li>
                </ul>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-toolbar', {
            template: '#v-toolbar-template',

            data() {
                return {
                    filters: {
                        available: {
                            sort: <?php echo json_encode($toolbar->getAvailableOrders(), 15, 512) ?>,

                            limit: <?php echo json_encode($toolbar->getAvailableLimits(), 15, 512) ?>,

                            mode: <?php echo json_encode($toolbar->getAvailableModes(), 15, 512) ?>,
                        },

                        default: {
                            sort: '<?php echo e($toolbar->getOrder([])['value']); ?>',

                            limit: '<?php echo e($toolbar->getLimit([])); ?>',

                            mode: '<?php echo e($toolbar->getMode([])); ?>',
                        },

                        applied: {
                            sort: '<?php echo e($toolbar->getOrder($params ?? [])['value']); ?>',

                            limit: '<?php echo e($toolbar->getLimit($params ?? [])); ?>',

                            mode: '<?php echo e($toolbar->getMode($params ?? [])); ?>',
                        }
                    }
                };
            },

            created() {
                let queryParams = new URLSearchParams(window.location.search);

                queryParams.forEach((value, filter) => {
                    if (['sort', 'limit', 'mode'].includes(filter)) {
                        this.filters.applied[filter] = value;
                    }
                });
            },

            mounted() {
                this.setFilters();
            },

            computed: {
                sortLabel() {
                    return this.filters.available.sort.find(sort => sort.value === this.filters.applied.sort).title;
                }
            },

            methods: {
                apply(type, value) {
                    this.filters.applied[type] = value;

                    this.setFilters();
                },

                changeMode(value = 'grid') {
                    this.filters.applied['mode'] = value;

                    this.setFilters();
                },

                setFilters() {
                    let filters = {};

                    for (let key in this.filters.applied) {
                        if (this.filters.applied[key] != this.filters.default[key]) {
                            filters[key] = this.filters.applied[key];
                        }
                    }

                    this.$emit('filter-applied', {
                        default: this.filters.default,
                        applied: filters,
                    });
                }
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/categories/toolbar.blade.php ENDPATH**/ ?>