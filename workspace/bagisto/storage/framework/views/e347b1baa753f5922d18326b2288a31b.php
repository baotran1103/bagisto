<?php echo view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]); ?>


<v-product-reviews>
    <div class="container max-1180:px-5">
        <?php if (isset($component)) { $__componentOriginal6da33f5fdb06a418f9ddea606e78cbed = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6da33f5fdb06a418f9ddea606e78cbed = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.reviews.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.reviews'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6da33f5fdb06a418f9ddea606e78cbed)): ?>
<?php $attributes = $__attributesOriginal6da33f5fdb06a418f9ddea606e78cbed; ?>
<?php unset($__attributesOriginal6da33f5fdb06a418f9ddea606e78cbed); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6da33f5fdb06a418f9ddea606e78cbed)): ?>
<?php $component = $__componentOriginal6da33f5fdb06a418f9ddea606e78cbed; ?>
<?php unset($__componentOriginal6da33f5fdb06a418f9ddea606e78cbed); ?>
<?php endif; ?>
    </div>
</v-product-reviews>

<?php echo view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]); ?>


<?php if (! $__env->hasRenderedOnce('78dd4107-5dc9-4bc3-a057-1bf003670cec')): $__env->markAsRenderedOnce('78dd4107-5dc9-4bc3-a057-1bf003670cec');
$__env->startPush('scripts'); ?>
    <!-- Product Review Template -->
    <script
        type="text/x-template"
        id="v-product-reviews-template"
    >
        <div class="container max-1180:mt-3.5 max-1180:px-5 max-md:px-4 max-sm:px-3.5">
            <!-- Create Review Form Container -->
            <div 
                class="w-full" 
                v-if="canReview"
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
                    <!-- Review Form -->
                    <form
                        class="grid grid-cols-[auto_1fr] justify-center gap-10 max-md:grid-cols-[1fr] max-md:gap-0"
                        @submit="handleSubmit($event, store)"
                        enctype="multipart/form-data"
                    >
                        <div class="max-w-[286px]">
                            <?php if (isset($component)) { $__componentOriginal578beb4bb944f523450535628cf00b41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal578beb4bb944f523450535628cf00b41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'image','class' => '!mb-0 !p-0 max-md:gap-1.5','name' => 'attachments','label' => trans('shop::app.products.view.reviews.attachments'),'isMultiple' => true,'ref' => 'reviewImages']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'image','class' => '!mb-0 !p-0 max-md:gap-1.5','name' => 'attachments','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.reviews.attachments')),'is-multiple' => true,'ref' => 'reviewImages']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $attributes = $__attributesOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__attributesOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $component = $__componentOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__componentOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.error','data' => ['class' => 'mt-4','controlName' => 'attachments']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-4','control-name' => 'attachments']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $attributes = $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $component = $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $attributes = $__attributesOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__attributesOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $component = $__componentOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__componentOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>
                        </div>
                        
                        <div>
                            <?php if (isset($component)) { $__componentOriginal578beb4bb944f523450535628cf00b41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal578beb4bb944f523450535628cf00b41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <?php if (isset($component)) { $__componentOriginal2f2718777649517fc23f75e819ccd670 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f2718777649517fc23f75e819ccd670 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.label','data' => ['class' => 'required mt-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'required mt-0']); ?>
                                    <?php echo app('translator')->get('shop::app.products.view.reviews.rating'); ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $attributes = $__attributesOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__attributesOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $component = $__componentOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__componentOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>

                                <span
                                    class="icon-star-fill cursor-pointer text-2xl"
                                    role="presentation"
                                    v-for="rating in [1,2,3,4,5]"
                                    :class="appliedRatings >= rating ? 'text-amber-500' : 'text-zinc-500'"
                                    @click="appliedRatings = rating"
                                >
                                </span>

                                <v-field
                                    type="hidden"
                                    name="rating"
                                    v-model="appliedRatings"
                                ></v-field>

                                <?php if (isset($component)) { $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.error','data' => ['controlName' => 'rating']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['control-name' => 'rating']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $attributes = $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $component = $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $attributes = $__attributesOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__attributesOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $component = $__componentOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__componentOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>

                            <?php if(
                                core()->getConfigData('catalog.products.review.guest_review')
                                && ! auth()->guard('customer')->user()
                            ): ?>
                                <?php if (isset($component)) { $__componentOriginal578beb4bb944f523450535628cf00b41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal578beb4bb944f523450535628cf00b41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                    <?php if (isset($component)) { $__componentOriginal2f2718777649517fc23f75e819ccd670 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f2718777649517fc23f75e819ccd670 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.label','data' => ['class' => 'required']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'required']); ?>
                                        <?php echo app('translator')->get('shop::app.products.view.reviews.name'); ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $attributes = $__attributesOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__attributesOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $component = $__componentOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__componentOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>

                                    <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'text','name' => 'name','rules' => 'required','value' => old('name'),'label' => trans('shop::app.products.view.reviews.name'),'placeholder' => trans('shop::app.products.view.reviews.name')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'name','rules' => 'required','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('name')),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.reviews.name')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.reviews.name'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $attributes = $__attributesOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__attributesOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $component = $__componentOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__componentOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>

                                    <?php if (isset($component)) { $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.error','data' => ['controlName' => 'name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['control-name' => 'name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $attributes = $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $component = $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $attributes = $__attributesOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__attributesOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $component = $__componentOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__componentOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>
                            <?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginal578beb4bb944f523450535628cf00b41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal578beb4bb944f523450535628cf00b41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <?php if (isset($component)) { $__componentOriginal2f2718777649517fc23f75e819ccd670 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f2718777649517fc23f75e819ccd670 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.label','data' => ['class' => 'required']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'required']); ?>
                                    <?php echo app('translator')->get('shop::app.products.view.reviews.title'); ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $attributes = $__attributesOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__attributesOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $component = $__componentOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__componentOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'text','name' => 'title','rules' => 'required','value' => old('title'),'label' => trans('shop::app.products.view.reviews.title'),'placeholder' => trans('shop::app.products.view.reviews.title')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'title','rules' => 'required','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('title')),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.reviews.title')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.reviews.title'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $attributes = $__attributesOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__attributesOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $component = $__componentOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__componentOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.error','data' => ['controlName' => 'title']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['control-name' => 'title']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $attributes = $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $component = $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $attributes = $__attributesOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__attributesOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $component = $__componentOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__componentOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginal578beb4bb944f523450535628cf00b41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal578beb4bb944f523450535628cf00b41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <?php if (isset($component)) { $__componentOriginal2f2718777649517fc23f75e819ccd670 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f2718777649517fc23f75e819ccd670 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.label','data' => ['class' => 'required']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'required']); ?>
                                    <?php echo app('translator')->get('shop::app.products.view.reviews.comment'); ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $attributes = $__attributesOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__attributesOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f2718777649517fc23f75e819ccd670)): ?>
<?php $component = $__componentOriginal2f2718777649517fc23f75e819ccd670; ?>
<?php unset($__componentOriginal2f2718777649517fc23f75e819ccd670); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginal03b54b937596232babb8a12a8847d013 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b54b937596232babb8a12a8847d013 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.control','data' => ['type' => 'textarea','name' => 'comment','rules' => 'required','value' => old('comment'),'label' => trans('shop::app.products.view.reviews.comment'),'placeholder' => trans('shop::app.products.view.reviews.comment'),'rows' => '12']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.control'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'textarea','name' => 'comment','rules' => 'required','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('comment')),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.reviews.comment')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('shop::app.products.view.reviews.comment')),'rows' => '12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $attributes = $__attributesOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__attributesOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b54b937596232babb8a12a8847d013)): ?>
<?php $component = $__componentOriginal03b54b937596232babb8a12a8847d013; ?>
<?php unset($__componentOriginal03b54b937596232babb8a12a8847d013); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.form.control-group.error','data' => ['controlName' => 'comment']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::form.control-group.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['control-name' => 'comment']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $attributes = $__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__attributesOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf)): ?>
<?php $component = $__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf; ?>
<?php unset($__componentOriginal72f1d7ac608c1db7c92b56fb85299dbf); ?>
<?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $attributes = $__attributesOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__attributesOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal578beb4bb944f523450535628cf00b41)): ?>
<?php $component = $__componentOriginal578beb4bb944f523450535628cf00b41; ?>
<?php unset($__componentOriginal578beb4bb944f523450535628cf00b41); ?>
<?php endif; ?>


                            <div class="mt-4 flex justify-start gap-4 max-xl:mb-5 max-sm:mb-5 max-sm:flex-wrap max-sm:justify-normal max-sm:gap-x-0">
                                <button
                                    class="primary-button w-full max-w-[374px] rounded-2xl px-11 py-4 text-center max-md:max-w-full max-md:rounded-lg max-md:py-3 max-sm:py-1.5"
                                    type='submit'
                                >
                                    <?php echo app('translator')->get('shop::app.products.view.reviews.submit-review'); ?>
                                </button>
                                
                                <button
                                    type="button"
                                    class="secondary-button items-center rounded-2xl px-8 py-2.5 max-md:w-full max-md:max-w-full max-md:rounded-lg max-md:py-1.5"
                                    @click="canReview = false"
                                >
                                    <?php echo app('translator')->get('shop::app.products.view.reviews.cancel'); ?>
                                </button>
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
            </div>

            <!-- Product Reviews Container -->
            <div v-else>
                <!-- Review Container Shimmer Effect -->
                <template v-if="isLoading">
                    <?php if (isset($component)) { $__componentOriginal6da33f5fdb06a418f9ddea606e78cbed = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6da33f5fdb06a418f9ddea606e78cbed = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.reviews.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.reviews'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6da33f5fdb06a418f9ddea606e78cbed)): ?>
<?php $attributes = $__attributesOriginal6da33f5fdb06a418f9ddea606e78cbed; ?>
<?php unset($__attributesOriginal6da33f5fdb06a418f9ddea606e78cbed); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6da33f5fdb06a418f9ddea606e78cbed)): ?>
<?php $component = $__componentOriginal6da33f5fdb06a418f9ddea606e78cbed; ?>
<?php unset($__componentOriginal6da33f5fdb06a418f9ddea606e78cbed); ?>
<?php endif; ?>
                </template>

                <!-- Reviews Cards Container -->
                <template v-else>
                    <template v-if="reviews.length">
                        <h3 class="mb-8 font-dmserif text-3xl max-md:mb-2.5 max-md:text-2xl max-sm:text-xl">
                            <?php echo app('translator')->get('shop::app.products.view.reviews.customer-review'); ?>

                            (<?php echo e($reviewHelper->getTotalReviews($product)); ?>)
                        </h3>
                        
                        <div class="flex gap-16 max-lg:flex-wrap max-sm:gap-5 max-sm:gap-x-0">
                            <!-- Left Section -->
                            <div class="sticky top-24 flex h-max flex-col gap-6 max-lg:relative max-lg:top-auto max-md:w-full">
                                
                                <div class="flex flex-col items-center gap-2 max-md:mt-3 max-md:gap-0 max-md:border-b max-md:border-zinc-200 max-md:pb-3">
                                    <p class="text-5xl max-md:text-3xl">
                                        <?php echo e($avgRatings); ?>

                                    </p>
                                    
                                    <div class="flex items-center gap-0.5">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <span class="icon-star-fill text-3xl <?php echo e($avgRatings >= $i ? 'text-amber-500' : 'text-zinc-500'); ?>"></span>
                                        <?php endfor; ?>
                                    </div>

                                    <p class="text-base text-zinc-500 max-sm:text-sm">
                                        <?php echo e($reviewHelper->getTotalFeedback($product)); ?>


                                        <?php echo app('translator')->get('shop::app.products.view.reviews.ratings'); ?>
                                    </p>
                                </div>

                                <!-- Ratings By Individual Stars -->
                                <div class="grid max-w-[365px] flex-wrap gap-y-3 max-md:max-w-full">
                                    <?php for($i = 5; $i >= 1; $i--): ?>
                                        <div class="row grid grid-cols-[1fr_2fr] items-center gap-4 max-md:grid-cols-[0.5fr_2fr] max-sm:flex-wrap max-sm:gap-0">
                                            <div class="whitespace-nowrap text-base font-medium max-sm:text-sm"><?php echo e($i); ?> Stars</div>

                                            <div class="h-4 w-[275px] max-w-full rounded-sm bg-neutral-200 max-sm:h-3.5 max-sm:w-full">
                                                <div
                                                    class="h-4 rounded-sm bg-amber-500 max-sm:h-3.5"
                                                    style="width: <?php echo e($percentageRatings[$i]); ?>%"
                                                ></div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>

                                <!-- Create Button -->
                                <?php if(core()->getConfigData('catalog.products.review.customer_review')): ?>
                                    <?php if(
                                        core()->getConfigData('catalog.products.review.guest_review')
                                        || auth()->guard('customer')->user()
                                    ): ?>
                                        <div
                                            class="flex cursor-pointer items-center justify-center gap-x-4 rounded-xl border border-navyBlue px-4 py-3 max-sm:rounded-lg max-sm:py-1.5"
                                            @click="canReview = true"
                                        >
                                            <span class="icon-pen text-2xl"></span>

                                            <?php echo app('translator')->get('shop::app.products.view.reviews.write-a-review'); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <!-- Right Section -->
                            <div class="flex w-full flex-col gap-5">
                                <!-- Product Review Item Vue Component -->
                                <v-product-review-item
                                    v-for='review in reviews'
                                    :review="review"
                                ></v-product-review-item>

                                <button
                                    class="mx-auto block w-max rounded-2xl border border-navyBlue bg-white px-11 py-3 text-center text-base font-medium text-navyBlue"
                                    v-if="links?.next"
                                    @click="get()"
                                >
                                    <?php echo app('translator')->get('shop::app.products.view.reviews.load-more'); ?>
                                </button>
                            </div>
                        </div>
                    </template>

                    <!-- Empty Review Section -->
                    <template v-else>
                        <div class="m-auto grid h-[476px] w-full place-content-center items-center justify-items-center text-center max-md:h-60">
                            <img
                                class="max-md:h-32 max-md:w-32 max-sm:h-[100px] max-sm:w-[100px]"
                                src="<?php echo e(bagisto_asset('images/review.png')); ?>"
                                alt=""
                                title=""
                            >

                            <p class="text-xl max-md:text-sm max-sm:text-xs">
                                <?php echo app('translator')->get('shop::app.products.view.reviews.empty-review'); ?>
                            </p>
                        
                            <?php if(core()->getConfigData('catalog.products.review.customer_review')): ?>
                                <?php if(
                                    core()->getConfigData('catalog.products.review.guest_review')
                                    || auth()->guard('customer')->user()
                                ): ?>
                                    <div
                                        class="mt-8 flex cursor-pointer items-center gap-x-4 rounded-xl border border-navyBlue px-4 py-2.5 max-sm:mt-5 max-sm:gap-x-1.5 max-sm:rounded-lg max-sm:py-1.5 max-sm:text-sm"
                                        @click="canReview = true"
                                    >
                                        <span class="icon-pen text-2xl max-sm:text-lg"></span>

                                        <?php echo app('translator')->get('shop::app.products.view.reviews.write-a-review'); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </script>

    <!-- Product Review Item Template -->
    <script
        type="text/x-template"
        id="v-product-review-item-template"
    >
        <div class="rounded-xl border border-zinc-200 p-6 max-md:hidden">
            <div class="flex gap-5">
                <template v-if="review.profile">
                    <img
                        class="flex max-h-[100px] min-h-[100px] min-w-[100px] max-w-[100px] items-center justify-center rounded-xl"
                        :src="review.profile"
                        :alt="review.name"
                        :title="review.name"
                    >
                </template>

                <template v-else>
                    <div
                        class="flex max-h-[100px] min-h-[100px] min-w-[100px] max-w-[100px] items-center justify-center rounded-xl bg-zinc-100"
                        :title="review.name"
                    >
                        <span class="text-2xl font-semibold text-zinc-500">
                            {{ review.name.split(' ').map(name => name.charAt(0).toUpperCase()).join('') }}
                        </span>
                    </div>
                </template>
            
                <div class="flex flex-col">
                    <p class="font x-md:text-lg text-xl">
                        {{ review.name }}
                    </p>
                    
                    <p class="mb-2 text-sm font-medium text-neutral-500">
                        {{ review.created_at }}
                    </p>

                    <div class="flex items-center gap-0.5">
                        <span
                            class="icon-star-fill text-3xl"
                            v-for="rating in [1,2,3,4,5]"
                            :class="review.rating >= rating ? 'text-amber-500' : 'text-zinc-500'"
                        ></span>
                    </div>
                </div>
            </div>

            <div class="mt-3 flex flex-col gap-4">
                <p class="text-base max-sm:text-xs">
                    {{ review.title }}
                </p>

                <p class="text-base leading-relaxed text-neutral-500 max-sm:text-xs">
                    {{ review.comment }}
                </p>

                <?php if((bool) core()->getConfigData('general.magic_ai.review_translation.enabled')): ?>
                    <button
                        class="secondary-button min-h-[34px] rounded-lg px-2 py-1 text-sm max-md:rounded-lg"
                        @click="translate"
                    >
                        <!-- Spinner -->
                        <template v-if="isLoading">
                            <img
                                class="h-5 w-5 animate-spin text-blue-600"
                                src="<?php echo e(bagisto_asset('images/spinner.svg')); ?>"
                            />

                            <?php echo app('translator')->get('shop::app.products.view.reviews.translating'); ?>
                        </template>

                        <template v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" role="presentation"> <g clip-path="url(#clip0_3148_2242)"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1484 9.31989L9.31995 12.1483L19.9265 22.7549L22.755 19.9265L12.1484 9.31989ZM12.1484 10.7341L10.7342 12.1483L13.5626 14.9767L14.9768 13.5625L12.1484 10.7341Z" fill="#060C3B"/> <path d="M11.0877 3.30949L13.5625 4.44748L16.0374 3.30949L14.8994 5.78436L16.0374 8.25924L13.5625 7.12124L11.0877 8.25924L12.2257 5.78436L11.0877 3.30949Z" fill="#060C3B"/> <path d="M2.39219 2.39217L5.78438 3.95197L9.17656 2.39217L7.61677 5.78436L9.17656 9.17655L5.78438 7.61676L2.39219 9.17655L3.95198 5.78436L2.39219 2.39217Z" fill="#060C3B"/> <path d="M3.30947 11.0877L5.78434 12.2257L8.25922 11.0877L7.12122 13.5626L8.25922 16.0374L5.78434 14.8994L3.30947 16.0374L4.44746 13.5626L3.30947 11.0877Z" fill="#060C3B"/> </g> <defs> <clipPath id="clip0_3148_2242"> <rect width="24" height="24" fill="white"/> </clipPath> </defs> </svg>
                            
                            <?php echo app('translator')->get('shop::app.products.view.reviews.translate'); ?>
                        </template>
                    </button>
                <?php endif; ?>
                
                <!-- Review Attachments -->
                <div
                    class="mt-3 flex flex-wrap gap-2"
                    v-if="review.images.length"
                >
                    <template v-for="(file, index) in review.images">
                        <div
                            :href="file.url"
                            class="flex h-12 w-12"
                            target="_blank"
                            v-if="file.type == 'image'"
                        >
                            <img
                                class="max-h-[50px] min-w-[50px] cursor-pointer rounded-xl"
                                :src="file.url"
                                :alt="review.name"
                                :title="review.name"
                                @click="isImageZooming = !isImageZooming; activeIndex = index"
                            >
                        </div>
                        
                        <div
                            :href="file.url"
                            class="flex h-12 w-12"
                            target="_blank"
                            v-else
                        >
                            <video
                                class="max-h-[50px] min-w-[50px] cursor-pointer rounded-xl"
                                :src="file.url"
                                :alt="review.name"
                                :title="review.name"
                                @click="isImageZooming = !isImageZooming; activeIndex = index"
                            >
                            </video>
                        </div>
                    </template>
                </div>

                <!-- Review Images zoomer -->
                <?php if (isset($component)) { $__componentOriginal194129360e774eb7ad91d6dffe60f354 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal194129360e774eb7ad91d6dffe60f354 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.image-zoomer.index','data' => [':attachments' => 'attachments',':isImageZooming' => 'isImageZooming',':initialIndex' => '\'file_\'+activeIndex']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::image-zoomer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([':attachments' => 'attachments',':is-image-zooming' => 'isImageZooming',':initial-index' => '\'file_\'+activeIndex']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal194129360e774eb7ad91d6dffe60f354)): ?>
