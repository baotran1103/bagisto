<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'text',
    'name' => '',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'type' => 'text',
    'name' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php switch($type):
    case ('hidden'): ?>
    <?php case ('text'): ?>
    <?php case ('email'): ?>
    <?php case ('password'): ?>
    <?php case ('number'): ?>
        <v-field
            v-slot="{ field, errors }"
            <?php echo e($attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])); ?>

            name="<?php echo e($name); ?>"
        >
            <input
                type="<?php echo e($type); ?>"
                name="<?php echo e($name); ?>"
                v-bind="field"
                :class="[errors.length ? 'border !border-red-500 hover:border-red-500' : '']"
                <?php echo e($attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base font-normal text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 max-sm:px-4 max-md:py-2 max-sm:text-sm'])); ?>

            >
        </v-field>
        <?php break; ?>

    <?php case ('file'): ?>
        <v-field
            v-slot="{ field, errors }"
            <?php echo e($attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', ':rules', 'label', ':label'])); ?>

            name="<?php echo e($name); ?>"
        >
            <input
                type="<?php echo e($type); ?>"
                name="<?php echo e($name); ?>"
                :class="[errors.length ? 'border !border-red-500 hover:border-red-500' : '']"
                <?php echo e($attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 max-sm:px-4 max-md:py-2 max-sm:text-sm'])); ?>

            >
        </v-field>
        <?php break; ?>

    <?php case ('color'): ?>
        <v-field
            v-slot="{ field, errors }"
            <?php echo e($attributes->except('class')); ?>

            name="<?php echo e($name); ?>"
        >
            <input
                type="<?php echo e($type); ?>"
                :class="[errors.length ? 'border !border-red-500' : '']"
                v-bind="field"
                <?php echo e($attributes->except(['value'])->merge(['class' => 'rounded-lg-md w-full appearance-none border text-base text-gray-600 transition-all hover:border-gray-400 '])); ?>

            >
        </v-field>
        <?php break; ?>

    <?php case ('textarea'): ?>
        <v-field
            v-slot="{ field, errors }"
            <?php echo e($attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])); ?>

            name="<?php echo e($name); ?>"
        >
            <textarea
                type="<?php echo e($type); ?>"
                name="<?php echo e($name); ?>"
                v-bind="field"
                :class="[errors.length ? 'border !border-red-500 hover:border-red-500' : '']"
                <?php echo e($attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base font-normal text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400'])); ?>

            >
            </textarea>

            <?php if($attributes->get('tinymce', false) || $attributes->get(':tinymce', false)): ?>
                <?php if (isset($component)) { $__componentOriginal28af586349f0da298ebbef290ec9b989 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal28af586349f0da298ebbef290ec9b989 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.tinymce.index','data' => ['selector' => 'textarea#' . $attributes->get('id'),'prompt' => stripcslashes($attributes->get('prompt', '')),':field' => 'field']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::tinymce'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['selector' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('textarea#' . $attributes->get('id')),'prompt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(stripcslashes($attributes->get('prompt', ''))),':field' => 'field']); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal28af586349f0da298ebbef290ec9b989)): ?>
<?php $attributes = $__attributesOriginal28af586349f0da298ebbef290ec9b989; ?>
<?php unset($__attributesOriginal28af586349f0da298ebbef290ec9b989); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal28af586349f0da298ebbef290ec9b989)): ?>
<?php $component = $__componentOriginal28af586349f0da298ebbef290ec9b989; ?>
<?php unset($__componentOriginal28af586349f0da298ebbef290ec9b989); ?>
<?php endif; ?>
            <?php endif; ?>
        </v-field>
        <?php break; ?>

    <?php case ('date'): ?>
        <v-field
            v-slot="{ field, errors }"
            <?php echo e($attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])); ?>

            name="<?php echo e($name); ?>"
        >
            <?php if (isset($component)) { $__componentOriginale0625c65349cebd7c8be1b8e7761118d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0625c65349cebd7c8be1b8e7761118d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.flat-picker.date','data' => ['attributes' => $attributes]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::flat-picker.date'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes)]); ?>
                <input
                    name="<?php echo e($name); ?>"
                    v-bind="field"
                    :class="[errors.length ? 'border !border-red-500 hover:border-red-500' : '']"
                    <?php echo e($attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base text-gray-600  transition-all hover:border-gray-400 focus:border-gray-400 max-sm:px-4 max-md:py-2 max-sm:text-sm'])); ?>

                    autocomplete="off"
                >
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0625c65349cebd7c8be1b8e7761118d)): ?>
<?php $attributes = $__attributesOriginale0625c65349cebd7c8be1b8e7761118d; ?>
<?php unset($__attributesOriginale0625c65349cebd7c8be1b8e7761118d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0625c65349cebd7c8be1b8e7761118d)): ?>
<?php $component = $__componentOriginale0625c65349cebd7c8be1b8e7761118d; ?>
<?php unset($__componentOriginale0625c65349cebd7c8be1b8e7761118d); ?>
<?php endif; ?>
        </v-field>
        <?php break; ?>

    <?php case ('datetime'): ?>
        <v-field
            v-slot="{ field, errors }"
            <?php echo e($attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])); ?>

            name="<?php echo e($name); ?>"
        >
            <?php if (isset($component)) { $__componentOriginalbe7f8f533eb681aa747412af470e462c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbe7f8f533eb681aa747412af470e462c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.flat-picker.datetime','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::flat-picker.datetime'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <input
                    name="<?php echo e($name); ?>"
                    v-bind="field"
                    :class="[errors.length ? 'border !border-red-500 hover:border-red-500' : '']"
                    <?php echo e($attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base text-gray-600  transition-all hover:border-gray-400 focus:border-gray-400 max-sm:px-4 max-md:py-2 max-sm:text-sm'])); ?>

                    autocomplete="off"
                >
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbe7f8f533eb681aa747412af470e462c)): ?>
<?php $attributes = $__attributesOriginalbe7f8f533eb681aa747412af470e462c; ?>
<?php unset($__attributesOriginalbe7f8f533eb681aa747412af470e462c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbe7f8f533eb681aa747412af470e462c)): ?>
<?php $component = $__componentOriginalbe7f8f533eb681aa747412af470e462c; ?>
<?php unset($__componentOriginalbe7f8f533eb681aa747412af470e462c); ?>
<?php endif; ?>
        </v-field>
        <?php break; ?>

    <?php case ('select'): ?>
        <v-field
            v-slot="{ field, errors }"
            <?php echo e($attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])); ?>

            name="<?php echo e($name); ?>"
        >
            <select
                name="<?php echo e($name); ?>"
                v-bind="field"
                :class="[errors.length ? 'border !border-red-500' : '']"
                <?php echo e($attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'custom-select mb-1.5 w-full rounded-lg border border-zinc-200 bg-white px-5 py-3 text-base text-gray-600  transition-all hover:border-gray-400 focus-visible:outline-none max-md:py-2 max-sm:px-4 max-sm:text-sm'])); ?>

            >
                <?php echo e($slot); ?>

            </select>
        </v-field>
        <?php break; ?>

    <?php case ('multiselect'): ?>
        <v-field
            as="select"
            v-slot="{ value }"
            :class="[errors && errors['<?php echo e($name); ?>'] ? 'border !border-red-500' : '']"
            <?php echo e($attributes->except([])->merge(['class' => 'mb-1.5 w-full rounded-lg border border-zinc-200 bg-white px-5 py-3 text-base text-gray-600  transition-all hover:border-gray-400 focus-visible:outline-none max-md:py-2 max-sm:px-4 max-sm:text-sm'])); ?>

            name="<?php echo e($name); ?>"
            multiple
        >
            <?php echo e($slot); ?>

        </v-field>
        <?php break; ?>

    <?php case ('checkbox'): ?>
        <v-field
            type="checkbox"
            class="hidden"
            v-slot="{ field }"
            <?php echo e($attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key'])); ?>

            name="<?php echo e($name); ?>"
        >
            <input
                type="checkbox"
                v-bind="field"
                class="peer sr-only"
                <?php echo e($attributes->except(['rules', 'label', ':label', 'key', ':key'])); ?>

                name="<?php echo e($name); ?>"
            />
        </v-field>

        <label
            class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl peer-checked:text-navyBlue"
            <?php echo e($attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key'])); ?>

        >
        </label>
        <?php break; ?>

    <?php case ('radio'): ?>
        <v-field
            type="radio"
            class="hidden"
            v-slot="{ field }"
            <?php echo e($attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key'])); ?>

            name="<?php echo e($name); ?>"
        >
            <input
                type="radio"
                name="<?php echo e($name); ?>"
                v-bind="field"
                class="peer sr-only"
                <?php echo e($attributes->except(['rules', 'label', ':label', 'key', ':key'])); ?>

            />
        </v-field>

        <label
            class="icon-radio-unselect peer-checked:icon-radio-select cursor-pointer text-2xl peer-checked:text-navyBlue"
            <?php echo e($attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key'])); ?>

        >
        </label>
        <?php break; ?>

    <?php case ('switch'): ?>
        <label class="relative inline-flex cursor-pointer items-center">
            <v-field
                type="checkbox"
                class="hidden"
                v-slot="{ field }"
                <?php echo e($attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key'])); ?>

                name="<?php echo e($name); ?>"
            >
                <input
                    type="checkbox"
                    name="<?php echo e($name); ?>"
                    id="<?php echo e($name); ?>"
                    class="peer sr-only"
                    v-bind="field"
                    <?php echo e($attributes->except(['v-model', 'rules', ':rules', 'label', ':label', 'key', ':key'])); ?>

                />
            </v-field>

            <label
                class="rounded-lg-full after:rounded-lg-full peer h-5 w-9 cursor-pointer bg-gray-200 after:absolute after:left-0.5 after:top-0.5 after:h-4 after:w-4 after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-navyBlue peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-blue-300"
                for="<?php echo e($name); ?>"
            ></label>
        </label>
        <?php break; ?>

    <?php case ('image'): ?>
        <?php if (isset($component)) { $__componentOriginal2f287634e10c0d369fd07cbcbb97c6a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f287634e10c0d369fd07cbcbb97c6a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.media.index','data' => [':class' => '[errors && errors[\''.e($name).'\'] ? \'border !border-red-500\' : \'\']','attributes' => $attributes,'name' => ''.e($name).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::media'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([':class' => '[errors && errors[\''.e($name).'\'] ? \'border !border-red-500\' : \'\']','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes),'name' => ''.e($name).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f287634e10c0d369fd07cbcbb97c6a6)): ?>
<?php $attributes = $__attributesOriginal2f287634e10c0d369fd07cbcbb97c6a6; ?>
<?php unset($__attributesOriginal2f287634e10c0d369fd07cbcbb97c6a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f287634e10c0d369fd07cbcbb97c6a6)): ?>
<?php $component = $__componentOriginal2f287634e10c0d369fd07cbcbb97c6a6; ?>
<?php unset($__componentOriginal2f287634e10c0d369fd07cbcbb97c6a6); ?>
<?php endif; ?>
        <?php break; ?>

    <?php case ('custom'): ?>
        <v-field <?php echo e($attributes); ?>>
            <?php echo e($slot); ?>

        </v-field>
<?php endswitch; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/form/control-group/control.blade.php ENDPATH**/ ?>