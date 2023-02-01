<!DOCTYPE html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Notifications</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>
<body >
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
    <div class="card uper edit-view" style="width: 1000px; margin: auto; margin-top: 50px">
        <div class="card-header">
            <h4>Notification Test</h4>
            <h6>by Alberto Bohbouth</h6>
        </div>
        <table>
            <tr>
                <td>
                    <div class="card-body">
                        <form id="notification" method="post" action="">
                            <div class="form-group py-4">
                                <?php $categories = [
                                    ['id' => 1, 'category' => 'Sports'],
                                    ['id' => 2, 'category' => 'Financial'],
                                    ['id' => 3, 'category' => 'Movies']
                                ];
                                ?>
                                <label class="col-sm-2 col-form-label" for="category">Category</label>
                                <select class="col-sm-4 form-control" name="category">
                                    <option></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category['id']); ?>" <?php echo e($category['id'] == old("category") ? "selected" : ""); ?>><?php echo e($category['category']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group py-2">
                                <label class="col-sm-2 col-form-label" for="message">Message</label>
                                <textarea type="date" rows="3" class="col-sm-4 form-control" name="message"></textarea>
                            </div>
                            <div class="form-group py-4">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                        </form>
                    </div>
                </td>
                <td>
                    <div class="card-body">
                        <div class="form-group py-2">
                            <label class="col-sm-2 col-form-label" for="log">Log</label>
                            <textarea type="date" rows="7" class="col-sm-4 form-control" name="log"></textarea>
                        </div>
                        <div class="form-group py-4">

                        </div>

                    </div>
                </td>
            </tr>
        </table>

    </div>
</body>
</html>
<?php /**PATH /home/alberto/Workspace/gilasoftware/notification_test/resources/views/notification.blade.php ENDPATH**/ ?>