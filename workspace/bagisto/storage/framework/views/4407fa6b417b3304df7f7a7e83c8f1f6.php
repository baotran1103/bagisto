<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'width'  => '200px',
    'height' => '200px'
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
    'width'  => '200px',
    'height' => '200px'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<v-media
    <?php echo e($attributes); ?>

    width="<?php echo e($width); ?>"
    height="<?php echo e($height); ?>"
>
    <?php if (isset($component)) { $__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.media.images.lazy','data' => ['class' => 'mb-4 h-[200px] w-[200px] rounded-xl max-sm:h-[100px] max-sm:w-[100px]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::media.images.lazy'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4 h-[200px] w-[200px] rounded-xl max-sm:h-[100px] max-sm:w-[100px]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848)): ?>
<?php $attributes = $__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848; ?>
<?php unset($__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848)): ?>
<?php $component = $__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848; ?>
<?php unset($__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848); ?>
<?php endif; ?>
</v-media>

<?php if (! $__env->hasRenderedOnce('5fa56f80-bf62-4564-91e0-ac7349642b48')): $__env->markAsRenderedOnce('5fa56f80-bf62-4564-91e0-ac7349642b48');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id="v-media-template"
    >
        <div class="mb-4 flex cursor-pointer flex-col rounded-lg">
            <div :class="{'border border-dashed border-gray-300 rounded-2xl': isDragOver }">
                <div
                    class="flex h-[200px] w-[200px] cursor-pointer flex-col items-center justify-center rounded-xl bg-zinc-100 hover:bg-gray-100 max-md:h-36 max-md:w-36 max-sm:h-[100px] max-sm:w-[100px]"
                    v-if="uploadedFiles.isPicked"
                >
                    <div 
                        class="group relative flex h-[200px] w-[200px] max-md:h-36 max-md:w-36 max-sm:h-[100px] max-sm:w-[100px]"
                        @mouseenter="uploadedFiles.showDeleteButton = true"
                        @mouseleave="uploadedFiles.showDeleteButton = false"
                    >
                        <img
                            class="rounded-xl object-cover max-md:rounded-full"
                            :src="uploadedFiles.url"
                            :class="{ 'opacity-25' : uploadedFiles.showDeleteButton }"
                            alt="Uploaded Image"
                        >

                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform opacity-0 transition-opacity group-hover:opacity-100">
                            <span 
                                class="icon-bin cursor-pointer text-2xl text-black"
                                @click="remove"
                            >
                            </span>
                        </div>
                    </div>
                </div>

                <label 
                    :for="`${$.uid}_fileInput`"
                    class="flex h-[200px] w-[200px] cursor-pointer flex-col items-center justify-center gap-2 rounded-xl bg-zinc-100 hover:bg-gray-100 max-md:h-36 max-md:w-36 max-sm:h-[100px] max-sm:w-[100px] max-sm:gap-1"
                    :style="{'max-width': this.width, 'max-height': this.height}"
                    v-show="! uploadedFiles.isPicked"
                    @dragover="onDragOver"
                    @dragleave="onDragLeave"
                    @drop="onDrop"
                >
                    <label 
                        :for="`${$.uid}_fileInput`"
                        class="icon-camera text-3xl max-sm:text-lg"
                    >
                    </label>

                    <p class="font-medium max-md:hidden max-sm:text-xs">
                        <?php echo app('translator')->get("shop::app.components.media.index.add-image"); ?>
                    </p>

                    <input
                        type="hidden"
                        :name="name"
                        v-if="! uploadedFiles.isPicked"
                    />

                    <v-field
                        type="file"
                        class="hidden"
                        :id="`${$.uid}_fileInput`"
                        :name="name"
                        :accept="acceptedTypes"
                        :rules="appliedRules"
                        :multiple="isMultiple"
                        @change="onFileChange"
                    >
                    </v-field>
                </label>
            </div>

            <div 
                class="flex items-center"
                v-if="isMultiple"
            >
                <ul class="justify-left mt-2 flex flex-wrap gap-2.5">
                    <li
                        v-for="(file, index) in uploadedFiles"
                        :key="index"
                    >
                        <template v-if="isImage(file)">
                            <div
                                class="group relative flex h-12 w-12 justify-center max-sm:h-[60px] max-sm:w-[60px]"
                                @mouseenter="file.showDeleteButton = true"
                                @mouseleave="file.showDeleteButton = false"
                            >
                                <img
                                    :src="file.url"
                                    :alt="file.name"
                                    class="max-h-12 min-w-12 rounded-xl max-sm:max-h-[60px] max-sm:min-w-[60px]"
                                    :class="{ 'opacity-25' : file.showDeleteButton }"
                                >
                                <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform opacity-0 transition-opacity group-hover:opacity-100">
                                    <span
                                        class="icon-bin cursor-pointer text-2xl text-black"
                                        @click="remove(index)"
                                    >
                                    </span>
                                </div>
                            </div>
                        </template>

                        <template v-else>
                            <div
                                class="group relative flex h-12 w-12 justify-center max-sm:h-[60px] max-sm:w-[60px]"
                                @mouseenter="file.showDeleteButton = true"
                                @mouseleave="file.showDeleteButton = false"
                            >
                                <video
                                    :src="file.url"
                                    :alt="file.name"
                                    class="max-h-12 min-w-12 rounded-xl max-sm:max-h-[60px] max-sm:min-w-[60px]"
                                    :class="{'opacity-25' : file.showDeleteButton}"
                                >
                                </video>
                                <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform opacity-0 transition-opacity group-hover:opacity-100">
                                    <span 
                                        class="icon-bin cursor-pointer text-2xl text-black"
                                        @click="remove(index)"
                                    >
                                    </span>
                                </div>
                            </div>
                        </template>
                    </li>
                </ul>
            </div>
        </div>
    </script>

    <script type="module">
        app.component("v-media", {
            template: '#v-media-template',

            props: {
                name: {
                    type: String, 
                    default: 'attachments',
                },

                isMultiple: {
                    type: Boolean,
                    default: false,
                },

                rules: {
                    type: String,
                },

                acceptedTypes: {
                    type: String, 
                    default: 'image/*, video/*,'
                },

                label: {
                    type: String, 
                    default: '<?php echo app('translator')->get("shop::app.components.media.index.add-attachments"); ?>'
                },

                src: {
                    type: String,
                    default: ''
                },

                height: {
                    type: String,
                    default: '200px',
                },

                width: {
                    type: String,
                    default: '200px',
                },
            },

            data() {
                return {
                    uploadedFiles: [],

                    isDragOver: false,

                    appliedRules: '',
                };
            },

            created() {
                this.appliedRules = this.rules;

                if (this.src != '') {
                    this.appliedRules = '';

                    this.uploadedFiles = {
                        isPicked: true,
                        url: this.src,
                    }
                }
            },

            methods: {
                onFileChange(event) {
                    let files = event.target.files;

                    for (let i = 0; i < files.length; i++) {
                        let file = files[i];

                        let reader = new FileReader();

                        reader.onload = () => {
                            if (! this.isMultiple) {
                                this.uploadedFiles = {
                                    isPicked: true,
                                    name: file.name,
                                    url: reader.result,
                                }

                                return;
                            }

                            this.uploadedFiles.push({
                                name: file.name,
                                url: reader.result,
                                file: new File([file], file.name),
                            });
                        };

                        reader.readAsDataURL(file);
                    }
                },

                handleDroppedFiles(files) {
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i];

                        let reader = new FileReader();
                        
                        reader.onload = () => {
                            if (! this.isMultiple) {
                                this.uploadedFiles = {
                                    isPicked: true,
                                    name: file.name,
                                    url: reader.result,
                                }

                                return;
                            }

                            this.uploadedFiles.push({
                                name: file.name,
                                url: reader.result,
                            });
                        };

                        reader.readAsDataURL(file);
                    }
                },

                isImage(file) {
                    if (! file.name) {
                        return;
                    }

                    return file.name.match(/\.(jpg|jpeg|png|gif)$/i);
                },

                onDragOver(event) {
                    event.preventDefault();

                    this.isDragOver = true;
                },

                onDragLeave(event) {
                    event.preventDefault();

                    this.isDragOver = false;
                },
                
                onDrop(event) {
                    event.preventDefault();

                    this.isDragOver = false;

                    let files = event.dataTransfer.files;

                    this.handleDroppedFiles(files);
                },

                remove(index) {
                    if (! this.isMultiple) {
                        this.uploadedFiles = [];

                        this.appliedRules = this.rules;
                        
                        return;
                    }

                    this.uploadedFiles.splice(index, 1);
                },
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/media/index.blade.php ENDPATH**/ ?>