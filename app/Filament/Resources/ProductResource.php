<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\ProductResource\Pages;
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
  Section::make('Product Information')
        ->schema([
            Grid::make()
                ->schema([
                    Section::make('Basic Details')
                        ->schema([
                            TextInput::make('name')
                                ->label('Product Name')
                                ->placeholder('Enter product name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Grid::make(2)
                                ->schema([
                                    TextInput::make('price')
                                        ->label('Price')
                                        ->numeric()
                                        ->prefix('$')
                                        ->inputMode('decimal')
                                        ->step(0.01)
                                        ->required(),

                                    Select::make('category_id')
                                        ->label('Category')
                                        ->placeholder('Select a category')
                                        ->searchable()
                                        ->preload()
                                        ->options(fn() => Category::pluck('name', 'id'))
                                        ->required(),
                                ]),

                            Textarea::make('description')
                                ->label('Description')
                                ->placeholder('Enter detailed product description')
                                ->required()
                                ->columnSpanFull()
                                ->rows(4),
                        ])
                        ->columns(1)
                        ->columnSpan(['lg' => 2]),

                    Section::make('Product Image')
                        ->schema([
                            FileUpload::make('image')
                                ->label('Main Product Image')
                                ->image()
                                ->directory('products')
                                ->imageEditor()
                                ->imageResizeMode('cover')
                                ->imageCropAspectRatio('1:1')
                                ->imagePreviewHeight('300')
                                ->loadingIndicatorPosition('left')
                                ->panelAspectRatio('1:1')
                                ->panelLayout('integrated')
                                ->removeUploadedFileButtonPosition('right')
                                ->uploadButtonPosition('left')
                                ->uploadProgressIndicatorPosition('left')
                                ->required()
                                ->columnSpanFull(),
                        ])
                        ->columnSpan(['lg' => 1]),
                ])
                ->columns(3),
        ])
        ->columns(1),
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
                    ->badge()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->sortable()
                    ->limit(20)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Created Date')
                    ->sortable()
            ])
            ->filters([

                SelectFilter::make('category_id')
                    ->label('Category')
                    ->searchable()
                    ->options(fn()=>Category::pluck('name','id'))
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
