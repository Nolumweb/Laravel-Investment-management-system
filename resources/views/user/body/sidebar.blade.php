
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->







        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-home-fill"></i>
                        <span>{{ __('Dashboard') }} </span>
                    </a>
                </li>




 




    <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ri-vip-crown-2-line"></i>
            <span>{{ __('Deposit') }}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('user.deposit.add') }}">{{ __('Add Deposit') }}</a></li>
                <li><a href="{{ route('user.deposit.all') }}">{{ __('Deposit Log') }}</a></li>
               
            </ul>


        </li>

        <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-apps-2-fill"></i>
                        <span>  {{ __('Withdrawal') }} </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('user.withdraw.add') }}">{{ __('Withdrawal Fund') }} </a></li>
                        <li><a href="{{ route('user.withdraw.all') }}">{{ __('Withdrawal Log') }}</a></li>
                    </ul>
                </li>




                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>  {{ __(' Plans') }} </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('user.plan.all') }}">{{ __('All Plans') }}</a></li>
                        <li><a href="{{ route('user.plan.myplan') }}">{{ __('My Plan') }}</a></li>
                    </ul>
                </li>


              

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-oil-fill"></i>
                        <span>  {{ __(' Transactions') }} </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('user.transactions.all') }}">{{ __('All Transactions') }}</a></li>
                        <li><a href="{{ route('user.deposit.ref') }}">{{ __('Commision Bonus') }}</a></li>
                    </ul>
                </li>

            
     <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ri-account-circle-line"></i>
            <span>{{ __('Settings') }}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('profile.show') }}">{{ __('My Profile') }}</a></li>
                <li><a href="{{ route('user.kyc.upload') }}">{{ __('Kyc') }}</a></li>
               
            </ul>

         </li>


                <li>
                    <a href="{{route('user.transactions.send')}}" class=" waves-effect">
                    <i class="ri-reddit-fill"></i>
                        <span>{{ __('Send Money')}}</span>
                    </a>
                </li>


               


              


              {{-- End here --}}
            </ul>
        </div>
    </div>
</div>

