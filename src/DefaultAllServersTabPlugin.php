<?php

namespace Yonn\DefaultAllServersTab;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Yonn\DefaultAllServersTab\Middleware\RedirectServersIndexToAllTab;

class DefaultAllServersTabPlugin implements Plugin
{
    public function getId(): string
    {
        return 'default-all-servers-tab';
    }

    public function register(Panel $panel): void
    {
        if ($panel->getId() !== 'app') {
            return;
        }

        $panel->middleware([RedirectServersIndexToAllTab::class]);
    }

    public function boot(Panel $panel): void {}
}
