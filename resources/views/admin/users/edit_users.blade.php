
 @extends('admin.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">





<div class="m-0 m-md-4 my-4 m-md-0">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="image-input">
                           

             @if ($user->profile_photo_path)
                  <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }} profile photo" class="img-thumbnail mt-2">
                @endif
               


                            </div>
                        </div>
                        <h3> @lang(ucfirst($user->name))</h3>
                        <p>@lang('Joined At') @lang($user->created_at->format('d M,Y h:i A')) </p>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-body">
                        <h4 class="card-title">{{__('User information')}}</h4>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">{{__('Email')}}
                                <span>{{ $user->email }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">{{__('Username')}}
                                <span>{{ $user->username }}</span></li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">{{__('Balance')}}
                                <span>{{ $user->wallet_balance }} </span>
                            </li>
                         

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="row">
                                                <div class="badge-box badge-box-two " id="badge-box-two">
                                                    <img src="" alt=""  data-toggle="tooltip" data-placement="top" title=""/>
                                                    <div class="lock-icon">
                                                        <i class="fa fa-lock"></i>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </li>
                        </ul>
                    </div>
                </div>


                <div class="card card-primary">
                    <div class="card-body">
                        <h4 class="card-title">{{__('User Action')}}</h4>
                        <div class="btn-list ">



                                            <button class="btn btn-outline-primary btn-rounded btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addSubtractFundModal">
                        <span class="btn-label"><i class="fas fa-hand-holding-usd"></i></span>
                        {{__('Add / Subtract Fund')}}
                    </button>

                        

                            <a href="{{ route('admin.users.transaction', ['user' => $user->id]) }}"
                                   class="btn btn-outline-primary btn-rounded btn-sm">
                                    <span class="btn-label"><i
                                            class="fas fa-exchange-alt"></i></span> {{__('Transaction Log')}}
                                </a>

                                <a href="{{ route('admin.users.credit', ['user' => $user->id]) }}"
                               class="btn btn-outline-primary btn-rounded btn-sm">
                                <span class="btn-label"><i
                                        class="fas fa-money-bill-alt"></i></span> {{__('Manual Credit Log')}}
                            </a>


                            <!-- <a href=""
                               class="btn btn-outline-primary btn-rounded btn-sm">
                                <span class="btn-label"><i
                                        class="fas fa-money-bill-alt"></i></span> {{__('Manual Debit Log')}}
                            </a> -->

                                <a href="{{ route('admin.users.deduct', ['user' => $user->id]) }}"
                                   class="btn btn-outline-primary btn-rounded btn-sm">
                                    <span class="btn-label"><i class="fas fa-newspaper"></i></span> {{__('Manual Debit Lo')}}
                                </a>

                                <a href=""
                                   class="btn btn-outline-primary btn-rounded btn-sm">
                                <span class="btn-label"><i
                                        class="fas fa-tree"></i></span> {{__('Investment Log')}}
                                </a>
                                <a href=""
                                   class="btn btn-outline-primary btn-rounded btn-sm">
                                    <span class="btn-label"><i
                                            class="fas fa-envelope-open"></i></span> {{__('Send Email')}}
                                </a>


                                <a href=""
                                   class="btn btn-outline-primary btn-rounded btn-sm">
                                    <span class="btn-label"><i class="fas fa-users"></i></span> {{__('Referral')}}
                                </a>

                                <a href=""
                                   class="btn btn-outline-primary btn-rounded btn-sm">
                                    <span class="btn-label"><i
                                            class="fas fa-file-invoice"></i></span> {{__('Kyc Record')}}
                                </a>

                            <button class="btn btn-outline-primary btn-rounded btn-sm loginAccount" type="button" data-toggle="modal"
                                    data-target="#signIn"
                                    data-route="">
                                <span class="btn-label"><i class="fas fa-sign-in-alt"></i></span>
                                {{__('Login as User')}}
                            </button>
                                <a href=""
                                   class="btn btn-outline-primary btn-rounded btn-sm">
                                    <span class="btn-label"><i
                                            class="fas fa-hand-holding"></i></span>{{__('Login as User')}} {{__('Payout History')}}
                                </a>
                        </div>
                    </div>
                </div>
            </div>

        
            <div class="col-md-8">

            <div class="card card-primary">
    <div class="card-body">
        <h4 class="card-title text-center">@lang('Update Password For') {{ ucfirst($user->username) }} </h4>
        <form method="post" action="{{ route('users.updatePassword') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__('New Password')}}</label>
                        <input id="new_password" type="password" class="form-control" name="password"
                            autocomplete="new-password">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__('Confirm Password')}}</label>
                        <input id="confirm_password" type="password" name="password_confirmation"
                            autocomplete="new-password" class="form-control">
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="submit-btn-wrapper mt-md-3 text-center text-md-left">
                        <button type="submit"
                            class="btn waves-effect waves-light btn-rounded btn-primary btn-block">
                            <span>{{__('Update Password')}}</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



                <div class="card card-primary">
                    <div class="card-body">
                        <h4 class="card-title">{{ ucfirst($user->username) }} @lang('Information')</h4>
                        <form method="post" action="{{ route('user.update', $user->id) }}"
                              enctype="multipart/form-data">
                              
                              @csrf
                            @method('PUT')            
                            <div class="row">
                            
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>{{__('Fullname')}}</label>
                                        <input class="form-control" type="text" name="name"
                                               value="{{ $user->name }}"
                                               required>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>{{__('Username')}}</label>
                                        <input class="form-control" type="text" name="username"
                                               value="{{ $user->username }}" required>
                                        @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>{{__('Email')}}</label>
                                        <input class="form-control" type="email" name="email" value="{{ $user->email }}"
                                               required>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>{{__('Mobile Number')}}</label>
                                        <input class="form-control" type="text" name="phone" value="{{ $user->phone }}">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>{{__('Profile Photo')}}</label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control custom-file-input @error('profile_photo') is-invalid @enderror" id="profile_photo" name="profile_photo">
                                        <label class="custom-file-label" for="profile_photo"></label>
                                    </div>
                                    @error('profile_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



              

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label>{{__('Address')}}</label>
                                        <textarea class="form-control" name="address"
                                                  rows="2">{{ $user->address }}</textarea>
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="form-group">
                                <label style="font-weight: 9000; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);" class='text-primary'>Email Verification</label>
                                <input type="checkbox" name="email_verified" id="email_verified" {{ $user->email_verified ? 'checked' : '' }} value="1">
                                <span id="verification_status">{{ $user->email_verified ? 'User Email Is Verified' : 'User Email Is Not Verified' }}</span>
                            </div>

                            

                            <div class="form-group">
                                <label style="font-weight: 9000; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);" class='text-primary' >Two-Factor Authentication</label>
                                <input type="checkbox" name="two_factor_enabled" id="two_factor_enabled" {{ $user->two_factor_enabled ? 'checked' : '' }} value="1">
                                <span id="two_factor_display">{{ $user->two_factor_enabled ? 'User 2Factor Security Is Enabled' : 'User 2Factor Security Is Not Enabled' }}</span>
                            </div>

                            <div class="form-group">
                                <label style="font-weight: 9000; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);"  class='text-primary'>Status</label>
                                <input type="checkbox" name="ustatus" id="ustatus" {{ $user->ustatus ? 'checked' : '' }} value="1">
                                <span id="status_text">{{ $user->ustatus ? 'This User is Active' : 'User is Banned' }}</span>
                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-btn-wrapper mt-md-3  text-center text-md-left">
                                <button type="submit"
                                        class=" btn waves-effect waves-light btn-rounded btn-primary btn-block">
                                    <span>{{__('Update User')}}</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            
   
              




            </div>
        </div>
        </div>
    </div>



   
 <div class="modal fade" id="addSubtractFundModal" tabindex="-1" aria-labelledby="addSubtractFundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title">{{__('Add/ Subtract Balance')}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group ">
                        <label>{{__('Balance')}}</label>
                        <input class="form-control" type="text" value="{{ $user->wallet_balance }}"  readonly>
                    </div>
                    <form method="POST" action="{{ route('update.balance') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="p-1 form-group">
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
                            </div>

                            <div class="p-1 form-group">
                                <textarea type="text" class="form-control"  name="feedback" placeholder="Admin Feedback" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <div class="btn-group">
                                    <button type="submit" name="transaction_type" value="credit" class="btn btn-primary">{{__('Add Funds')}}</button>
                                    <button type="submit" name="transaction_type" value="deduct" class="btn btn-danger">{{__('Subtract Funds')}}</button>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                            </div>
                 </form>


        </div>
    </div>
</div>









    <!-- Admin Login as a User Modal -->
    <div class="modal fade" id="signIn">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="" class="loginAccountAction" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title">{{__('Sign In Confirmation')}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p>{{__('Are You Sure You Want To Sign')}}</p>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span>{{__('Close')}}</span>
                        </button>
                        <button type="submit" class=" btn btn-primary "><span>{{__('Yes')}}</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>










</div>
</div>


@endsection

@section('scripts')
<script>

    // JavaScript to toggle checkboxes
    document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('ustatus').addEventListener('change', function () {
    var statusText = document.getElementById('status_text');
    statusText.textContent = this.checked ? 'This User is Active' : 'User is Banned';
    this.value = this.checked ? '1' : '0';
});
        document.getElementById('email_verified').addEventListener('change', function () {
        var verificationStatus = document.getElementById('verification_status');
        verificationStatus.textContent = this.checked ? 'User Email Has been Verified' : 'User Email Has Not Been Verified';
        this.value = this.checked ? '1' : '0';
    });

    document.getElementById('two_factor_enabled').addEventListener('change', function () {
        var twoFactorDisplay = document.getElementById('two_factor_display');
        twoFactorDisplay.textContent = this.checked ? 'User 2Factor Security Is Enabled' : 'User 2Factor Security Has Been Disabled';
        this.value = this.checked ? '1' : '0';
    });
    });
</script>




@endsection



