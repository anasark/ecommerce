<?php

namespace App\Livewire\Table;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Invoice;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class InvoiceTable extends DataTableComponent
{
    protected $model = Invoice::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Code", "code")
                ->sortable(),
            Column::make("Subtotal", "subtotal")
                ->format(fn ($value) => Str::price($value)),
            Column::make("Tax", "tax")
                ->format(fn ($value) => Str::price($value)),
            Column::make("Total", "total")
                ->format(fn ($value) => Str::price($value)),
            Column::make("Status", "status")
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
                        ->location(fn($row) => route('invoice.view', $row->code))
                        ->attributes(function($row) {
                            return [
                                'class' => 'py-1 px-4 rounded-full bg-gradient-to-r from-sky-500 to-indigo-500 hover:bg-gradient-to-r from-sky-600 to-indigo-600 ',
                            ];
                        }),
                ]),
        ];
    }
}
