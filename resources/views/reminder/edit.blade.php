@extends('layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Reminder</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Reminder</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Reminder</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('reminder.update',$row->id)}}" method="post" id="add_form">
                            @csrf
                            @method("PATCH")
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{$row->title}}">
                                        </div>
                                        @if($errors->has('title'))
                                            <small class="text-danger" >
                                                {{ $errors->first('title') }}
                                            </small>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{$row->description}}">
                                        </div>
                                        @if($errors->has('description'))
                                            <small class="text-danger" >
                                                {{ $errors->first('description') }}
                                            </small>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date_time">DateTime</label>
                                            <input type="datetime-local" class="form-control" id="date_time" name="date_time" placeholder="Date Time" value="{{$row->date_time}}">
                                        </div>
                                        @if($errors->has('date_time'))
                                            <small class="text-danger" >
                                                {{ $errors->first('date_time') }}
                                            </small>
                                        @endif
                                    </div>

                                    <!-- time Picker -->
                                    {{-- <div class="col-md-6">
                                         <!-- Date and time -->
                                         <div class="form-group">
                                             <label>Date and time:</label>
                                             <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                 <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                                                 <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                     <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>--}}

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="{{url('reminder')}}" class="btn btn-success" >Back</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script type="text/javascript">
        //Date and time picker
        $('#reservationdatetime').datetimepicker(
            {
                icons: { time: 'far fa-clock' },
                format: 'DD/MM/YYYY hh:mm',
            });
    </script>

    <script>
        $(document).ready(function () {

        })
    </script>
@endsection