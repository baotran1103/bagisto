<?php $reviewHelper = app('Webkul\Product\Helpers\Review'); ?>
<?php $productViewHelper = app('Webkul\Product\Helpers\View'); ?>

<?php
    $avgRatings = $reviewHelper->getAverageRating($product);

    $percentageRatings = $reviewHelper->getPercentageRating($product);

    $customAttributeValues = $productViewHelper->getAdditionalData($product);

    $attributeData = collect($customAttributeValues)->filter(fn ($item) => ! empty($item['value']));
?>

<!-- SEO Meta Content -->
<?php $__env->startPush('meta'); ?>
    <meta name="description" content="<?php echo e(trim($product->meta_description) != "" ? $product->meta_description : \Illuminate\Support\Str::limit(strip_tags($product->description), 120, '')); ?>"/>

    <meta name="keywords" content="<?php echo e($product->meta_keywords); ?>"/>

    <?php if(core()->getConfigData('catalog.rich_snippets.products.enable')): ?>
        <script type="application/ld+json">
            <?php echo app('Webkul\Product\Helpers\SEO')->getProductJsonLd($product); ?>

        </script>
    <?php endif; ?>

    <?php $productBaseImage = product_image()->getProductBaseImage($product); ?>

    <meta name="twitter:card" content="summary_large_image" />

    <meta name="twitter:title" content="<?php echo e($product->name); ?>" />

    <meta name="twitter:description" content="<?php echo htmlspecialchars(trim(strip_tags($product->description))); ?>" />

    <meta name="twitter:image:alt" content="" />

    <meta name="twitter:image" content="<?php echo e($productBaseImage['medium_image_url']); ?>" />

    <meta property="og:type" content="og:product" />

    <meta property="og:title" content="<?php echo e($product->name); ?>" />

    <meta property="og:image" content="<?php echo e($productBaseImage['medium_image_url']); ?>" />

    <meta property="og:description" content="<?php echo htmlspecialchars(trim(strip_tags($product->description))); ?>" />

    <meta property="og:url" content="<?php echo e(route('shop.product_or_category.index', $product->url_key)); ?>" />
<?php $__env->stopPush(); ?>

<!-- Page Layout -->
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
        <?php echo e(trim($product->meta_title) != "" ? $product->meta_title : $product->name); ?>

     <?php $__env->endSlot(); ?>

    <?php echo view_render_event('bagisto.shop.products.view.before', ['product' => $product]); ?>


    <!-- Breadcrumbs -->
    <?php if((core()->getConfigData('general.general.breadcrumbs.shop'))): ?>
        <div class="flex justify-center px-7 max-lg:hidden">
            <?php if (isset($component)) { $__componentOriginaldef12fd0653509715c3bc62a609dde73 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldef12fd0653509715c3bc62a609dde73 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.breadcrumbs.index','data' => ['name' => 'product','entity' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'product','entity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldef12fd0653509715c3bc62a609dde73)): ?>
