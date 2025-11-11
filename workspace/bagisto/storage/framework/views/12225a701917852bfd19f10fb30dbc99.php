<?php if(core()->getConfigData('catalog.products.social_share.enabled')): ?>
    <?php
        $message = core()->getConfigData('catalog.products.social_share.share_message');
    ?>

    <div class="flex gap-6">
        <?php echo view_render_event('bagisto.shop.products.view.share.before', ['product' => $product]); ?>


        <!-- For Mobile View -->
        <div class="md:hidden flex gap-2.5 justify-center items-center max-sm:gap-1.5">
            <span class="icon-share text-2xl"></span>

            <span
                class="max-sm:text-base cursor-pointer"
                onclick="shareProduct()"
            >
                <?php echo app('translator')->get('admin::app.configuration.index.catalog.products.social-share.share'); ?>
            </span>
        </div>

        <!-- For Desktop View -->
        <div class="max-md:hidden">
            <ul class="flex gap-3">
                <?php $__currentLoopData = ['facebook', 'twitter', 'instagram', 'pinterest', 'linkedin', 'whatsapp', 'email']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(! core()->getConfigData('catalog.products.social_share.' . $social)): ?>
                        <?php continue; ?>
                    <?php endif; ?>

                    <?php echo $__env->make('social_share::links.' . $social , compact('product', 'message'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

        <?php echo view_render_event('bagisto.shop.products.view.share.after', ['product' => $product]); ?>

    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            function shareProduct() {
                let productName = "<?php echo e($product->name); ?>";
                let productUrl = "<?php echo e(route('shop.product_or_category.index', [$product->url_key])); ?>";

                if (navigator.share) {
                    navigator.share({
                        title: productName,
                        text: productName + ' ' + productUrl,
                        url: productUrl
                    })
                    .catch((error) => console.error('Error sharing:', error));
                } else {
                    alert('Your browser does not support sharing.');
                }
            }
        </script>    
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/SocialShare/src/Providers/../Resources/views/share.blade.php ENDPATH**/ ?>