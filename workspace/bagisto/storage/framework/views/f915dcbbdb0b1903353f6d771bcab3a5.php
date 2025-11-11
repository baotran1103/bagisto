<?php if (! ($breadcrumbs->isEmpty())): ?>
    <nav aria-label="">
        <ol class="flex">
            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(
                    $breadcrumb->url 
                    && ! $loop->last
                ): ?>
                    <li class="flex items-center gap-x-2.5 text-base font-medium">
                        <a href="<?php echo e($breadcrumb->url); ?>">
                            <?php echo e($breadcrumb->title); ?>

                        </a>

                        <span class="icon-arrow-right rtl:icon-arrow-left text-2xl"></span>
                    </li>
                <?php else: ?>
                    <li 
                        class="flex items-center gap-x-2.5 break-all text-base text-zinc-500 after:content-['/'] after:last:hidden ltr:ml-2.5 rtl:mr-0" 
                        aria-current="page"
                    >
                        <?php echo e($breadcrumb->title); ?>

                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </nav>
<?php endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/partials/breadcrumbs.blade.php ENDPATH**/ ?>