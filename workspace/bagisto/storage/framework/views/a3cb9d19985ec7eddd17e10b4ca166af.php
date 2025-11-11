<?php if($product->type == 'grouped'): ?>
    <?php echo view_render_event('bagisto.shop.products.view.grouped_products.before', ['product' => $product]); ?>


    <div class="w-[455px] max-w-full max-sm:w-full">
        <?php
            $groupedProducts = $product->grouped_products()->orderBy('sort_order')->get();
        ?>

        <?php if($groupedProducts->count()): ?>
            <div class="mt-8 grid gap-5 max-sm:mt-3 max-sm:gap-3">
                <?php $__currentLoopData = $groupedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($groupedProduct->associated_product->getTypeInstance()->isSaleable()): ?>
                        <div class="flex items-center justify-between gap-5">
                            <div class="text-sm font-medium">
                                <p class="">
                                    <?php echo app('translator')->get('shop::app.products.view.type.grouped.name'); ?>
                                </p>

                                <p class="mt-1.5 text-zinc-500">
                                    <?php echo e($groupedProduct->associated_product->name . ' + ' . core()->currency($groupedProduct->associated_product->getTypeInstance()->getFinalPrice())); ?>

                                </p>

                            </div>

                            <?php if (isset($component)) { $__componentOriginal6c50a43d549a14cd17ba26b5e08aa48c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c50a43d549a14cd17ba26b5e08aa48c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.quantity-changer.index','data' => ['name' => 'qty['.e($groupedProduct->associated_product_id).']','value' => $groupedProduct->qty,'class' => 'gap-x-4 rounded-xl px-3 py-2.5 max-sm:!py-1.5','@change' => 'updateQty($event, '.e($groupedProduct->associated_product_id).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::quantity-changer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'qty['.e($groupedProduct->associated_product_id).']','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupedProduct->qty),'class' => 'gap-x-4 rounded-xl px-3 py-2.5 max-sm:!py-1.5','@change' => 'updateQty($event, '.e($groupedProduct->associated_product_id).')']); ?>
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
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        
    </div>

    <?php echo view_render_event('bagisto.shop.products.view.grouped_products.before', ['product' => $product]); ?>

<?php endif; ?><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/view/types/grouped.blade.php ENDPATH**/ ?>