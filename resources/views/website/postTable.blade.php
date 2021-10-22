@extends('homeTest')

@section('postTable')



<table class="table container" >
    <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">Title</th>
        {{-- <th scope="col">Post</th> --}}

        <th scope="col">Time</th>
        <th scope="col">Photo</th>

        <th scope="col">Action</th>
        <th scope="col"></th>

      </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)


      <tr>
          <input type="hidden" class="delete_val_id" value="{{$post->id}}">
        <th scope="row">{{ $post->id }}</th>
        <td>{{ $post->title }}</td>
        {{-- <td>{{ $post->post }}</td> --}}
        {{-- <td>{{ $post['id']->category->name }}</td> --}}

        <td>{{ $post->created_at->diffForHumans()}}</td>
        <td><img style="width: 90px;height:90px" src="{{asset('images/posts/'.$post->photo)}}" alt="No Image"></td>
        <td><a class="btn btn-sm btn-info" title="حذف" href="{{route('admin.post.edit',$post->id)}}"><i class="las la-pen"></i></a>
{{--        <a class="modal-effect btn btn-sm btn-danger" title="حذف" href="{{route('admin.post.delete',$post->id)}}"><i class="las la-trash font-size-h3"></i></a>--}}
{{--            <button type="button" class="btn-danger servideletebtn"></button>--}}
                        <button @click="delete_post(post.id)" class="btn btn-danger">Delete</button>
{{--            <a href="javascript:;" data-toggle="modal" data-id='{{$post->id}}' data-target="#exampleModalCenter" >Remove</a>--}}



        <!-- Modal -->
{{--            <div id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--                <div role="document">--}}
{{--                    <div >--}}
{{--                        <form action="{{route('admin.post.delete',$post->id)}}" method="post">--}}
{{--                            {{ csrf_field() }}--}}
{{--                            <div >--}}
{{--                                <button type=button data-dismiss="modal" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div >--}}
{{--                                <input type=hidden id="{{$post->id}}" name="{{$post->id}}">--}}
{{--                                <h5 id="exampleModalLabel">Are you sure want to delete?</h5>--}}
{{--                            </div>--}}
{{--                            <div >--}}
{{--                                <button type=button data-dismiss="modal">No</button>--}}
{{--                                <button type=submit >Yes ! Delete it</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Modal -->--}}
        </td>


      </tr>
      @endforeach
    </tbody>
  </table>

  @endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script  src=//code.jquery.com/jquery-3.5.1.slim.min.js integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin=anonymous></script>
    <script>
        export default {
            data() {
                return {
                    posts: {},
                    categories: {},
                    category_id: '',
                    sort_field: 'created_at',
                    sort_direction: 'desc',
                }
            },
            mounted() {
                axios.get('/api/category')
                    .then(response => {
                        this.categories = response.data.data;
                    });
                this.getResults();
            },
            watch: {
                category_id(value) {
                    this.getResults()
                }
            },
            methods: {
                change_sort(field) {
                    if (this.sort_field === field) {
                        this.sort_direction = this.sort_direction === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.sort_field = field;
                        this.sort_direction = 'asc';
                    }
                    this.getResults();
                },
                getResults(page = 1) {
                    console.log(
                        '/api/posts?page=' + page
                        + '&category_id=' + this.category_id
                        + '&sort_field=' + this.sort_field
                        + '&sort_direction=' + this.sort_direction
                    );
                    axios.get('/api/posts?page=' + page
                        + '&category_id=' + this.category_id
                        + '&sort_field=' + this.sort_field
                        + '&sort_direction=' + this.sort_direction)
                        .then(response => {
                            this.posts = response.data;
                        });
                },
                delete_post(id) {
                    swal({
                        title: "Are Your Shure You Want to Delete The Post ?",
                        icon: "warning",
                        buttons: ["No", "Yes"],
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                axios.delete('/api/posts/' + id).then(response => {
                                    swal("Post Deleted Successfully");
                                    this.getResults()
                                })
                            } else {
                                swal("Post Not Deleted");
                            }
                        }).catch(error => {
                        swal({
                            icon: 'error',
                            title: 'Error Happened'
                        });
                    });
                }
            }
        }
     //    // $('.addAttr').click(function() {
     //    //     var id = $(this).data('id');
     //    //     $('#id').val(id);
     //    // } );
     //   $(document).ready(function (){
     // $('.servideletebtn').click(function (e){
     //     $.ajaxSetup({
     //         headers: {
     //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     //         }
     //     });
     //     e.preventDefault();
     //     var delete_id = $(this).closest("tr").find('.delete_val_id').val();
     //     delete_post(delete_id) {
     //         swal({
     //             title: "Are Your Shure You Want to Delete The Post ?",
     //             icon: "warning",
     //             buttons: ["No", "Yes"],
     //             dangerMode: true,
     //         })
     //             .then((willDelete) => {
     //                 if (willDelete) {
     //                     axios.delete('/delete-Post/' + delete_id).then(response => {
     //                         swal("Post Deleted Successfully");
     //                         this.getResults()
     //                     })
     //                 } else {
     //                     swal("Post Not Deleted");
     //                 }
     //             }).catch(error => {
     //             swal({
     //                 icon: 'error',
     //                 title: 'Error Happened'
     //             });
     //         });
     //     }
         // alert(delete_id)
         // swal({
    //         title: "Are you sure?",
    //         text: "Once deleted, you will not be able to recover this imaginary file!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })
    //         .then((willDelete) => {
    //             if (willDelete) {
    //
    //                 var data = {
    //                     "_token": $('input[name=_token]').val(),
    //                     "id" : delete_id,
    //                 $.ajax({
    //                     type:"DELETE",
    //                     url : '/delete-Post/'+delete_id,
    //                     data : data,
    //                     success : function (response){
    //                         swal(response.status, {
    //                             icon: "success",
    //                         })
    //                     .then((result) => {
    //                         location.reload();
    //                         });
    //                     }
    //                 });
    //                 }
    //
    //
    //         });
    // });
    //
    // });
    // });

    </script>
@endsection
