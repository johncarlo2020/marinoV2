<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Item;
use Filament\Forms\Get;
class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Inventory';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                ->label('Item')
                ->options(Item::where('qty','!=',0)->pluck('name', 'id'))
                ->searchable()
                ->live(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->maxValue(function (Get $get){
                        if(!empty($get('item_id'))){
                            $qty = Item::where('id',$get('item_id'))->first();
                            return $qty->qty;
                        }
                    }),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('P'),
                Forms\Components\TextInput::make('mop')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('or')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('notes')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('mop')
                    ->searchable(),
                Tables\Columns\TextColumn::make('or')
                    ->searchable(),
                Tables\Columns\TextColumn::make('notes')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->after(function (array $data) {
                   $item = Item::find($data['item_id']);
                   $item->qty = $item->qty -= $data['qty'];
                   $item->save();
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSales::route('/'),
            //'create' => Pages\CreateSale::route('/create'),
            //'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
