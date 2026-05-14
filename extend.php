<?php

/**
 * GreenUI Theme for Flarum v2
 */

use Flarum\Extend;
use Flarum\Frontend\Document;
use Flarum\Settings\SettingsRepositoryInterface;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->css(__DIR__ . '/less/admin.less'),

    (new Extend\Settings())
        ->default('greenui.light.all_bg_color', '#ffffff')
        ->default('greenui.light.all_bg_color_hover', '#f7f7f7')
        ->default('greenui.light.header_bg', '#ffffff')

        ->default('greenui.light_hc.all_bg_color', '#ffffff')
        ->default('greenui.light_hc.all_bg_color_hover', '#e8f5f1')
        ->default('greenui.light_hc.header_bg', '#ffffff')

        ->default('greenui.dark.all_bg_color', '#2c3332')
        ->default('greenui.dark.all_bg_color_hover', '#262b2b')
        ->default('greenui.dark.header_bg', '#2c3332')

        ->default('greenui.dark_hc.all_bg_color', '#000000')
        ->default('greenui.dark_hc.all_bg_color_hover', '#0a1a15')
        ->default('greenui.dark_hc.header_bg', '#000000'),

    (new Extend\Head('forum'))
        ->add(function () {
            /** @var SettingsRepositoryInterface $settings */
            $settings = resolve(SettingsRepositoryInterface::class);

            // Светлая
            $lightBg = $settings->get('greenui.light.all_bg_color', '#ffffff');
            $lightBgHover = $settings->get('greenui.light.all_bg_color_hover', '#f7f7f7');
            $lightHeader = $settings->get('greenui.light.header_bg', '#ffffff');

            // Светлая HC
            $lightHcBg = $settings->get('greenui.light_hc.all_bg_color', '#ffffff');
            $lightHcBgHover = $settings->get('greenui.light_hc.all_bg_color_hover', '#e8f5f1');
            $lightHcHeader = $settings->get('greenui.light_hc.header_bg', '#ffffff');

            // Тёмная
            $darkBg = $settings->get('greenui.dark.all_bg_color', '#2c3332');
            $darkBgHover = $settings->get('greenui.dark.all_bg_color_hover', '#262b2b');
            $darkHeader = $settings->get('greenui.dark.header_bg', '#2c3332');

            // Тёмная HC
            $darkHcBg = $settings->get('greenui.dark_hc.all_bg_color', '#000000');
            $darkHcBgHover = $settings->get('greenui.dark_hc.all_bg_color_hover', '#0a1a15');
            $darkHcHeader = $settings->get('greenui.dark_hc.header_bg', '#000000');

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

            return '<style id="greenui-colors">' . $style . '</style>';
        }),
];