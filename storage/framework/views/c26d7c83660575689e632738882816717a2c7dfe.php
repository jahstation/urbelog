<?php $__env->startSection('title'); ?> Create User <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class='col-lg-4 col-lg-offset-4'>

        <?php if($errors->has('')): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div class='bg-danger alert'><?php echo e($error); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>



        <h1><i class='fa fa-user'></i> Edit User</h1>

        <?php echo e(Form::model($user, ['role' => 'form', 'url' => '/user/' . $user->id, 'method' => 'PUT'])); ?>


        <div class='form-group'>
            <?php echo e(Form::label('name', 'Name')); ?>

            <?php echo e(Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control'])); ?>

        </div>


        <div class='form-group'>
            <?php echo e(Form::label('email', 'Email')); ?>

            <?php echo e(Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control'])); ?>

        </div>

        <div class='form-group'>
            <?php echo e(Form::label('password', 'Password')); ?>

            <?php echo e(Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control'])); ?>

        </div>

        <div class='form-group'>
            <?php echo e(Form::label('password_confirmation', 'Confirm Password')); ?>

            <?php echo e(Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control'])); ?>

        </div>

        <div class='form-group'>
            <?php echo e(Form::submit('Login', ['class' => 'btn btn-primary'])); ?>

        </div>

        <?php echo e(Form::close()); ?>


    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>