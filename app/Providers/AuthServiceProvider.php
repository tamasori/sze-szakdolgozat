<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\EwcCode;
use App\Models\Export;
use App\Models\FuelType;
use App\Models\InspectionRecord;
use App\Models\Inspector;
use App\Models\Part;
use App\Models\PredefinedAnswer;
use App\Models\Quality;
use App\Models\Sale;
use App\Models\WorkshopMachinery;
use App\Policies\CarMakePolicy;
use App\Policies\CarModelPolicy;
use App\Policies\CarPolicy;
use App\Policies\ColorPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\EnquiryPolicy;
use App\Policies\EwcCodePolicy;
use App\Policies\ExportPolicy;
use App\Policies\FuelTypePolicy;
use App\Policies\InspectionRecordPolicy;
use App\Policies\InspectorPolicy;
use App\Policies\PartPolicy;
use App\Policies\PredefinedAnswerPolicy;
use App\Policies\QualityPolicy;
use App\Policies\SalePolicy;
use App\Policies\WorkshopMachineryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        CarMake::class => CarMakePolicy::class,
        CarModel::class => CarModelPolicy::class,
        Car::class => CarPolicy::class,
        Color::class => ColorPolicy::class,
        Customer::class => CustomerPolicy::class,
        Enquiry::class => EnquiryPolicy::class,
        EwcCode::class => EwcCodePolicy::class,
        Export::class => ExportPolicy::class,
        FuelType::class => FuelTypePolicy::class,
        InspectionRecord::class => InspectionRecordPolicy::class,
        Inspector::class => InspectorPolicy::class,
        Part::class => PartPolicy::class,
        PredefinedAnswer::class => PredefinedAnswerPolicy::class,
        Quality::class => QualityPolicy::class,
        Sale::class => SalePolicy::class,
        WorkshopMachinery::class => WorkshopMachineryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole(config("app.super_admin_name")) ? true : null;
        });
    }
}
