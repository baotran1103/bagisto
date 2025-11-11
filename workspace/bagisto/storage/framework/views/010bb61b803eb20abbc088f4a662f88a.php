<?php echo view_render_event('bagisto.shop.layout.features.before'); ?>


<!--
    The ThemeCustomizationRepository repository is injected directly here because there is no way
    to retrieve it from the view composer, as this is an anonymous component.
-->
<?php $themeCustomizationRepository = app('Webkul\Theme\Repositories\ThemeCustomizationRepository'); ?>

<?php
    $channel = core()->getCurrentChannel();

    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'services_content',
        'status'     => 1,
        'theme_code' => $channel->theme,
        'channel_id' => $channel->id,
    ]); 
?>

<!-- Features -->
<?php if($customization): ?>
    <div class="container mt-20 max-lg:px-8 max-md:mt-10 max-md:px-4">
        <div class="max-md:max-y-6 flex justify-center gap-6 max-lg:flex-wrap max-md:grid max-md:grid-cols-2 max-md:gap-x-2.5 max-md:text-center">
            <?php $__currentLoopData = $customization->options['services']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center gap-5 bg-white max-md:grid max-md:gap-2.5 max-sm:gap-1 max-sm:px-2">
                    <span
                        class="<?php echo e($service['service_icon']); ?> flex items-center justify-center w-[60px] h-[60px] bg-white border border-black rounded-full text-4xl text-navyBlue p-2.5 max-md:m-auto max-md:w-16 max-md:h-16 max-sm:w-10 max-sm:h-10 max-sm:text-2xl"
                        role="presentation"
                    ></span>

                    <div class="max-lg:grid max-lg:justify-center">
                        <!-- Service Title -->
                        <p class="font-dmserif text-base font-medium max-md:text-xl max-sm:text-sm"><?php echo e($service['title']); ?></p>

                        <!-- Service Description -->
                        <p class="mt-2.5 max-w-[217px] text-sm font-medium text-zinc-500 max-md:mt-0 max-md:text-base max-sm:text-xs">
                            <?php echo e($service['description']); ?>

                        </p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>

<?php echo view_render_event('bagisto.shop.layout.features.after'); ?><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/layouts/services.blade.php ENDPATH**/ ?>