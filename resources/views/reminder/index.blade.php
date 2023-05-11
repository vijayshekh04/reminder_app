@extends('layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reminders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reminders</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Reminders</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover" width="100%">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Desc</th>
                                    <th>DateTime</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($reminders as $row)
                                        <tr id="tr_{{$row->id}}">
                                            <td>{{$row->title}}</td>
                                            <td>{{$row->description}}</td>
                                            <td>{{date('Y-m-d H:i',strtotime($row->date_time))}}</td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="{{route('reminder.edit',$row->id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit font-medium-5"></i></a>
                                                    <a href="javascript:void(0)" data-id="{{$row->id}}" class="delete_btn" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt font-medium-5 text-danger"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $(document).on("click",'.buttons-excel',function () {
                window.location.replace('{{ url("stone/export") }}');

            });

            /**
             * Delete Record Call
             */
            $(document).on("click",".delete_btn",function () {
                var id = $(this).data("id");
                Swal.fire( {
                        title: "Are you sure?",
                        text: "You want to delete this record?",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                        confirmButtonClass: "btn btn-primary",
                        cancelButtonClass: "btn btn-danger ml-1",
                        buttonsStyling: !1
                    }
                ).then(function(t) {
                        if(t.value){
                            $.ajax({
                                type: "post",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "{{ url('reminder/destroy')}}",
                                data: {
                                    "id": id
                                },
                                dataType:"json",
                                success: function (response) {

                                    if(response.status == "success") {
                                        jQuery('#tr_'+id).fadeOut('slow');
                                        show_message('success', 'Record deleted successfully.');
                                    }else{
                                        show_message("fail",response.message);
                                    }
                                },
                                error:function (e) {
                                    console.log(e);
                                    show_message('fail','Something goes to wrong. please try again');
                                }
                            })
                        }

                    }
                )
            });
        });
    </script>
@endsection