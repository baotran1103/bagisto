<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['options']));

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

foreach (array_filter((['options']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<v-carousel :images="<?php echo e(json_encode($options['images'] ?? [])); ?>">
    <div class="overflow-hidden">
        <div class="shimmer aspect-[2.743/1] max-h-screen w-screen"></div>
    </div>
</v-carousel>

<?php if (! $__env->hasRenderedOnce('5002bb83-7fd1-4443-af99-9fc97781594c')): $__env->markAsRenderedOnce('5002bb83-7fd1-4443-af99-9fc97781594c');
$__env->startPush('scripts'); ?>
    <script
        type="text/x-template"
        id="v-carousel-template"
    >
        <div class="relative m-auto flex w-full overflow-hidden">
            <!-- Slider -->
            <div 
                class="inline-flex translate-x-0 cursor-pointer transition-transform duration-700 ease-out will-change-transform"
                ref="sliderContainer"
            >
                <div
                    class="max-h-screen w-screen bg-cover bg-no-repeat"
                    v-for="(image, index) in images"
                    @click="visitLink(image)"
                    ref="slide"
                >
                    <?php if (isset($component)) { $__componentOriginal3657c70d06ebc8c078f4ecac2ea1a848 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3657c70d06ebc8c078f4ecac2ea1a848 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'shop::components.media.images.lazy','data' => ['class' => 'aspect-[2.743/1] max-h-full w-full max-w-full select-none transition-transform duration-300 ease-in-out',':lazy' => 'false',':src' => 'image.image',':srcset' => 'image.image + \' 1920w, \' + image.image.replace(\'storage\', \'cache/large\') + \' 1280w,\' + image.image.replace(\'storage\', \'cache/medium\') + \' 1024w, \' + image.image.replace(\'storage\', \'cache/small\') + \' 525w\'',':alt' => 'image?.title','tabindex' => '0','fetchpriority' => 'high']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('shop::media.images.lazy'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'aspect-[2.743/1] max-h-full w-full max-w-full select-none transition-transform duration-300 ease-in-out',':lazy' => 'false',':src' => 'image.image',':srcset' => 'image.image + \' 1920w, \' + image.image.replace(\'storage\', \'cache/large\') + \' 1280w,\' + image.image.replace(\'storage\', \'cache/medium\') + \' 1024w, \' + image.image.replace(\'storage\', \'cache/small\') + \' 525w\'',':alt' => 'image?.title','tabindex' => '0','fetchpriority' => 'high']); ?>
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
                </div>
            </div>

            <!-- Navigation -->
            <span
                class="icon-arrow-left absolute left-2.5 top-1/2 -mt-[22px] hidden w-auto rounded-full bg-black/80 p-3 text-2xl font-bold text-white opacity-30 transition-all md:inline-block"
                :class="{
                    'cursor-not-allowed': direction == 'ltr' && currentIndex == 0,
                    'cursor-pointer hover:opacity-100': direction == 'ltr' ? currentIndex > 0 : currentIndex <= 0
                }"
                role="button"
                aria-label="<?php echo app('translator')->get('shop::components.carousel.previous'); ?>"
                tabindex="0"
                v-if="images?.length >= 2"
                @click="navigate('prev')"
            >
            </span>

            <span
                class="icon-arrow-right absolute right-2.5 top-1/2 -mt-[22px] hidden w-auto rounded-full bg-black/80 p-3 text-2xl font-bold text-white opacity-30 transition-all md:inline-block"
                :class="{
                    'cursor-not-allowed': direction == 'rtl' && currentIndex == 0,
                    'cursor-pointer hover:opacity-100': direction == 'rtl' ? currentIndex < 0 : currentIndex >= 0
                }"
                role="button"
                aria-label="<?php echo app('translator')->get('shop::components.carousel.next'); ?>"
                tabindex="0"
                v-if="images?.length >= 2"
                @click="navigate('next')"
            >
            </span>

            <!-- Pagination -->
            <div class="absolute bottom-5 left-0 flex w-full justify-center max-md:bottom-3.5 max-sm:bottom-2.5">
                <div
                    v-for="(image, index) in images"
                    class="mx-1 h-3 w-3 cursor-pointer rounded-full max-md:h-2 max-md:w-2 max-sm:h-1.5 max-sm:w-1.5"
                    :class="{ 'bg-navyBlue': index === Math.abs(currentIndex), 'opacity-30 bg-gray-500': index !== Math.abs(currentIndex) }"
                    role="button"
                    tabindex="0"
                    @click="navigateByPagination(index)"
                >
                </div>
            </div>
        </div>
    </script>

    <script type="module">
        app.component("v-carousel", {
            template: '#v-carousel-template',

            props: ['images'],

            data() {
                return {
                    isDragging: false,
                    startPos: 0,
                    currentTranslate: 0,
                    prevTranslate: 0,
                    animationID: 0,
                    currentIndex: 0,
                    slider: '',
                    slides: [],
                    autoPlayInterval: null,
                    direction: 'ltr',
                    startFrom: 1,
                };
            },

            mounted() {
                this.slider = this.$refs.sliderContainer;

                if (
                    this.$refs.slide
                    && typeof this.$refs.slide[Symbol.iterator] === 'function'
                ) {
                    this.slides = Array.from(this.$refs.slide);
                }

                this.init();

                this.play();
            },

            methods: {
                init() {
                    this.direction = document.dir;

                    if (this.direction == 'rtl') {
                        this.startFrom = -1;
                    }

                    this.slides.forEach((slide, index) => {
                        slide.querySelector('img')?.addEventListener('dragstart', (e) => e.preventDefault());

                        slide.addEventListener('mousedown', this.handleDragStart);

                        slide.addEventListener('touchstart', this.handleDragStart);

                        slide.addEventListener('mouseup', this.handleDragEnd);

                        slide.addEventListener('mouseleave', this.handleDragEnd);

                        slide.addEventListener('touchend', this.handleDragEnd);

                        slide.addEventListener('mousemove', this.handleDrag);

                        slide.addEventListener('touchmove', this.handleDrag, { passive: true });
                    });

                    window.addEventListener('resize', this.setPositionByIndex);
                },

                handleDragStart(event) {
                    this.startPos = event.type === 'mousedown' ? event.clientX : event.touches[0].clientX;

                    this.isDragging = true;

                    this.animationID = requestAnimationFrame(this.animation);
                },

                handleDrag(event) {
                    if (! this.isDragging) {
                        return;
                    }

                    const currentPosition = event.type === 'mousemove' ? event.clientX : event.touches[0].clientX;

                    this.currentTranslate = this.prevTranslate + currentPosition - this.startPos;
                },

                handleDragEnd(event) {
                    clearInterval(this.autoPlayInterval);

                    cancelAnimationFrame(this.animationID);

                    this.isDragging = false;

                    const movedBy = this.currentTranslate - this.prevTranslate;

                    if (this.direction == 'ltr') {
                        if (
                            movedBy < -100
                            && this.currentIndex < this.slides.length - 1
                        ) {
                            this.currentIndex += 1;
                        }

                        if (
                            movedBy > 100
                            && this.currentIndex > 0
                        ) {
                            this.currentIndex -= 1;
                        }
                    } else {
                        if (
                            movedBy > 100
                            && this.currentIndex < this.slides.length - 1
                        ) {
                            if (Math.abs(this.currentIndex) != this.slides.length - 1) {
                                this.currentIndex -= 1;
                            }
                        }

                        if (
                            movedBy < -100
                            && this.currentIndex < 0
                        ) {
                            this.currentIndex += 1;
                        }
                    }

                    this.setPositionByIndex();

                    this.play();
                },

                animation() {
                    this.setSliderPosition();

                    if (this.isDragging) {
                        requestAnimationFrame(this.animation);
                    }
                },

                setPositionByIndex() {
                    this.currentTranslate = this.currentIndex * -window.innerWidth;

                    this.prevTranslate = this.currentTranslate;

                    this.setSliderPosition();
                },

                setSliderPosition() {
                    if (this.slider) {
                        this.slider.style.transform = `translateX(${this.currentTranslate}px)`;
                    }
                },

                visitLink(image) {
                    if (image.link) {
                        window.location.href = image.link;
                    }
                },

                navigate(type) {
                    clearInterval(this.autoPlayInterval);

                    if (this.direction === 'rtl') {
                        type === 'next' ? this.prev() : this.next();
                    } else {
                        type === 'next' ? this.next() : this.prev();
                    }

                    this.setPositionByIndex();

                    this.play();
                },

                next() {
                    this.currentIndex = (this.currentIndex + this.startFrom) % this.images.length;
                },

                prev() {
                    this.currentIndex = this.direction == 'ltr'
                        ? this.currentIndex > 0 ? this.currentIndex - 1 : 0
                        : this.currentIndex < 0 ? this.currentIndex + 1 : 0;
                },

                navigateByPagination(index) {
                    this.direction == 'rtl' ? index = -index : '';

                    clearInterval(this.autoPlayInterval);

                    this.currentIndex = index;

                    this.setPositionByIndex();

                    this.play();
                },

                play() {
                    clearInterval(this.autoPlayInterval);

                    this.autoPlayInterval = setInterval(() => {
                        this.currentIndex = (this.currentIndex + this.startFrom) % this.images.length;

                        this.setPositionByIndex();
                    }, 5000);
                },
            },
        });
    </script>
<?php $__env->stopPush(); endif; ?><?php /**PATH /var/www/html/bagisto/packages/Webkul/Shop/src/resources/views/components/carousel/index.blade.php ENDPATH**/ ?>