<?php $attributes = $__attributesOriginal194129360e774eb7ad91d6dffe60f354; ?>
<?php unset($__attributesOriginal194129360e774eb7ad91d6dffe60f354); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal194129360e774eb7ad91d6dffe60f354)): ?>
<?php $component = $__componentOriginal194129360e774eb7ad91d6dffe60f354; ?>
<?php unset($__componentOriginal194129360e774eb7ad91d6dffe60f354); ?>
<?php endif; ?>
            </div>
        </div>

        <!-- For Mobile View -->
        <div class="md:hidden">
            <div class="grid gap-1.5 rounded-xl border border-zinc-200 p-4 max-md:mb-0">
                <div class="flex items-center gap-2.5">
                    <img
                        v-if="review.profile"
                        class="flex max-h-10 min-h-10 min-w-10 max-w-10 items-center justify-center rounded-full"
                        :src="review.profile"
                        :alt="review.name"
                        :title="review.name"
                    >
    
                    <div
                        v-else
                        class="flex max-h-10 min-h-10 min-w-10 max-w-10 items-center justify-center rounded-full bg-zinc-100"
                        :title="review.name"
                    >
                        <span class="text-xs font-semibold text-zinc-500">
                            {{ review.name.split(' ').map(name => name.charAt(0).toUpperCase()).join('') }}
                        </span>
                    </div>
    
                    <div class="grid grid-cols-1">
                        <p class="text-base font-medium">
                            {{ review.name }}
                        </p>
                        
                        <p class="text-xs text-zinc-500">
                            {{ review.created_at }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <span class="icon-star-fill text-xl <?php echo e($avgRatings >= $i ? 'text-amber-500' : 'text-zinc-500'); ?>"></span>
                    <?php endfor; ?>
                </div>
    
                <div class="w-full">
                    <p class="text-sm font-semibold">
                        {{ review.title }}
                    </p>
    
                    <p class="mt-1.5 text-sm text-zinc-500">
                        {{ review.comment }}
                    </p>

                    <?php if((bool) core()->getConfigData('general.magic_ai.review_translation.enabled')): ?>
                        <button
                            class="secondary-button mt-2.5 min-h-[34px] rounded-lg px-4 py-2.5 text-base max-md:rounded-lg max-sm:px-3 max-sm:py-1 max-sm:text-xs"
                            @click="translate"
                        >
                            <!-- Spinner -->
                            <template v-if="isLoading">
                                <img
                                    class="h-5 w-5 animate-spin text-blue-600"
                                    src="<?php echo e(bagisto_asset('images/spinner.svg')); ?>"
                                />

                                <?php echo app('translator')->get('shop::app.products.view.reviews.translating'); ?>
                            </template>

                            <template v-else>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" role="presentation"> <g clip-path="url(#clip0_3148_2242)"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1484 9.31989L9.31995 12.1483L19.9265 22.7549L22.755 19.9265L12.1484 9.31989ZM12.1484 10.7341L10.7342 12.1483L13.5626 14.9767L14.9768 13.5625L12.1484 10.7341Z" fill="#060C3B"/> <path d="M11.0877 3.30949L13.5625 4.44748L16.0374 3.30949L14.8994 5.78436L16.0374 8.25924L13.5625 7.12124L11.0877 8.25924L12.2257 5.78436L11.0877 3.30949Z" fill="#060C3B"/> <path d="M2.39219 2.39217L5.78438 3.95197L9.17656 2.39217L7.61677 5.78436L9.17656 9.17655L5.78438 7.61676L2.39219 9.17655L3.95198 5.78436L2.39219 2.39217Z" fill="#060C3B"/> <path d="M3.30947 11.0877L5.78434 12.2257L8.25922 11.0877L7.12122 13.5626L8.25922 16.0374L5.78434 14.8994L3.30947 16.0374L4.44746 13.5626L3.30947 11.0877Z" fill="#060C3B"/> </g> <defs> <clipPath id="clip0_3148_2242"> <rect width="24" height="24" fill="white"/> </clipPath> </defs> </svg>
                                
                                <?php echo app('translator')->get('shop::app.products.view.reviews.translate'); ?>
                            </template>
                        </button> 
                    <?php endif; ?>
                </div>
    
                <!-- Review Attachments -->
                <div
                    class="journal-scroll scrollbar-width-hidden mt-3 flex gap-2 overflow-auto"
                    v-if="review.images.length"
                >
                    <template v-for="file in review.images">
                        <a
                            :href="file.url"
                            class="flex h-20 w-20"
                            target="_blank"
                            v-if="file.type == 'image'"
                        >
                            <img
                                class="max-h-20 min-w-20 cursor-pointer rounded-xl"
                                :src="file.url"
                                :alt="review.name"
                                :title="review.name"
                            >
                        </a>
    
                        <a
                            :href="file.url"
                            class="flex h-20 w-20"
                            target="_blank"
                            v-else
                        >
                            <video
                                class="max-h-20 min-w-20 cursor-pointer rounded-xl"
                                :src="file.url"
                                :alt="review.name"
                                :title="review.name"
                            >
                            </video>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-product-reviews', {
            template: '#v-product-reviews-template',

            data() {
                return {
                    isLoading: true,
                    
                    appliedRatings: 5,

                    canReview: false,

                    reviews: [],

                    links: {
                        next: '<?php echo e(route('shop.api.products.reviews.index', $product->id)); ?>',
                    },

                    meta: {},
                }
            },

            mounted() {
                this.get();
            },

            methods: {
                get() {
                    if (! this.links?.next) {
                        return;
                    }
                    
                    this.$axios.get(this.links.next)
                        .then(response => {
                            this.isLoading = false;

                            this.reviews = [...this.reviews, ...response.data.data];

                            this.links = response.data.links;

                            this.meta = response.data.meta;
                        })
                        .catch(error => {});
                },

                store(params, { resetForm, setErrors }) {
                    let selectedFiles = this.$refs.reviewImages.uploadedFiles
                        .filter(obj => obj.file instanceof File)
                        .map(obj => obj.file);

                    params.attachments = selectedFiles;

                    this.$axios.post('<?php echo e(route('shop.api.products.reviews.store', $product->id)); ?>', params, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            this.$emitter.emit('add-flash', { type: 'success', message: response.data.data.message });

                            resetForm();

                            this.canReview = false;
                        })
                        .catch(error => {
                            setErrors({'attachments': ["<?php echo app('translator')->get('shop::app.products.view.reviews.failed-to-upload'); ?>"]});

                            this.$refs.reviewImages.uploadedFiles.forEach(element => {
                                setTimeout(() => {
                                    this.$refs.reviewImages.removeFile();
                                }, 0);
                            });
                        });
                },
            },
        });
        
        app.component('v-product-review-item', {
            template: '#v-product-review-item-template',

            props: ['review'],

            data() {
                return {
                    isLoading: false,

                    isImageZooming: false,

                    activeIndex: 0,
                }
            },

            computed: {
                attachments() {
                    let data = [...this.review.images].map((file) => {
                        return {
                            url: file.url,
                            type: file.type,
                        }
                    });

                    return data;
                },
            },

            methods: {
                translate() {
                    this.isLoading = true;

                    this.$axios.get("<?php echo e(route('shop.api.products.reviews.translate', ['id' => $product->id, 'review_id' => ':reviewId'])); ?>".replace(':reviewId', this.review.id))
                        .then(response => {
                            this.isLoading = false;

                            this.review.comment = response.data.content;
                        })
                        .catch(error => {
                            this.isLoading = false;

                            this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                        });
                },
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/view/reviews.blade.php ENDPATH**/ ?>