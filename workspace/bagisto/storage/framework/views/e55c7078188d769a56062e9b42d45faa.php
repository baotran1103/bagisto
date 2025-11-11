<?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.before'); ?>


<div class="flex min-h-[78px] w-full justify-between border border-b border-l-0 border-r-0 border-t-0 px-[60px] max-1180:px-8">
    <!--
        This section will provide categories for the first, second, and third levels. If
        additional levels are required, users can customize them according to their needs.
    -->
    <!-- Left Nagivation Section -->
    <div class="flex items-center gap-x-10 max-[1180px]:gap-x-5">
        <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.before'); ?>


        <a
            href="<?php echo e(route('shop.home.index')); ?>"
            aria-label="<?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.bagisto'); ?>"
        >
            <img
                src="<?php echo e(core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg')); ?>"
                width="131"
                height="29"
                alt="<?php echo e(config('app.name')); ?>"
            >
        </a>

        <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.after'); ?>


        <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.before'); ?>


        <v-desktop-category>
            <div class="flex items-center gap-5">
                <span
                    class="shimmer h-6 w-20 rounded"
                    role="presentation"
                ></span>

                <span
                    class="shimmer h-6 w-20 rounded"
                    role="presentation"
                ></span>

                <span
                    class="shimmer h-6 w-20 rounded"
                    role="presentation"
                ></span>
            </div>
        </v-desktop-category>

        <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.after'); ?>

    </div>

    <!-- Right Nagivation Section -->
    <div class="flex items-center gap-x-9 max-[1100px]:gap-x-6 max-lg:gap-x-8">

        <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.search_bar.before'); ?>


        <!-- Search Bar Container -->
        <div class="relative w-full">
            <form
                action="<?php echo e(route('shop.search.index')); ?>"
                class="flex max-w-[445px] items-center"
                role="search"
            >
                <label
                    for="organic-search"
                    class="sr-only"
                >
                    <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.search'); ?>
                </label>

                <div class="icon-search pointer-events-none absolute top-2.5 flex items-center text-xl ltr:left-3 rtl:right-3"></div>

                <input
                    type="text"
                    name="query"
                    value="<?php echo e(request('query')); ?>"
                    class="block w-full rounded-lg border border-transparent bg-zinc-100 px-11 py-3 text-xs font-medium text-gray-900 transition-all hover:border-gray-400 focus:border-gray-400"
                    minlength="<?php echo e(core()->getConfigData('catalog.products.search.min_query_length')); ?>"
                    maxlength="<?php echo e(core()->getConfigData('catalog.products.search.max_query_length')); ?>"
                    placeholder="<?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.search-text'); ?>"
                    aria-label="<?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.search-text'); ?>"
                    aria-required="true"
                    pattern="[^\\]+"
                    required
                >

                <button
                    type="submit"
                    class="hidden"
                    aria-label="<?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.submit'); ?>"
                >
                </button>

                <?php if(core()->getConfigData('catalog.products.settings.image_search')): ?>
                    <?php echo $__env->make('shop::search.images.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>
            </form>
        </div>

        <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.search_bar.after'); ?>


        <!-- Right Navigation Links -->
        <div class="mt-1.5 flex gap-x-8 max-[1100px]:gap-x-6 max-lg:gap-x-8">

            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.before'); ?>


            <!-- Compare -->
            <?php if(core()->getConfigData('catalog.products.settings.compare_option')): ?>
                <a
                    href="<?php echo e(route('shop.compare.index')); ?>"
                    aria-label="<?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.compare'); ?>"
                >
                    <span
                        class="icon-compare inline-block cursor-pointer text-2xl"
                        role="presentation"
                    ></span>
                </a>
            <?php endif; ?>

            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.after'); ?>


            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.before'); ?>


            <!-- Mini cart -->
            <?php if(core()->getConfigData('sales.checkout.shopping_cart.cart_page')): ?>
                <?php echo $__env->make('shop::checkout.cart.mini-cart', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?>

            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.after'); ?>


            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile.before'); ?>


            <!-- user profile -->
            <?php if (isset($component)) { $__componentOriginal6eb652d0a4a36e6466d8d4f363feb553 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6eb652d0a4a36e6466d8d4f363feb553 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.dropdown.index','data' => ['position' => 'bottom-'.e(core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['position' => 'bottom-'.e(core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left').'']); ?>
                 <?php $__env->slot('toggle', null, []); ?> 
                    <span
                        class="icon-users inline-block cursor-pointer text-2xl"
                        role="button"
                        aria-label="<?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.profile'); ?>"
                        tabindex="0"
                    ></span>
                 <?php $__env->endSlot(); ?>

                <!-- Guest Dropdown -->
                <?php if(auth()->guard('customer')->guest()): ?>
                     <?php $__env->slot('content', null, []); ?> 
                        <div class="grid gap-2.5">
                            <p class="font-dmserif text-xl">
                                <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.welcome-guest'); ?>
                            </p>

                            <p class="text-sm">
                                <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.dropdown-text'); ?>
                            </p>
                        </div>

                        <p class="mt-3 w-full border border-zinc-200"></p>

                        <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.customers_action.before'); ?>


                        <div class="mt-6 flex gap-4">
                            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.sign_in_button.before'); ?>


                            <a
                                href="<?php echo e(route('shop.customer.session.create')); ?>"
                                class="primary-button m-0 mx-auto block w-max rounded-2xl px-7 text-center text-base max-md:rounded-lg ltr:ml-0 rtl:mr-0"
                            >
                                <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.sign-in'); ?>
                            </a>

                            <a
                                href="<?php echo e(route('shop.customers.register.index')); ?>"
                                class="secondary-button m-0 mx-auto block w-max rounded-2xl border-2 px-7 text-center text-base max-md:rounded-lg max-md:py-3 ltr:ml-0 rtl:mr-0"
                            >
                                <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.sign-up'); ?>
                            </a>

                            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.sign_up_button.after'); ?>

                        </div>

                        <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.customers_action.after'); ?>

                     <?php $__env->endSlot(); ?>
                <?php endif; ?>

                <!-- Customers Dropdown -->
                <?php if(auth()->guard('customer')->check()): ?>
                     <?php $__env->slot('content', null, ['class' => '!p-0']); ?> 
                        <div class="grid gap-2.5 p-5 pb-0">
                            <p class="font-dmserif text-xl">
                                <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.welcome'); ?>’
                                <?php echo e(auth()->guard('customer')->user()->first_name); ?>

                            </p>

                            <p class="text-sm">
                                <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.dropdown-text'); ?>
                            </p>
                        </div>

                        <p class="mt-3 w-full border border-zinc-200"></p>

                        <div class="mt-2.5 grid gap-1 pb-2.5">
                            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile_dropdown.links.before'); ?>


                            <a
                                class="cursor-pointer px-5 py-2 text-base hover:bg-gray-100"
                                href="<?php echo e(route('shop.customers.account.profile.index')); ?>"
                            >
                                <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.profile'); ?>
                            </a>

                            <a
                                class="cursor-pointer px-5 py-2 text-base hover:bg-gray-100"
                                href="<?php echo e(route('shop.customers.account.orders.index')); ?>"
                            >
                                <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.orders'); ?>
                            </a>

                            <?php if(core()->getConfigData('customer.settings.wishlist.wishlist_option')): ?>
                                <a
                                    class="cursor-pointer px-5 py-2 text-base hover:bg-gray-100"
                                    href="<?php echo e(route('shop.customers.account.wishlist.index')); ?>"
                                >
                                    <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.wishlist'); ?>
                                </a>
                            <?php endif; ?>

                            <!--Customers logout-->
                            <?php if(auth()->guard('customer')->check()): ?>
                                <?php if (isset($component)) { $__componentOriginal4d3fcee3e355fb6c8889181b04f357cc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d3fcee3e355fb6c8889181b04f357cc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.index','data' => ['method' => 'DELETE','action' => ''.e(route('shop.customer.session.destroy')).'','id' => 'customerLogout']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['method' => 'DELETE','action' => ''.e(route('shop.customer.session.destroy')).'','id' => 'customerLogout']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d3fcee3e355fb6c8889181b04f357cc)): ?>
<?php $attributes = $__attributesOriginal4d3fcee3e355fb6c8889181b04f357cc; ?>
<?php unset($__attributesOriginal4d3fcee3e355fb6c8889181b04f357cc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d3fcee3e355fb6c8889181b04f357cc)): ?>
<?php $component = $__componentOriginal4d3fcee3e355fb6c8889181b04f357cc; ?>
<?php unset($__componentOriginal4d3fcee3e355fb6c8889181b04f357cc); ?>
<?php endif; ?>

                                <a
                                    class="cursor-pointer px-5 py-2 text-base hover:bg-gray-100"
                                    href="<?php echo e(route('shop.customer.session.destroy')); ?>"
                                    onclick="event.preventDefault(); document.getElementById('customerLogout').submit();"
                                >
                                    <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.logout'); ?>
                                </a>
                            <?php endif; ?>

                            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile_dropdown.links.after'); ?>

                        </div>
                     <?php $__env->endSlot(); ?>
                <?php endif; ?>
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

            <?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile.after'); ?>

        </div>
    </div>
