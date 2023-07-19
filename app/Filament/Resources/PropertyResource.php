<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Filament\Resources\PropertyResource\Widgets\PropertyOverview;
use App\Models\Property;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;
    protected static ?string $navigationGroup = 'Configuration';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required(),
                Forms\Components\TextInput::make('surface')
                    ->required()
                    ->integer()
                    ->suffix('m2'),
                Forms\Components\TextInput::make('rooms')
                    ->required()
                    ->integer(),
                Forms\Components\TextInput::make('bedrooms')
                    ->required()
                    ->integer(),
                Forms\Components\TextInput::make('floor')
                    ->required()
                    ->integer(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->integer(),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('postal_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('sold')
                    ->required(),
                Forms\Components\Select::make('options')
                    ->multiple()
                    ->relationship('options', 'name')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price')
                    ->money('eur', true),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\IconColumn::make('sold')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/y H:i', 'Europe/Paris'),
                Tables\Columns\TextColumn::make('options.name'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return   __('Propriétés');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            PropertyOverview::class,
        ];
    }
}
