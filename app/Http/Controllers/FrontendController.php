<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Configuration;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class FrontendController extends Controller
{
    private function getConfigurations()
    {
        $primaryColor = Configuration::getValue('primary_color', '#03662c');
        $secondaryColor = Configuration::getValue('secondary_color', '#58ac43');
        $heroStartColor = Configuration::getValue('hero_background_start_color', $primaryColor);
        $heroEndColor = Configuration::getValue('hero_background_end_color', $heroStartColor);

        return [
            'site_name' => Configuration::getValue('site_name', 'Amazon Frigorífico'),
            'site_description' => Configuration::getValue('site_description', 'Especialistas em produtos de qualidade'),
            'hero_title' => Configuration::getValue('hero_title', __('frontend.home.hero.default_title')),
            'hero_subtitle' => Configuration::getValue('hero_subtitle', __('frontend.home.hero.default_subtitle')),
            'cta_button_text' => Configuration::getValue('cta_button_text', __('frontend.home.hero.primary_cta')),
            'primary_color' => $primaryColor,
            'secondary_color' => $secondaryColor,
            'accent_color' => Configuration::getValue('accent_color', '#e5d830'),
            'contact_phone' => Configuration::getValue('contact_phone', '(11) 99999-9999'),
            'contact_phone_secondary' => Configuration::getValue('contact_phone_secondary'),
            'contact_email' => Configuration::getValue('contact_email', 'contato@amazonfrigorifico.com.br'),
            'contact_address' => Configuration::getValue('contact_address', 'Rua das Flores, 123 - Centro - São Paulo/SP'),
            'contact_map_latitude' => Configuration::getValue('contact_map_latitude'),
            'contact_map_longitude' => Configuration::getValue('contact_map_longitude'),
            'contact_map_url' => Configuration::getValue('contact_map_url'),
            'social_facebook' => Configuration::getValue('social_facebook', ''),
            'social_instagram' => Configuration::getValue('social_instagram', ''),
            'social_whatsapp' => Configuration::getValue('social_whatsapp', ''),
            'text_heading_color' => Configuration::getValue('text_heading_color', '#111827'),
            'text_body_color' => Configuration::getValue('text_body_color', '#1f2937'),
            'text_secondary_color' => Configuration::getValue('text_secondary_color', '#374151'),
            'text_muted_color' => Configuration::getValue('text_muted_color', '#6b7280'),
            'hero_heading_color' => Configuration::getValue('hero_heading_color', '#ffffff'),
            'hero_text_color' => Configuration::getValue('hero_text_color', '#f8fafc'),
            'hero_background_start_color' => $heroStartColor,
            'hero_background_end_color' => $heroEndColor,
            'card_title_color' => Configuration::getValue('card_title_color', '#111827'),
            'card_text_color' => Configuration::getValue('card_text_color', '#4b5563'),
            'footer_heading_color' => Configuration::getValue('footer_heading_color', '#ffffff'),
            'footer_text_color' => Configuration::getValue('footer_text_color', '#d1d5db'),
            'meta_title' => Configuration::getValue('meta_title', __('frontend.home.meta.title')),
            'meta_description' => Configuration::getValue('meta_description', __('frontend.home.meta.description')),
            'meta_keywords' => Configuration::getValue('meta_keywords', 'frigorífico, produtos, qualidade'),
        ];
    }

    public function home()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->take(6)
            ->get();
            
        $featuredProducts = Product::where('is_active', true)
            ->with('category')
            ->take(8)
            ->get();

        $config = $this->getConfigurations();

        return view('frontend.home', compact('categories', 'featuredProducts', 'config'));
    }

    public function categories()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        $config = $this->getConfigurations();

        return view('frontend.categories', compact('categories', 'config'));
    }

    public function products(Request $request)
    {
        $query = Product::where('is_active', true)->with('category');
        
        // Filtro por categoria
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Busca por nome
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();
        $config = $this->getConfigurations();

        return view('frontend.products', compact('products', 'categories', 'config'));
    }

    public function product(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }
        
        $relatedProducts = Product::where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        $config = $this->getConfigurations();

        return view('frontend.product', compact('product', 'relatedProducts', 'config'));
    }

    public function category(Category $category)
    {
        if (!$category->is_active) {
            abort(404);
        }
        
        $products = $category->products()
            ->where('is_active', true)
            ->paginate(12);

        $config = $this->getConfigurations();

        return view('frontend.category', compact('category', 'products', 'config'));
    }

    public function about()
    {
        $config = $this->getConfigurations();
        return view('frontend.about', compact('config'));
    }

    public function history()
    {
        $config = $this->getConfigurations();
        return view('frontend.history', compact('config'));
    }

    public function news()
    {
        $newsItems = News::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(9);

        $config = $this->getConfigurations();
        return view('frontend.news', compact('config', 'newsItems'));
    }

    public function newsShow(News $news)
    {
        $config = $this->getConfigurations();

        $relatedNews = News::query()
            ->where('id', '!=', $news->id)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        return view('frontend.news-show', [
            'config' => $config,
            'news' => $news,
            'relatedNews' => $relatedNews,
        ]);
    }

    public function contact()
    {
        $config = $this->getConfigurations();
        return view('frontend.contact', compact('config'));
    }

    public function submitContact(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        ContactMessage::create($data);

        return redirect()
            ->route('frontend.contact')
            ->with('status', 'Em breve entraremos em contato.');
    }
}
