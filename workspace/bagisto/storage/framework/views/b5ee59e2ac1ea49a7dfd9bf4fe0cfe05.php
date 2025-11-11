<div class="flex flex-wrap max-lg:hidden">
    <?php if (isset($component)) { $__componentOriginald037dc316bb847c92e2fa747ccab56ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald037dc316bb847c92e2fa747ccab56ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.layouts.header.desktop.bottom','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::layouts.header.desktop.bottom'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald037dc316bb847c92e2fa747ccab56ee)): ?>
<?php $attributes = $__attributesOriginald037dc316bb847c92e2fa747ccab56ee; ?>
<?php unset($__attributesOriginald037dc316bb847c92e2fa747ccab56ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald037dc316bb847c92e2fa747ccab56ee)): ?>
<?php $component = $__componentOriginald037dc316bb847c92e2fa747ccab56ee; ?>
<?php unset($__componentOriginald037dc316bb847c92e2fa747ccab56ee); ?>
<?php endif; ?>
</div>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/layouts/header/desktop/index.blade.php ENDPATH**/ ?>