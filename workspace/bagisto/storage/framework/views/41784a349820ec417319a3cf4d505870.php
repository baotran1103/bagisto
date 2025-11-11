<div class="max-md:[&>*]:leading-6 max-sm:[&>*]:leading-4 grid gap-1.5 max-md:flex">
    <?php if($prices['from']['regular']['price'] != $prices['from']['final']['price']): ?>
        <p class="flex items-center gap-4 max-sm:text-sm">
            <span
                class="final-price text-zinc-500 line-through max-sm:text-sm"
                aria-label="<?php echo e($prices['from']['regular']['formatted_price']); ?>"
            >
                <?php echo e($prices['from']['regular']['formatted_price']); ?>

            </span>
            
            <?php echo e($prices['from']['final']['formatted_price']); ?>

        </p>
    <?php else: ?>
        <p class="final-price flex items-center gap-4 max-sm:text-sm">
            <?php echo e($prices['from']['regular']['formatted_price']); ?>

        </p>
    <?php endif; ?>

    <?php if(
        $prices['from']['regular']['price'] != $prices['to']['regular']['price']
        || $prices['from']['final']['price'] != $prices['to']['final']['price']
    ): ?>
        <p class="text-base font-normal max-sm:text-sm">To</p>
        
        <?php if($prices['to']['regular']['price'] != $prices['to']['final']['price']): ?>
            <p class="flex items-center gap-4 max-sm:text-sm">
                <span
                    class="final-price text-zinc-500 line-through max-sm:text-sm"
                    aria-label="<?php echo e($prices['to']['regular']['formatted_price']); ?>"
                >
                    <?php echo e($prices['to']['regular']['formatted_price']); ?>

                </span>
                
                <?php echo e($prices['to']['final']['formatted_price']); ?>

            </p>
        <?php else: ?>
            <p class="final-price flex items-center gap-4 max-sm:text-sm">
                <?php echo e($prices['to']['regular']['formatted_price']); ?>

            </p>
        <?php endif; ?>
    <?php endif; ?>
</div><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/prices/bundle.blade.php ENDPATH**/ ?>