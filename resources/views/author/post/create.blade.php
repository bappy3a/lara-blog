@extends('layouts.admin_mastar')
@section('title','Create Tag')

@section('content')


<section class="content">
        <div class="container-fluid">


<form action="{{ route('author.post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf




             <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <label for="email_address">Poat Title</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" id="email_address" class="form-control" placeholder="Enter your title">
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
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tag">Select Tag</label>
                                <select name="tags[]" class="form-control show-tick" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <a href="{{ route('author.post.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
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
                            <textarea name="body" id="" cols="130" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>


</form>
        </div>
    </section>



@endsection