# Componentes Reutilizáveis - Amazon Frigorífico

Este diretório contém componentes Blade reutilizáveis para o sistema Amazon Frigorífico.

## 📦 Componentes Disponíveis

### 1. ProductCard (`product-card.blade.php`)

Componente para exibir cards de produtos com layout simétrico.

#### Uso:
```blade
<x-product-card :product="$product" variant="default" :show-line="true" />
```

#### Parâmetros:
- `product` (obrigatório): Modelo do produto
- `variant` (opcional): `default`, `compact`, `featured`
- `show-line` (opcional): `true`/`false` - Mostrar badge da linha do produto

#### Variantes:
- **default**: Card padrão com sombras e animações completas
- **compact**: Card menor para listas compactas
- **featured**: Card destacado para seções especiais

### 2. CategoryCard (`category-card.blade.php`)

Componente para exibir cards de categorias.

#### Uso:
```blade
<x-category-card :category="$category" variant="featured" />
```

#### Parâmetros:
- `category` (obrigatório): Modelo da categoria
- `variant` (opcional): `default`, `compact`, `featured`

### 3. HeroSection (`hero-section.blade.php`)

Componente para seções hero com título, subtítulo e ícone.

#### Uso:
```blade
<x-hero-section 
    title="Título da Seção"
    subtitle="Subtítulo descritivo"
    icon="products"
    background="blue"
    :show-pattern="true" />
```

#### Parâmetros:
- `title` (obrigatório): Título principal
- `subtitle` (obrigatório): Subtítulo descritivo
- `icon` (opcional): `products`, `categories`, `about`, `default`
- `background` (opcional): `blue`, `green`, `gray`
- `show-pattern` (opcional): `true`/`false` - Mostrar padrão de fundo

## 🎨 Características dos Componentes

### Layout Simétrico
- **Altura uniforme**: Todos os cards têm a mesma altura
- **Botão fixo**: Sempre na parte inferior
- **Espaços pré-definidos**: Título (2 linhas), descrição (4 linhas)

### Responsividade
- **Mobile**: 1 coluna
- **Tablet**: 2 colunas
- **Desktop**: 3-4 colunas
- **Adaptativo**: Classes Tailwind responsivas

### Animações
- **Hover effects**: Transformações e sombras
- **Transições suaves**: Duração de 300-500ms
- **Scale effects**: Zoom nas imagens

## 🔧 Manutenção

### Adicionando Novos Componentes
1. Crie o arquivo `.blade.php` em `resources/views/components/`
2. Use `@props()` para definir parâmetros
3. Documente o uso no README
4. Teste em diferentes páginas

### Modificando Componentes Existentes
1. **CUIDADO**: Mudanças afetam todas as páginas
2. Teste em todas as páginas que usam o componente
3. Mantenha compatibilidade com parâmetros existentes
4. Use variantes para diferentes estilos

## 📱 Páginas que Usam os Componentes

### ProductCard
- `frontend/products.blade.php` - Lista de produtos
- `frontend/home.blade.php` - Produtos em destaque

### CategoryCard
- `frontend/home.blade.php` - Categorias principais

### HeroSection
- `frontend/products.blade.php` - Header da página de produtos

## 🚀 Benefícios

1. **Reutilização**: Um componente, múltiplas páginas
2. **Consistência**: Design uniforme em todo o site
3. **Manutenção**: Uma mudança, todas as páginas atualizadas
4. **Performance**: Código otimizado e organizado
5. **Escalabilidade**: Fácil adição de novos componentes