<?php $attributes = $__attributesOriginaldef12fd0653509715c3bc62a609dde73; ?>
<?php unset($__attributesOriginaldef12fd0653509715c3bc62a609dde73); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldef12fd0653509715c3bc62a609dde73)): ?>
<?php $component = $__componentOriginaldef12fd0653509715c3bc62a609dde73; ?>
<?php unset($__componentOriginaldef12fd0653509715c3bc62a609dde73); ?>
<?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Product Information Vue Component -->
    <v-product>
        <?php if (isset($component)) { $__componentOriginal0eaa493b847a30b19675cbd7b242ec38 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0eaa493b847a30b19675cbd7b242ec38 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.view','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.view'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0eaa493b847a30b19675cbd7b242ec38)): ?>
<?php $attributes = $__attributesOriginal0eaa493b847a30b19675cbd7b242ec38; ?>
<?php unset($__attributesOriginal0eaa493b847a30b19675cbd7b242ec38); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0eaa493b847a30b19675cbd7b242ec38)): ?>
<?php $component = $__componentOriginal0eaa493b847a30b19675cbd7b242ec38; ?>
<?php unset($__componentOriginal0eaa493b847a30b19675cbd7b242ec38); ?>
<?php endif; ?>
    </v-product>

    <!-- Information Section -->
    <div class="1180:mt-20">
        <div class="max-1180:hidden">
            <?php if (isset($component)) { $__componentOriginalfc60bb615bed00622a91d98d31176f33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc60bb615bed00622a91d98d31176f33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.tabs.index','data' => ['position' => 'center','ref' => 'productTabs']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['position' => 'center','ref' => 'productTabs']); ?>
                <!-- Description Tab -->
                <?php echo view_render_event('bagisto.shop.products.view.description.before', ['product' => $product]); ?>


                <?php if (isset($component)) { $__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.tabs.item','data' => ['id' => 'descritpion-tab','class' => 'container mt-[60px] !p-0','title' => trans('shop::app.products.view.description'),'isSelected' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::tabs.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'descritpion-tab','class' => 'container mt-[60px] !p-0','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.description')),'is-selected' => true]); ?>
                    <div class="container mt-[60px] max-1180:px-5">
                        <p class="text-lg text-zinc-500 max-1180:text-sm">
                            <?php echo $product->description; ?>

                        </p>
                    </div>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90)): ?>
<?php $attributes = $__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90; ?>
<?php unset($__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90)): ?>
<?php $component = $__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90; ?>
<?php unset($__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90); ?>
<?php endif; ?>

                <?php echo view_render_event('bagisto.shop.products.view.description.after', ['product' => $product]); ?>


                <!-- Additional Information Tab -->
                <?php if(count($attributeData)): ?>
                    <?php if (isset($component)) { $__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.tabs.item','data' => ['id' => 'information-tab','class' => 'container mt-[60px] !p-0','title' => trans('shop::app.products.view.additional-information'),'isSelected' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::tabs.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'information-tab','class' => 'container mt-[60px] !p-0','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.additional-information')),'is-selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                        <div class="container mt-[60px] max-1180:px-5">
                            <div class="mt-8 grid max-w-max grid-cols-[auto_1fr] gap-4">
                                <?php $__currentLoopData = $customAttributeValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customAttributeValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(! empty($customAttributeValue['value'])): ?>
                                        <div class="grid">
                                            <p class="text-base text-black">
                                                <?php echo $customAttributeValue['label']; ?>

                                            </p>
                                        </div>

                                        <?php if($customAttributeValue['type'] == 'file'): ?>
                                            <a
                                                href="<?php echo e(Storage::url($product[$customAttributeValue['code']])); ?>"
                                                download="<?php echo e($customAttributeValue['label']); ?>"
                                            >
                                                <span class="icon-download text-2xl"></span>
                                            </a>
                                        <?php elseif($customAttributeValue['type'] == 'image'): ?>
                                            <a
                                                href="<?php echo e(Storage::url($product[$customAttributeValue['code']])); ?>"
                                                download="<?php echo e($customAttributeValue['label']); ?>"
                                            >
                                                <img
                                                    class="h-5 min-h-5 w-5 min-w-5"
                                                    src="<?php echo e(Storage::url($customAttributeValue['value'])); ?>"
                                                />
                                            </a>
                                        <?php else: ?>
                                            <div class="grid">
                                                <p class="text-base text-zinc-500">
                                                    <?php echo $customAttributeValue['value']; ?>

                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90)): ?>
<?php $attributes = $__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90; ?>
<?php unset($__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90)): ?>
<?php $component = $__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90; ?>
<?php unset($__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90); ?>
<?php endif; ?>
                <?php endif; ?>

                <!-- Reviews Tab -->
                <?php if (isset($component)) { $__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.tabs.item','data' => ['id' => 'review-tab','class' => 'container mt-[60px] !p-0','title' => trans('shop::app.products.view.review'),'isSelected' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::tabs.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'review-tab','class' => 'container mt-[60px] !p-0','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.review')),'is-selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                    <?php echo $__env->make('shop::products.view.reviews', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90)): ?>
