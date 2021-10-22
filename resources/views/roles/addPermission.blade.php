@extends('homeTest')

@section('addPermission')
    <div class="card-body">

        <form action="{{ route('admin.store.permission') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Add your permission</label>
                <input type="text" name='name' class="form-control" id="exampleFormControlInput1" placeholder="Put the title">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Add</button>

        </form>
    </div>
@endsection
