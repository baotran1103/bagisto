<p class="price-label text-sm text-zinc-500 max-sm:text-xs">
    <?php echo app('translator')->get('shop::app.products.prices.configurable.as-low-as'); ?>
</p>

<p class="regular-price text-lg font-semibold text-gray-500 line-through"></p>

<p class="final-price font-semibold">
    <?php echo e($prices['regular']['formatted_price']); ?>

</p><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/prices/configurable.blade.php ENDPATH**/ ?>