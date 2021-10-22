
@extends('homeTest')
@section('notification')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Create new Notification
            </h3>
            <div class="card-toolbar">

            </div>
        </div>
        <!--begin::Form-->

        <div class="card-body">

            {{--                                @if($errors->any())--}}
            {{--                                    <label class="alert alert-danger">--}}
            {{--                                        <ul class="list">--}}


            {{--                                        @foreach($errors->all() as $error)--}}

            {{--                                            <li> {{$error}}</li>--}}
            {{--                                       @endforeach--}}
            {{--                                        </ul>--}}
            {{--                                    </label>--}}
            {{--                                @endif--}}

            <form method="POST" action="{{ route('admin.notification.send') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('title') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="name" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Message') }}</label>

                    <div class="col-md-6">
                        <textarea id="description" type="text" class="form-control summernote  @error('Message') is-invalid @enderror" name="message" required autocomplete="name" autofocus rows="10">{{old('description')}}</textarea>

                        @error('Message')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('User') }}</label>

                    <div class="col-md-6">

                        <select name="user_id" class="form-control">
                            <option value="" selected>المستخدم  </option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}"  {{old('user_id') ==$user->id ?'selected':''}}>
                                    {{$user->name}}
                                </option>
                            @endforeach

                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>




                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">
                        Send notification
                    </button>
                    {{--                                <button type="reset" class="btn btn-secondary">Cancel</button>--}}
                </div>
            </form>
            <!--end::Form-->
        </div>
        @endsection
