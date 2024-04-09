@extends('user.master')
@section('all')

<div class="page-content">
    <div class="container-fluid">


    <div class="row">
        <div class="col-lg-6">
            <div class="card"><br><br>
    <center>
        <img class="rounded-circle avatar-xl" src="{{ (!empty($adminData->profile_image))? url('upload/user_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap">
    </center>

                <div class="card-body">
                    <h4 class="card-title">Firstame : {{ $adminData->firstname }} </h4>
                    <hr>
                    <h4 class="card-title">Lastame : {{ $adminData->lastname }} </h4>
                    <hr>

                    <h4 class="card-title">User Email : {{ $adminData->email}} </h4>
                    <hr>
                    <h4 class="card-title">User Name : {{ $adminData->username }} </h4>
                    <hr>
                    <h4 class="card-title">Mobile Number : {{ $adminData->phone }} </h4>
                    <hr>
                    <h4 class="card-title">State : {{ $adminData->state }} </h4>
                    <hr>
                    <h4 class="card-title">Country of Residence : {{ $adminData->country }} </h4>
                    <hr>

                    <a href="{{ route('user.profile.edit') }}" class="btn btn-info btn-rounded waves-effect waves-light" > Edit Profile</a>
                </div>
            </div>
        </div>


                            </div>


    </div>
    </div>

@endsection
