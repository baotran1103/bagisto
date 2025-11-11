<div class="panel-side journal-scroll grid max-h-[1320px] min-w-[342px] max-w-[400px] grid-cols-[1fr] overflow-y-auto overflow-x-hidden max-xl:min-w-[270px] ltr:pr-7 rtl:pl-7">
    <div class="flex h-[50px] items-center justify-between border-b border-zinc-200 py-2.5 max-md:hidden">
        <p class="shimmer h-6 w-[30%]"></p>
        <p class="shimmer h-5 w-1/5"></p>
    </div>

    <!-- Price Range Filter Shimmer -->
    <div class="border-b border-zinc-200">
        <div class="flex items-center justify-between py-2.5">
            <p class="shimmer h-7 w-2/5"></p>
            <span class="shimmer h-6 w-6"></span>
        </div>

        <div class="z-10 rounded-lg bg-white">
            <?php if (isset($component)) { $__componentOriginal381c2a85a436b293bdf7706572920569 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal381c2a85a436b293bdf7706572920569 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.range-slider.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.range-slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal381c2a85a436b293bdf7706572920569)): ?>
<?php $attributes = $__attributesOriginal381c2a85a436b293bdf7706572920569; ?>
<?php unset($__attributesOriginal381c2a85a436b293bdf7706572920569); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal381c2a85a436b293bdf7706572920569)): ?>
<?php $component = $__componentOriginal381c2a85a436b293bdf7706572920569; ?>
<?php unset($__componentOriginal381c2a85a436b293bdf7706572920569); ?>
<?php endif; ?>
        </div>
    </div>

    <!-- Checkbox Filter Shimmer -->
    <div class="border-b border-zinc-200">
        <div class="flex items-center justify-between py-2.5">
            <p class="shimmer h-[27px] w-2/5"></p>
            <span class="shimmer h-6 w-6"></span>
        </div>

        <div class="flex flex-col items-center justify-between gap-2">
            <p class="shimmer h-[52px] w-full rounded-xl"></p>

            <div class="shimmer h-5 w-[50%] self-end rounded"></div>
        </div>

        <div class="z-10 grid gap-1 rounded-lg bg-white pb-3">
            <div class="flex items-center gap-x-4 ltr:pl-2 rtl:pr-2">
                <div class="shimmer h-5 w-5 rounded"></div>

                <div class="p-2 ltr:pl-0 rtl:pr-0">
                    <div class="shimmer h-5 w-[100px]"></div>
                </div>
            </div>

            <div class="flex items-center gap-x-4 rounded ltr:pl-2 rtl:pr-2">
                <div class="shimmer h-5 w-5 rounded"></div>

                <div class="p-2 ltr:pl-0 rtl:pr-0">
                    <div class="shimmer h-5 w-[100px]"></div>
                </div>
            </div>

            <div class="flex items-center gap-x-4 rounded ltr:pl-2 rtl:pr-2">
                <div class="shimmer h-5 w-5 rounded"></div>

                <div class="p-2 ltr:pl-0 rtl:pr-0">
                    <div class="shimmer h-5 w-[100px]"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkbox Filter Shimmer -->
    <div class="border-b border-zinc-200">
        <div class="flex items-center justify-between py-2.5">
            <p class="shimmer h-[27px] w-2/5"></p>
            <span class="shimmer h-6 w-6"></span>
        </div>

        <div class="flex flex-col items-center justify-between gap-2">
            <p class="shimmer h-[52px] w-full rounded-xl"></p>

            <div class="shimmer h-5 w-[50%] self-end rounded"></div>
        </div>

        <div class="z-10 grid gap-1 rounded-lg bg-white pb-3">
            <div class="flex items-center gap-x-4 ltr:pl-2 rtl:pr-2">
                <div class="shimmer h-5 w-5 rounded"></div>

                <div class="p-2 ltr:pl-0 rtl:pr-0">
                    <div class="shimmer h-5 w-[100px]"></div>
                </div>
            </div>

            <div class="flex items-center gap-x-4 rounded ltr:pl-2 rtl:pr-2">
                <div class="shimmer h-5 w-5 rounded"></div>

                <div class="p-2 ltr:pl-0 rtl:pr-0">
                    <div class="shimmer h-5 w-[100px]"></div>
                </div>
            </div>

            <div class="flex items-center gap-x-4 rounded ltr:pl-2 rtl:pr-2">
                <div class="shimmer h-5 w-5 rounded"></div>

                <div class="p-2 ltr:pl-0 rtl:pr-0">
                    <div class="shimmer h-5 w-[100px]"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/shimmer/categories/filters.blade.php ENDPATH**/ ?>