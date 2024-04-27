<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoadResource\Pages;
use App\Filament\Resources\LoadResource\RelationManagers;
use App\Models\Load;
use App\Models\Transaction;
use App\Models\Shift;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class LoadResource extends Resource
{
    protected static ?string $model = Load::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('network_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_id')
                    ->numeric(),
                Forms\Components\TextInput::make('package_id')
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mop')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('network.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount.peso')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('package.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mop')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('status')
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
            ->actions([
                Tables\Actions\Action::make('Load Now')
                ->action(fn (Load $record) => self::load($record)
                )
                ->requiresConfirmation()
                ->modalDescription('Are you sure you\'d like to delete this post? This cannot be undone.')
                ->visible(fn (Load $record) => $record->status == 'pending' ),

                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function load($load) // Make the function static
    {
       if($load->type == 'amount' )
       {
        $client = new Client();
            $authorizationToken = env('API_KEY');
            try {
                $response = $client->post('https://thailandtopup.com/api/v2/topup', [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode($authorizationToken . ':'),
                        'Accept' => 'application/json', 
                    ],
                    'form_params' => [
                        'number' => $load->number,
                        'amount' => $load->amount->baht,
                        'network' => $load->network->id,
                    ],
                ]);

                if ($response->getStatusCode() === 201) {
                    $responseData = json_decode($response->getBody(), true);
                    $shift = Shift::orderBY('id','desc')->first();
                    $transaction = new Transaction;
                    $transaction->number = $responseData['phone_number'];
                    $transaction->name = $load->name;
                    $transaction->baht_amount = $load->amount->baht;
                    $transaction->php_amount = $load->amount->peso;
                    $transaction->mop = $load->mop;
                    $transaction->or = $responseData['order_id'];
                    $transaction->notes = $load->email;
                    $transaction->shift_id = $shift->id;
                    $transaction->save();

                    
                    if($load->mop == 'credit'){
                        $currentDate = Carbon::now();
                        $dateIn30Days = $currentDate->addDays(30);
                        $credit = new Credit;
                        $credit->name = $data['name'];
                        $credit->email = $data['notes'];
                        $credit->number = $data['number'];
                        $credit->amount = $data['php_amount'];
                        $credit->due = $dateIn30Days;
                        $credit->status = 'Unpaid';
                        $credit->save();
                    }

                    $load = Load::find($load->id);
                    $load->status = 'Created';
                    $load->save();

                  
                } else {
                   
                }
            } catch (RequestException $e) {
                dd($e);
            }
       }else{
        $client = new Client();
        $authorizationToken = env('API_KEY');
        try {
            $response = $client->post('https://thailandtopup.com/api/v2/topupais-pro', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($authorizationToken . ':'),
                    'Accept' => 'application/json', 
                ],
                'form_params' => [
                    'number' => $load->number,
                    'code' => $load->package->code,
                ],
            ]);

            if ($response->getStatusCode() === 201) {
                $responseData = json_decode($response->getBody(), true);
                $shift = Shift::orderBY('id','desc')->first();
                $transaction = new Transaction;
                $transaction->number = $responseData['phone_number'];
                $transaction->name = $load->name;
                $transaction->baht_amount = $load->amount->baht;
                $transaction->php_amount = $load->amount->peso;
                $transaction->mop = $load->mop;
                $transaction->or = $responseData['order_id'];
                $transaction->notes = $load->email;
                $transaction->shift_id = $shift->id;
                $transaction->save();

                if($load->mop == 'credit'){
                    $currentDate = Carbon::now();
                    $dateIn30Days = $currentDate->addDays(30);
                    $credit = new Credit;
                    $credit->name = $data['name'];
                    $credit->email = $data['notes'];
                    $credit->number = $data['number'];
                    $credit->amount = $data['php_amount'];
                    $credit->due = $dateIn30Days;
                    $credit->status = 'Unpaid';
                    $credit->save();
                }

                $load = Load::find($load->id);
                $load->status = 'Created';
                $load->save();

              
            } else {
               
            }
        } catch (RequestException $e) {
            dd($e);
        }
       }
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
            'index' => Pages\ListLoads::route('/'),
            'create' => Pages\CreateLoad::route('/create'),
            'edit' => Pages\EditLoad::route('/{record}/edit'),
        ];
    }
}
