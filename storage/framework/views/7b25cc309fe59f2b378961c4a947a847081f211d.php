<?php $__env->startSection('content'); ?>

    <div id="app">
        <dev-grid-spr-unit></dev-grid-spr-unit>
    </div>








    <h1>Hello World</h1>

    <p>
        This view is loaded from module: <?php echo config('directory.name'); ?>


    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('directory::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Soft\PROGRAMMING\WEB\WebServer\domains\basked.pr\Modules/Directory\Resources/views/index.blade.php ENDPATH**/ ?>