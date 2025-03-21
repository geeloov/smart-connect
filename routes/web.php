Route::get('/applications/{jobPosition}/create', [JobApplicationController::class, 'create'])
    ->name('applications.create'); 