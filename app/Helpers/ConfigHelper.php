<?php

namespace App\Helpers;

use App\Models\Configuration;

class ConfigHelper
{
    /**
     * Get configuration value by key
     */
    public static function get($key, $default = null)
    {
        return Configuration::getValue($key, $default);
    }

    /**
     * Set configuration value
     */
    public static function set($key, $value)
    {
        return Configuration::setValue($key, $value);
    }

    /**
     * Get all configurations by group
     */
    public static function getGroup($group)
    {
        return Configuration::getByGroup($group);
    }

    /**
     * Get site name
     */
    public static function siteName()
    {
        return self::get('site_name', 'Amazon Frigorífico');
    }

    /**
     * Get site description
     */
    public static function siteDescription()
    {
        return self::get('site_description', 'Especialistas em produtos de qualidade');
    }

    /**
     * Get primary color
     */
    public static function primaryColor()
    {
        return self::get('primary_color', '#03662c');
    }

    /**
     * Get secondary color
     */
    public static function secondaryColor()
    {
        return self::get('secondary_color', '#58ac43');
    }

    /**
     * Get accent color
     */
    public static function accentColor()
    {
        return self::get('accent_color', '#e5d830');
    }

    /**
     * Get heading text color
     */
    public static function headingTextColor()
    {
        return self::get('text_heading_color', '#111827');
    }

    /**
     * Get body text color
     */
    public static function bodyTextColor()
    {
        return self::get('text_body_color', '#1f2937');
    }

    /**
     * Get secondary text color
     */
    public static function secondaryTextColor()
    {
        return self::get('text_secondary_color', '#374151');
    }

    /**
     * Get muted text color
     */
    public static function mutedTextColor()
    {
        return self::get('text_muted_color', '#6b7280');
    }

    public static function heroHeadingColor()
    {
        return self::get('hero_heading_color', '#ffffff');
    }

    public static function heroTextColor()
    {
        return self::get('hero_text_color', '#f8fafc');
    }

    public static function heroBackgroundStartColor()
    {
        return self::get('hero_background_start_color', self::primaryColor());
    }

    public static function heroBackgroundEndColor()
    {
        return self::get('hero_background_end_color', self::heroBackgroundStartColor());
    }

    public static function cardTitleColor()
    {
        return self::get('card_title_color', '#111827');
    }

    public static function cardTextColor()
    {
        return self::get('card_text_color', '#4b5563');
    }

    public static function footerHeadingColor()
    {
        return self::get('footer_heading_color', '#ffffff');
    }

    public static function footerTextColor()
    {
        return self::get('footer_text_color', '#d1d5db');
    }

    /**
     * Get hero title
     */
    public static function heroTitle()
    {
        return self::get('hero_title', 'Bem-vindo ao Amazon Frigorífico');
    }

    /**
     * Get hero subtitle
     */
    public static function heroSubtitle()
    {
        return self::get('hero_subtitle', 'Descubra nossos produtos de qualidade');
    }

    /**
     * Get contact phone
     */
    public static function contactPhone()
    {
        return self::get('contact_phone', '(11) 99999-9999');
    }

    /**
     * Get contact email
     */
    public static function contactEmail()
    {
        return self::get('contact_email', 'contato@amazonfrigorifico.com.br');
    }

    /**
     * Get contact address
     */
    public static function contactAddress()
    {
        return self::get('contact_address', 'Rua das Flores, 123 - Centro - São Paulo/SP');
    }

    /**
     * Get social media links
     */
    public static function socialLinks()
    {
        return [
            'facebook' => self::get('social_facebook'),
            'instagram' => self::get('social_instagram'),
            'whatsapp' => self::get('social_whatsapp'),
        ];
    }

    /**
     * Get SEO meta data
     */
    public static function seoData()
    {
        return [
            'title' => self::get('meta_title', self::siteName()),
            'description' => self::get('meta_description', self::siteDescription()),
            'keywords' => self::get('meta_keywords', 'frigorífico, produtos, qualidade'),
        ];
    }

    /**
     * Clear all configuration cache
     */
    public static function clearCache()
    {
        Configuration::clearCache();
    }
}
