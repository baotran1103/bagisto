<!-- Mini Cart Vue Component -->
<v-mini-cart>
    <span
        class="icon-cart cursor-pointer text-2xl"
        role="button"
        aria-label="<?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.shopping-cart'); ?>"
    ></span>
</v-mini-cart>

<?php if (! $__env->hasRenderedOnce('393218df-9c4d-4eb2-b34d-1eabc441c2b8')): $__env->markAsRenderedOnce('393218df-9c4d-4eb2-b34d-1eabc441c2b8');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id="v-mini-cart-template"
    >
        <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.before'); ?>


        <?php if(core()->getConfigData('sales.checkout.mini_cart.display_mini_cart')): ?>
            <?php if (isset($component)) { $__componentOriginal2b3e2da8ab003ef79d854b1862e64fc8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b3e2da8ab003ef79d854b1862e64fc8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.drawer.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::drawer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <!-- Drawer Toggler -->
                 <?php $__env->slot('toggle', null, []); ?> 
                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.toggle.before'); ?>


                    <span class="relative">
                        <span
                            class="icon-cart cursor-pointer text-2xl"
                            role="button"
                            aria-label="<?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.shopping-cart'); ?>"
                            tabindex="0"
                        ></span>

                        <?php if(core()->getConfigData('sales.checkout.my_cart.summary') == 'display_item_quantity'): ?>
                            <span
                                class="absolute -top-4 rounded-[44px] bg-navyBlue px-2 py-1.5 text-xs font-semibold leading-[9px] text-white ltr:left-5 rtl:right-5 max-md:ltr:left-4 max-md:rtl:right-4"
                                v-if="cart?.items_qty"
                            >
                                {{ cart.items_qty }}
                            </span>
                        <?php else: ?>
                            <span
                                class="absolute -top-4 rounded-[44px] bg-navyBlue px-2 py-1.5 text-xs font-semibold leading-[9px] text-white ltr:left-5 rtl:right-5 max-md:px-2 max-md:py-1.5 max-md:ltr:left-4 max-md:rtl:right-4"
                                v-if="cart?.items_count"
                            >
                                {{ cart.items_count }}
                            </span>
                        <?php endif; ?>
                    </span>

                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.toggle.after'); ?>

                 <?php $__env->endSlot(); ?>

                <!-- Drawer Header -->
                 <?php $__env->slot('header', null, []); ?> 
                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.header.before'); ?>


                    <div class="flex items-center justify-between">
                        <p class="text-2xl font-medium max-md:text-xl max-sm:text-xl">
                            <?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.shopping-cart'); ?>
                        </p>
                    </div>

                    <p class="text-base max-md:text-zinc-500 max-sm:text-xs">
                        <?php echo e(core()->getConfigData('sales.checkout.mini_cart.offer_info')); ?>

                    </p>

                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.header.after'); ?>

                 <?php $__env->endSlot(); ?>

                <!-- Drawer Content -->
                 <?php $__env->slot('content', null, []); ?> 
                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.before'); ?>


                    <!-- Cart Item Listing -->
                    <div
                        class="mt-9 grid gap-12 max-md:mt-2.5 max-md:gap-5"
                        v-if="cart?.items?.length"
                    >
                        <div
                            class="flex gap-x-5 max-md:gap-x-4"
                            v-for="item in cart?.items"
                        >
                            <!-- Cart Item Image -->
                            <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.image.before'); ?>


                            <div class="">
                                <a :href="`<?php echo e(route('shop.product_or_category.index', '')); ?>/${item.product_url_key}`">
                                    <img
                                        :src="item.base_image.small_image_url"
                                        class="max-w-28 max-h-28 rounded-xl max-md:max-h-20 max-md:max-w-[76px]"
                                    />
                                </a>
                            </div>

                            <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.image.after'); ?>


                        <!-- Cart Item Information -->
                        <div class="grid flex-1 place-content-start justify-stretch gap-y-2.5">
                            <div class="flex justify-between gap-2 max-md:gap-0 max-sm:flex-wrap">

                                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.name.before'); ?>


                                    <a
                                    class="max-w-4/5 max-md:w-full"
                                    :href="`<?php echo e(route('shop.product_or_category.index', '')); ?>/${item.product_url_key}`"
                                >
                                        <p class="text-base font-medium max-md:font-normal max-sm:text-sm">
                                            {{ item.name }}
                                        </p>
                                    </a>

                                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.name.after'); ?>


                                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.price.before'); ?>


                                    <template v-if="displayTax.prices == 'including_tax'">
                                        <p class="text-lg max-md:font-semibold max-sm:text-sm">
                                            {{ item.formatted_price_incl_tax }}
                                        </p>
                                    </template>

                                    <template v-else-if="displayTax.prices == 'both'">
                                        <p class="flex flex-col text-lg max-md:font-semibold max-sm:text-sm">
                                            {{ item.formatted_price_incl_tax }}

                                            <span class="text-xs font-normal text-zinc-500">
                                                <?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.excl-tax'); ?>

                                                <span class="font-medium text-black">{{ item.formatted_price }}</span>
                                            </span>
                                        </p>
                                    </template>

                                    <template v-else>
                                        <p class="text-lg max-md:font-semibold max-sm:text-sm">
                                            {{ item.formatted_price }}
                                        </p>
                                    </template>

                                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.price.after'); ?>

                                </div>

                                <!-- Cart Item Options Container -->
                                <div
                                    class="grid select-none gap-x-2.5 gap-y-1.5 max-sm:gap-y-0.5"
                                    v-if="item.options.length"
                                >

                                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.product_details.before'); ?>


                                    <!-- Details Toggler -->
                                    <div class="">
                                        <p
                                            class="flex cursor-pointer items-center gap-x-4 text-base max-md:gap-x-1.5 max-md:text-sm max-sm:text-xs"
                                            @click="item.option_show = ! item.option_show"
                                        >
                                            <?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.see-details'); ?>

                                            <span
                                                class="text-2xl max-md:text-xl max-sm:text-lg"
                                                :class="{'icon-arrow-up': item.option_show, 'icon-arrow-down': ! item.option_show}"
                                            ></span>
                                        </p>
                                    </div>

                                    <!-- Option Details -->
                                    <div
                                        class="grid gap-2"
                                        v-show="item.option_show"
                                    >
                                        <template v-for="attribute in item.options">
                                            <div class="max-md:grid max-md:gap-0.5">
                                                <p class="text-sm font-medium text-zinc-500 max-md:font-normal max-sm:text-xs">
                                                    {{ attribute.attribute_name + ':' }}
                                                </p>

                                                <p class="text-sm max-sm:text-xs">
                                                    <template v-if="attribute?.attribute_type === 'file'">
                                                        <a
                                                            :href="attribute.file_url"
                                                            class="text-blue-700"
                                                            target="_blank"
                                                            :download="attribute.file_name"
                                                        >
                                                            {{ attribute.file_name }}
                                                        </a>
                                                    </template>

                                                    <template v-else>
                                                        {{ attribute.option_label }}
                                                    </template>
                                                </p>
                                            </div>
                                        </template>
                                    </div>

                                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.product_details.after'); ?>

                                </div>

                                <div class="flex flex-wrap items-center gap-5 max-md:gap-2.5">
                                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.quantity_changer.before'); ?>


                                <!-- Cart Item Quantity Changer -->
                                <?php if (isset($component)) { $__componentOriginal6c50a43d549a14cd17ba26b5e08aa48c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c50a43d549a14cd17ba26b5e08aa48c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.quantity-changer.index','data' => ['class' => 'max-h-9 max-w-[150px] gap-x-2.5 rounded-[54px] px-3.5 py-1.5 max-md:gap-x-2 max-md:px-1 max-md:py-0.5','name' => 'quantity',':value' => 'item?.quantity','@change' => 'updateItem($event, item)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::quantity-changer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-h-9 max-w-[150px] gap-x-2.5 rounded-[54px] px-3.5 py-1.5 max-md:gap-x-2 max-md:px-1 max-md:py-0.5','name' => 'quantity',':value' => 'item?.quantity','@change' => 'updateItem($event, item)']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6c50a43d549a14cd17ba26b5e08aa48c)): ?>
<?php $attributes = $__attributesOriginal6c50a43d549a14cd17ba26b5e08aa48c; ?>
<?php unset($__attributesOriginal6c50a43d549a14cd17ba26b5e08aa48c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6c50a43d549a14cd17ba26b5e08aa48c)): ?>
<?php $component = $__componentOriginal6c50a43d549a14cd17ba26b5e08aa48c; ?>
<?php unset($__componentOriginal6c50a43d549a14cd17ba26b5e08aa48c); ?>
<?php endif; ?>

                                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.quantity_changer.after'); ?>


                                <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.remove_button.before'); ?>


                                <!-- Cart Item Remove Button -->
                                <button
                                    type="button"
                                    class="text-blue-700 max-md:text-sm"
                                    @click="removeItem(item.id)"
                                >
                                    <?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.remove'); ?>
                                </button>

                                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.remove_button.after'); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty Cart Section -->
                    <div
                        class="mt-32 pb-8 max-md:mt-32"
                        v-else
                    >
                        <div class="b-0 grid place-items-center gap-y-5 max-md:gap-y-0">
                            <img
                                class="max-md:h-[100px] max-md:w-[100px]"
                                src="<?php echo e(bagisto_asset('images/thank-you.png')); ?>"
                            >

                            <p
                                class="text-xl max-md:text-sm"
                                role="heading"
                            >
                                <?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.empty-cart'); ?>
                            </p>
                        </div>
                    </div>

                    <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.after'); ?>

                 <?php $__env->endSlot(); ?>

            <!-- Drawer Footer -->
             <?php $__env->slot('footer', null, []); ?> 
                <div
                    v-if="cart?.items?.length"
                    class="grid-col-1 grid gap-5 max-md:gap-2.5"
                >
                    <div
                        class="my-8 flex items-center justify-between border-b border-zinc-200 px-6 pb-2 max-md:my-0 max-md:border-t max-md:px-5 max-md:py-2"
                        :class="{'!justify-end': isLoading}"
                    >
                        <?php echo view_render_event('bagisto.shop.checkout.mini-cart.subtotal.before'); ?>


                        <template v-if="! isLoading">
                            <p class="text-sm font-medium text-zinc-500">
                                <?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.subtotal'); ?>
                            </p>

                        <template v-if="displayTax.subtotal == 'including_tax'">
                            <p class="text-3xl font-semibold max-md:text-base">
                                {{ cart.formatted_sub_total_incl_tax }}
                            </p>
                        </template>

                        <template v-else-if="displayTax.subtotal == 'both'">
                            <p class="flex flex-col text-3xl font-semibold max-md:text-sm max-sm:text-right">
                                {{ cart.formatted_sub_total_incl_tax }}

                                <span class="text-sm font-normal text-zinc-500 max-sm:text-xs">
                                    <?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.excl-tax'); ?>

                                    <span class="font-medium text-black">{{ cart.formatted_sub_total }}</span>
                                </span>
                            </p>
                        </template>

                        <template v-else>
                            <p class="text-3xl font-semibold max-md:text-base">
                                {{ cart.formatted_sub_total }}
                            </p>
                        </template>
                    </template>

                        <template v-else>
                            <!-- Spinner -->
                            <svg
                                class="text-blue h-8 w-8 animate-spin text-[5px] font-semibold max-md:h-7 max-md:w-7 max-sm:h-4 max-sm:w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                aria-hidden="true"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                        </template>

                            <?php echo view_render_event('bagisto.shop.checkout.mini-cart.subtotal.after'); ?>

                        </div>

                        <?php echo view_render_event('bagisto.shop.checkout.mini-cart.action.before'); ?>


                        <!-- Cart Action Container -->
                        <div class="grid gap-2.5 px-6 max-md:px-4 max-sm:gap-1.5">
                            <?php echo view_render_event('bagisto.shop.checkout.mini-cart.continue_to_checkout.before'); ?>


                        <a
                            href="<?php echo e(route('shop.checkout.onepage.index')); ?>"
                            class="mx-auto block w-full cursor-pointer rounded-2xl bg-navyBlue px-11 py-4 text-center text-base font-medium text-white max-md:rounded-lg max-md:px-5 max-md:py-2"
                        >
                            <?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.continue-to-checkout'); ?>
                        </a>

                            <?php echo view_render_event('bagisto.shop.checkout.mini-cart.continue_to_checkout.after'); ?>


                            <div class="block cursor-pointer text-center text-base font-medium max-md:py-1.5">
                                <a href="<?php echo e(route('shop.checkout.cart.index')); ?>">
                                    <?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.view-cart'); ?>
                                </a>
                            </div>
                        </div>

                        <?php echo view_render_event('bagisto.shop.checkout.mini-cart.action.after'); ?>

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

        <?php else: ?>
            <a href="<?php echo e(route('shop.checkout.onepage.index')); ?>">
                <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.toggle.before'); ?>


                    <span class="relative">
                        <span
                            class="icon-cart cursor-pointer text-2xl"
                            role="button"
                            aria-label="<?php echo app('translator')->get('shop::app.checkout.cart.mini-cart.shopping-cart'); ?>"
                            tabindex="0"
                        ></span>

                        <span
                            class="absolute -top-4 rounded-[44px] bg-navyBlue px-2 py-1.5 text-xs font-semibold leading-[9px] text-white ltr:left-5 rtl:right-5 max-md:px-2 max-md:py-1.5 max-md:ltr:left-4 max-md:rtl:right-4"
                            v-if="cart?.items_qty"
                        >
                            {{ cart.items_qty }}
                        </span>
                    </span>

                <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.toggle.after'); ?>

            </a>
        <?php endif; ?>

        <?php echo view_render_event('bagisto.shop.checkout.mini-cart.drawer.after'); ?>

    </script>

    <script type="module">
        app.component("v-mini-cart", {
            template: '#v-mini-cart-template',

            data() {
                return  {
                    cart: null,

                    isLoading:false,

                    displayTax: {
                        prices: "<?php echo e(core()->getConfigData('sales.taxes.shopping_cart.display_prices')); ?>",
                        subtotal: "<?php echo e(core()->getConfigData('sales.taxes.shopping_cart.display_subtotal')); ?>",
                    },
                }
            },

            mounted() {
                this.getCart();

                /**
                 * To Do: Implement this.
                 *
                 * Action.
                 */
                this.$emitter.on('update-mini-cart', (cart) => {
                    this.cart = cart;
                });
            },

            methods: {
                getCart() {
                    this.$axios.get('<?php echo e(route('shop.api.checkout.cart.index')); ?>')
                        .then(response => {
                            this.cart = response.data.data;
                        })
                        .catch(error => {});
                },

                updateItem(quantity, item) {
                    this.isLoading = true;

                    let qty = {};

                    qty[item.id] = quantity;

                    this.$axios.put('<?php echo e(route('shop.api.checkout.cart.update')); ?>', { qty })
                        .then(response => {
                            if (response.data.message) {
                                this.cart = response.data.data;
                            } else {
                                this.$emitter.emit('add-flash', { type: 'warning', message: response.data.data.message });
                            }

                            this.isLoading = false;
                        }).catch(error => this.isLoading = false);
                },

                removeItem(itemId) {
                    this.$emitter.emit('open-confirm-modal', {
                        agree: () => {
                            this.isLoading = true;

                            this.$axios.post('<?php echo e(route('shop.api.checkout.cart.destroy')); ?>', {
                                '_method': 'DELETE',
                                'cart_item_id': itemId,
                            })
                            .then(response => {
                                this.cart = response.data.data;

                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                                this.isLoading = false;
                            })
                            .catch(error => {
                                this.$emitter.emit('add-flash', { type: 'error', message: response.data.message });

                                this.isLoading = false;
                            });
                        }
                    });
                },
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/checkout/cart/mini-cart.blade.php ENDPATH**/ ?>