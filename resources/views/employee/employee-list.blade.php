@extends('dashboard')
@section('content')

<!-- /.card-header -->
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('employees.add'); }}'" ><i class="fa fa-plus"></i> Add Employees </button>
</div>
<div class="card-body">
    <h5> Employees Table</h5>
    <?php
    if( 0  != $employees->total() ){?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 350px">Last Name</th>
                <th style="width: 300px">First Name</th>
                <th style="width: 200px">Last Name</th>
                <th style="width: 300px">Mobile Number</th>
                <th style="width: 300px">Email Address</th>
                <th style="width: 450px">Designations</th>
                <th style="width: 300px">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = ($employees->perPage() * ($employees->currentPage() - 1)) + 1; ?>
            @foreach($employees as $employee)
            <tr>
                <td >{{ $i++ }}</td>
                <td style="width: 10px" > 
                <?php 
                    if( '' == $employee->image ){?>
                    <img src="{{ asset('images/avatar.png') }}" alt="tag"  height="50" width="50"> 
                <?php }else{ ?>
                    <img src="{{asset('images/').'/'.$employee->image }}" alt="tag"  height="50" width="50" >
                    <?php     } ?>
                </td>
                <td > {{ $employee->first_name }} </td>
                <td > {{ $employee->last_name }} </td>
                <td > {{ $employee->mobile }} </td>
                <td > {{ $employee->email }} </td>
                <td > {{ $employee->designations->name }} </td>

                <td>
                    <a class="btn"  title="edit" href="{{ route('employees.edit', ['id' => $employee->id]) }}"  ><i class="fas fa-edit"></i></a>
                    <a class="btn" title="delete" onclick="return confirm('Are you sure to detete  {{ $employee->name }} ?')"  href="{{ route('employees.delete', ['id' => $employee->id]) }}" ><i class="fas fa-times"></i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
</div>
<?php } else{?> 
<img src="{{url('/images/norecordfound.png')}}" class="no-data-found" style="width: 100%;" />
    <?php } ?>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        {!! $employees->links('pagination::bootstrap-4') !!}
    </ul>
</div>
@endsection