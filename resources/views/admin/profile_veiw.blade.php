@extends('admin.master')
@section('all')


<div class="page-content">
    <div class="container-fluid">
    
    
    <div class="row">
        <div class="col-lg-6">
            <div class="card"><br><br>
    <center>
        <img class="rounded-circle avatar-xl" src="{{ asset('storage/upload/admin_images/' . Auth::guard('admin')->user()->profile_image) }}" alt="Card image cap"> 
    </center>
    
                <div class="card-body">
                    <h4 class="card-title">Name : {{ $adminData->name }} </h4>
                    <hr>
                    <h4 class="card-title"> Email : {{ $adminData->email}} </h4>
                    <hr>
                   <h4 class="card-title">Username : {{ $adminData->username }} </h4>
                    <hr>
                    <a href="{{ route('admin.profile_edit') }}" class="btn btn-info btn-rounded waves-effect waves-light" > Edit Profile</a>
                </div>
            </div>
        </div> 
    
    
                            </div> 
    
    
    </div>
    </div>
@endsection 