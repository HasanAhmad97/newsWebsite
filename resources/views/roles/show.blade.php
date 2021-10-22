@extends('homeTest')
@section('css')
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />



@section('title')
عرض الصلاحيات - مورا سوفت للادارة القانونية
@stop


@endsection
@section('showRole')
<!-- breadcrumb -->
{{--<div class="breadcrumb-header justify-content-between">--}}
{{--    <div class="my-auto">--}}
{{--        <div class="d-flex">--}}
{{--            <h4 class="content-title mb-0 my-auto">الصلاحيات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض--}}
{{--                الصلاحيات</span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- breadcrumb -->


<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <div class="pull-right">
                        <a class=" btn btn-primary btn-sm" href="{{ route('admin.roles.index') }}">Back</a>
                    </div>
                </div>
                <table class="table container mt-5">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Role name</th>
                        <th scope="col">Role permissions</th>

                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th scope="row"><a href="#">{{ $role->name }}</a>
                            </th>
                            <th scope="row">
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                        <li>{{ $v->name }}</li>
                                    @endforeach
                                @endif
                            </th>

                        </tr>

                    </tbody>
                </table>
{{--                <div class="row">--}}
{{--                    <!-- col -->--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <ul id="treeview1">--}}
{{--                            <li><a href="#">{{ $role->name }}</a>--}}
{{--                                <ul>--}}
{{--                                    @if(!empty($rolePermissions))--}}
{{--                                    @foreach($rolePermissions as $v)--}}
{{--                                    <li>{{ $v->name }}</li>--}}
{{--                                    @endforeach--}}
{{--                                    @endif--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <!-- /col -->--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>

@endsection
