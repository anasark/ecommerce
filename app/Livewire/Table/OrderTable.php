<?php

namespace App\Livewire\Table;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Order::query()->where('user_id', Auth::id());
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Product")
                ->label(function ($row) {
                    $text = $row->orderItems->first()->product->name;
                    if ($row->orderItems->count() > 1) {
                        $text .= ', and others.';
                    }
                    return $text;
                }),
            Column::make("Status", "invoice.status")
                ->format(fn ($value) => ucwords($value))
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => 'View')
                        ->location(fn($row) => route('order.view', $row->id))
                        ->attributes(function($row) {
                            return [
                                'class' => 'py-1 px-4 rounded-full bg-gradient-to-r from-sky-500 to-indigo-500 hover:bg-gradient-to-r from-sky-600 to-indigo-600 ',
                            ];
                        }),
                ]),
        ];
    }
}
