<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\GalleryRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\VariantsRelationManager;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Product')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required(),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('sale_price')
                                    ->numeric(),
                                Forms\Components\TextInput::make('stock')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\Toggle::make('is_active')
                                    ->default(true),
                                Forms\Components\Toggle::make('featured'),
                                Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull(),
                            ])->columns(2),


                        Forms\Components\Tabs\Tab::make('Gallery')
                            ->schema([
                                Forms\Components\Repeater::make('gallery')
                                    ->relationship('gallery')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->image()
                                            ->directory('products')
                                            ->required(),
                                        Forms\Components\Toggle::make('is_primary')
                                            ->label('Primary Image')
                                            ->default(false)
                                            ->afterStateUpdated(function (string $state, Forms\Set $set, ?string $operation) {
                                                if ($state) {
                                                    $set('gallery.*.is_primary', false);
                                                    $set('is_primary', true);
                                                }
                                            }),
                                        Forms\Components\TextInput::make('sort_order')
                                            ->integer()
                                            ->default(fn () => 0)
                                            ->required(),
                                    ])
                                    ->reorderableWithButtons()
                                    ->defaultItems(0)
                                    ->columns(3)
                                    ->columnSpanFull()
                                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                                        static $order = 0;
                                        $data['sort_order'] = $order++;
                                        return $data;
                                    }),
                            ]),

                        Forms\Components\Tabs\Tab::make('Specifications')
                            ->schema([
                                Forms\Components\KeyValue::make('specifications')
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('primaryImage.image')
                    ->label('Image')
                    ->square()
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale_price')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('featured')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            GalleryRelationManager::class,
            VariantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
