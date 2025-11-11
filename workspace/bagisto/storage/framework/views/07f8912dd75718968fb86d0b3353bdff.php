<?php if($product->type == 'downloadable'): ?>
    <?php echo view_render_event('bagisto.shop.products.view.downloadable.before', ['product' => $product]); ?>


    <?php if($product->downloadable_samples->count()): ?>
        <div class="sample-list mb-6 mt-8">
            <label class="mb-3 flex font-medium">
                <?php echo app('translator')->get('shop::app.products.view.type.downloadable.samples'); ?>
            </label>

            <ul>
                <?php $__currentLoopData = $product->downloadable_samples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sample): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="mb-2">
                        <a 
                            href="<?php echo e(route('shop.downloadable.download_sample', ['type' => 'sample', 'id' => $sample->id])); ?>" 
                            class="text-blue-700"
                            target="_blank"
                        >
                            <?php echo e($sample->title); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if($product->downloadable_links->count()): ?>
        <label class="mb-4 mt-8 flex font-medium max-sm:mb-1.5 max-sm:mt-3">
            <?php echo app('translator')->get('shop::app.products.view.type.downloadable.links'); ?>
        </label>

        <div class="grid gap-4 max-sm:gap-1">
            <?php $__currentLoopData = $product->downloadable_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex select-none items-center gap-x-4">
                    <div class="flex items-center">
                        <v-field
                            type="checkbox"
                            name="links[]"
                            value="<?php echo e($link->id); ?>"
                            id="<?php echo e($link->id); ?>"
                            class="peer hidden"
                            rules="required"
                            label="<?php echo app('translator')->get('shop::app.products.view.type.downloadable.links'); ?>"
                        >
                        </v-field>
                        
                        <label
                            class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-navyBlue peer-checked:text-navyBlue"
                            for="<?php echo e($link->id); ?>"
                        ></label>
                        
                        <label
                            for="<?php echo e($link->id); ?>"
                            class="cursor-pointer max-sm:text-sm ltr:ml-1 rtl:mr-1"
                        >
                            <?php echo e($link->title . ' + ' . core()->currency($link->price)); ?>

                        </label>
                    </div>

                    <?php if(
                        $link->sample_file
                        || $link->sample_url
                    ): ?>
                        <a 
                            href="<?php echo e(route('shop.downloadable.download_sample', ['type' => 'link', 'id' => $link->id])); ?>"
                            target="_blank"
                            class="text-blue-700 max-sm:text-sm"
                        >
                            <?php echo app('translator')->get('shop::app.products.view.type.downloadable.sample'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <v-error-message
                name="links[]"
                v-slot="{ message }"
            >
                <p class="text-xs italic text-red-500">
                    {{ message }}
                </p>
            </v-error-message>
        </div>
    <?php endif; ?>

    <?php echo view_render_event('bagisto.shop.products.view.downloadable.before', ['product' => $product]); ?>

<?php endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/view/types/downloadable.blade.php ENDPATH**/ ?>