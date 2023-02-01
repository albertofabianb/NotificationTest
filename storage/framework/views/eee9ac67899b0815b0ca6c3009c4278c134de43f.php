<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Notification Test</h1>


        <select id="category" name="category">
            <?php $categories = [
                ['id' => 1, 'category' => 'Sports'],
                ['id' => 2, 'category' => 'Financial'],
                ['id' => 3, 'category' => 'Movies']
            ];
            ?>
            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <option id="<?php echo e($category['id']); ?>"><?php echo e($category['category']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <option id="0">No categories found</option>
            <?php endif; ?>
        </select>

        <textarea name="message"></textarea>
        <button >Publish</button>


    </body>
</html><?php /**PATH /home/alberto/Workspace/gilasoftware/notification_test/resources/views/notifications.blade.php ENDPATH**/ ?>