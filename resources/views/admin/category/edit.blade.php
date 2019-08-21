@extends('layouts.admin_mastar')
@section('title','Create Tag')

@section('content')


<section class="content">
        <div class="container-fluid">

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Category
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.category.update',$category->id) }}" method="POST"  enctype="multipart/form-data">
                            	@csrf
                                @method('UPDATE')
                                <label for="email_address">Category Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" id="email_address" class="form-control" value="{{ $category->name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="image">
                                    </div>
                                </div>
                                <a href="{{ route('admin.category.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->

        </div>
    </section>


@endsection