<?php $attributes = $__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90; ?>
<?php unset($__attributesOriginal1f42c1ae3abb1d72da6c703bc82e8a90); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90)): ?>
<?php $component = $__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90; ?>
<?php unset($__componentOriginal1f42c1ae3abb1d72da6c703bc82e8a90); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc60bb615bed00622a91d98d31176f33)): ?>
<?php $attributes = $__attributesOriginalfc60bb615bed00622a91d98d31176f33; ?>
<?php unset($__attributesOriginalfc60bb615bed00622a91d98d31176f33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc60bb615bed00622a91d98d31176f33)): ?>
<?php $component = $__componentOriginalfc60bb615bed00622a91d98d31176f33; ?>
<?php unset($__componentOriginalfc60bb615bed00622a91d98d31176f33); ?>
<?php endif; ?>
        </div>
    </div>

    <!-- Information Section -->
    <div class="container mt-6 grid gap-3 !p-0 max-1180:px-5 1180:hidden">
        <!-- Description Accordion -->
        <?php if (isset($component)) { $__componentOriginald3ba50c765d00f082351f5b73fecce50 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald3ba50c765d00f082351f5b73fecce50 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.accordion.index','data' => ['class' => 'max-md:border-none','isActive' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::accordion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-md:border-none','is-active' => true]); ?>
             <?php $__env->slot('header', null, ['class' => 'bg-gray-100 max-md:!py-3 max-sm:!py-2']); ?> 
                <p class="text-base font-medium 1180:hidden">
                    <?php echo app('translator')->get('shop::app.products.view.description'); ?>
                </p>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('content', null, ['class' => 'max-sm:px-0']); ?> 
                <div class="mb-5 text-lg text-zinc-500 max-1180:text-sm max-md:mb-1 max-md:px-4">
                    <?php echo $product->description; ?>

                </div>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald3ba50c765d00f082351f5b73fecce50)): ?>
<?php $attributes = $__attributesOriginald3ba50c765d00f082351f5b73fecce50; ?>
<?php unset($__attributesOriginald3ba50c765d00f082351f5b73fecce50); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald3ba50c765d00f082351f5b73fecce50)): ?>
<?php $component = $__componentOriginald3ba50c765d00f082351f5b73fecce50; ?>
<?php unset($__componentOriginald3ba50c765d00f082351f5b73fecce50); ?>
<?php endif; ?>

        <!-- Additional Information Accordion -->
        <?php if(count($attributeData)): ?>
            <?php if (isset($component)) { $__componentOriginald3ba50c765d00f082351f5b73fecce50 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald3ba50c765d00f082351f5b73fecce50 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.accordion.index','data' => ['class' => 'max-md:border-none','isActive' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::accordion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-md:border-none','is-active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                 <?php $__env->slot('header', null, ['class' => 'bg-gray-100 max-md:!py-3 max-sm:!py-2']); ?> 
                    <p class="text-base font-medium 1180:hidden">
                        <?php echo app('translator')->get('shop::app.products.view.additional-information'); ?>
                    </p>
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('content', null, ['class' => 'max-sm:px-0']); ?> 
                    <div class="container max-1180:px-5">
                        <div class="grid max-w-max grid-cols-[auto_1fr] gap-4 text-lg text-zinc-500 max-1180:text-sm">
                            <?php $__currentLoopData = $customAttributeValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customAttributeValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(! empty($customAttributeValue['value'])): ?>
                                    <div class="grid">
                                        <p class="text-base text-black">
                                            <?php echo e($customAttributeValue['label']); ?>

                                        </p>
                                    </div>

                                    <?php if($customAttributeValue['type'] == 'file'): ?>
                                        <a
                                            href="<?php echo e(Storage::url($product[$customAttributeValue['code']])); ?>"
                                            download="<?php echo e($customAttributeValue['label']); ?>"
                                        >
                                            <span class="icon-download text-2xl"></span>
                                        </a>
                                    <?php elseif($customAttributeValue['type'] == 'image'): ?>
                                        <a
                                            href="<?php echo e(Storage::url($product[$customAttributeValue['code']])); ?>"
                                            download="<?php echo e($customAttributeValue['label']); ?>"
                                        >
                                            <img
                                                class="h-5 min-h-5 w-5 min-w-5"
                                                src="<?php echo e(Storage::url($customAttributeValue['value'])); ?>"
                                                alt="Product Image"
                                            />
                                        </a>
                                    <?php else: ?>
                                        <div class="grid">
                                            <p class="text-base text-zinc-500">
                                                <?php echo e($customAttributeValue['value'] ?? '-'); ?>

                                            </p>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald3ba50c765d00f082351f5b73fecce50)): ?>
