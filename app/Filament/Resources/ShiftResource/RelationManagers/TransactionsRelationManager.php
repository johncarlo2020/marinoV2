<?php

namespace App\Filament\Resources\ShiftResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('baht_amount')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('php_amount')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('mop')
                    ->label('Mode of Payment')
                    ->options([
                        'Casg'   => 'Cash',
                        'GCASH'   => 'GCASH',
                        'BDO'   => 'BDO',
                        'BPI'   => 'BPI',
                        'Credit'   => 'Credit',
                    ]),
                Forms\Components\TextInput::make('or')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('notes')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                 Tables\Columns\TextColumn::make('number')->searchable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('baht_amount'),
                Tables\Columns\TextColumn::make('php_amount'),
                Tables\Columns\TextColumn::make('mop'),
                Tables\Columns\TextColumn::make('or'),
                Tables\Columns\TextColumn::make('notes'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->before(function (array $data) {
                    $currentDate = Carbon::now();
                    $dateIn30Days = $currentDate->addDays(30);
                    if($data['mop'] == 'Credit'){
                        $credit = new Credit;
                        $credit->name = $data['name'];
                        $credit->email = $data['notes'];
                        $credit->number = $data['number'];
                        $credit->amount = $data['php_amount'];
                        $credit->due = $dateIn30Days;
                        $credit->status = 'Unpaid';
                        $credit->save();
                    }
                }),
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
}
