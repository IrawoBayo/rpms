@foreach($results as $result)
    <tr>
        <td>{{ $result->subjects->subject_name }}</td>
        <td>{{ $result->classes->class_name }} - {{ $result->classes->class_name_num }}</td>
        <td> {{ $result->students->student_name }}</td>
        <td> {{ $result->test_score }}</td>
        <td> {{ $result->exam_score }}</td>
        <td> {{ $result->total }}</td>
        <td> {{ $result->grade }}</td>
        <td> {{ $result->remarks }}</td>
        <td>Action</td>
    </tr>

@endforeach




@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col md 12 float-right">
                <div class="col-md-4 mt-3">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Tags</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('/add-tag') }}" class="form-horizontal" method="POST">
                            {{ csrf_field() }}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tag Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="ccol-md-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">All Tags</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                @if(Session::has('flash_message_success'))                    
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>	
                                        <strong>{!! session('flash_message_success') !!}</strong>
                                    </div>
                                @endif
                                @if(Session::has('flash_message_danger'))                    
                                    	<div class="alert alert-danger">
                                        	 <button type="button" class="close" data-dismiss="alert">×</button> 
                                             {!! session('flash_message_danger') !!}
                                       </div>
                                @endif
                            <tbody><tr>
                            <th>ID</th>
                            <th>Tag Name</th>
                            <th>Action</th>
                            </tr>
                            @foreach($tags as $tag)
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td>{{$tag->name}}</td>
                                <td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody></table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

@stop