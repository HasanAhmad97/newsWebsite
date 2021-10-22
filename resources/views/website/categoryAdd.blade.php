@extends('homeTest')

@section('categoryAdd')
    
        
    
<div class="card-body">

<form action="{{ route('admin.category.store') }}" method="post">
    @csrf
<div class="form-group">
    <label for="exampleFormControlInput1">Category Name</label>
    <input type="text" name='name' class="form-control" id="exampleFormControlInput1" placeholder="Put the title">
  </div>
  <button type="submit" class="btn btn-primary mt-4">Send</button>

</form>
</div>
@endsection