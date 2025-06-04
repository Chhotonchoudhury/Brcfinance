<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Company;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       // Retrieve the first record's logo and favicon from the 'Company' model
        $company = Company::first();

        // Check if the company record exists before accessing logo and favicon
         // If company logo exists, use it; otherwise, use default
         $companyLogo = $company && $company->company_logo
         ? 'storage/' . $company->company_logo
         : 'assetsDashboard/img/logo.png';

        // If company favicon exists, use it; otherwise, use default
        $favicon = $company && $company->favicon
            ? 'storage/' . $company->favicon
            : 'assetsDashboard/img/favicon.ico';

        // Share the logo and favicon URL with all views
        View::share('companyLogo', $companyLogo);
        View::share('favicon', $favicon);
    }
}