<?php $attributes = $__attributesOriginald3ba50c765d00f082351f5b73fecce50; ?>
<?php unset($__attributesOriginald3ba50c765d00f082351f5b73fecce50); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald3ba50c765d00f082351f5b73fecce50)): ?>
<?php $component = $__componentOriginald3ba50c765d00f082351f5b73fecce50; ?>
<?php unset($__componentOriginald3ba50c765d00f082351f5b73fecce50); ?>
<?php endif; ?>
        <?php endif; ?>

        <!-- Reviews Accordion -->
        <?php if (isset($component)) { $__componentOriginald3ba50c765d00f082351f5b73fecce50 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald3ba50c765d00f082351f5b73fecce50 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.accordion.index','data' => ['class' => 'max-md:border-none','isActive' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::accordion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-md:border-none','is-active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
             <?php $__env->slot('header', null, ['class' => 'bg-gray-100 max-md:!py-3 max-sm:!py-2','id' => 'review-accordian-button']); ?> 
                <p class="text-base font-medium">
                    <?php echo app('translator')->get('shop::app.products.view.review'); ?>
                </p>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('content', null, []); ?> 
                <?php echo $__env->make('shop::products.view.reviews', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald3ba50c765d00f082351f5b73fecce50)): ?>
<?php $attributes = $__attributesOriginald3ba50c765d00f082351f5b73fecce50; ?>
<?php unset($__attributesOriginald3ba50c765d00f082351f5b73fecce50); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald3ba50c765d00f082351f5b73fecce50)): ?>
<?php $component = $__componentOriginald3ba50c765d00f082351f5b73fecce50; ?>
<?php unset($__componentOriginald3ba50c765d00f082351f5b73fecce50); ?>
<?php endif; ?>
    </div>

    <!-- Featured Products -->
    <?php if (isset($component)) { $__componentOriginalc7b94830d947988d2b7058066254da2b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7b94830d947988d2b7058066254da2b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.products.carousel','data' => ['title' => trans('shop::app.products.view.related-product-title'),'src' => route('shop.api.products.related.index', ['id' => $product->id])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::products.carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.related-product-title')),'src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('shop.api.products.related.index', ['id' => $product->id]))]); ?>
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

    <!-- Up-sell Products -->
    <?php if (isset($component)) { $__componentOriginalc7b94830d947988d2b7058066254da2b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7b94830d947988d2b7058066254da2b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.products.carousel','data' => ['title' => trans('shop::app.products.view.up-sell-title'),'src' => route('shop.api.products.up-sell.index', ['id' => $product->id])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::products.carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.up-sell-title')),'src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('shop.api.products.up-sell.index', ['id' => $product->id]))]); ?>
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

    <?php echo view_render_event('bagisto.shop.products.view.after', ['product' => $product]); ?>


    <?php if (! $__env->hasRenderedOnce('b4033196-e583-4df0-9a08-25126c97b118')): $__env->markAsRenderedOnce('b4033196-e583-4df0-9a08-25126c97b118');
