<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostsResource\Pages;
use App\Filament\Resources\PostsResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class PostsResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?int $navigationSort = 3;


    protected static function getNavigationLabel():string
    {
        return "Posts";
    }
    
    public static function getPluralLabel():string
    {
        return "Posts";
    }

    protected static ?string $navigationGroup = 'Blog Management';

    protected static ?string $slug = 'blog/posts';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kategori_id')
                ->label('Kategori')
                ->relationship('kategori', 'nama')
                ->required(),

                Forms\Components\Select::make('author_id')
                ->label('Author')
                ->relationship('author', 'nama')
                ->required(),

                Forms\Components\TextInput::make('judul')
                ->label('Judul')
                ->required(),

                Forms\Components\RichEditor::make('konten')
                ->label('Konten')
                ->columnSpanFull(),

                Forms\Components\DateTimePicker::make('publish_date')
                ->label('Published')
                ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kategori.nama')
                ->label('Kategori')
                ->searchable(),

                Tables\Columns\TextColumn::make('author.nama')
                ->label('Author')
                ->searchable(),

                Tables\Columns\TextColumn::make('judul')
                ->label('Judul')
                ->searchable(),

                Tables\Columns\TextColumn::make('publish_date')
                ->label('Published'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePosts::route('/'),
        ];
    }    
}
