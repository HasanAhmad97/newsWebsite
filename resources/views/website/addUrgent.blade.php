@extends('homeTest')

@section('addUrgent')



<div class="card-body">

<form action="{{ route('admin.urgent.store') }}" method="post">
    @csrf
<div class="form-group">
    <label for="exampleFormControlInput1">News Title</label>
    <input type="text" name='name' class="form-control" id="exampleFormControlInput1" placeholder="Put the title">
  </div>
  <button type="submit" class="btn btn-primary mt-4">Add</button>

</form>
</div>
@endsection
