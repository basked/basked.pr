<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>
    <div id="app">
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'project-manager')): ?>
        <dev-grid-elationship></dev-grid-elationship>
        <?php endif; ?>
        <dev-grid-diagram></dev-grid-diagram>
    </div>

    <p>
        This view is loaded from module: <?php echo config('treelife.name'); ?>



    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('treelife::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Soft\PROGRAMMING\WEB\WebServer\domains\basked.pr\Modules/TreeLife\Resources/views/index.blade.php ENDPATH**/ ?>