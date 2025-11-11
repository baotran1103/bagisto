<?php if($prices['final']['price'] < $prices['regular']['price']): ?>
    <p
        class="final-price font-medium text-zinc-500 line-through max-sm:leading-4"
        aria-label="<?php echo e($prices['regular']['formatted_price']); ?>"
    >
        <?php echo e($prices['regular']['formatted_price']); ?>

    </p>

    <p class="font-semibold max-sm:leading-4">
        <?php echo e($prices['final']['formatted_price']); ?>

    </p>
<?php else: ?>
    <p class="final-price font-semibold max-sm:leading-4">
        <?php echo e($prices['regular']['formatted_price']); ?>

    </p>
<?php endif; ?><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/prices/index.blade.php ENDPATH**/ ?>