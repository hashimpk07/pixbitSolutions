
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('product')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Update Product Page</h5>
</div>

<form action="javascript:void(0)" id="productEditForm" name="productEditForm"  enctype="multipart/form-data">
    <input type="hidden" name="id" class="form-control" id="id" value="<?php echo e($products->productId); ?>">
    <div class="card-body">
        <div class="form-group">
            <label for="color"> Product Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="productName" class="form-control" id="productName" placeholder="Enter Product" value="<?php echo e($products->productName); ?>">
            <div class="error" id="productNameErr"></div>
        </div>

        <div class="form-group">
            <label for="productSize"> Product Sizes <span style="color:#ff0000">*</span> </label>
            <div class="form-group">
                <div class="input-group">
                <select class="form-control" id="productSize" name="productSize"> 
                    <option value="0">Select Size</option>
                    <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($size->id); ?>" <?php echo e(( $size->id == $products->productSizeId) ? 'selected' : ''); ?>><?php echo e($size->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </select>
                </div>
                <div class="error" id="productSizeErr"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="productColors"> Product Colors  <span style="color:#ff0000">*</span></label>
            <div class="form-group">
                <div class="input-group">
                <?php   $prodColor = explode(",",$products->colorId)   ?>
                <select class="selectpicker" multiple data-live-search="true" name="productColors[]" id="productColors">
                    <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($color->id); ?>" <?php echo e((  in_array($color->id, $prodColor) )  ? 'selected' : ''); ?>> <?php echo e($color->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                   
                </select>
                <div class="error" id="productColorsErr"></div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="member_input_image"> Product Image <span style="color:#ff0000">*</span> </label>
            <div class="form-group" id="product_image_div" >
                <?php if( '' != $products->productimage ){?>
                <div class="input-group">
                    <img id="product_image" name="product_image" src="<?php echo e(asset('images/').'/'.$products->productimage); ?>" alt="your image" />
                </div>
                <?php }else{ ?>
                <div class="input-group">
                    <img id="product_image" name="product_image" src="" alt="your image" />
                </div>
                <?php } ?>
            </div>
            <input type='file' id="product_input_image" onchange="readURL(this);"  name="product_input_image" value="<?php echo e($products->productimage); ?>" data-value="<?php echo e($products->productimage); ?>" class="form-control" />
            <div class="error" id="product_imageErr"></div>
        </div>

         <div class="form-group">
            <label for="mobileNumber"> Product Description  </label>
            <div class="form-group">
                <div class="input-group">
                    <textarea  type="textarea" name="description" class="form-control" id="description" placeholder="Description"  rows="4" cols="50"><?php echo e($products->productdescription); ?></textarea>
                </div>
        </div>


    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="productForm-add btn btn-submit btn-primary" id="productForm-add">Save</button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Products Updated Successfully</h2>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() {     
            $('#productName').on('input', function() {
                $('#productNameErr').hide();
            });
        });

        $('#productSize').change(function(e) {
            var colorSize = $(this,':selected').val();
            if( 0 != colorSize ){
                $('#productSizeErr').hide();
            }else{
                $('#productSizeErr').show();
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                $('#product_image_div').show();
                reader.onload = function (e) {
                    $('#product_image').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#productEditForm").submit(function(e) {
            
            e.preventDefault();
        
            $('#productName').on('input', function() {
                $('#productNameErr').hide();
            });
       
            var productFlag    = 0;
            var productName    = $("#productName").val();
            var productSize    = $("#productSize option:selected").val();
            var productColors  = $('#productColors > option:selected');
        
   
            if(productName == "") {
                $("#productNameErr").html("Please Enter Product");
                productFlag = 1;
            }

            if(productColors.length == 0){
                $("#productColorsErr").html("Please Select Product Colors");
                productFlag = 1;
            }
            if( 0 == productSize || "" == productSize ){
                $("#productSizeErr").html("Please Select Product Size");
                productFlag = 1;
            }
    
           
            if( 1 == productFlag ){
                return false;
            }else{
            
                formData = new FormData(this);
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:"<?php echo e(route('product.update')); ?>",
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
                                window.location = '<?php echo e(route('product')); ?>'
                            }, 2500);
                        }else{
                            $("#colorErr").html("Data Not Saved ! Please check Data");
                        }
                    
                    },
                    error: function(response) {
                    }
                    
                });
            }
        });

       

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\TimesworldTechnology\resources\views/product/product-edit.blade.php ENDPATH**/ ?>