</div>

<?php if (! $__env->hasRenderedOnce('989b59ba-77f2-4793-8264-503b376fbaab')): $__env->markAsRenderedOnce('989b59ba-77f2-4793-8264-503b376fbaab');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id="v-desktop-category-template"
    >
        <!-- Loading State -->
        <div
            class="flex items-center gap-5"
            v-if="isLoading"
        >
            <span
                class="shimmer h-6 w-20 rounded"
                role="presentation"
            ></span>

            <span
                class="shimmer h-6 w-20 rounded"
                role="presentation"
            ></span>

            <span
                class="shimmer h-6 w-20 rounded"
                role="presentation"
            ></span>
        </div>

        <!-- Default category layout -->
        <div
            class="flex items-center"
            v-else-if="'<?php echo e(core()->getConfigData('general.design.categories.category_view')); ?>' !== 'sidebar'"
        >
            <div
                class="group relative flex h-[77px] items-center border-b-4 border-transparent hover:border-b-4 hover:border-navyBlue"
                v-for="category in categories"
            >
                <span>
                    <a
                        :href="category.url"
                        class="inline-block px-5 uppercase"
                    >
                        {{ category.name }}
                    </a>
                </span>

                <div
                    class="pointer-events-none absolute top-[78px] z-[1] max-h-[580px] w-max max-w-[1260px] translate-y-1 overflow-auto overflow-x-auto border border-b-0 border-l-0 border-r-0 border-t border-[#F3F3F3] bg-white p-9 opacity-0 shadow-[0_6px_6px_1px_rgba(0,0,0,.3)] transition duration-300 ease-out group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100 group-hover:duration-200 group-hover:ease-in ltr:-left-9 rtl:-right-9"
                    v-if="category.children && category.children.length"
                >
                    <div class="flex justify-between gap-x-[70px]">
                        <div
                            class="grid w-full min-w-max max-w-[150px] flex-auto grid-cols-[1fr] content-start gap-5"
                            v-for="pairCategoryChildren in pairCategoryChildren(category)"
                        >
                            <template v-for="secondLevelCategory in pairCategoryChildren">
                                <p class="font-medium text-navyBlue">
                                    <a :href="secondLevelCategory.url">
                                        {{ secondLevelCategory.name }}
                                    </a>
                                </p>

                                <ul
                                    class="grid grid-cols-[1fr] gap-3"
                                    v-if="secondLevelCategory.children && secondLevelCategory.children.length"
                                >
                                    <li
                                        class="text-sm font-medium text-zinc-500"
                                        v-for="thirdLevelCategory in secondLevelCategory.children"
                                    >
                                        <a :href="thirdLevelCategory.url">
                                            {{ thirdLevelCategory.name }}
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar category layout -->
        <div v-else>
            <!-- Categories Navigation -->
            <div class="flex items-center">
                <!-- "All" button for opening the category drawer -->
                <div
                    class="flex h-[77px] cursor-pointer items-center border-b-4 border-transparent hover:border-b-4 hover:border-navyBlue"
                    @click="toggleCategoryDrawer"
                >
                    <span class="flex items-center gap-1 px-5 uppercase">
                        <span class="icon-hamburger text-xl"></span>

                        <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.all'); ?>
                    </span>
                </div>

                <!-- Show only first 4 categories in main navigation -->
                <div
                    class="group relative flex h-[77px] items-center border-b-4 border-transparent hover:border-b-4 hover:border-navyBlue"
                    v-for="category in categories.slice(0, 4)"
                >
                    <span>
                        <a
                            :href="category.url"
                            class="inline-block px-5 uppercase"
                        >
                            {{ category.name }}
                        </a>
                    </span>

                    <!-- Dropdown for each category -->
                    <div
                        class="pointer-events-none absolute top-[78px] z-[1] max-h-[580px] w-max max-w-[1260px] translate-y-1 overflow-auto overflow-x-auto border border-b-0 border-l-0 border-r-0 border-t border-[#F3F3F3] bg-white p-9 opacity-0 shadow-[0_6px_6px_1px_rgba(0,0,0,.3)] transition duration-300 ease-out group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100 group-hover:duration-200 group-hover:ease-in ltr:-left-9 rtl:-right-9"
                        v-if="category.children && category.children.length"
                    >
                        <div class="flex justify-between gap-x-[70px]">
                            <div
                                class="grid w-full min-w-max max-w-[150px] flex-auto grid-cols-[1fr] content-start gap-5"
                                v-for="pairCategoryChildren in pairCategoryChildren(category)"
                            >
                                <template v-for="secondLevelCategory in pairCategoryChildren">
                                    <p class="font-medium text-navyBlue">
                                        <a :href="secondLevelCategory.url">
                                            {{ secondLevelCategory.name }}
                                        </a>
                                    </p>

                                    <ul
                                        class="grid grid-cols-[1fr] gap-3"
                                        v-if="secondLevelCategory.children && secondLevelCategory.children.length"
                                    >
                                        <li
                                            class="text-sm font-medium text-zinc-500"
                                            v-for="thirdLevelCategory in secondLevelCategory.children"
                                        >
                                            <a :href="thirdLevelCategory.url">
                                                {{ thirdLevelCategory.name }}
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagisto Drawer Integration -->
            <?php if (isset($component)) { $__componentOriginal2b3e2da8ab003ef79d854b1862e64fc8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b3e2da8ab003ef79d854b1862e64fc8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.drawer.index','data' => ['position' => 'left','width' => '400px',':isActive' => 'isDrawerActive','@toggle' => 'onDrawerToggle','@close' => 'onDrawerClose']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::drawer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['position' => 'left','width' => '400px',':is-active' => 'isDrawerActive','@toggle' => 'onDrawerToggle','@close' => 'onDrawerClose']); ?>
                 <?php $__env->slot('toggle', null, []); ?>  <?php $__env->endSlot(); ?>

                 <?php $__env->slot('header', null, ['class' => 'border-b border-gray-200']); ?> 
                    <div class="flex w-full items-center justify-between">
                        <p class="text-xl font-medium">
                            <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.categories'); ?>
                        </p>
                    </div>
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('content', null, ['class' => '!px-0']); ?> 
                    <!-- Wrapper with transition effects -->
                    <div class="relative h-full overflow-hidden">
                        <!-- Sliding container -->
                        <div
                            class="flex h-full transition-transform duration-300"
                            :class="{
                                'ltr:translate-x-0 rtl:translate-x-0': currentViewLevel !== 'third',
                                'ltr:-translate-x-full rtl:translate-x-full': currentViewLevel === 'third'
                            }"
                        >
                            <!-- First level view -->
                            <div class="h-[calc(100vh-74px)] w-full flex-shrink-0 overflow-auto">
                                <div class="py-4">
                                    <div
                                        v-for="category in categories"
                                        :key="category.id"
                                        :class="{'mb-2': category.children && category.children.length}"
                                    >
                                        <div class="flex cursor-pointer items-center justify-between px-6 py-2 transition-colors duration-200 hover:bg-gray-100">
                                            <a
                                                :href="category.url"
                                                class="text-base font-medium text-black"
                                            >
                                                {{ category.name }}
                                            </a>
                                        </div>

                                        <!-- Second Level Categories -->
                                        <div v-if="category.children && category.children.length" >
                                            <div
                                                v-for="secondLevelCategory in category.children"
                                                :key="secondLevelCategory.id"
                                            >
                                                <div
                                                    class="flex cursor-pointer items-center justify-between px-6 py-2 transition-colors duration-200 hover:bg-gray-100"
                                                    @click="showThirdLevel(secondLevelCategory, category, $event)"
                                                >
                                                    <a
                                                        :href="secondLevelCategory.url"
                                                        class="text-sm font-normal"
                                                    >
                                                        {{ secondLevelCategory.name }}
                                                    </a>

                                                    <span
                                                        v-if="secondLevelCategory.children && secondLevelCategory.children.length"
                                                        class="icon-arrow-right rtl:icon-arrow-left"
                                                    ></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Third level view -->
                            <div
                                class="h-full w-full flex-shrink-0"
                                v-if="currentViewLevel === 'third'"
                            >
                                <div class="border-b border-gray-200 px-6 py-4">
                                    <button
                                        @click="goBackToMainView"
                                        class="flex items-center justify-center gap-2 focus:outline-none"
                                        aria-label="Go back"
                                    >
                                        <span class="icon-arrow-left rtl:icon-arrow-right text-lg"></span>

                                        <p class="text-base font-medium text-black">
                                            <?php echo app('translator')->get('shop::app.components.layouts.header.desktop.bottom.back-button'); ?>
                                        </p>
                                    </button>
                                </div>

                                <!-- Third Level Content -->
                                <div class="py-4">
                                    <div
                                        v-for="thirdLevelCategory in currentSecondLevelCategory?.children"
                                        :key="thirdLevelCategory.id"
                                        class="mb-2"
                                    >
                                        <a
                                            :href="thirdLevelCategory.url"
                                            class="block px-6 py-2 text-sm transition-colors duration-200 hover:bg-gray-100"
                                        >
                                            {{ thirdLevelCategory.name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b3e2da8ab003ef79d854b1862e64fc8)): ?>
