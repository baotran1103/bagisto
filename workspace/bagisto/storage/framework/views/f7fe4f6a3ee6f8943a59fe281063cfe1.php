<?php if($product->getTypeInstance()->isCustomizable()): ?>
    <?php
        $options = $product->customizable_options()->with([
            'product',
            'customizable_option_prices',
        ])->get();
    ?>

    <?php if($options->isNotEmpty()): ?>
        <?php echo view_render_event('bagisto.shop.products.view.customizable-options.before', ['product' => $product]); ?>


        <v-product-customizable-options
            :initial-price="<?php echo e($product->getTypeInstance()->getMinimalPrice()); ?>"
        >
        </v-product-customizable-options>

        <?php echo view_render_event('bagisto.shop.products.view.customizable-options.after', ['product' => $product]); ?>


        <?php if (! $__env->hasRenderedOnce('4367f94d-9a84-48ff-82c1-0e5480113293')): $__env->markAsRenderedOnce('4367f94d-9a84-48ff-82c1-0e5480113293');
$__env->startPush('scripts'); ?>
            <script
                type="text/x-template"
                id="v-product-customizable-options-template"
            >
                <div class="mt-8 max-sm:mt-0">
                    <template v-for="(option, index) in options">
                        <v-product-customizable-option-item
                            :option="option"
                            :key="index"
                            @priceUpdated="priceUpdated"
                        >
                        </v-product-customizable-option-item>
                    </template>

                    <div class="mb-2.5 mt-5 flex items-center justify-between">
                        <p class="text-sm">
                            <?php echo app('translator')->get('shop::app.products.view.type.simple.customizable-options.total-amount'); ?>
                        </p>

                        <p class="text-lg font-medium max-sm:text-sm">
                            {{ formattedTotalPrice }}
                        </p>
                    </div>
                </div>
            </script>

            <script
                type="text/x-template"
                id="v-product-customizable-option-item-template"
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
                        <!-- Text Field -->
                        <template v-if="option.type == 'text'">
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

                                <span class="text-black">
                                    {{ '+ ' + $shop.formatPrice(option.price) }}
                                </span>
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

                            <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'text',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'option.id','vModel' => 'selectedItems',':rules' => '{ \'required\': Boolean(option.is_required), \'max\': option.max_characters }',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'option.id','v-model' => 'selectedItems',':rules' => '{ \'required\': Boolean(option.is_required), \'max\': option.max_characters }',':label' => 'option.label']); ?>
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

                        <!-- Textarea Field -->
                        <template v-else-if="option.type == 'textarea'">
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

                                <span class="text-black">
                                    {{ '+ ' + $shop.formatPrice(option.price) }}
                                </span>
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

                            <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'textarea',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'option.id','vModel' => 'selectedItems',':rules' => '{ \'required\': Boolean(option.is_required), \'max\': option.max_characters }',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'textarea',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'option.id','v-model' => 'selectedItems',':rules' => '{ \'required\': Boolean(option.is_required), \'max\': option.max_characters }',':label' => 'option.label']); ?>
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

                        <!-- Checkbox Options -->
                        <template v-else-if="option.type == 'checkbox'">
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

                            <div class="grid gap-2">
                                <div
                                    class="flex select-none items-center gap-x-4 max-sm:gap-x-1.5"
                                    v-for="(item, index) in optionItems"
                                >
                                    <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'checkbox',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'item.id',':for' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'','vModel' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'checkbox',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'item.id',':for' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'','v-model' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']); ?>
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
                                        :for="'customizable_options[' + option.id + '][' + index + ']'"
                                    >
                                        {{ item.label }}

                                        <span class="text-black">
                                            {{ '+ ' + $shop.formatPrice(item.price) }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </template>

                        <!-- Radio Options -->
                        <template v-else-if="option.type == 'radio'">
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

                            <div class="grid gap-2 max-sm:gap-1">
                                <!-- "None" radio option for cases where the option is not required. -->
                                <div
                                    class="flex select-none gap-x-4"
                                    v-if="! Boolean(option.is_required)"
                                >
                                    <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'radio',':name' => '\'customizable_options[\' + option.id + \'][]\'','value' => '0',':for' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'','vModel' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label',':checked' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'radio',':name' => '\'customizable_options[\' + option.id + \'][]\'','value' => '0',':for' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'','v-model' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label',':checked' => 'true']); ?>
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
                                        :for="'customizable_options[' + option.id + '][' + index + ']'"
                                    >
                                        <?php echo app('translator')->get('shop::app.products.view.type.simple.customizable-options.none'); ?>
                                    </label>
                                </div>

                                <!-- Options -->
                                <div
                                    class="flex select-none items-center gap-x-4 max-sm:gap-x-1.5"
                                    v-for="(item, index) in optionItems"
                                >
                                    <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'radio',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'item.id',':for' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'','vModel' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'radio',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'item.id',':for' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'',':id' => '\'customizable_options[\' + option.id + \'][\' + index + \']\'','v-model' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']); ?>
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
                                        :for="'customizable_options[' + option.id + '][' + index + ']'"
                                    >
                                        {{ item.label }}

                                        <span class="text-black">
                                            {{ '+ ' + $shop.formatPrice(item.price) }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </template>

                        <!-- Select Options -->
                        <template v-else-if="option.type == 'select'">
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

                            <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'select',':name' => '\'customizable_options[\' + option.id + \'][]\'','vModel' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'select',':name' => '\'customizable_options[\' + option.id + \'][]\'','v-model' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']); ?>
                                <!-- "None" select option for cases where the option is not required. -->
                                <option
                                    value="0"
                                    v-if="! Boolean(option.is_required)"
                                >
                                    <?php echo app('translator')->get('shop::app.products.view.type.simple.customizable-options.none'); ?>
                                </option>

                                <option
                                    v-for="item in optionItems"
                                    :value="item.id"
                                >
                                    {{ item.label + ' + ' + $shop.formatPrice(item.price) }}
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

                        <!-- Multiselect Options -->
                        <template v-else-if="option.type == 'multiselect'">
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

                            <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'multiselect',':name' => '\'customizable_options[\' + option.id + \'][]\'','vModel' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'multiselect',':name' => '\'customizable_options[\' + option.id + \'][]\'','v-model' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']); ?>
                                <option
                                    v-for="item in optionItems"
                                    :value="item.id"
                                    :selected="value && value.includes(item.id)"
                                >
                                    {{ item.label + ' + ' + $shop.formatPrice(item.price) }}
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

                        <!-- Date Field -->
                        <template v-else-if="option.type == 'date'">
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

                                <span class="text-black">
                                    {{ '+ ' + $shop.formatPrice(option.price) }}
                                </span>
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

                            <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'date',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'option.id','vModel' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'date',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'option.id','v-model' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']); ?>
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

                        <!-- Datetime Field -->
                        <template v-else-if="option.type == 'datetime'">
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

                                <span class="text-black">
                                    {{ '+ ' + $shop.formatPrice(option.price) }}
                                </span>
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

                            <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'datetime',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'option.id','vModel' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'datetime',':name' => '\'customizable_options[\' + option.id + \'][]\'',':value' => 'option.id','v-model' => 'selectedItems',':rules' => '{\'required\': Boolean(option.is_required)}',':label' => 'option.label']); ?>
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

                        <!-- Time Field -->
                        <template v-else-if="option.type == 'time'">
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

                                <span class="text-black">
                                    {{ '+ ' + $shop.formatPrice(option.price) }}
                                </span>
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

                            <v-field
                                type="time"
                                :name="'customizable_options[' + option.id + '][]'"
                                :value="option.id"
                                v-model="selectedItems"
                                :rules="{'required': Boolean(option.is_required)}"
                                :label="option.label"
                            />
                        </template>

                        <!-- File -->
                        <template v-else-if="option.type == 'file'">
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

                                <span class="text-black">
                                    {{ '+ ' + $shop.formatPrice(option.price) }}
                                </span>
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

                            <v-field
                                type="file"
                                :name="'customizable_options[' + option.id + '][]'"
                                :rules="{'required': Boolean(option.is_required), ...(option.supported_file_extensions && option.supported_file_extensions.length ? {'ext': option.supported_file_extensions.split(',').map(ext => ext.trim())} : {})}"
                                :label="option.label"
                                @change="handleFileChange"
                            >
                            </v-field>
                        </template>

                        <?php if (isset($component)) { $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.error','data' => [':name' => '\'customizable_options[\' + option.id + \'][]\'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([':name' => '\'customizable_options[\' + option.id + \'][]\'']); ?>
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
                </div>
            </script>

            <script type="module">
                app.component('v-product-customizable-options', {
                    template: '#v-product-customizable-options-template',

                    props: {
                        initialPrice: {
                            type: Number,

                            required: true,
                        },
                    },

                    data: function() {
                        return {
                            options: <?php echo json_encode($options, 15, 512) ?>,

                            prices: [],
                        }
                    },

                    mounted() {
                        this.options = this.options.map((option) => {
                            if (! this.canHaveMultiplePriceOptions(option.type)) {
                                return {
                                    id: option.id,
                                    label: option.label,
                                    type: option.type,
                                    is_required: option.is_required,
                                    max_characters: option.max_characters,
                                    supported_file_extensions: option.supported_file_extensions,
                                    price_id: option.customizable_option_prices[0].id,
                                    price: option.customizable_option_prices[0].price,
                                };
                            }

                            return {
                                id: option.id,
                                label: option.label,
                                type: option.type,
                                is_required: option.is_required,
                                max_characters: option.max_characters,
                                supported_file_extensions: option.supported_file_extensions,
                                price: 0,
                            };
                        });

                        this.prices = this.options.map((option) => {
                            return {
                                option_id: option.id,
                                price: 0,
                            };
                        });
                    },

                    computed: {
                        formattedTotalPrice: function() {
                            let totalPrice = this.initialPrice;

                            for (let price of this.prices) {
                                totalPrice += parseFloat(price.price);
                            }

                            return this.$shop.formatPrice(totalPrice);
                        }
                    },

                    methods: {
                        priceUpdated({ option, totalPrice }) {
                            let price = this.prices.find(price => price.option_id === option.id);

                            price.price = totalPrice;
                        },

                        canHaveMultiplePriceOptions(type) {
                            return ['checkbox', 'radio', 'select', 'multiselect'].includes(type);
                        },
                    }
                });

                app.component('v-product-customizable-option-item', {
                    template: '#v-product-customizable-option-item-template',

                    emits: ['priceUpdated'],

                    props: ['option'],

                    data: function() {
                        return {
                            optionItems: [],

                            selectedItems: this.canHaveMultiplePrices()  ? [] : null,
                        };
                    },

                    mounted() {
                        if (! this.option.customizable_option_prices) {
                            return;
                        }

                        this.optionItems = this.option.customizable_option_prices.map(optionItem => {
                            return {
                                id: optionItem.id,
                                label: optionItem.label,
                                price: optionItem.price,
                            };
                        });
                    },

                    watch: {
                        selectedItems: function (value) {
                            let selectedItemValues = Array.isArray(value) ? value : [value];

                            let totalPrice = 0;

                            for (let item of this.optionItems) {
                                switch (this.option.type) {
                                    case 'text':
                                    case 'textarea':
                                    case 'date':
                                    case 'datetime':
                                    case 'time':
                                        if (selectedItemValues[0].length > 0) {
                                            totalPrice += parseFloat(item.price);
                                        }

                                        break;

                                    case 'checkbox':
                                    case 'radio':
                                    case 'select':
                                    case 'multiselect':
                                        if (selectedItemValues.includes(item.id)) {
                                            totalPrice += parseFloat(item.price);
                                        }

                                    case 'file':
                                        if (selectedItemValues[0] instanceof File) {
                                            totalPrice += parseFloat(item.price);
                                        }

                                        break;
                                }
                            }

                            this.$emit('priceUpdated', {
                                option: this.option,

                                totalPrice,
                            });
                        },
                    },

                    methods: {
                        canHaveMultiplePrices() {
                            return ['checkbox', 'multiselect'].includes(this.option.type);
                        },

                        handleFileChange($event) {
                            const selectedFiles = event.target.files;

                            this.selectedItems = selectedFiles[0];
                        },
                    },
                });
            </script>
        <?php $__env->stopPush(); endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/view/customizable-options.blade.php ENDPATH**/ ?>