$__env->startPush('scripts'); ?>
        <script
            type="text/x-template"
            id="v-product-template"
        >
            <?php if (isset($component)) { $__componentOriginal4d3fcee3e355fb6c8889181b04f357cc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d3fcee3e355fb6c8889181b04f357cc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.index','data' => ['vSlot' => '{ meta, errors, handleSubmit }','as' => 'div']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['v-slot' => '{ meta, errors, handleSubmit }','as' => 'div']); ?>
                <form
                    ref="formData"
                    @submit="handleSubmit($event, addToCart)"
                >
                    <input
                        type="hidden"
                        name="product_id"
                        value="<?php echo e($product->id); ?>"
                    >

                    <input
                        type="hidden"
                        name="is_buy_now"
                        v-model="is_buy_now"
                    >

                    <div class="container px-[60px] max-1180:px-0">
                        <div class="mt-12 flex gap-9 max-1180:flex-wrap max-lg:mt-0 max-sm:gap-y-4">
                            <!-- Gallery Blade Inclusion -->
                            <?php echo $__env->make('shop::products.view.gallery', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                            <!-- Details -->
                            <div class="relative max-w-[590px] max-1180:w-full max-1180:max-w-full max-1180:px-5 max-sm:px-4">
                                <?php echo view_render_event('bagisto.shop.products.name.before', ['product' => $product]); ?>


                                <div class="flex justify-between gap-4">
                                    <h1 class="break-words text-3xl font-medium max-sm:text-xl">
                                        <?php echo e($product->name); ?>

                                    </h1>

                                    <?php if(core()->getConfigData('customer.settings.wishlist.wishlist_option')): ?>
                                        <div
                                            class="flex max-h-[46px] min-h-[46px] min-w-[46px] cursor-pointer items-center justify-center rounded-full border bg-white text-2xl transition-all hover:opacity-[0.8] max-sm:max-h-7 max-sm:min-h-7 max-sm:min-w-7 max-sm:text-base"
                                            role="button"
                                            aria-label="<?php echo app('translator')->get('shop::app.products.view.add-to-wishlist'); ?>"
                                            tabindex="0"
                                            :class="isWishlist ? 'icon-heart-fill text-red-600' : 'icon-heart'"
                                            @click="addToWishlist"
                                        >
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php echo view_render_event('bagisto.shop.products.name.after', ['product' => $product]); ?>


                                <!-- Rating -->
                                <?php echo view_render_event('bagisto.shop.products.rating.before', ['product' => $product]); ?>


                                <?php if($totalRatings = $reviewHelper->getTotalFeedback($product)): ?>
                                    <!-- Scroll To Reviews Section and Activate Reviews Tab -->
                                    <div
                                        class="mt-1 w-max cursor-pointer max-sm:mt-1.5"
                                        role="button"
                                        tabindex="0"
                                        @click="scrollToReview"
                                    >
                                        <?php if (isset($component)) { $__componentOriginal189c61a27640c2633434112e6503d31c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal189c61a27640c2633434112e6503d31c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.products.ratings','data' => ['class' => 'transition-all hover:border-gray-400 max-sm:px-3 max-sm:py-1','average' => $avgRatings,'total' => $totalRatings,':rating' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::products.ratings'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'transition-all hover:border-gray-400 max-sm:px-3 max-sm:py-1','average' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($avgRatings),'total' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalRatings),':rating' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal189c61a27640c2633434112e6503d31c)): ?>
