@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Paaword</b></h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="#">Home</a></li>
                <li><i class="icon_document_alt"></i>Setting</li>
                <li><i class="fa fa-file-text-o"></i>Change Password</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
        <section class="panel panel-default">
                <header class="panel-heading">
                    <b>Change Password</b>
                </header>

                <div class="alert alert-success" style="display:none"></div>

                <form action="" class="form-horizontal" id="frm-get-result" method="post">
                    @if(Session::has('flash_message_success'))                    
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{!! session('flash_message_success') !!}</strong>
                        </div>
                    @endif
                    @if(Session::has('flash_message_error'))                    
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{!! session('flash_message_error') !!}</strong>
                        </div>
                    @endif
                    <div class="panel-body" style="border-bottom: 1px solid #ccc;">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label for="password">Current Password</label>
                                <div class="input-group">
                                    <input type="password" name="oldPwd" id="oldPwd" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="password">New Password</label>
                                <div class="input-group">
                                    <input type="password" name="newPwd" id="newPwd" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="password">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Password">
                                </div>
                            </div>
                        </div>
                    </div>				
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-sm" id="add-student-result">Change</button>				
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>			
            </section>						
        </div>
    </div>

@endsection