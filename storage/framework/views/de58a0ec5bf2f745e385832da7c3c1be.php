<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                        }
                    }
                }
            }
        }
    </script>
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