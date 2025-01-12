<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueResource\Pages;
use App\Filament\Resources\IssueResource\RelationManagers;
use App\Models\Issue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IssueResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project')
                    ->searchable()
                    ->columnSpanFull()
                    ->preload()
                    ->relationship(name: 'project', titleAttribute: 'project_name'),
                Forms\Components\RichEditor::make('issue_description')
                    ->label('Issue Description')
                    ->columnSpanFull(),
                    //->required(),
                Select::make('assigned_to')
                    ->searchable()
                    ->preload()
                    ->columnSpanFull()
                    ->placeholder('Search for people...')
                    //->required()
                    //->multiple()
                    //->relationship(name: 'user', titleAttribute: 'name'),
                    ->options(User::class::pluck('name','email')),
                FileUpload::make('attachment')
                    ->label('Attachment')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'open' => 'Open',
                        'started' => 'Started',
                        'notStarted' => 'Not Started',
                        'inReview' => 'In Review',
                        'closed' => 'Closed',
                        'resolved' => 'Resolved',
                        'notResolved' => 'Not Resolved',

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.project_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('issue_description')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assigned_to')
                    ->label('Assigned To Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label('Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    ])
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
            'index' => Pages\ListIssues::route('/'),
            'create' => Pages\CreateIssue::route('/create'),
            'view' => Pages\ViewIssue::route('/{record}'),
            'edit' => Pages\EditIssue::route('/{record}/edit'),
        ];
    }
}
