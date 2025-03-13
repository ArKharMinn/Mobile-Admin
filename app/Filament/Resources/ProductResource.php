<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use Filament\Tables\Columns\ImageColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Section::make([
                            TextInput::make('name')
                                ->label('Name')
                                ->required(),

                            TextInput::make('price')
                                ->label('Price')
                                ->required(),
                            Select::make('category_id')
                                ->label('Category')
                                ->options(
                                    \App\Models\Category::all()->pluck('name', 'id')
                                )
                                ->required(),
                        ])
                            ->columnSpan(1),
                        Section::make([
                            FileUpload::make('image')
                                ->label('Image')
                                ->required(),

                            Textarea::make('description')
                                ->label('Description')
                                ->required(),
                        ])
                            ->columnSpan(1),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image'),
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('danger')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->sortable()
                    ->formatStateUsing(fn($state) => Str::limit($state, 30, '...'))
                    ->searchable(),
                SelectColumn::make('status')
                    ->options([
                        'active' => 'active',
                        'inactive' => 'inactive'
                    ])
                    ->searchable()
                    ->sortable()
                    ->label('Status'),
                TextColumn::make('created_at')
                    ->label('Created Data')
                    ->sortable()
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'active',
                        'inactive' => 'inactive'
                    ]),
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->options([
                        Category::all()->pluck('name', 'id')->toArray()
                    ])
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
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
            //
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
