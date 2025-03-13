<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverView extends StatsOverviewWidget
{

    protected function getStats(): array
    {

        return [
            Stat::make('Total Product', Product::count())
                ->description('Total number of Product')
                ->descriptionIcon('heroicon-m-device-phone-mobile')
                ->color('success'),
            Stat::make('Total Category', Category::count())
                ->description('Total number of Category')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('success'),
            Stat::make('Total User', User::count())
                ->description('Total number of User')
                ->descriptionIcon('heroicon-m-user')
                ->color('success'),
        ];
    }
}
