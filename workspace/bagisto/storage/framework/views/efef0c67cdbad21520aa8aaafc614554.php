<!-- Review Section Header -->
<div class="mb-8 flex items-center justify-between gap-4 max-sm:flex-wrap">
    <div class="shimmer h-9 w-[245px]"></div>
</div>

<div class="flex gap-16 max-lg:flex-wrap">
    <!-- Left Section -->
    <div class="flex flex-col gap-6">
        <div class="flex flex-col items-center gap-2">
            <div class="shimmer h-12 w-16"></div>
            
            <div class="flex items-center gap-0.5">
                <span class="shimmer h-[30px] w-[30px]"></span>
                <span class="shimmer h-[30px] w-[30px]"></span>
                <span class="shimmer h-[30px] w-[30px]"></span>
                <span class="shimmer h-[30px] w-[30px]"></span>
                <span class="shimmer h-[30px] w-[30px]"></span>
            </div>

            <div class="shimmer h-6 w-20"></div>
        </div>

        <!-- Ratings By Individual Stars -->
        <div class="grid max-w-[365px] flex-wrap gap-y-3">
            <?php for($i = 5; $i >= 1; $i--): ?>
                <div class="row grid grid-cols-[1fr_2fr] items-center gap-4 max-sm:flex-wrap">
                    <div class="shimmer h-6 w-[56px]"></div>

                    <div class="shimmer h-4 w-[275px] rounded-sm"></div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Right Section -->
    <div class="flex w-full flex-col gap-5">
        <?php if (isset($component)) { $__componentOriginaladb41bb849ccfebe9f4702cef0843352 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaladb41bb849ccfebe9f4702cef0843352 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.reviews.card','data' => ['count' => '12']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.reviews.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['count' => '12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaladb41bb849ccfebe9f4702cef0843352)): ?>
<?php $attributes = $__attributesOriginaladb41bb849ccfebe9f4702cef0843352; ?>
<?php unset($__attributesOriginaladb41bb849ccfebe9f4702cef0843352); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaladb41bb849ccfebe9f4702cef0843352)): ?>
<?php $component = $__componentOriginaladb41bb849ccfebe9f4702cef0843352; ?>
<?php unset($__componentOriginaladb41bb849ccfebe9f4702cef0843352); ?>
<?php endif; ?>
    </div>
</div><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/shimmer/products/reviews/index.blade.php ENDPATH**/ ?>