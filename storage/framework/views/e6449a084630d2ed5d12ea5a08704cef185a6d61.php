<?php $__env->startSection('title'); ?> Users <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-lg-10 col-lg-offset-1">

        <h1><i class="fa fa-users"></i> User Administration <a href="/logout" class="btn btn-default pull-right">Logout</a></h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->created_at->format('F d, Y h:ia')); ?></td>
                        <td>
                            <a href="/user/<?php echo e($user->id); ?>/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                            <?php echo e(Form::open(['url' => '/user/' . $user->id, 'method' => 'DELETE'])); ?>

                            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger'])); ?>

                            <?php echo e(Form::close()); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </tbody>

            </table>
        </div>

        <a href="/user/create" class="btn btn-success">Add User</a>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>