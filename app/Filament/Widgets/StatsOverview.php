<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $numberPropertySold = Property::query()->available(false)->count();
        return [
            Card::make('Nombre de propriété vendu', $numberPropertySold)
                ->color('success'),
        ];
    }
}
