<div class="container mt-20 max-lg:px-8 max-md:mt-8 max-sm:mt-7 max-sm:!px-4">
    <div class="flex items-center justify-between">
        <h3 class="shimmer h-8 w-[200px] max-sm:h-7"></h3>

        <div class="flex items-center justify-between gap-8 max-lg:hidden">
            <span
                class="shimmer inline-block h-6 w-6"
                role="presentation"
            ></span>

            <span
                class="shimmer inline-block h-6 w-6 max-sm:hidden"
                role="presentation"
            ></span>
        </div>

        <div class="shimmer h-7 w-24 max-sm:h-5 max-sm:w-[68px] lg:hidden"></div>
    </div>

    <div class="scrollbar-hide mt-10 flex gap-8 overflow-auto pb-2.5 max-md:mt-5 max-sm:gap-4">
        <?php if (isset($component)) { $__componentOriginal63d85b8bc2d72394bd433a79cbb59384 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal63d85b8bc2d72394bd433a79cbb59384 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.cards.grid','data' => ['class' => 'min-w-[291px] max-md:h-fit max-md:min-w-56 max-sm:min-w-[192px]','count' => 4]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.cards.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'min-w-[291px] max-md:h-fit max-md:min-w-56 max-sm:min-w-[192px]','count' => 4]); ?>
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

    <?php if($navigationLink): ?>
        <a
            class="shimmer mx-auto mt-16 block h-12 w-[150.172px] rounded-2xl max-md:hidden"
            role="button"
            aria-label="Show more products"
        ></a>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/shimmer/products/carousel.blade.php ENDPATH**/ ?>