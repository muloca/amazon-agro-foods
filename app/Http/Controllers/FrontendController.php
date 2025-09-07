<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
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

        return view('frontend.home', compact('categories', 'featuredProducts'));
    }

    public function categories()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        return view('frontend.categories', compact('categories'));
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

        return view('frontend.products', compact('products', 'categories'));
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

        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function category(Category $category)
    {
        if (!$category->is_active) {
            abort(404);
        }
        
        $products = $category->products()
            ->where('is_active', true)
            ->paginate(12);

        return view('frontend.category', compact('category', 'products'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function history()
    {
        return view('frontend.history');
    }

    public function news()
    {
        return view('frontend.news');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}