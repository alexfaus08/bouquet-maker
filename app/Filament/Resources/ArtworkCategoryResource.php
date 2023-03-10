<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtworkCategoryResource\Pages;
use App\Filament\Resources\ArtworkCategoryResource\RelationManagers;
use App\Models\ArtworkCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArtworkCategoryResource extends Resource
{
    protected static ?string $model = ArtworkCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-color-swatch';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListArtworkCategories::route('/'),
            'create' => Pages\CreateArtworkCategory::route('/create'),
            'edit' => Pages\EditArtworkCategory::route('/{record}/edit'),
        ];
    }
}
