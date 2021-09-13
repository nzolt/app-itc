<?php $__env->startSection('content'); ?>
    <!-- Call to Action-->
    <div class="card text-white bg-secondary my-5 py-4">
        <div class="card-body">
            <p class="text-white m-0">
                <div class="mb-5">
                    <div class="">
                        <h2 class="card-title"><?php echo e($data['name']); ?></h2>
                        <p class="card-text"><?php echo e($data['description']); ?></p>
                        <?php if(array_key_exists('type')): ?>
                            <p class="card-text">Type: <?php echo e(ucfirst($data['type'])); ?></p>
                        <?php endif; ?>
                        <p class="card-text">Suppliers</p>
                        <ul>
                            <?php if(array_key_exists('suppliers', $data)): ?>
                            <?php $__currentLoopData = explode('|', $data['suppliers']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($sup); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li>No supplier for this product!</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </p>
        </div>
    </div>
    <div class="row gx-4 gx-lg-5">

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/app/views/detail.blade.php ENDPATH**/ ?>