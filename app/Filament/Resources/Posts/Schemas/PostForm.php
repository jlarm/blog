<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('title')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->columnSpanFull(),
                                TextInput::make('slug')
                                    ->readOnly(),
                                MarkdownEditor::make('body')
                                    ->columnSpanFull(),
                            ])
                        ->columnSpan(2),
                        Section::make()
                            ->schema([
                                TagsInput::make('tags')
                                    ->suggestions([
                                        'tailwindcss',
                                        'php',
                                        'laravel',
                                        'alpinejs',
                                        'vue',
                                        'javascript',
                                    ]),

                                Select::make('categories')
                                    ->searchable()
                                    ->multiple()
                                    ->relationship('categories', 'name')
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                            ->required(),
                                        TextInput::make('slug')
                                            ->readOnly(),
                                    ])
                            ])
                        ->columnSpan(1)
                    ])
                ->columnSpanFull()
            ]);
    }
}
