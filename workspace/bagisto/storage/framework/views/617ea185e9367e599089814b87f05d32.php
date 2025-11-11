<div class="container px-[60px] max-lg:px-8 max-sm:px-4">
    <div class="flex items-start gap-10 max-lg:gap-5 md:mt-10">
        <!-- Desktop Filter Shimmer Effect -->
        <div class="max-md:hidden">
            <?php if (isset($component)) { $__componentOriginal8d0f18a0464611f33d443c290edba98e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8d0f18a0464611f33d443c290edba98e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.categories.filters','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.categories.filters'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8d0f18a0464611f33d443c290edba98e)): ?>
<?php $attributes = $__attributesOriginal8d0f18a0464611f33d443c290edba98e; ?>
<?php unset($__attributesOriginal8d0f18a0464611f33d443c290edba98e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8d0f18a0464611f33d443c290edba98e)): ?>
<?php $component = $__componentOriginal8d0f18a0464611f33d443c290edba98e; ?>
<?php unset($__componentOriginal8d0f18a0464611f33d443c290edba98e); ?>
<?php endif; ?>
        </div>

        <div class="flex-1">
            <!-- Desktop Toolbar Shimmer Effect -->
            <div class="max-md:hidden">
                <?php if (isset($component)) { $__componentOriginal0df91a730d509e786ed461ef5e8e3cfb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0df91a730d509e786ed461ef5e8e3cfb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.categories.toolbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.categories.toolbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0df91a730d509e786ed461ef5e8e3cfb)): ?>
<?php $attributes = $__attributesOriginal0df91a730d509e786ed461ef5e8e3cfb; ?>
<?php unset($__attributesOriginal0df91a730d509e786ed461ef5e8e3cfb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0df91a730d509e786ed461ef5e8e3cfb)): ?>
<?php $component = $__componentOriginal0df91a730d509e786ed461ef5e8e3cfb; ?>
<?php unset($__componentOriginal0df91a730d509e786ed461ef5e8e3cfb); ?>
<?php endif; ?>
            </div>

            <!-- Product Card Container -->
            <?php if(request()->query('mode') =='list'): ?>
                <div class="mt-8 grid grid-cols-1 gap-6">
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
                </div>
            <?php else: ?>
                <div class="mt-8 grid grid-cols-3 gap-8 max-1060:grid-cols-2 max-md:mt-5 max-md:justify-items-center max-md:gap-x-4 max-md:gap-y-5">
                    <!-- Product Card Shimmer Effect -->
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
            <?php endif; ?>

            <button class="shimmer mx-auto mt-14 block h-12 w-[171.516px] rounded-2xl py-3"></button>
        </div>
    </div>
</div><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/shimmer/categories/view.blade.php ENDPATH**/ ?>