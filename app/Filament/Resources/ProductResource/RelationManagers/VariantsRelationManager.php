<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';
    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('sku')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('sale_price')
                            ->numeric(),
                        Forms\Components\TextInput::make('stock')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                        Forms\Components\KeyValue::make('attributes')
                            ->keyLabel('Attribute')
                            ->valueLabel('Value')
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('sku')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale_price')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->sortable()
                    ->color(fn ($record) =>
                    $record->stock > 10 ? 'success' :
                        ($record->stock > 0 ? 'warning' : 'danger')
                    ),
                Tables\Columns\TextColumn::make('attributes')
                    ->searchable()
                    ->wrap()
                    ->formatStateUsing(fn ($state) => collect($state)
                        ->map(fn ($value, $key) => "$value")
                        ->join(', ')
                    ),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('stock_status')
                    ->options([
                        'in_stock' => 'In Stock',
                        'low_stock' => 'Low Stock',
                        'out_of_stock' => 'Out of Stock',
                    ])
                    ->query(function (Builder $query, array $data) {
                        return match ($data['value']) {
                            'in_stock' => $query->where('stock', '>', 10),
                            'low_stock' => $query->whereBetween('stock', [1, 10]),
                            'out_of_stock' => $query->where('stock', '<=', 0),
                            default => $query
                        };
                    }),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active status')
                    ->default(true),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('updateStock')
                    ->form([
                        Forms\Components\TextInput::make('adjustment')
                            ->numeric()
                            ->required()
                            ->label('Stock Adjustment'),
                    ])
                    ->action(function ($record, array $data) {
                        $record->stock += $data['adjustment'];
                        $record->save();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('updateStockBulk')
                        ->label('Update Stock')
                        ->form([
                            Forms\Components\TextInput::make('adjustment')
                                ->numeric()
                                ->required()
                                ->label('Stock Adjustment'),
                        ])
                        ->action(function ($records, array $data) {
                            foreach ($records as $record) {
                                $record->stock += $data['adjustment'];
                                $record->save();
                            }
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
