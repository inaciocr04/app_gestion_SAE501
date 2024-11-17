<?php

namespace App\Providers;

use App\Models\Depot;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Observers\StudentObserver;
use App\Observers\TeacherObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        User::observe(UserObserver::class);
        Student::observe(StudentObserver::class);
        Teacher::observe(TeacherObserver::class);

        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                $student = $user->student;
                if ($student) {
                    $latestStatu = $student->student_statu()
                        ->orderBy('created_at', 'desc')
                        ->first();

                    if ($latestStatu) {
                        $actualYear = $latestStatu->actual_year_id;
                        $yearTraining = $latestStatu->year_training_id;

                        $depotLinks = Depot::where('actif', true)
                            ->where('actual_year_id', $actualYear)
                            ->where('year_training_id', $yearTraining)
                            ->get();

                        $view->with('depotLinks', $depotLinks);
                    } else {
                        $view->with('depotLinks', collect());
                    }
                } else {
                    $view->with('depotLinks', collect());
                }
            } else {
                $view->with('depotLinks', collect());
            }
        });
    }

}
