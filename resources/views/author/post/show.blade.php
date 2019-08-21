@extends('layouts.admin_mastar')
@section('title','Create Tag')

@section('content')


<section class="content">
        <div class="container-fluid">

            <a class="btn btn-danger" href="{{ route('admin.post.index') }}"><i class="material-icons">arrow_back</i> <span>Back</span></a>
            @if($post->is_approved == false)
                <button type="button" class="btn btn-clear pull-right"><i class="material-icons">done</i><span>Approve</span></button>
            @else
                <button type="button" class="btn btn-success pull-right" disabled><i class="material-icons">done</i><span>Approved</span></button>
            @endif

            <br>
            <br>

             <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{ $post->title }}</h2>
                            <small>Posted By <strong>{{ $post->user->name }}</strong> On {{ $post->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="body">
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan bg-green"><h2>Category</h2></div>
                        <div class="body">
                            @foreach($post->categories as $category)
                                <span class="label bg-green">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="header"><h2>Tag</h2></div>
                        <div class="body">
                            @foreach($post->tags as $tag)
                                <span class="label bg-cyan">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-amber"><h2>Fether Images</h2></div>
                        <div class="body">
                            <img width="100%" src="{{ URL($post->image) }}" alt="No Image">
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </section>



@endsection