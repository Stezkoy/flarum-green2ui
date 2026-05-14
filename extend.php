<?php

use Flarum\Extend;
use Flarum\Frontend\Document;
use Flarum\Settings\SettingsRepositoryInterface;

return [

    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->css(__DIR__ . '/less/admin.less'),

    (new Extend\Settings())
        // (light)
        ->default('green2ui.light.all_bg_color', '#ffffff')
        ->default('green2ui.light.all_bg_color_hover', '#f7f7f7')
        ->default('green2ui.light.header_bg', '#ffffff')

        // (light-hc)
        ->default('green2ui.light_hc.all_bg_color', '#ffffff')
        ->default('green2ui.light_hc.all_bg_color_hover', '#e8f5f1')
        ->default('green2ui.light_hc.header_bg', '#ffffff')

        // (dark)
        ->default('green2ui.dark.all_bg_color', '#2c3332')
        ->default('green2ui.dark.all_bg_color_hover', '#262b2b')
        ->default('green2ui.dark.header_bg', '#2c3332')

        // (dark-hc)
        ->default('green2ui.dark_hc.all_bg_color', '#000000')
        ->default('green2ui.dark_hc.all_bg_color_hover', '#0a1a15')
        ->default('green2ui.dark_hc.header_bg', '#000000'),

    (new Extend\Frontend('forum'))
        ->head(function (Document $document) {
            /** @var SettingsRepositoryInterface $settings */
            $settings = resolve(SettingsRepositoryInterface::class);

            $lightBg = $settings->get('green2ui.light.all_bg_color', '#ffffff');
            $lightBgHover = $settings->get('green2ui.light.all_bg_color_hover', '#f7f7f7');
            $lightHeader = $settings->get('green2ui.light.header_bg', '#ffffff');

            $lightHcBg = $settings->get('green2ui.light_hc.all_bg_color', '#ffffff');
            $lightHcBgHover = $settings->get('green2ui.light_hc.all_bg_color_hover', '#e8f5f1');
            $lightHcHeader = $settings->get('green2ui.light_hc.header_bg', '#ffffff');

            $darkBg = $settings->get('green2ui.dark.all_bg_color', '#2c3332');
            $darkBgHover = $settings->get('green2ui.dark.all_bg_color_hover', '#262b2b');
            $darkHeader = $settings->get('green2ui.dark.header_bg', '#2c3332');

            $darkHcBg = $settings->get('green2ui.dark_hc.all_bg_color', '#000000');
            $darkHcBgHover = $settings->get('green2ui.dark_hc.all_bg_color_hover', '#0a1a15');
            $darkHcHeader = $settings->get('green2ui.dark_hc.header_bg', '#000000');

            $style = "
                :root {
                    --all-bg-color: {$lightBg};
                    --all-bg-color-hover: {$lightBgHover};
                    --header-bg: {$lightHeader};
                }
                [data-theme=light-hc] {
                    --all-bg-color: {$lightHcBg};
                    --all-bg-color-hover: {$lightHcBgHover};
                    --header-bg: {$lightHcHeader};
                }
                [data-theme^=dark] {
                    --all-bg-color: {$darkBg};
                    --all-bg-color-hover: {$darkBgHover};
                    --header-bg: {$darkHeader};
                }
                [data-theme=dark-hc] {
                    --all-bg-color: {$darkHcBg};
                    --all-bg-color-hover: {$darkHcBgHover};
                    --header-bg: {$darkHcHeader};
                }
            ";

            $document->head[] = '<style id="green2ui-colors">' . $style . '</style>';
        }),
];