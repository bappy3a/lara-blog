@extends('layouts.admin_mastar')
@section('title','tag')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a class="btn btn-primary" href="{{ route('admin.category.create') }}">Add New Category</a>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Email
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subscribers as $key=>$subscriber)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td class="text-center">
                                                    <button onclick="deletesub({{ $subscriber->id }})" class="btn btn-danger waves-effect" type="button"><i class="material-icons">delete</i></button>
                                                    <form id="delete-form-{{ $subscriber->id }}" action="{{ route('admin.subscriber.delete',$subscriber->id) }}" method="post" style="display: none;">
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
        function deletesub(id) {
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