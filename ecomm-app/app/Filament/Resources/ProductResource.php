<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(components:[
                Forms\Components\TextInput::make(name:'name')->required(),
                Forms\Components\TextInput::make(name:'description')->required(),
                Forms\Components\TextInput::make(name:'price')->numeric()->required(),
                Forms\Components\FileUpload::make(name: 'image')->required(),
                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(components:[
                Tables\Columns\TextColumn::make(name:'name'),
                Tables\Columns\TextColumn::make(name:'description'),
                Tables\Columns\TextColumn::make(name:'price'),
                Tables\Columns\ImageColumn::make(name:'image')
                       ->label(label:'Image')
                       ->size(size: 50, )
                       ->url(url:fn ($record): string => asset(path: 'storage/' . $record->image)),

                       
                   

                         
                
            ])
            ->filters(filters: [
                //
            ])
            ->actions(actions:[
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
        ->label('View')
        ->url(fn ($record) => route('filament.admin.resources.products.view', ['record' => $record->getKey()])),
    
            ])
            ->bulkActions(actions:[
                Tables\Actions\BulkActionGroup::make(actions:[
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
            'view' => Pages\ProductView::route('/{record}/view'),

        ];
    }
}
