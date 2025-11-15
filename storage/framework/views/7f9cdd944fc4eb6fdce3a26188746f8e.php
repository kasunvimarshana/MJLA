<?php $__env->startSection('title', 'Courses - ' . config('app.name')); ?>
<?php $__env->startSection('description', 'Explore our Japanese language courses for all levels'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Our Courses</h1>
        <p class="mt-2 text-lg text-gray-600">Discover the perfect course for your Japanese learning journey</p>
    </div>

    <?php if($courses->isEmpty()): ?>
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No courses available</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new course.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                    <?php if($course->image): ?>
                        <img src="<?php echo e($course->image); ?>" alt="<?php echo e($course->title); ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                <?php echo e(ucfirst($course->level)); ?>

                            </span>
                            <?php if($course->is_featured): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Featured
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            <a href="<?php echo e(route('courses.show', $course->slug)); ?>" class="hover:text-primary-600">
                                <?php echo e($course->title); ?>

                            </a>
                        </h3>
                        
                        <?php if($course->description): ?>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                <?php echo e(Str::limit($course->description, 100)); ?>

                            </p>
                        <?php endif; ?>
                        
                        <div class="flex items-center justify-between">
                            <div class="text-2xl font-bold text-primary-600">
                                ¥<?php echo e(number_format($course->price, 0)); ?>

                            </div>
                            <a href="<?php echo e(route('courses.show', $course->slug)); ?>" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                                Learn more →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-8">
            <?php echo e($courses->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/runner/work/MJLA/MJLA/resources/views/courses/index.blade.php ENDPATH**/ ?>