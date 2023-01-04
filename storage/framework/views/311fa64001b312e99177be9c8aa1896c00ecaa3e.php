
<?php $__env->startSection('content'); ?>

<!-- /.card-header -->
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right;"; onclick="window.location='<?php echo e(URL::route('book_issue.return')); ?>'" ><i class="fa fa-plus"></i> Return Books  </button>
    <button type="button" class="btn btn-info" style="float: right;margin-right: 10px;"; onclick="window.location='<?php echo e(URL::route('book_issue.issue')); ?>'" ><i class="fa fa-plus"></i> Issued Books </button>
</div>
<div class="card-body">
    <h5> Book Issue Details </h5>
    <?php
    if( 0  != $library->total() ){?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Student Name</th>
                <th>Book Name</th>
                <th>Book Number</th>
                <th>Book Author</th>
                <th  style="width: 175px">Issue Date</th>
                <th style="width: 175px">Return Date</th>
                <th>Return Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = ($library->perPage() * ($library->currentPage() - 1)) + 1; ?>
            <?php $__currentLoopData = $library; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $libry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if( 0 == $libry->status ){
                $status = 'Issued';
            }else{
                $status = 'Return';
            }?>
            <tr>
                <td > <?php echo e($i++); ?> </td>
                <td > <?php echo e($libry->studentName); ?> </td>
                <td > <?php echo e($libry->bookName); ?> </td>
                <td > <?php echo e($libry->booknumber); ?> </td>
                <td > <?php echo e($libry->bookAuthor); ?> </td>
                <td > <?php echo e(date('d-M-Y', strtotime($libry->issueDate))); ?> </td>
                <td > <?php echo e(date('d-M-Y', strtotime($libry->returnDate))); ?> </td>
                <td > <?php echo e($status); ?> </td>
            </tr>

         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </tbody>
    </table>
</div>
<?php } else{?> 
<img src="<?php echo e(url('/images/norecordfound.png')); ?>" class="no-data-found" style="width: 100%;" />
    <?php } ?>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        <?php echo $library->links('pagination::bootstrap-4'); ?>

    </ul>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Bliss-technologies\resources\views/library/library-list.blade.php ENDPATH**/ ?>