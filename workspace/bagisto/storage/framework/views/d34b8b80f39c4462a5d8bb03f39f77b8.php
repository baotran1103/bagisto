<?php if($product->type == 'bundle'): ?>
    <?php echo view_render_event('bagisto.shop.products.view.bundle-options.before', ['product' => $product]); ?>


    <v-product-bundle-options :errors="errors"></v-product-bundle-options>

    <?php echo view_render_event('bagisto.shop.products.view.bundle-options.after', ['product' => $product]); ?>


    <?php if (! $__env->hasRenderedOnce('fc583850-e2c8-4b03-8216-886360e2fe9e')): $__env->markAsRenderedOnce('fc583850-e2c8-4b03-8216-886360e2fe9e');
$__env->startPush('scripts'); ?>
        <script
            type="text/x-template"
            id="v-product-bundle-options-template"
        >
            <div class="mt-8 max-sm:mt-0">
                <v-product-bundle-option-item
                    v-for="(option, index) in options"
                    :option="option"
                    :errors="errors"
                    :key="index"
                    @onProductSelected="productSelected(option, $event)"
                >
                </v-product-bundle-option-item>

                <div class="mb-2.5 mt-5 flex items-center justify-between">
                    <p class="text-sm">
                        <?php echo app('translator')->get('shop::app.products.view.type.bundle.total-amount'); ?>
                    </p>

                    <p class="text-lg font-medium max-sm:text-sm">
                        {{ formattedTotalPrice }}
                    </p>
                </div>

                <ul class="grid gap-2.5 text-base max-sm:text-sm">
                    <li v-for="option in options">
                        <span class="mb-1.5 inline-block max-sm:mb-0">
                            {{ option.label }}
                        </span>

                        <template v-for="product in option.products">
                            <div
                                class="text-zinc-500"
                                :key="product.id"
                                v-if="product.is_default"
                            >
                                {{ product.qty + ' x ' + product.name }}
                            </div>
                        </template>
                    </li>
                </ul>
            </div>
        </script>

        <script
            type="text/x-template"
            id="v-product-bundle-option-item-template"
        >
            <div class="mt-8 border-b border-zinc-200 pb-4 max-sm:mt-4 max-sm:pb-0">
                <?php if (isset($component)) { $__componentOriginal578beb4bb944f523450535628cf00b41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal578beb4bb944f523450535628cf00b41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <!-- Dropdown Options Container -->
                    <?php if (isset($component)) { $__componentOriginal2f2718777649517fc23f75e819ccd670 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f2718777649517fc23f75e819ccd670 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.label','data' => ['class' => '!mt-0 max-sm:!mb-2.5',':class' => '{ \'required\': Boolean(option.is_required) }']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => '!mt-0 max-sm:!mb-2.5',':class' => '{ \'required\': Boolean(option.is_required) }']); ?>
                        {{ option.label }}
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $attributes = $__attributesOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__attributesOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $component = $__componentOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__componentOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>

                    <template v-if="option.type == 'select'">
                        <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'select',':name' => '\'bundle_options[\' + option.id + \'][]\'',':rules' => '{\'required\': Boolean(option.is_required)}','vModel' => 'selectedProduct',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'select',':name' => '\'bundle_options[\' + option.id + \'][]\'',':rules' => '{\'required\': Boolean(option.is_required)}','v-model' => 'selectedProduct',':label' => 'option.label']); ?>
                            <option
                                value="0"
                                v-if="! Boolean(option.is_required)"
                            >
                                <?php echo app('translator')->get('shop::app.products.view.type.bundle.none'); ?>
                            </option>

                            <option
                                v-for="product in option.products"
                                :value="product.id"
                            >
                                {{ product.name }}

                                <div
                                    class="flex gap-2.5"
                                    v-if="product.price.regular.price != product.price.final.price"
                                >
                                    <span class="text-black">+</span>

                                    <span class="text-zinc-500 line-through max-sm:text-sm">
                                        ({{ product.price.regular.formatted_price }})
                                    </span>

                                    <span class="text-black">{{ product.price.final.formatted_price }}</span>
                                </div>

                                <span
                                    class="text-black"
                                    v-else
                                >
                                    {{ '+ ' + product.price.final.formatted_price }}
                                </span>
                            </option>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $attributes = $__attributesOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__attributesOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $component = $__componentOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__componentOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
                    </template>
                    
                    <template v-if="option.type == 'radio'">
                        <div class="grid gap-2 max-sm:gap-1">
                            <!-- None radio option if option is not required -->
                            <div
                                class="flex select-none gap-x-4"
                                v-if="! Boolean(option.is_required)"
                            >
                                <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'radio',':name' => '\'bundle_options[\' + option.id + \'][]\'',':for' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'','value' => '0','vModel' => 'selectedProduct',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'radio',':name' => '\'bundle_options[\' + option.id + \'][]\'',':for' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'','value' => '0','v-model' => 'selectedProduct',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $attributes = $__attributesOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__attributesOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $component = $__componentOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__componentOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>

                                <label
                                    class="cursor-pointer text-zinc-500 max-sm:text-sm"
                                    :for="'bundle_options[' + option.id + '][' + index + ']'"
                                >
                                    <?php echo app('translator')->get('shop::app.products.view.type.bundle.none'); ?>
                                </label>
                            </div>

                            <!-- Options -->
                            <div
                                class="flex select-none items-center gap-x-4 max-sm:gap-x-1.5"
                                v-for="(product, index) in option.products"
                            >
                                <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'radio',':name' => '\'bundle_options[\' + option.id + \'][]\'',':for' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':value' => 'product.id','vModel' => 'selectedProduct',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'radio',':name' => '\'bundle_options[\' + option.id + \'][]\'',':for' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':value' => 'product.id','v-model' => 'selectedProduct',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $attributes = $__attributesOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__attributesOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $component = $__componentOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__componentOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>

                                <label
                                    class="flex cursor-pointer gap-2 text-zinc-500 max-sm:text-sm"
                                    :for="'bundle_options[' + option.id + '][' + index + ']'"
                                >
                                    {{ product.name }}

                                    <div
                                        class="flex gap-2.5"
                                        v-if="product.price.regular.price != product.price.final.price"
                                    >
                                        <span class="text-black">+</span>

                                        <span class="text-zinc-500 line-through max-sm:text-sm">
                                            {{ product.price.regular.formatted_price }}
                                        </span>
    
                                        <span class="text-black">{{ product.price.final.formatted_price }}</span>
                                    </div>

                                    <span
                                        class="text-black"
                                        v-else
                                    >
                                        {{ '+ ' + product.price.final.formatted_price }}
                                    </span>
                                </label>
                            </div>
                        </div>
                    </template>

                    <template v-if="option.type == 'multiselect'">
                        <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'multiselect',':name' => '\'bundle_options[\' + option.id + \'][]\'',':rules' => '{\'required\': Boolean(option.is_required)}','vModel' => 'selectedProduct',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'multiselect',':name' => '\'bundle_options[\' + option.id + \'][]\'',':rules' => '{\'required\': Boolean(option.is_required)}','v-model' => 'selectedProduct',':label' => 'option.label']); ?>
                            <option
                                value="0"
                                v-if="! Boolean(option.is_required)"
                            >
                                <?php echo app('translator')->get('shop::app.products.view.type.bundle.none'); ?>
                            </option>

                            <option
                                v-for="product in option.products"
                                :value="product.id"
                                :selected="value && value.includes(product.id)"
                            >
                                {{ product.name }}

                                <div
                                    class="flex gap-2.5"
                                    v-if="product.price.regular.price != product.price.final.price"
                                >
                                    <span class="text-black">+</span>

                                    <span class="text-zinc-500 line-through max-sm:text-sm">
                                        ({{ product.price.regular.formatted_price }})
                                    </span>

                                    <span class="text-black">{{ product.price.final.formatted_price }}</span>
                                </div>

                                <span
                                    class="text-black"
                                    v-else
                                >
                                    {{ '+ ' + product.price.final.formatted_price }}
                                </span>
                            </option>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $attributes = $__attributesOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__attributesOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $component = $__componentOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__componentOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
                    </template>

                    <template v-if="option.type == 'checkbox'">
                        <div class="grid gap-2">
                        <!-- Options -->
                            <div
                                class="flex select-none items-center gap-x-4 max-sm:gap-x-1.5"
                                v-for="(product, index) in option.products"
                            >
                                <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'checkbox',':name' => '\'bundle_options[\' + option.id + \'][]\'',':for' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':value' => 'product.id','vModel' => 'selectedProduct',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'checkbox',':name' => '\'bundle_options[\' + option.id + \'][]\'',':for' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'bundle_options[\' + option.id + \'][\' + index + \']\'',':value' => 'product.id','v-model' => 'selectedProduct',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $attributes = $__attributesOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__attributesOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $component = $__componentOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__componentOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>

                                <label
                                    class="flex cursor-pointer gap-2 text-zinc-500 max-sm:text-sm"
                                    :for="'bundle_options[' + option.id + '][' + index + ']'"
                                >
                                    {{ product.name }}

                                    <span
                                        class="flex gap-2"
                                        v-if="product.price.regular.price != product.price.final.price"
                                    >
                                        <span class="text-black">+</span>

                                        <span class="text-zinc-500 line-through max-sm:text-sm">
                                            ({{ product.price.regular.formatted_price }})
                                        </span>

                                        <span class="text-black">{{ product.price.final.formatted_price }}</span>
                                    </span>

                                    <span
                                        class="text-black"
                                        v-else
                                    >
                                        {{ '+ ' + product.price.final.formatted_price }}
                                    </span>
                                </label>
                            </div>
                        </div>
                    </template>

                    <?php if (isset($component)) { $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.error','data' => [':name' => '\'bundle_options[\' + option.id + \'][]\'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([':name' => '\'bundle_options[\' + option.id + \'][]\'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $attributes = $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $component = $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $attributes = $__attributesOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__attributesOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $component = $__componentOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__componentOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>

                <template v-if="['select', 'radio'].includes(option.type)">
                    <?php if (isset($component)) { $__componentOriginal6c50a43d549a14cd17ba26b5e08aa48c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c50a43d549a14cd17ba26b5e08aa48c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.quantity-changer.index','data' => [':name' => '\'bundle_option_qty[\' + option?.id + \']\'',':value' => 'productQty','class' => 'mt-5 w-max gap-x-4 rounded-xl !border-zinc-200 px-4 py-1.5 max-sm:my-4','@change' => 'qtyUpdated($event)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::quantity-changer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([':name' => '\'bundle_option_qty[\' + option?.id + \']\'',':value' => 'productQty','class' => 'mt-5 w-max gap-x-4 rounded-xl !border-zinc-200 px-4 py-1.5 max-sm:my-4','@change' => 'qtyUpdated($event)']); ?>
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
                </template>
            </div>
        </script>

        <script type="module">
            app.component('v-product-bundle-options', {
                template: '#v-product-bundle-options-template',

                props: ['errors'],

                data: function() {
                    return {
                        config: <?php echo json_encode(app('Webkul\Product\Helpers\BundleOption')->getBundleConfig($product), 15, 512) ?>,

                        options: [],

                    }
                },

                computed: {
                    formattedTotalPrice: function() {
                        var total = 0;

                        for (var key in this.options) {
                            for (var key1 in this.options[key].products) {
                                if (! this.options[key].products[key1].is_default)
                                    continue;

                                total += this.options[key].products[key1].qty * this.options[key].products[key1].price.final.price;
                            }
                        }

                        return this.$shop.formatPrice(total);
                    }
                },

                created: function() {
                    for (var key in this.config.options) {
                        this.options.push(this.config.options[key]);
                    }
                },

                methods: {
                    productSelected: function(option, value) {
                        var selectedProductIds = Array.isArray(value) ? value : [value];

                        for (var key in option.products) {
                            option.products[key].is_default = selectedProductIds.indexOf(option.products[key].id) > -1 ? 1 : 0;
                        }
                    }
                }
            });

            app.component('v-product-bundle-option-item', {
                template: '#v-product-bundle-option-item-template',

                props: ['option', 'errors'],

                data: function() {
                    return {
                        selectedProduct: (this.option.type == 'checkbox' || this.option.type == 'multiselect')  ? [] : null,
                    };
                },

                computed: {
                    productQty: function() {
                        let qty = 0;

                        this.option.products.forEach((product, key) => {
                            if (this.selectedProduct == product.id) {
                                qty =  this.option.products[key].qty;
                            }
                        });

                        return qty;
                    }
                },

                watch: {
                    selectedProduct: function (value) {
                        this.$emit('onProductSelected', value);
                    }
                },

                created: function() {
                    for (var key in this.option.products) {
                        if (! this.option.products[key].is_default)
                            continue;

                        if (this.option.type == 'checkbox' || this.option.type == 'multiselect') {
                            this.selectedProduct.push(this.option.products[key].id)
                        } else {
                            this.selectedProduct = this.option.products[key].id
                        }
                    }
                },

                methods: {
                    qtyUpdated: function(qty) {
                        if (! this.option.products.find(data => data.id == this.selectedProduct)) {
                            return;
                        }

                        this.option.products.find(data => data.id == this.selectedProduct).qty = qty;
                    }
                }
            });
        </script>
    <?php $__env->stopPush(); endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/view/types/bundle.blade.php ENDPATH**/ ?>