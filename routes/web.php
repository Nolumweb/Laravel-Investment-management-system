<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AdminAuthenticateMiddleware;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthPageController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\KycController;




Route::get('/', function () {
    return view('welcome');
});







Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AdminAuthPageController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminAuthPageController::class, 'login']);
    Route::post('admin/logout', [AdminAuthPageController::class, 'logout'])->name('admin.logout');

});


Route::middleware([AdminAuthenticateMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/profile_veiw', [AdminController::class, 'Veiw'])->name('admin.profile_veiw');
    Route::post('/store/admin', [AdminController::class, 'StoreProfile'])->name('store.admin');
    Route::get('/admin/profile_edit', [AdminController::class, 'Edit'])->name('admin.profile_edit');
    Route::get('/admin/c_password', [AdminController::class, 'Cpass'])->name('admin.c_password');
    Route::post('/update/admin', [AdminController::class, 'UpdatePassword'])->name('update.admin');

    // ALL Users
Route::get('/admin/users/all_users', [ClientController::class, 'AllU'])->name('admin.users.all_users');
Route::get('/admin/users/add_users', [ClientController::class, 'AddUsers'])->name('admin.users.add_users');
Route::get('/admin/users/delete_users/{id}', [ClientController::class, 'UserDelete'])->name('admin.users.delete_users');
Route::get('/admin/users/edit_users/{id}', [ClientController::class, 'EditUsers'])->name('admin.users.edit_users');
Route::put('/user/update/{id}', [ClientController::class, 'UserUpdate'])->name('user.update');
Route::put('/users/updatePassword', [ClientController::class,'updatePassword'])->name('users.updatePassword');
Route::post('/user/store', [ClientController::class, 'UserStore'])->name('user.store');


Route::get('/admin/kyc/index', [KycController::class, 'index'])->name('admin.kyc.index');
Route::get('/admin/kyc/pend', [KycController::class, 'pend'])->name('admin.kyc.pend');
Route::post('/admin/kyc/{id}/approve', [KycController::class, 'approve'])->name('admin.kyc.approve');
Route::post('/admin/kyc/{id}/reject', [KycController::class, 'reject'])->name('admin.kyc.reject');
    


Route::post('/update/balance', [ClientController::class, 'updateBalance'])->name('update.balance');
Route::get('/users/{user}/transaction', [ClientController::class, 'transactionLog'])->name('admin.users.transaction');
Route::get('/users/{user}/credit', [ClientController::class, 'creditLog'])->name('admin.users.credit');
Route::get('/users/{user}/deduct', [ClientController::class, 'deductLog'])->name('admin.users.deduct');



    Route::get('/admin/investments/all', [PlanController::class, 'getAllInvestments'])->name('admin.investments.all');
    Route::get('/admin/investments/active', [PlanController::class, 'getActive'])->name('admin.investments.active');
    Route::get('/admin/investments/mature', [PlanController::class, 'getMatured'])->name('admin.investments.mature');
    Route::get('/admin/investments/complete', [PlanController::class, 'getCompleted'])->name('admin.investments.complete');

    Route::get('/admin/transactions/all', [TransactionController::class, 'transactionAll'])->name('admin.transactions.all');
    Route::get('/admin/deposit/all', [TransactionController::class, 'index'])->name('admin.deposit.all');
    Route::get('/admin/deposit/pend', [TransactionController::class, 'pend'])->name('admin.deposit.pend');
    Route::post('/admin/deposit/{id}/approve', [TransactionController::class, 'approve'])->name('admin.deposit.approve');
    Route::post('/admin/deposit/{id}/reject', [TransactionController::class, 'reject'])->name('admin.deposit.reject');
    

    Route::get('/admin/withdrawal/all', [TransactionController::class, 'all'])->name('admin.withdrawal.all');
    Route::get('/admin/withdrawal/pend', [TransactionController::class, 'withdrawalpend'])->name('admin.withdrawal.pend');
    Route::post('/admin/withdrawal/{id}/approve', [TransactionController::class, 'withdrawalapprove'])->name('admin.withdrawal.approve');
    Route::post('/admin/withdrawal/{id}/reject', [TransactionController::class, 'withdrawalreject'])->name('admin.withdrawal.reject');


    Route::get('/admin/plan/all', [PlanController::class, 'all'])->name('admin.plan.all');
    Route::get('/admin/plan/create', [PlanController::class, 'create'])->name('admin.plan.create');
    Route::post('/plan', [PlanController::class, 'store'])->name('plan.store');
    Route::get('/admin/plan/pend', [PlanController::class, 'PlanPend'])->name('admin.plan.pend');



    Route::get('/admin/wallets/index', [WalletController::class, 'index'])->name('wallets.index');
    Route::get('/admin/wallets/create', [WalletController::class, 'create'])->name('wallets.create');
    Route::post('/wallets', [WalletController::class, 'store'])->name('wallets.store');
    Route::get('/admin/wallets/{wallet}/edit', [WalletController::class, 'edit'])->name('wallets.edit');
    Route::put('/wallets/{wallet}', [WalletController::class, 'update'])->name('wallets.update');
    Route::delete('/admin/wallets/{id}', [WalletController::class, 'destroy'])->name('wallets.destroy');

// ALL Users
//  
 // Blog Category All Routes 
// Route::controller(BlogCategoryController::class)->group(function () {
//     Route::get('/all/blog/category', 'AllBlogCategory')->name('all.blog.category');
//     Route::get('/add/blog/category', 'AddBlogCategory')->name('add.blog.category');
//     Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
//     Route::get('/edit/blog/category/{id}', 'EditBlogCategory')->name('edit.blog.category');
//      Route::post('/update/blog/category/{id}', 'UpdateBlogCategory')->name('update.blog.category');
//      Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');     
     
// });



 // Blog All Route 
// Route::controller(BlogController::class)->group(function () {
//     Route::get('/all/blog', 'AllBlog')->name('all.blog');
//     Route::get('/add/blog', 'AddBlog')->name('add.blog');
//     Route::post('/store/blog', 'StoreBlog')->name('store.blog');
//     Route::get('/edit/blog/{id}', 'EditBlog')->name('edit.blog');
//     Route::post('/update/blog', 'UpdateBlog')->name('update.blog');
//     Route::get('/delete/blog/{id}', 'DeleteBlog')->name('delete.blog');
//     Route::get('/blog/details/{id}', 'BlogDetails')->name('blog.details');
//     Route::get('/category/blog/{id}', 'CategoryBlog')->name('category.blog');
//     Route::get('/blog', 'HomeBlog')->name('home.blog');
     
});




    // Route::middleware([
    //     CheckUserStatus::class,
    //     'auth:sanctum',
    //     config('jetstream.auth_session'),
    //     'verified',
    // ])->group(function () {
   
    