<?php $attributes = $__attributesOriginal189c61a27640c2633434112e6503d31c; ?>
<?php unset($__attributesOriginal189c61a27640c2633434112e6503d31c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal189c61a27640c2633434112e6503d31c)): ?>
<?php $component = $__componentOriginal189c61a27640c2633434112e6503d31c; ?>
<?php unset($__componentOriginal189c61a27640c2633434112e6503d31c); ?>
<?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php echo view_render_event('bagisto.shop.products.rating.after', ['product' => $product]); ?>


                                <!-- Pricing -->
                                <?php echo view_render_event('bagisto.shop.products.price.before', ['product' => $product]); ?>


                                <p class="mt-[22px] flex items-center gap-2.5 text-2xl !font-medium max-sm:mt-2 max-sm:gap-x-2.5 max-sm:gap-y-0 max-sm:text-lg">
                                    <?php echo $product->getTypeInstance()->getPriceHtml(); ?>

                                </p>

                                <?php if(\Webkul\Tax\Facades\Tax::isInclusiveTaxProductPrices()): ?>
                                    <span class="text-sm font-normal text-zinc-500 max-sm:text-xs">
                                        (<?php echo app('translator')->get('shop::app.products.view.tax-inclusive'); ?>)
                                    </span>
                                <?php endif; ?>

                                <?php if(count($product->getTypeInstance()->getCustomerGroupPricingOffers())): ?>
                                    <div class="mt-2.5 grid gap-1.5">
                                        <?php $__currentLoopData = $product->getTypeInstance()->getCustomerGroupPricingOffers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p class="text-zinc-500 [&>*]:text-black">
                                                <?php echo $offer; ?>

                                            </p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

                                <?php echo view_render_event('bagisto.shop.products.price.after', ['product' => $product]); ?>


                                <?php echo view_render_event('bagisto.shop.products.short_description.before', ['product' => $product]); ?>


                                <p class="mt-6 text-lg text-zinc-500 max-sm:mt-1.5 max-sm:text-sm">
                                    <?php echo $product->short_description; ?>

                                </p>

                                <?php echo view_render_event('bagisto.shop.products.short_description.after', ['product' => $product]); ?>


                                <?php echo $__env->make('shop::products.view.types.simple', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                <?php echo $__env->make('shop::products.view.types.configurable', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                <?php echo $__env->make('shop::products.view.types.grouped', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                <?php echo $__env->make('shop::products.view.types.bundle', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                <?php echo $__env->make('shop::products.view.types.downloadable', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                <?php echo $__env->make('shop::products.view.types.booking', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                <!-- Product Actions and Quantity Box -->
                                <div class="mt-8 flex max-w-[470px] gap-4 max-sm:mt-4">

                                    <?php echo view_render_event('bagisto.shop.products.view.quantity.before', ['product' => $product]); ?>


                                    <?php if($product->getTypeInstance()->showQuantityBox()): ?>
                                        <?php if (isset($component)) { $__componentOriginal6c50a43d549a14cd17ba26b5e08aa48c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c50a43d549a14cd17ba26b5e08aa48c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.quantity-changer.index','data' => ['name' => 'quantity','value' => '1','class' => 'gap-x-4 rounded-xl px-7 py-4 max-md:py-3 max-sm:gap-x-5 max-sm:rounded-lg max-sm:px-4 max-sm:py-1.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::quantity-changer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'quantity','value' => '1','class' => 'gap-x-4 rounded-xl px-7 py-4 max-md:py-3 max-sm:gap-x-5 max-sm:rounded-lg max-sm:px-4 max-sm:py-1.5']); ?>
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
                                    <?php endif; ?>

                                    <?php echo view_render_event('bagisto.shop.products.view.quantity.after', ['product' => $product]); ?>


                                    <?php if(core()->getConfigData('sales.checkout.shopping_cart.cart_page')): ?>
                                        <!-- Add To Cart Button -->
                                        <?php echo view_render_event('bagisto.shop.products.view.add_to_cart.before', ['product' => $product]); ?>


                                        <?php if (isset($component)) { $__componentOriginal30786825665921390a816ebee82cf580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30786825665921390a816ebee82cf580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.button.index','data' => ['type' => 'submit','class' => 'secondary-button w-full max-w-full max-md:py-3 max-sm:rounded-lg max-sm:py-1.5','buttonType' => 'secondary-button','loading' => false,'title' => trans('shop::app.products.view.add-to-cart'),'disabled' => ! $product->isSaleable(1),':loading' => 'isStoring.addToCart',':disabled' => 'isStoring.addToCart','@click' => 'is_buy_now=0;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'secondary-button w-full max-w-full max-md:py-3 max-sm:rounded-lg max-sm:py-1.5','button-type' => 'secondary-button','loading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.add-to-cart')),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $product->isSaleable(1)),':loading' => 'isStoring.addToCart',':disabled' => 'isStoring.addToCart','@click' => 'is_buy_now=0;']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal30786825665921390a816ebee82cf580)): ?>
