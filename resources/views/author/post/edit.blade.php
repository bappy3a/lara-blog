@extends('layouts.admin_mastar')
@section('title','Create Tag')

@section('content')


<section class="content">
        <div class="container-fluid">


<form action="{{ route('admin.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')




             <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <label for="email_address">Poat Title</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" id="email_address" class="form-control" value="{{ $post->title }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="image">Featured Image</label>
                                    <input type="file" name="image">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="demo-checkbox">
                                <input type="checkbox" name="status" id="md_checkbox_1" value="1" class="chk-col-red" checked />
                                <label for="md_checkbox_1">Publish</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">

                            <div class="form-group" >
                                <label for="categories">Select Category</label>
                                <select name="categories[]" class="form-control show-tick" multiple>
                                    @foreach($categories as $category)
                                        <option 
                                            @foreach($post->categories as $postcategory)
                                                {{ $postcategory->id == $category->id ? 'selected' : '' }}
                                            @endforeach

                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Select Tag</label>
                                <select name="tags[]" class="form-control show-tick" multiple>
                                    @foreach($tags as $tag)
                                        <option 
                                            @foreach($post->tags as $posttag)
                                                {{ $posttag->id == $tag->id ? 'selected' : '' }}
                                            @endforeach

                                        value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <a href="{{ route('admin.post.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Body
                            </h2>
                        </div>
                        <div class="body">
                            <textarea name="body" id="" cols="130" rows="10">{{ $post->body }}</textarea>
                        </div>
                    </div>
                </div>
            </div>


</form>
        </div>
    </section>



@endsection