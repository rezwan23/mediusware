<?php $__env->startSection('footer1'); ?>
    <script src="/date.js"></script>
    <script>
        $('#pwd1').datepicker({
            format: 'yyyy-mm-dd',
        });
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('head1'); ?>
    <link rel="stylesheet" href="/date.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid app-body app-home">
        <h2></h2>
        <div class="panel panel-default">
            <div class="panel-heading"><h1>Recent Post Sent to buffer</h1></div>
            <div class="panel-body">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="email"><i class="fa fa-search"></i></label>
                        <input type="text" value="<?php echo e(request()->get('search')??''); ?>" class="form-control" id="email" name="search">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Date:</label>
                        <input type="text" value="<?php echo e(request()->get('date')??''); ?>" class="form-control" autocomplete="off" id="pwd1" name="date">
                    </div>
                    <div class="form-group">
                        <label for="pwd1">Group:</label>
                        <select class="form-control" name="group_type" id="pwd1">
                            <option value="*">All Group</option>
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if(request()->get('group_type') == $group->id): ?> selected <?php endif; ?> value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <table class="table table-bordered social-accounts">
                    <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Group Type</th>
                        <th>Account Name</th>
                        <th>Post Text</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $postings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($posting->groupInfo?$posting->groupInfo->name:''); ?></td>
                            <td><?php echo e(ucfirst($posting->groupInfo?$posting->groupInfo->type:'')); ?></td>
                            <td>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="">
                                            <span class="fa fa-facebook"></span>
                                            <img width="50" class="media-object img-circle" src="<?php echo e($posting->accountInfo->avatar); ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php echo e(\Illuminate\Support\Str::words($posting->post_text, 5, '...')); ?>

                            </td>
                            <td>
                                <?php echo e(\Carbon\Carbon::parse($posting->created_at)->format('d F, Y, h:s a')); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <?php echo e($postings->appends($_GET)->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>