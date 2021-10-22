@extends('website.homePage')
@section('sport')
@foreach ($posts as $post)
    

<div class="col-md-6">
    <article class="entry card">
        <div class="entry__img-holder card__img-holder">
            <a href="single-post.html">
                <div class="thumb-container thumb-70">
                    <td><img class="entry__img lazyload" src="{{asset('images/posts/'.$post->photo)}}" alt="No Image"></td>

                    {{-- <img src="{{asset('assets_website/img/content/thumb/post-8.jpg')}}" class="entry__img lazyload" alt="" /> --}}
                </div>
            </a>
            <a href="#" class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet">{{ $post->category->name }}</a>
        </div>

        <div class="entry__body card__body">
            <div class="entry__header">

                <h2 class="entry__title">
                    <a href="single-post.html">{{ $post->title }}</a>
                </h2>
                <ul class="entry__meta">
                    <li class="entry__meta-author">
                        <span>المؤلف:</span>
                        <a href="#">حسن</a>
                    </li>
                    <li class="entry__meta-date">
                        {{ $post->created_at->diffForHumans()}}
                    </li>
                </ul>
            </div>
            <div class="entry__excerpt">
                <p>{{ $post->post}}</p>
            </div>
        </div>
    </article>
</div>
@endforeach
@endsection