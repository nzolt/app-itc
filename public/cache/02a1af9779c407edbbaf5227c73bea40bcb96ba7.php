<?php $__env->startSection('content'); ?>
    <!-- Call to Action-->
    <div class="card text-white bg-secondary my-5 py-4 text-center">
        <div class="card-body"><p class="text-white m-0">List of our insurance products!</p></div>
    </div>
    <div class="row gx-4 gx-lg-5">
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title"><?php echo e(ucfirst($key)); ?></h2>
                    <p class="card-text"><?php echo e($item); ?></p>
                </div>
                <div class="card-footer"><a class="btn btn-primary btn-sm" href="/details/<?php echo e($key); ?>">More Info</a></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/app/views/list.blade.php ENDPATH**/ ?>