// for ban users
 Route::get('base', [BaseController::class, 'base'])->name('base');





Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',
])->group(function () {
    
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    

    
    // Route::get('/dashboard', function () {return view('dashboard'); })->name('dashboard');
    Route::get('user/plan/all', [UserController::class, 'AllPlan'])->name('user.plan.all');
    Route::get('user/plan/add', [UserController::class, 'ViewPlan'])->name('user.plan.add');
    Route::post('user/plan', [UserController::class, 'Plan'])->name('user.plan');
    Route::get('user/plan/myplan', [UserController::class, 'MyPlan'])->name('user.plan.myplan');

    Route::get('user/deposit/all', [UserController::class, 'AllDeposit'])->name('user.deposit.all');
    Route::get('user/deposit/add', [UserController::class, 'ViewDeposit'])->name('user.deposit.add');
    Route::get('user/deposit/confirm', [UserController::class, 'ConfirmDeposit'])->name('user.deposit.confirm');
    Route::post('user/deposit', [UserController::class, 'Deposit'])->name('user.deposit');

    Route::get('user/withdraw/all', [UserController::class, 'AllWithdraw'])->name('user.withdraw.all');
    Route::get('user/withdraw/add', [UserController::class, 'Viewwithdraw'])->name('user.withdraw.add');
    Route::post('user/withdraw', [UserController::class, 'withdraw'])->name('user.withdraw');
   

    Route::get('/user/transactions/all', [UserController::class, 'transactionAll'])->name('user.transactions.all');
    Route::get('/user/transactions/send', [UserController::class, 'send'])->name('user.transactions.send');
    Route::post('user/send', [UserController::class, 'sendmoney'])->name('user.send');
   
    Route::get('user/deposit/ref', [UserController::class, 'Allref'])->name('user.deposit.ref');

    Route::get('/user/kyc/upload', [UserController::class, 'kyc'])->name('user.kyc.upload');
    Route::post('/kyc/upload', [UserController::class, 'upload'])->name('kyc.upload');


});


























