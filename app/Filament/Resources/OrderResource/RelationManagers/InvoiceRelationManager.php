<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class InvoiceRelationManager extends RelationManager
{
    protected static string $relationship = 'invoice';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('total')
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('subtotal')
                    ->formatStateUsing(fn ($state) => Str::price($state)),
                Tables\Columns\TextColumn::make('tax')
                    ->formatStateUsing(fn ($state) => Str::price($state)),
                Tables\Columns\TextColumn::make('total')
                    ->formatStateUsing(fn ($state) => Str::price($state)),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(fn ($state) => strtoupper($state)),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->paginated(false);
    }
}
