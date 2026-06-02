<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AtelierController as AdminAtelierController;
use App\Http\Controllers\Admin\CreneauController as AdminCreneauController;
use App\Http\Controllers\Admin\ReservationAdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CodePromoController as AdminCodePromoController;
use App\Http\Controllers\Admin\IngredientController as AdminIngredientController;
use App\Http\Controllers\Admin\AvisAdminController;
use App\Http\Controllers\Admin\NewsletterAdminController;
use App\Http\Controllers\Admin\MessageContactController;
use App\Http\Controllers\Chef\ChefController;
use App\Http\Controllers\Logistique\StockController;
use Illuminate\Support\Facades\Route;

// ===== ROUTES PUBLIQUES =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'envoyerContact'])->name('contact.envoyer');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/mentions-legales', [PageController::class, 'mentionsLegales'])->name('mentions-legales');
Route::get('/ateliers', [CatalogueController::class, 'index'])->name('ateliers.index');
Route::get('/ateliers/{slug}', [CatalogueController::class, 'show'])->name('ateliers.show');
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// ===== ROUTES CLIENT (authentifié) =====
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/reserver/{creneau}', [ReservationController::class, 'create'])->name('reservation.create');
    Route::post('/reserver', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/paiement/succes', [PaiementController::class, 'succes'])->name('paiement.succes');
    Route::get('/paiement/echec', [PaiementController::class, 'echec'])->name('paiement.echec');
    Route::get('/paiement/{reservation}', [PaiementController::class, 'initier'])->name('paiement.initier');
    Route::get('/mon-compte', [CompteController::class, 'index'])->name('compte.index');
    Route::put('/mon-compte', [CompteController::class, 'update'])->name('compte.update');
    Route::get('/mes-reservations', [CompteController::class, 'reservations'])->name('compte.reservations');
    Route::get('/mes-factures', [CompteController::class, 'factures'])->name('compte.factures');
    Route::delete('/mon-compte/photo', [CompteController::class, 'supprimerPhoto'])->name('compte.supprimer-photo');
    Route::delete('/mes-reservations/{id}', [CompteController::class, 'supprimerReservation'])->name('compte.supprimer-reservation');
    Route::get('/facture/{facture}/pdf', [FactureController::class, 'telecharger'])->name('facture.pdf');
    Route::post('/avis', [AvisController::class, 'store'])->name('avis.store');
});

// ===== ROUTES ADMIN =====
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('ateliers', AdminAtelierController::class);
    Route::resource('creneaux', AdminCreneauController::class);
    Route::get('/reservations', [ReservationAdminController::class, 'index'])->name('reservations.index');
    Route::put('/reservations/{reservation}', [ReservationAdminController::class, 'update'])->name('reservations.update');
    Route::resource('utilisateurs', AdminUserController::class);
    Route::resource('codes-promo', AdminCodePromoController::class);
    Route::resource('ingredients', AdminIngredientController::class);
    Route::get('/avis', [AvisAdminController::class, 'index'])->name('avis.index');
    Route::put('/avis/{avi}/toggle', [AvisAdminController::class, 'toggleVisibilite'])->name('avis.toggle');
    Route::get('/newsletter', [NewsletterAdminController::class, 'index'])->name('newsletter.index');
    Route::post('/newsletter/envoyer', [NewsletterAdminController::class, 'envoyer'])->name('newsletter.envoyer');
    Route::get('/messages', [MessageContactController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageContactController::class, 'show'])->name('messages.show');
    Route::put('/messages/{message}/toggle', [MessageContactController::class, 'toggleLu'])->name('messages.toggle');
    Route::delete('/messages/{message}', [MessageContactController::class, 'destroy'])->name('messages.destroy');
});

// ===== ROUTES CHEF =====
Route::prefix('chef')->middleware(['auth', 'role:chef'])->name('chef.')->group(function () {
    Route::get('/planning', [ChefController::class, 'planning'])->name('planning');
    Route::get('/sessions', [ChefController::class, 'sessions'])->name('sessions');
});

// ===== ROUTES LOGISTIQUE =====
Route::prefix('logistique')->middleware(['auth', 'role:logistique'])->name('logistique.')->group(function () {
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::put('/stocks/{ingredient}', [StockController::class, 'update'])->name('stocks.update');
});

// ===== WEBHOOK KkiaPay (pas d'auth, appel externe) =====
Route::post('/webhook/kkiapay', [PaiementController::class, 'webhook'])->name('webhook.kkiapay');

// ===== PROFIL (créé par Breeze) =====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== DASHBOARD GLOBAL (Breeze) =====
Route::middleware(['auth'])->get('/dashboard', function () {

    $user = auth()->user();

    return match($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'chef' => redirect()->route('chef.planning'),
        'logistique' => redirect()->route('logistique.stocks.index'),
        default => redirect()->route('compte.index'),
    };

})->name('dashboard');
// Route pour importer les ateliers depuis le seeder (à supprimer après utilisation)
// ===== ROUTES DE TEST TEMPORAIRES (À SUPPRIMER APRÈS) =====

// Test ateliers
Route::get('/debug-ateliers', function() {
    if (!Illuminate\Support\Facades\Schema::hasTable('ateliers')) {
        return "❌ La table 'ateliers' n'existe pas !";
    }
    
    $count = App\Models\Atelier::count();
    $ateliers = App\Models\Atelier::limit(10)->get(['id', 'titre', 'slug', 'statut']);
    
    return response()->json([
        'table_exists' => true,
        'ateliers_count' => $count,
        'ateliers' => $ateliers
    ]);
});

// Import des ateliers
Route::get('/import-ateliers', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed --class=AtelierSeeder --force');
        $ateliersCount = App\Models\Atelier::count();
        $creneauxCount = App\Models\Creneau::count();
        
        return response()->json([
            'success' => true,
            'ateliers_count' => $ateliersCount,
            'creneaux_count' => $creneauxCount
        ]);
    } catch (\Exception $e) {
        return "❌ Erreur : " . $e->getMessage();
    }
});

// Test paiement
Route::get('/test-paiement', function() {
    return response()->json([
        'mode' => config('services.kkiapay.mode', 'non configuré'),
        'has_public_key' => !empty(config('services.kkiapay.public_key')),
        'has_secret_key' => !empty(config('services.kkiapay.secret_key')),
        'has_api_key' => !empty(config('services.kkiapay.api_key')),
        'message' => 'Clés configurées : ' . (empty(config('services.kkiapay.public_key')) ? '❌ Non' : '✅ Oui')
    ]);
});

// Vérification des images
Route::get('/check-images', function() {
    $imagesPath = storage_path('app/public/photos/ateliers');
    $imagesExist = is_dir($imagesPath);
    $imagesCount = $imagesExist ? count(glob($imagesPath . '/*')) : 0;
    
    $linkExists = file_exists(public_path('storage'));
    
    return response()->json([
        'storage_exists' => $imagesExist,
        'images_count' => $imagesCount,
        'link_exists' => $linkExists
    ]);
});
require __DIR__.'/auth.php';