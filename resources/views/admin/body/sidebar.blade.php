<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Users Management</li>

                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Users Welfare</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.users.all_users') }}">Manage Users</a></li>
                        <li><a href="{{ route('admin.kyc.index') }}">KYC Log</a></li>
                        <li><a href="{{ route('admin.kyc.pend') }}"> Pend KYC</a></li>

                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.transactions.all') }}" class="waves-effect">
                        <i class="ri-oil-fill"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-compass-2-fill"></i>
                        <span>Investment Log</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.investments.all') }}">All Investment</a></li>
                        <li><a href="{{ route('admin.investments.active') }}">Active Investment</a></li>
                        <li><a href="{{ route('admin.investments.mature') }}">Matured Investment</a></li>
                        <li><a href="{{ route('admin.investments.complete') }}">Completed Investment</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-apps-2-fill"></i>
                        <span>Deposit</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.deposit.all') }}">All Deposit</a></li>
                        <li><a href="{{ route('admin.deposit.pend') }}">Deposit Request</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-apps-2-fill"></i>
                        <span>Withdrawal</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.withdrawal.all') }}">All Withdrawal</a></li>
                        <li><a href="{{ route('admin.withdrawal.pend') }}">Withdrawal Request</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-reddit-fill"></i>
                        <span>Wallets</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('wallets.create') }}">Add Wallet</a></li>
                        <li><a href="{{ route('wallets.index') }}">All Wallet</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Plan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.plan.all') }}">All Plan</a></li>
                        <li><a href="{{ route('admin.plan.create') }}">Create Plan</a></li>
                    </ul>
                </li>
<!-- 
                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Ticket Control</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Pend Ticket</a></li>
                        <li><a href="#">Approved Ticket</a></li>
                        <li><a href="#">All History</a></li>
                    </ul>
                </li> -->
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
