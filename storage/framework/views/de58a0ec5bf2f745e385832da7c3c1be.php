<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title><?php echo e(config('app.name')); ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Majime Japanese Language Academy - Master the Japanese language with expert instruction and comprehensive courses">
    <meta name="keywords" content="Japanese language, Japanese courses, Learn Japanese, Japanese Academy, MJLA">
    
    <!-- Vite Assets -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-3xl">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">
                Welcome to Majime Japanese Language Academy
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                Master the Japanese language with expert instruction and comprehensive courses
            </p>
            <div class="flex justify-center space-x-4 mb-8">
                <a href="<?php echo e(route('courses.index')); ?>" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                    Explore Courses
                </a>
                <a href="#" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Learn More
                </a>
            </div>
            <div class="text-sm text-gray-500">
                Laravel v<?php echo e(Illuminate\Foundation\Application::VERSION); ?> (PHP v<?php echo e(PHP_VERSION); ?>)
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/runner/work/MJLA/MJLA/resources/views/welcome.blade.php ENDPATH**/ ?>