<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $data = [];

        foreach (Product::getProductIds() as $id => $name) {
            $data[] = Stat::make(ucfirst($name), OrderItem::countByProductId($id));
        }

        return $data;
    }
}
