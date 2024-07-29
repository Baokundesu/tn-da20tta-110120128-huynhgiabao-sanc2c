<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ManageStoreController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Route cho trang chính của cửa hàng
Route::get('/', [StoreController::class, 'index'])->name('home');

// Route cho lọc sản phẩm theo loại từ trang chủ
Route::get('/type/{type}', [StoreController::class, 'index'])->name('store.filter.by.type');

// Route cho trang đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route cho trang đăng kí
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//Route cho trang điều khoản sử dụng
Route::get('/terms', function () {
    return view('auths.terms');
})->name('terms');

// Route cho đăng xuất
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route cho trang thông tin người dùng
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); 
});

//Route cho trang đăng kí gian hàng
Route::middleware('auth')->group(function () {
    // Route để hiển thị form đăng ký gian hàng
    Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
    
    // Route để xử lý việc lưu trữ gian hàng
    Route::post('/store', [StoreController::class, 'store'])->name('store.store');
    Route::get('/store/{id}', [StoreController::class, 'show'])->name('store.show');
    
    // Route cho trang thông tin người dùng
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::post('/order/{order}/cancel', [OrderController::class, 'userCancel'])->name('order.user-cancel');
    });
});

//Route cho trang quản lý gian hàng
Route::middleware(['auth'])->prefix('manage')->group(function () {
    Route::get('/stores', [ManageStoreController::class, 'index'])->name('manage.stores.index');
    Route::get('/stores/create', [ManageStoreController::class, 'create'])->name('manage.stores.create'); 
    Route::post('/stores', [ManageStoreController::class, 'store'])->name('manage.stores.store'); 
    Route::get('/stores/{id}/edit', [ManageStoreController::class, 'edit'])->name('manage.stores.edit');
    Route::put('/stores/{id}', [ManageStoreController::class, 'update'])->name('manage.stores.update');
    Route::delete('/stores/{id}', [ManageStoreController::class, 'destroy'])->name('manage.stores.destroy');
});

// Route cho trang Admin
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout'); // Thay đổi phương thức thành POST

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Quản lý người dùng
    Route::get('users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::delete('users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
    
    // Quản lý gian hàng
    Route::get('stores', [AdminController::class, 'listStores'])->name('admin.stores');
    Route::delete('stores/{id}', [AdminController::class, 'deleteStore'])->name('admin.stores.delete');
    
    // Duyệt gian hàng
    Route::get('stores/pending', [AdminController::class, 'pendingStores'])->name('admin.stores.pending');
    Route::post('stores/{id}/approve', [AdminController::class, 'approveStore'])->name('admin.stores.approve');
});

// Route cho trang giỏ hàng
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{store}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/delete/{store}', [CartController::class, 'delete'])->name('cart.delete');
    Route::put('/update/{store}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/checkout', [CartController::class, 'showCheckout'])->name('cart.showCheckout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
    Route::get('/success', [CartController::class, 'showSuccess'])->name('cart.success');

    Route::get('/cart/success', [CartController::class, 'showCodSuccess'])->name('cart.success');
    Route::get('/cart/momo_success', [CartController::class, 'showMomoSuccess'])->name('cart.momo_success');
    Route::get('/cart/vnp_success', [CartController::class, 'showVnpSuccess'])->name('cart.vnp_success');
});

//Route cho trang quản lý đơn hàng
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');