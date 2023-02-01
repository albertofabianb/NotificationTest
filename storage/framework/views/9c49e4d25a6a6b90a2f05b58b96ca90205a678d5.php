

<?php $__env->startSection('content'); ?>
    <style>
        .uper {
            margin-top: 40px;
        }
        .sga_checkbox{
            height: 20px;
            width: 20px;
        }
        label {
            /*            text-align: right; */
        }
    </style>
    <div class="card uper edit-view">
        <div class="card-header">
            <h4>Notification Test</h4>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div><br />
            <?php endif; ?>
            <form id="notification" method="post" action="<?php echo e(route('/')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group py-4">
                    <label class="col-sm-2 col-form-label" for="category">Category</label>
                    <select class="col-sm-4 form-control" name="category">
                        <option></option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == old("category") ? "selected" : ""); ?>><?php echo e($category->category); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group py-2">
                    <label class="col-sm-2 col-form-label" for="message">Message</label>
                    <textarea type="date" class="col-sm-4 form-control" name="message" value="<?php echo e(old('message')); ?>"></textarea>
                </div>
                <br>
                <div class="form-group py-4">
                    <button type="submit" onClick="prevenir=0" class="btn btn-primary">Crear</button>
                    <a href="<?php echo e(session('volver_a')); ?>" class="btn btn-success">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <script>

        prevent = 1;

        $('#category').data('serialize',$('#category').serialize()); // On load save form current state

        $(window).bind('beforeunload', function(e){
            if($('#category').serialize() != $('#category').data('serialize') && prevent){
                return true;
            }else{
                e=null;
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alberto/Workspace/gilasoftware/notification_test/resources/views/create.blade.php ENDPATH**/ ?>