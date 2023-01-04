@extends('dashboard')
@section('content')

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('designations'); }}'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Edit Designation </h5>
</div>

<form action="javascript:void(0)" id="designationsEditForm" name="designationsEditForm">
    <p id="error" style="color: red;margin-left: 21px;"></p>
    <div class="card-body">

        <div class="form-group">
            <input type="hidden" name="designation_id" class="form-control" id="designation_id"  value="{{$designation->id}}" >
            <label for="color"> Designation Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="designationName" class="form-control" id="designationName" placeholder="Enter Designation Name "  value="{{$designation->name}}" >
            <div class="error" id="designationNameErr"></div>
        </div>

    </div>

    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="designationsForm-edit btn btn-submit btn-primary" id="designationsForm-edit">Submit</button>
        <input type="button" value="Cancel" class="designationsForm-cancel btn btn-submit" id="designationsCancel" style="background-color: green;color:white !important;" />
    </div>
    

</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Designation Updated Successfully</h2>
    </div>
</div> 
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  

        $("#designationsCancel").click(function() {
            $("#designationsEditForm")[0].reset();
            $("#error").html("");
            $('#designationNameErr').hide();
        });

        $( function() {     
            $('#designationName').on('input', function() {
                $('#designationNameErr').hide();
            });
        });

        $("#designationsEditForm").submit(function(e) {
            e.preventDefault();
            var flag                   = 0;
            var designationName        = $("#designationName").val();
            var id                     = $("#designation_id").val();
            if(designationName == "" ) {
                $('#designationNameErr').show();
                $("#designationNameErr").html("Please Enter Designation Name");
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
                    url:"{{ route('designations.update') }}",
                    type: "POST",
                    dataType: "json",
                    data:{ 
                        id   : id,
                        designationName:designationName,
                    },
                    success:function(data){
                        if( data.status == 'success' ){
                            $(".pop-outer").fadeIn("slow");
                            setTimeout(function () {
                                window.location = '{{ route('designations') }}'
                            }, 2500);
                        }else{
                             $("#error").html("Data Not Saved ! Please check Data");
                        }
                    
                    },
                    error: function(response) {
                        $("#error").text("Please check the data ! Wrong Data Enter");
                        $("#designationName").focus();

                    }   
                });
            }
        });
</script>
@endsection