<?php $attributes = $__attributesOriginal2b3e2da8ab003ef79d854b1862e64fc8; ?>
<?php unset($__attributesOriginal2b3e2da8ab003ef79d854b1862e64fc8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b3e2da8ab003ef79d854b1862e64fc8)): ?>
<?php $component = $__componentOriginal2b3e2da8ab003ef79d854b1862e64fc8; ?>
<?php unset($__componentOriginal2b3e2da8ab003ef79d854b1862e64fc8); ?>
<?php endif; ?>
        </div>
    </script>

    <script type="module">
        app.component('v-desktop-category', {
            template: '#v-desktop-category-template',

            data() {
                return {
                    isLoading: true,
                    categories: [],
                    isDrawerActive: false,
                    currentViewLevel: 'main',
                    currentSecondLevelCategory: null,
                    currentParentCategory: null
                }
            },

            mounted() {
                this.getCategories();
            },

            methods: {
                getCategories() {
                    this.$axios.get("<?php echo e(route('shop.api.categories.tree')); ?>")
                        .then(response => {
                            this.isLoading = false;
                            this.categories = response.data.data;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                },

                pairCategoryChildren(category) {
                    if (! category.children) return [];

                    return category.children.reduce((result, value, index, array) => {
                        if (index % 2 === 0) {
                            result.push(array.slice(index, index + 2));
                        }
                        return result;
                    }, []);
                },

                toggleCategoryDrawer() {
                    this.isDrawerActive = !this.isDrawerActive;
                    if (this.isDrawerActive) {
                        this.currentViewLevel = 'main';
                    }
                },

                onDrawerToggle(event) {
                    this.isDrawerActive = event.isActive;
                },

                onDrawerClose(event) {
                    this.isDrawerActive = false;
                },

                showThirdLevel(secondLevelCategory, parentCategory, event) {
                    if (secondLevelCategory.children && secondLevelCategory.children.length) {
                        this.currentSecondLevelCategory = secondLevelCategory;
                        this.currentParentCategory = parentCategory;
                        this.currentViewLevel = 'third';

                        if (event) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                    }
                },

                goBackToMainView() {
                    this.currentViewLevel = 'main';
                }
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?>
<?php echo view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.after'); ?>

<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/layouts/header/desktop/bottom.blade.php ENDPATH**/ ?>