<?php $attributes = $__attributesOriginal30786825665921390a816ebee82cf580; ?>
<?php unset($__attributesOriginal30786825665921390a816ebee82cf580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30786825665921390a816ebee82cf580)): ?>
<?php $component = $__componentOriginal30786825665921390a816ebee82cf580; ?>
<?php unset($__componentOriginal30786825665921390a816ebee82cf580); ?>
<?php endif; ?>

                                        <?php echo view_render_event('bagisto.shop.products.view.add_to_cart.after', ['product' => $product]); ?>

                                    <?php endif; ?>
                                </div>

                                <!-- Buy Now Button -->
                                <?php if(core()->getConfigData('sales.checkout.shopping_cart.cart_page')): ?>
                                    <?php echo view_render_event('bagisto.shop.products.view.buy_now.before', ['product' => $product]); ?>


                                    <?php if(core()->getConfigData('catalog.products.storefront.buy_now_button_display')): ?>
                                        <?php if (isset($component)) { $__componentOriginal30786825665921390a816ebee82cf580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30786825665921390a816ebee82cf580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.button.index','data' => ['type' => 'submit','class' => 'primary-button mt-5 w-full max-w-[470px] max-md:py-3 max-sm:mt-3 max-sm:rounded-lg max-sm:py-1.5','buttonType' => 'primary-button','title' => trans('shop::app.products.view.buy-now'),'disabled' => ! $product->isSaleable(1),':loading' => 'isStoring.buyNow','@click' => 'is_buy_now=1;',':disabled' => 'isStoring.buyNow']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'primary-button mt-5 w-full max-w-[470px] max-md:py-3 max-sm:mt-3 max-sm:rounded-lg max-sm:py-1.5','button-type' => 'primary-button','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.buy-now')),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $product->isSaleable(1)),':loading' => 'isStoring.buyNow','@click' => 'is_buy_now=1;',':disabled' => 'isStoring.buyNow']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal30786825665921390a816ebee82cf580)): ?>
<?php $attributes = $__attributesOriginal30786825665921390a816ebee82cf580; ?>
<?php unset($__attributesOriginal30786825665921390a816ebee82cf580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30786825665921390a816ebee82cf580)): ?>
<?php $component = $__componentOriginal30786825665921390a816ebee82cf580; ?>
<?php unset($__componentOriginal30786825665921390a816ebee82cf580); ?>
<?php endif; ?>
                                    <?php endif; ?>

                                    <?php echo view_render_event('bagisto.shop.products.view.buy_now.after', ['product' => $product]); ?>

                                <?php endif; ?>

                                <?php echo view_render_event('bagisto.shop.products.view.additional_actions.before', ['product' => $product]); ?>


                                <!-- Share Buttons -->
                                <div class="mt-10 flex gap-9 max-md:mt-4 max-md:flex-wrap max-sm:justify-center max-sm:gap-3">
                                    <?php echo view_render_event('bagisto.shop.products.view.compare.before', ['product' => $product]); ?>


                                    <div
                                        class="flex cursor-pointer items-center justify-center gap-2.5 max-sm:gap-1.5 max-sm:text-base"
                                        role="button"
                                        tabindex="0"
                                        @click="is_buy_now=0; addToCompare(<?php echo e($product->id); ?>)"
                                    >
                                        <?php if(core()->getConfigData('catalog.products.settings.compare_option')): ?>
                                            <span
                                                class="icon-compare text-2xl"
                                                role="presentation"
                                            ></span>

                                            <?php echo app('translator')->get('shop::app.products.view.compare'); ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php echo view_render_event('bagisto.shop.products.view.compare.after', ['product' => $product]); ?>

                                </div>

                                <?php echo view_render_event('bagisto.shop.products.view.additional_actions.after', ['product' => $product]); ?>

                            </div>
                        </div>
                    </div>
                </form>
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
        </script>

        <script type="module">
            app.component('v-product', {
                template: '#v-product-template',

                data() {
                    return {
                        isWishlist: Boolean("<?php echo e((boolean) auth()->guard()->user()?->wishlist_items->where('channel_id', core()->getCurrentChannel()->id)->where('product_id', $product->id)->count()); ?>"),

                        isCustomer: '<?php echo e(auth()->guard('customer')->check()); ?>',

                        is_buy_now: 0,

                        isStoring: {
                            addToCart: false,

                            buyNow: false,
                        },
                    }
                },

                methods: {
                    addToCart(params) {
                        const operation = this.is_buy_now ? 'buyNow' : 'addToCart';

                        this.isStoring[operation] = true;

                        let formData = new FormData(this.$refs.formData);

                        this.ensureQuantity(formData);

                        this.$axios.post('<?php echo e(route("shop.api.checkout.cart.store")); ?>', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then(response => {
                                if (response.data.message) {
                                    this.$emitter.emit('update-mini-cart', response.data.data);

                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                                    if (response.data.redirect) {
                                        window.location.href= response.data.redirect;
                                    }
                                } else {
                                    this.$emitter.emit('add-flash', { type: 'warning', message: response.data.data.message });
                                }

                                this.isStoring[operation] = false;
                            })
                            .catch(error => {
                                this.isStoring[operation] = false;

                                this.$emitter.emit('add-flash', { type: 'warning', message: error.response.data.message });
                            });
                    },

                    addToWishlist() {
                        if (this.isCustomer) {
                            this.$axios.post('<?php echo e(route('shop.api.customers.account.wishlist.store')); ?>', {
                                    product_id: "<?php echo e($product->id); ?>"
                                })
                                .then(response => {
                                    this.isWishlist = ! this.isWishlist;

                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.data.message });
                                })
                                .catch(error => {});
                        } else {
                            window.location.href = "<?php echo e(route('shop.customer.session.index')); ?>";
                        }
                    },

                    addToCompare(productId) {
                        /**
                         * This will handle for customers.
                         */
                        if (this.isCustomer) {
                            this.$axios.post('<?php echo e(route("shop.api.compare.store")); ?>', {
                                    'product_id': productId
                                })
                                .then(response => {
                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.data.message });
                                })
                                .catch(error => {
                                    if ([400, 422].includes(error.response.status)) {
                                        this.$emitter.emit('add-flash', { type: 'warning', message: error.response.data.data.message });

                                        return;
                                    }

                                    this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message});
                                });

                            return;
                        }

                        /**
                         * This will handle for guests.
                         */
                        let existingItems = this.getStorageValue(this.getCompareItemsStorageKey()) ?? [];

                        if (existingItems.length) {
                            if (! existingItems.includes(productId)) {
                                existingItems.push(productId);

                                this.setStorageValue(this.getCompareItemsStorageKey(), existingItems);

                                this.$emitter.emit('add-flash', { type: 'success', message: "<?php echo app('translator')->get('shop::app.products.view.add-to-compare'); ?>" });
                            } else {
                                this.$emitter.emit('add-flash', { type: 'warning', message: "<?php echo app('translator')->get('shop::app.products.view.already-in-compare'); ?>" });
                            }
                        } else {
                            this.setStorageValue(this.getCompareItemsStorageKey(), [productId]);

                            this.$emitter.emit('add-flash', { type: 'success', message: "<?php echo app('translator')->get('shop::app.products.view.add-to-compare'); ?>" });
                        }
                    },

                    updateQty(quantity, id) {
                        this.isLoading = true;

                        let qty = {};

                        qty[id] = quantity;

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

                    getCompareItemsStorageKey() {
                        return 'compare_items';
                    },

                    setStorageValue(key, value) {
                        localStorage.setItem(key, JSON.stringify(value));
                    },

                    getStorageValue(key) {
                        let value = localStorage.getItem(key);

                        if (value) {
                            value = JSON.parse(value);
                        }

                        return value;
                    },

                    scrollToReview() {
                        let accordianElement = document.querySelector('#review-accordian-button');

                        if (accordianElement) {
                            accordianElement.click();

                            accordianElement.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }

                        let tabElement = document.querySelector('#review-tab-button');

                        if (tabElement) {
                            tabElement.click();

                            tabElement.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    },

                    ensureQuantity(formData) {
                        if (! formData.has('quantity')) {
                            formData.append('quantity', 1);
                        }
                    },
                },
            });
        </script>
    <?php $__env->stopPush(); endif; ?>
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
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/view.blade.php ENDPATH**/ ?>