@extends('layouts.admin_mastar')
@section('title','tag')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Post <span class="badge bg-blue">{{ $posts->count() }}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>Is Approve</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($posts as $key=>$post)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ str_limit($post->title,'10') }}</td>
                                                <td>{{ $post->user->name }}</td>
                                                <td>{{ $post->view_count }}</td>
                                                <td>
                                                    @if($post->is_approved == true)
                                                        <span class="badge bg-blue">Approved</span>
                                                    @else
                                                        <span class="badge bg-pink">Panding</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($post->status == true)
                                                        <span class="badge bg-blue">Approved</span>
                                                    @else
                                                        <span class="badge bg-pink">Panding</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-success waves-effect" href="{{ route('admin.post.show',$post->id) }}"><i class="material-icons">visibility</i></a>


                                                    <a class="btn btn-info waves-effect" href="{{ route('admin.post.edit',$post->id) }}"><i class="material-icons">border_color</i></a>


                                                    <button onclick="deletepost({{ $post->id }})" class="btn btn-danger waves-effect" type="button"><i class="material-icons">delete</i></button>
                                                    <form id="delete-form-{{ $post->id }}" action="{{ route('admin.post.destroy',$post->id) }}" method="post" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <script type="text/javascript">
        function deletepost(id) {
            const swalWithBootstrapButtons = Swal.mixin({
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
              } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire(
                  'Cancelled',
                  'Your Data  is safe :)',
                  'error'
                )
              }
            })
        }
    </script>

@endsection