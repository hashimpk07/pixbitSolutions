
<?php $__env->startSection('content'); ?>
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('book_issue')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>   Books Issue Page</h5>
</div>
<form action="javascript:void(0)"  id="bookIssueForm" name="bookIssueForm" >
    <p id="error" style="color: red;margin-left: 21px;"></p>
    <div class="card-body">

       <div class="form-group">
            <label for="BookName"> Book Name <span style="color:#ff0000">*</span> </label>
            <div class="form-group">
                <div class="input-group">
                    <select class="form-control" id="bookName" name="bookName"> 
                        <option value="0">Select Books</option>
                        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($book->id); ?>"><?php echo e($book->name); ?> - (<?php echo e($book->book_no); ?> )</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    </select>
                </div>
                <div class="error" id="bookNameErr"></div>
            </div>

            <div class="form-group">
                <label for="studentName"> Student Name <span style="color:#ff0000">*</span> </label>
                <div class="input-group">
                    <select class="form-control" id="studentName" name="studentName"> 
                        <option value="0">Select Student Name</option>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($student->id); ?>"><?php echo e($student->name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    </select>
                </div>
                <div class="error" id="studentNameErr"></div>
            </div>

            <div class="form-group">
                <label for="issueDate"> Issue Date <span style="color:#ff0000">*</span> </label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="issueDate" name="issueDate">
                    </div>
                <div class="error" id="issueDateErr"></div>
            </div>

            <div class="form-group">
                <label for="returnDate"> Return Date <span style="color:#ff0000">*</span> </label>
                <div class="input-group">
                   <input type="date" class="form-control" id="returnDate" name="returnDate" >
                </div>
                <div class="error" id="returnDateErr"></div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="bookIssueForm-edit btn btn-submit btn-primary" id="bookIssueForm-edit">Save</button>

    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Book Issued Successfully</h2>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $(document).ready( function() {
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            $('#issueDate').val(today);
            weeks = new Date(now.setDate(now.getDate() + 7)).toISOString().split('T')[0];            
            $('#returnDate').val(weeks);
        });

        $("#bookIssueForm").submit(function(e) {
            
            e.preventDefault();
       
            var flag            = 0;
            var bookName        = $("#bookName option:selected").val();
            var studentName     = $("#studentName option:selected").val();
            var issueDate        = $("#issueDate").val();
            var returnDate        = $("#returnDate").val();
   
            if(issueDate == "") {
                $("#issueDateErr").html("Please Enter Issue Date");
                flag = 1;
            }

            if(returnDate == ""){
                $("#returnDateErr").html("Please Enter Return Date");
                flag = 1;
            }
            if( 0 == studentName || "" == studentName ){
                $("#studentNameErr").html("Please Enter Student Name");
                flag = 1;
            }
            if( 0 == bookName || "" == bookName ){
                $("#bookNameErr").html("Please Enter Book Name");
                flag = 1;
            }
    
            if( 1 == flag ){
                return false;
            }else{
               
                formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:"<?php echo e(route('book_issue.update')); ?>",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success:function(data){
                        if( data.status == 'success' ){
                            $(".pop-outer").fadeIn("slow");
                            setTimeout(function () {
                                window.location = '<?php echo e(route('book_issue')); ?>'
                            }, 2500);
                        }else{
                             $("#error").text(data.message);
                        }
                    
                    },
                    error: function(response) {
                        $("#error").text("Please check the data ! Wrong Data Enter");
                        $("#bookNumber").focus();

                    }
                    
                });
            }
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Bliss-technologies\resources\views/library/library-issue.blade.php ENDPATH**/ ?>