
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('employees')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>

<div class="card-body">
   <h5>   Add Employee </h5>
</div>
<div style="color: green;margin-left: 26px;display:none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Employee Added Successfully</h2>
    </div>
</div> 

<form action="javascript:void(0)" id="employeeForm" name="employeeForm-add"  method="post">
    <div class="card-body">

        <div class="form-group">
            <label for="employee"> First Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="firstName" class="form-control" id="firstName" placeholder="Enter First Name ">
            <div class="error" id="firstNameErr"></div>
        </div>

        <div class="form-group">
            <label for="employee"> Last Name </label>
                <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Enter Last Name ">
        </div>

        <div class="form-group">
            <label for="employee">Joining Date <span style="color:#ff0000">*</span></label>
               <input type="date" class="form-control datetimepicker-input"  id="jod" name="jod" placeholder="Enter Date Of Joining " />            
               <div class="error" id="jodErr"></div>
        </div>


        <div class="form-group">
            <label for="employee"> Date Of Birth <span style="color:#ff0000">*</span></label>
               <input type="date" class="form-control datetimepicker-input"  id="dob" name="dob" placeholder="Enter Date Of Birth " />            
               <div class="error" id="dobErr"></div>
        </div>

         <div class="form-group">
            <label for="designationName"> Designations <span style="color:#ff0000">*</span></label>
            <select class="form-control" id="designationName" name="designationName"> 
                <option value="0">Select Designations </option>
                <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($designations->id); ?>"><?php echo e($designations->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                   
            </select>      
            <div class="error" id="designationErr"></div>
        </div>

        <div class="form-group">
            <label for="teachers"> Gender <span style="color:#ff0000">*</span></label>
               <input type="radio" value="1" name="gender" style="margin-left:11%"><span> Male </span>                        
                <input type="radio" value="2" name="gender" style="margin-left:45%"><span> Female </span>          
               <div class="error" id="genderErr"></div>
        </div>

        <div class="form-group">
            <label for="employee"> Mobile Number <span style="color:#ff0000">*</span></label>
                <input type="text" name="mob" class="form-control" id="mob" placeholder="Enter Mobile Number">
            <div class="error" id="mobErr"></div>
        </div>

        <div class="form-group">
            <label for="employee"> LandLine Number</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number ">
        </div>

        <div class="form-group">
            <label for="employee"> Email Address <span style="color:#ff0000">*</span></label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email Address ">
            <div class="error" id="emailErr"></div>
        </div>

        <div class="form-group">
            <label for="employee"> Permanent Address <span style="color:#ff0000">*</span></label>
                <textarea  type="textarea" name="permanentAddress" class="form-control" id="permanentAddress" placeholder="Permanent Address"  rows="4" cols="50"></textarea>
        </div>

         <div class="form-group">
            <input type="checkbox" value="1" name="adress_same" id="adress_same" onchange="sameAddress()"><span> Same As Present Address </span>                        
        </div>

        <div class="form-group">
            <label for="employee"> Present Address <span style="color:#ff0000">*</span></label>
                <textarea  type="textarea" name="presentAddress" class="form-control" id="presentAddress" placeholder="present Address"  rows="4" cols="50"></textarea>
        </div>

        <div class="form-group">
            <label for="status"> Status <span style="color:#ff0000">*</span></label>
            <select class="form-control" id="status" name="status"> 
                <option value="1"> Active </option>
                <option value="0"> Inactive</option>
            </select>
            <div class="error" id="statusErr"></div>
        </div>

        <div class="form-group">
            <label for="member_input_image"> Profile Pic <span style="color:#ff0000">*</span> </label>
            <div class="form-group" id="profile_image_div" style="display:none;">
                <div class="input-group">
                    <img id="profile_image" name="profile_image" src="" alt="your image" style="width:10% !important;" />
                </div>
            </div>
            <input type='file' id="profile_input_image" onchange="readURL(this);"  name="profile_input_image" class="form-control" />
            <div class="error" id="profile_imageErr"></div>
        </div>

        <div class="form-group">
            <label for="member_input_attach"> Resume </label>
            <input type='file' id="resume"  name="resume" class="form-control" />
        </div>


    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="employeeForm-add btn btn-submit btn-primary" id="employeeForm-add">Save</button>
    </div>
</form>
                                          
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() {     
            $('#firstName').on('input', function() {
                $('#firstNameErr').hide();
            });
            $('#jod').on('input', function() {
                $('#jodErr').hide();
            });
            $('#dob').on('input', function() {
                $('#dobErr').hide();
            });
            $('#mob').on('input', function() {
                $('#mobErr').hide();
            });
            $('#email').on('input', function() {
                $('#emailErr').hide();
            });

            $('input[type=radio][name=gender]').change(function() {
                $("#genderErr").hide();
            });
        });

        $('#designationName').change(function(e) {
            var designationName = $(this,':selected').val();
            if( 0 != designationName ){
                $('#designationErr').hide();
            }else{
                $('#designationErr').show();
            }

        });

        $('#status').change(function(e) {
            var statusnName = $(this,':selected').val();
            if( 0 != statusnName ){
                $('#statusErr').hide();
            }else{
                $('#statusErr').show();
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                $('#profile_image_div').show();
                reader.onload = function (e) {
                    $('#profile_image').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function sameAddress() {
            if( 1 == $('input:checkbox[name=adress_same]:checked').val() ){   
                $('#presentAddress').val( $('#permanentAddress').val() );
            }else{
                $('#presentAddress').val("");
            }
        }
        $("#employeeForm").submit(function(e) {
            e.preventDefault();
            var flag    = 0;
            var firstName    = $("#firstName").val();
            var jod          = $("#jod").val();
            var dob          = $("#dob").val();
            var mob          = $("#mob").val();
            var phone        = $("#phone").val();
            var email        = $("#email").val();
            var designation  = $("#designationName option:selected").val();
            var status       = $('#status option:selected').val();
            var profile_image = $("#profile_input_image").val();
            var gender       = $('input:radio[name=gender]:checked').val();

            if(firstName == "") {
                $("#firstNameErr").html("Please Enter First Name");
                flag = 1;
            }

            if(jod == "") {
                $("#jodErr").html("Please Enter Joining Date");
                flag = 1;
            }

            if(dob == "") {
                $("#dobErr").html("Please Enter Date Of Birth");
                flag = 1;
            }

            if(mob == "") {
                $("#mobErr").html("Please Enter Mobile Number");
                flag = 1;
            }

            if(email == "") {
                $("#emailErr").html("Please Enter Email Address");
                flag = 1;
            }

            if( 0 == designation ){
                $("#designationErr").html("Please Select Designation");
                flag = 1;  
            }
            
            if(profile_image == "") {
                $("#profile_imageErr").html("Please Enter Profile Picture");
                flag = 1;
                
            }
            if( undefined == gender  ){
                $("#genderErr").html("Please Enter Gender");
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
                    url:"<?php echo e(route('employees.create')); ?>",
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
                                window.location = '<?php echo e(route('employees')); ?>'
                            }, 2500);
                        }else{
                            $("#firstNameErr").html("Data Not Saved ! Please check Data");
                        }
                    
                    },
                    error: function(response) {
                    }
                    
                });
            }
        });  
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Pixbit\pixbit\resources\views/employee/employee-add.blade.php ENDPATH**/ ?>