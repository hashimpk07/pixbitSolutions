@extends('dashboard')
@section('content')

<!-- /.card-header -->
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('designations.add'); }}'" ><i class="fa fa-plus"></i> Add Designations </button>
</div>
<div class="card-body">
    <h5> Designations Table</h5>
    <?php
    if( 0  != $designations->total() ){?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 350px">Name</th>
                <th style="width: 10px">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = ($designations->perPage() * ($designations->currentPage() - 1)) + 1; ?>
            @foreach($designations as $designation)
            <tr>
                <td >{{ $i++ }}</td>
                <td > {{ $designation->name }} </td>
                <td>
                    <a class="btn"  title="edit" href="{{ route('designations.edit', ['id' => $designation->id]) }}"  ><i class="fas fa-edit"></i></a>
                    <a class="btn" title="delete" onclick="return confirm('Are you sure to detete  {{ $designation->name }} ?')"  href="{{ route('designations.delete', ['id' => $designation->id]) }}" ><i class="fas fa-times"></i></a>
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
        {!! $designations->links('pagination::bootstrap-4') !!}
    </ul>
</div>
@endsection