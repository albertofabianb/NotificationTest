<!DOCTYPE html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Notifications</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <style>
        div.scroll {
            margin:4px, 4px;
            padding:4px;
            width: 600px;
            background-color: #d1Ebfc;
            background-color: #f9f9f9;
            height: 250px;
            overflow-x: hidden;
            overflow-y: auto;
            font-size: smaller;
            font-family:Courier;
            border-width:thin;
        }
    </style>
</head>

<body>
    <div class="card uper edit-view" style="width: 1000px; margin: auto; margin-top: 50px">
        <div class="card-header">
            <h4>Notification Test</h4>
            <h6>by Alberto Bohbouth</h6>
        </div>
        <table>
            <tr>
                <td width="40%">
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
                        <form id="notification" method="post" action="<?php echo e(url('publish')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group py-4 ">
                                <label class="col-sm-4 col-form-label" for="category_id">Category</label>
                                <select required class="col-sm-4 form-control" name="category_id">
                                    <option></option>
                                    <?php $__currentLoopData = $categories ?? ''; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" ><?php echo e($category->category); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group py-2 " >
                                <label class="col-sm-4 col-form-label" for="message">Message</label>
                                <textarea  required  type="date" rows="4" class="col-sm-4 form-control" style="resize: none" name="message"></textarea>
                            </div>
                            <div class="form-group py-4">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                        </form>
                    </div>
                </td>
                <td>
                    <div class="card-body">
                        <div class="form-group py-2 col-lg-14" >
                            <label class="col-sm-2 col-form-label" for="log">Log</label>
                            <div class=" scroll" id="log">
                               <?=$log ?? ''?>
                            </div>
                        </div>
                        <div class="form-group py-4">
                        </div>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</body>
</html><?php /**PATH /home/alberto/Workspace/gilasoftware/notification_test/resources/views/notificationFront/index.blade.php ENDPATH**/ ?>