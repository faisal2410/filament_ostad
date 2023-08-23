<?php

namespace App\Filament\Resources;

use App\Enums\ProductTypeEnum;
use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationLabel='Products';

    protected static ?string $navigationGroup='Shop';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Group::make()
               ->schema([
                Section::make()
                ->schema([
                    TextInput::make('name'),
                    TextInput::make('slug'),
                    MarkdownEditor::make('description')
                    ->columnSpan('full'),


                ])->columns(2),
                Section::make('Pricing & Inventory')
                ->schema([

                    TextInput::make('sku'),
                    TextInput::make('price'),
                    TextInput::make('quantity'),
                    Select::make('type')
                    ->options([
                        'downloadable'=>ProductTypeEnum::DELIVERABLE->value,
                        'deliverable'=>ProductTypeEnum::DOWNLOADABLE->value
                        ])


                ])->columns(2),

               ]),
               Group::make()
               ->schema([
                Section::make('Status')
                ->schema([
                    Toggle::make('is_visible'),
                    Toggle::make('is_featured'),
                    DatePicker::make('published_at'),

                ]),
                Section::make('Image')
                ->schema([
                    FileUpload::make('image')
                ])->collapsible(),
                Section::make('Associations')
                ->schema([

                    Select::make('brand_id')
                    ->relationship('brand','name')


                ])

               ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('image'),
                TextColumn::make('name'),
                TextColumn::make('brand.name'),
                IconColumn::make('is_visible')->boolean(),
                TextColumn::make('price'),
                TextColumn::make('quantity'),
                TextColumn::make('published_at'),
                TextColumn::make('type'),






            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
