<v-product-gallery ref="gallery">
    <?php if (isset($component)) { $__componentOriginala9edc0e71c40cffba9a9bc821f0a4093 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9edc0e71c40cffba9a9bc821f0a4093 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.shimmer.products.gallery','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::shimmer.products.gallery'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9edc0e71c40cffba9a9bc821f0a4093)): ?>
<?php $attributes = $__attributesOriginala9edc0e71c40cffba9a9bc821f0a4093; ?>
<?php unset($__attributesOriginala9edc0e71c40cffba9a9bc821f0a4093); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9edc0e71c40cffba9a9bc821f0a4093)): ?>
<?php $component = $__componentOriginala9edc0e71c40cffba9a9bc821f0a4093; ?>
<?php unset($__componentOriginala9edc0e71c40cffba9a9bc821f0a4093); ?>
<?php endif; ?>
</v-product-gallery>

<?php if (! $__env->hasRenderedOnce('e61a371b-2645-438b-9c3d-9a05cda4509c')): $__env->markAsRenderedOnce('e61a371b-2645-438b-9c3d-9a05cda4509c');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id="v-product-gallery-template"
    >
        <div>
            <!-- Desktop Gallery -->
            <?php echo $__env->make('shop::products.view.gallery.desktop', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Mobile Gallery -->
            <?php echo $__env->make('shop::products.view.gallery.mobile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            
            <!-- Gallery Images Zoomer -->
            <?php if (isset($component)) { $__componentOriginal194129360e774eb7ad91d6dffe60f354 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal194129360e774eb7ad91d6dffe60f354 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.image-zoomer.index','data' => [':attachments' => 'attachments',':isImageZooming' => 'isImageZooming',':initialIndex' => '`media_${activeIndex}`']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::image-zoomer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([':attachments' => 'attachments',':is-image-zooming' => 'isImageZooming',':initial-index' => '`media_${activeIndex}`']); ?>
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
    </script>

    <script type="module">
        app.component('v-product-gallery', {
            template: '#v-product-gallery-template',

            data() {
                return {
                    isImageZooming: false,

                    isMediaLoading: true,

                    media: {
                        images: <?php echo json_encode(product_image()->getGalleryImages($product), 15, 512) ?>,

                        videos: <?php echo json_encode(product_video()->getVideos($product), 15, 512) ?>,
                    },

                    baseFile: {
                        type: '',

                        path: ''
                    },

                    activeIndex: 0,

                    containerOffset: 110,
                };
            },

            watch: {
                'media.images': {
                    deep: true,

                    handler(newImages, oldImages) {
                        let selectedImage = newImages?.[this.activeIndex];

                        if (JSON.stringify(newImages) !== JSON.stringify(oldImages) && selectedImage?.large_image_url) {
                            this.baseFile.path = selectedImage.large_image_url;
                        }
                    },
                },
            },
        
            mounted() {
                if (this.media.images.length) {

                    this.baseFile.type = 'image';

                    this.baseFile.path = this.media.images[0].large_image_url;
                } else if (this.media.videos.length) {

                    this.baseFile.type = 'video';

                    this.baseFile.path = this.media.videos[0].video_url;
                }
            },

            computed: {
                lengthOfMedia() {
                    if (this.media.images.length) {
                        return [...this.media.images, ...this.media.videos].length > 5;
                    }
                },

                attachments() {
                    return [...this.media.images, ...this.media.videos].map(media => ({
                        url: media.type === 'videos' ? media.video_url : media.original_image_url,
                        
                        type: media.type === 'videos' ? 'video' : 'image',
                    }));
                },
            },

            methods: {
                isActiveMedia(index) {
                    return index === this.activeIndex;
                },
                
                onMediaLoad() {
                    this.isMediaLoading = false;
                },

                change(media, index) {
                    this.isMediaLoading = true;

                    if (media.type == 'videos') {
                        this.baseFile.type = 'video';

                        this.baseFile.path = media.video_url;

                        this.onMediaLoad();
                    } else {
                        this.baseFile.type = 'image';

                        this.baseFile.path = media.large_image_url;
                    }

                    if (index > this.activeIndex) {
                        this.swipeDown();
                    } else if (index < this.activeIndex) {
                        this.swipeTop();
                    }

                    this.activeIndex = index;
                },

                swipeTop() {
                    const container = this.$refs.swiperContainer;

                    container.scrollTop -= this.containerOffset;
                },

                swipeDown() {
                    const container = this.$refs.swiperContainer;

                    container.scrollTop += this.containerOffset;
                },
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?>
<?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/products/view/gallery.blade.php ENDPATH**/ ?>