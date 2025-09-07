<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrigorificoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar categorias
        $carnes = Category::create([
            'name' => 'Carnes',
            'description' => 'Carnes bovinas, suínas e aves',
        ]);

        $laticinios = Category::create([
            'name' => 'Laticínios',
            'description' => 'Leite, queijos, iogurtes e derivados',
        ]);

        $congelados = Category::create([
            'name' => 'Congelados',
            'description' => 'Produtos congelados e resfriados',
        ]);

        $bebidas = Category::create([
            'name' => 'Bebidas',
            'description' => 'Bebidas geladas e refrigerantes',
        ]);

        // Criar produtos
        Product::create([
            'name' => 'Picanha Premium',
            'description' => 'Picanha bovina de primeira qualidade, cortada na hora e embalada a vácuo para manter a frescura.',
            'category_id' => $carnes->id,
        ]);

        Product::create([
            'name' => 'Queijo Minas Frescal',
            'description' => 'Queijo minas frescal artesanal, produzido com leite fresco e ingredientes naturais.',
            'category_id' => $laticinios->id,
        ]);

        Product::create([
            'name' => 'Hambúrguer Artesanal',
            'description' => 'Hambúrguer de carne bovina artesanal, temperado com especiarias especiais.',
            'category_id' => $congelados->id,
        ]);

        Product::create([
            'name' => 'Coca-Cola 2L',
            'description' => 'Refrigerante Coca-Cola 2 litros, sempre gelado e refrescante.',
            'category_id' => $bebidas->id,
        ]);

        Product::create([
            'name' => 'Frango Inteiro',
            'description' => 'Frango inteiro resfriado, criado livre e sem hormônios.',
            'category_id' => $carnes->id,
        ]);

        Product::create([
            'name' => 'Iogurte Natural',
            'description' => 'Iogurte natural cremoso, rico em probióticos e sem conservantes.',
            'category_id' => $laticinios->id,
        ]);

        Product::create([
            'name' => 'Sorvete de Chocolate',
            'description' => 'Sorvete cremoso de chocolate belga, perfeito para qualquer ocasião.',
            'category_id' => $congelados->id,
        ]);

        Product::create([
            'name' => 'Água Mineral',
            'description' => 'Água mineral natural, sempre fresca e cristalina.',
            'category_id' => $bebidas->id,
        ]);
    }
}
