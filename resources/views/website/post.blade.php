@extends('homeTest')
@section('post')
    

<div class="container "> 
<form action="{{ route('admin.post.store')}}" id="formData" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleFormControlInput1">Title</label>
      <input type="text" name='title' class="form-control" id="exampleFormControlInput1" placeholder="Put your title">
    </div>
 

    <div class="form-group">
      <label for="exampleFormControlTextarea1">Example textarea</label>
      <textarea name='post' class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="Photo">Photo</label>
      <input type="file" name="photo" class="form-control" id="photo">
    </div>
    <select class="form-control mt-4"name="category_id" >
      <option value="">اختر التصنيف</option>      
      @foreach ($categories as $category)
      
    <option value="{{$category['id']}}">{{$category->name}}</option>
    @endforeach
    </select>

    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
    <button onclick="save_form($(this),event)" id="save" class="btn btn-primary mt-4">Send</button>
  </form>
</div>
@section('scripts')
<script>
function save_form(element,event) {

event.preventDefault();
var post=$(element).parents('form').attr('method');
var form=$(element).parents('form')[0];



var data = new FormData(form);


var url=$(element).parents('form').attr('action');

$.ajax({
type:post,
url:url,
data:data,
dataty:"json",
contentType:false,
processData:false,
success:function (data) {

console.log(data)
        // swal({
        //     title: "عمل رائع!",
        //     text: "تم الحفظ بنجاح!",
        //     icon: "success",
        //     button: "تم!",
        // })
// alert('تم الحفظ')
@if (Session::has('success'))
    <div class="alert container alert-success"  sturole="alert">
      {{Session::get('success')}}
    </div>
    @endif




} ,
error:function (error) {
    if(error.status===422){

        const errors=error.responseJSON.errors
        const first_item=Object.keys(errors)[0]
        const first_dom=document.getElementById(first_item)
        const first_message=errors[first_item][0]
        // swal({
        //     title: 'خطأ' ,
        //     text:first_message,
        //     icon: "warning",

        //     button: true,
        // })
        first_dom.scrollIntoView({behavior:"smooth"})
        const error_message=document.querySelectorAll('.text-danger')
        error_message.forEach((element)=>element.textContent='')
        first_dom.insertAdjacentHTML('afterend','<div class="text-danger">'+first_message+'</div>')
        const dom_error=document.querySelectorAll('.form-control')
        dom_error.forEach((element)=>element.classList.remove('border','border-danger'))
        first_dom.classList.add('border','border-danger')
        // swal({
        //     title: 'خطأ' ,
        //     text:first_message,
        //     icon: "warning",

        //     dangerMode: true,
        // })

    }else{
        console.log("error");
    }



}
});


}
</script>
    @endsection

    @endsection