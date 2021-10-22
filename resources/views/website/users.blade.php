

@extends('homeTest')


@section('users')


<table class="table container">
    <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
          <th scope="col">roles</th>
        <th scope="col">Action</th>




      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)


      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>

          <td>
              @foreach($user->getRoleNames() as $v)
              {{ $v }}
              @endforeach
          </td>

        <td><a class="btn btn-sm btn-info" href="{{route('admin.userEdit',$user->id)}}"><i class="las la-pen"></i></a>
        <a class="modal-effect btn btn-sm btn-danger " href="{{route('admin.delete',$user->id)}}"><i
                class="las la-trash font-size-h3"></i></a></td>


      </tr>
      @endforeach
    </tbody>
  </table>

  @endsection
