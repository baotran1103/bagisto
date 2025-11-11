<?php
    $channel = core()->getCurrentChannel();
?>

<!-- SEO Meta Content -->
<?php $__env->startPush('meta'); ?>
    <meta
        name="title"
        content="<?php echo e($channel->home_seo['meta_title'] ?? ''); ?>"
    />

    <meta
        name="description"
        content="<?php echo e($channel->home_seo['meta_description'] ?? ''); ?>"
    />

    <meta
        name="keywords"
        content="<?php echo e($channel->home_seo['meta_keywords'] ?? ''); ?>"
    />
<?php $__env->stopPush(); ?>

<?php if (isset($component)) { $__componentOriginal2643b7d197f48caff2f606750db81304 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2643b7d197f48caff2f606750db81304 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.layouts.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::layouts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Page Title -->
     <?php $__env->slot('title', null, []); ?> 
        <?php echo e($channel->home_seo['meta_title'] ?? ''); ?>

     <?php $__env->endSlot(); ?>
    
    <!-- Loop over the theme customization -->
    <?php $__currentLoopData = $customizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php ($data = $customization->options) ?>

        <!-- Static content -->
        <?php switch($customization->type):
            case ($customization::IMAGE_CAROUSEL): ?>
                <!-- Image Carousel -->
                <?php if (isset($component)) { $__componentOriginalf822cda9ef0d23eb334a82ea5494f8ce = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf822cda9ef0d23eb334a82ea5494f8ce = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.carousel.index','data' => ['options' => $data,'ariaLabel' => ''.e(trans('shop::app.home.index.image-carousel')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data),'aria-label' => ''.e(trans('shop::app.home.index.image-carousel')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf822cda9ef0d23eb334a82ea5494f8ce)): ?>
<?php $attributes = $__attributesOriginalf822cda9ef0d23eb334a82ea5494f8ce; ?>
<?php unset($__attributesOriginalf822cda9ef0d23eb334a82ea5494f8ce); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf822cda9ef0d23eb334a82ea5494f8ce)): ?>
<?php $component = $__componentOriginalf822cda9ef0d23eb334a82ea5494f8ce; ?>
<?php unset($__componentOriginalf822cda9ef0d23eb334a82ea5494f8ce); ?>
<?php endif; ?>

                <?php break; ?>
            <?php case ($customization::STATIC_CONTENT): ?>
                <!-- push style -->
                <?php if(! empty($data['css'])): ?>
                    <?php $__env->startPush('styles'); ?>
                        <style>
                            <?php echo e($data['css']); ?>

                        </style>
                    <?php $__env->stopPush(); ?>
                <?php endif; ?>

                <!-- render html -->
                <?php if(! empty($data['html'])): ?>
                    <?php echo $data['html']; ?>

                <?php endif; ?>

                <?php break; ?>
            <?php case ($customization::CATEGORY_CAROUSEL): ?>
                <!-- Categories carousel -->
                <?php if (isset($component)) { $__componentOriginal55b1251dd0fd6403a4d59156278578f2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal55b1251dd0fd6403a4d59156278578f2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.categories.carousel','data' => ['title' => $data['title'] ?? '','src' => route('shop.api.categories.index', $data['filters'] ?? []),'navigationLink' => route('shop.home.index'),'ariaLabel' => ''.e(trans('shop::app.home.index.categories-carousel')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::categories.carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['title'] ?? ''),'src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('shop.api.categories.index', $data['filters'] ?? [])),'navigation-link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('shop.home.index')),'aria-label' => ''.e(trans('shop::app.home.index.categories-carousel')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal55b1251dd0fd6403a4d59156278578f2)): ?>
<?php $attributes = $__attributesOriginal55b1251dd0fd6403a4d59156278578f2; ?>
<?php unset($__attributesOriginal55b1251dd0fd6403a4d59156278578f2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal55b1251dd0fd6403a4d59156278578f2)): ?>
<?php $component = $__componentOriginal55b1251dd0fd6403a4d59156278578f2; ?>
<?php unset($__componentOriginal55b1251dd0fd6403a4d59156278578f2); ?>
<?php endif; ?>

                <?php break; ?>
            <?php case ($customization::PRODUCT_CAROUSEL): ?>
                <!-- Product Carousel -->
                <?php if (isset($component)) { $__componentOriginalc7b94830d947988d2b7058066254da2b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7b94830d947988d2b7058066254da2b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.products.carousel','data' => ['title' => $data['title'] ?? '','src' => route('shop.api.products.index', $data['filters'] ?? []),'navigationLink' => route('shop.search.index', $data['filters'] ?? []),'ariaLabel' => ''.e(trans('shop::app.home.index.product-carousel')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::products.carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['title'] ?? ''),'src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('shop.api.products.index', $data['filters'] ?? [])),'navigation-link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('shop.search.index', $data['filters'] ?? [])),'aria-label' => ''.e(trans('shop::app.home.index.product-carousel')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7b94830d947988d2b7058066254da2b)): ?>
<?php $attributes = $__attributesOriginalc7b94830d947988d2b7058066254da2b; ?>
<?php unset($__attributesOriginalc7b94830d947988d2b7058066254da2b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7b94830d947988d2b7058066254da2b)): ?>
<?php $component = $__componentOriginalc7b94830d947988d2b7058066254da2b; ?>
<?php unset($__componentOriginalc7b94830d947988d2b7058066254da2b); ?>
<?php endif; ?>

                <?php break; ?>
        <?php endswitch; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2643b7d197f48caff2f606750db81304)): ?>
<?php $attributes = $__attributesOriginal2643b7d197f48caff2f606750db81304; ?>
<?php unset($__attributesOriginal2643b7d197f48caff2f606750db81304); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2643b7d197f48caff2f606750db81304)): ?>
<?php $component = $__componentOriginal2643b7d197f48caff2f606750db81304; ?>
<?php unset($__componentOriginal2643b7d197f48caff2f606750db81304); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/home/index.blade.php ENDPATH**/ ?>