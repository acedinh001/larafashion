<?php

namespace App\Filament\Pages;

use App\Settings\KaidoSetting;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class ManageSetting extends SettingsPage
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = KaidoSetting::class;

    public static function getNavigationGroup(): ?string
    {
        return __('filament.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.manage_setting');
    }

    public function getTitle(): string|Htmlable
    {
        return __('filament.manage_setting');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('filament.site_info'))->columns(1)->schema([
                    TextInput::make('site_name')
                        ->label(__('filament.site_name'))
                        ->required(),
                    Toggle::make('site_active')
                        ->label(__('filament.site_active')),
                    Toggle::make('registration_enabled')
                        ->label(__('filament.registration_enabled')),
                    Toggle::make('password_reset_enabled')
                        ->label(__('filament.password_reset_enabled')),
                    Toggle::make('sso_enabled')
                        ->label(__('filament.sso_enabled')),
                ]),
            ]);
    }

}
