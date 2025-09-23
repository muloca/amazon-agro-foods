<?php

if (!function_exists('config_helper')) {
    /**
     * Get configuration value by key
     */
    function config_helper($key = null, $default = null) {
        if ($key === null) {
            return app(\App\Helpers\ConfigHelper::class);
        }
        return \App\Helpers\ConfigHelper::get($key, $default);
    }
}

if (!function_exists('site_name')) {
    function site_name() {
        return \App\Helpers\ConfigHelper::siteName();
    }
}

if (!function_exists('site_description')) {
    function site_description() {
        return \App\Helpers\ConfigHelper::siteDescription();
    }
}

if (!function_exists('primary_color')) {
    function primary_color() {
        return \App\Helpers\ConfigHelper::primaryColor();
    }
}

if (!function_exists('hero_title')) {
    function hero_title() {
        return \App\Helpers\ConfigHelper::heroTitle();
    }
}

if (!function_exists('hero_subtitle')) {
    function hero_subtitle() {
        return \App\Helpers\ConfigHelper::heroSubtitle();
    }
}

if (!function_exists('text_heading_color')) {
    function text_heading_color() {
        return \App\Helpers\ConfigHelper::headingTextColor();
    }
}

if (!function_exists('text_body_color')) {
    function text_body_color() {
        return \App\Helpers\ConfigHelper::bodyTextColor();
    }
}

if (!function_exists('text_secondary_color')) {
    function text_secondary_color() {
        return \App\Helpers\ConfigHelper::secondaryTextColor();
    }
}

if (!function_exists('text_muted_color')) {
    function text_muted_color() {
        return \App\Helpers\ConfigHelper::mutedTextColor();
    }
}

if (!function_exists('hero_heading_color')) {
    function hero_heading_color() {
        return \App\Helpers\ConfigHelper::heroHeadingColor();
    }
}

if (!function_exists('hero_text_color')) {
    function hero_text_color() {
        return \App\Helpers\ConfigHelper::heroTextColor();
    }
}

if (!function_exists('hero_background_start_color')) {
    function hero_background_start_color() {
        return \App\Helpers\ConfigHelper::heroBackgroundStartColor();
    }
}

if (!function_exists('hero_background_end_color')) {
    function hero_background_end_color() {
        return \App\Helpers\ConfigHelper::heroBackgroundEndColor();
    }
}

if (!function_exists('card_title_color')) {
    function card_title_color() {
        return \App\Helpers\ConfigHelper::cardTitleColor();
    }
}

if (!function_exists('card_text_color')) {
    function card_text_color() {
        return \App\Helpers\ConfigHelper::cardTextColor();
    }
}

if (!function_exists('footer_heading_color')) {
    function footer_heading_color() {
        return \App\Helpers\ConfigHelper::footerHeadingColor();
    }
}

if (!function_exists('footer_text_color')) {
    function footer_text_color() {
        return \App\Helpers\ConfigHelper::footerTextColor();
    }
}

if (!function_exists('contact_phone')) {
    function contact_phone() {
        return \App\Helpers\ConfigHelper::contactPhone();
    }
}

if (!function_exists('contact_email')) {
    function contact_email() {
        return \App\Helpers\ConfigHelper::contactEmail();
    }
}

if (!function_exists('contact_address')) {
    function contact_address() {
        return \App\Helpers\ConfigHelper::contactAddress();
    }
}
