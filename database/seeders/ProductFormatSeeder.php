<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductFormat;
use App\Models\Category;

class ProductFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all products grouped by category
        $products = Product::with('category')->get();

        foreach ($products as $product) {
            $categoryName = $product->category ? $product->category->name : '';
            $formats = $this->getFormatsForCategory($categoryName, $product->name);

            foreach ($formats as $format) {
                ProductFormat::create([
                    'product_id' => $product->id,
                    'format' => $format['format'],
                    'price_per_format' => $format['price_per_format'],
                    'packaging' => $format['packaging'],
                ]);
            }
        }
    }

    /**
     * Get appropriate formats based on product category and name
     *
     * @param string $categoryName
     * @param string $productName
     * @return array
     */
    private function getFormatsForCategory($categoryName, $productName)
    {
        // Default formats if no specific match is found
        $defaultFormats = [
            [
                'format' => 'unit',
                'price_per_format' => 1.00,
                'packaging' => 'standard',
            ]
        ];

        // Category-specific formats
        $categoryFormats = [
            'Food Products' => [
                // Rice, Sugar, Flour
                'Rice' => [
                    ['format' => 'kg', 'price_per_format' => 2.50, 'packaging' => 'bag'],
                    ['format' => '5kg', 'price_per_format' => 11.99, 'packaging' => 'bag'],
                    ['format' => '10kg', 'price_per_format' => 22.50, 'packaging' => 'sack'],
                ],
                'Sugar' => [
                    ['format' => 'kg', 'price_per_format' => 1.75, 'packaging' => 'bag'],
                    ['format' => '5kg', 'price_per_format' => 8.25, 'packaging' => 'bag'],
                    ['format' => '25kg', 'price_per_format' => 39.99, 'packaging' => 'sack'],
                ],
                'Flour' => [
                    ['format' => 'kg', 'price_per_format' => 1.25, 'packaging' => 'bag'],
                    ['format' => '5kg', 'price_per_format' => 5.99, 'packaging' => 'bag'],
                    ['format' => '25kg', 'price_per_format' => 27.50, 'packaging' => 'sack'],
                ],
                'Oil' => [
                    ['format' => '500ml', 'price_per_format' => 8.99, 'packaging' => 'bottle'],
                    ['format' => '1L', 'price_per_format' => 15.99, 'packaging' => 'bottle'],
                    ['format' => '5L', 'price_per_format' => 74.99, 'packaging' => 'can'],
                ],
                'default' => [
                    ['format' => 'kg', 'price_per_format' => 2.00, 'packaging' => 'bag'],
                    ['format' => 'box', 'price_per_format' => 5.00, 'packaging' => 'carton'],
                ],
            ],
            'Natural and Medicinal Products' => [
                'Herbs' => [
                    ['format' => '100g', 'price_per_format' => 8.75, 'packaging' => 'pouch'],
                    ['format' => '250g', 'price_per_format' => 19.99, 'packaging' => 'pouch'],
                    ['format' => '500g', 'price_per_format' => 36.50, 'packaging' => 'jar'],
                ],
                'Extract' => [
                    ['format' => '30ml', 'price_per_format' => 24.99, 'packaging' => 'bottle'],
                    ['format' => '100ml', 'price_per_format' => 74.99, 'packaging' => 'bottle'],
                    ['format' => '250ml', 'price_per_format' => 179.99, 'packaging' => 'bottle'],
                ],
                'Oils' => [
                    ['format' => 'set of 3', 'price_per_format' => 45.50, 'packaging' => 'box'],
                    ['format' => 'set of 6', 'price_per_format' => 85.99, 'packaging' => 'box'],
                    ['format' => 'set of 12', 'price_per_format' => 159.99, 'packaging' => 'premium box'],
                ],
                'default' => [
                    ['format' => 'unit', 'price_per_format' => 15.00, 'packaging' => 'box'],
                    ['format' => 'set', 'price_per_format' => 45.00, 'packaging' => 'premium box'],
                ],
            ],
            'Raw Materials' => [
                'Flowers' => [
                    ['format' => 'bouquet', 'price_per_format' => 18.50, 'packaging' => 'wrapped'],
                    ['format' => 'large bouquet', 'price_per_format' => 32.99, 'packaging' => 'premium wrapped'],
                    ['format' => 'bulk (50)', 'price_per_format' => 149.99, 'packaging' => 'box'],
                ],
                'Agricultural' => [
                    ['format' => 'basic kit', 'price_per_format' => 120.00, 'packaging' => 'box'],
                    ['format' => 'premium kit', 'price_per_format' => 199.99, 'packaging' => 'case'],
                    ['format' => 'professional kit', 'price_per_format' => 349.99, 'packaging' => 'case'],
                ],
                'Feed' => [
                    ['format' => '5kg', 'price_per_format' => 35.75, 'packaging' => 'bag'],
                    ['format' => '25kg', 'price_per_format' => 159.99, 'packaging' => 'sack'],
                    ['format' => '50kg', 'price_per_format' => 299.99, 'packaging' => 'bulk sack'],
                ],
                'default' => [
                    ['format' => 'kg', 'price_per_format' => 10.00, 'packaging' => 'bag'],
                    ['format' => 'ton', 'price_per_format' => 1000.00, 'packaging' => 'bulk'],
                ],
            ],
            'Minerals and Derivatives' => [
                'Metals' => [
                    ['format' => 'sample set', 'price_per_format' => 250.00, 'packaging' => 'case'],
                    ['format' => 'oz', 'price_per_format' => 1800.00, 'packaging' => 'secure container'],
                    ['format' => 'kg', 'price_per_format' => 57000.00, 'packaging' => 'secure vault'],
                ],
                'Gemstone' => [
                    ['format' => 'small collection', 'price_per_format' => 375.50, 'packaging' => 'display case'],
                    ['format' => 'medium collection', 'price_per_format' => 799.99, 'packaging' => 'premium display case'],
                    ['format' => 'large collection', 'price_per_format' => 1499.99, 'packaging' => 'luxury display case'],
                ],
                'Coal' => [
                    ['format' => 'ton', 'price_per_format' => 45.00, 'packaging' => 'bulk'],
                    ['format' => '5 tons', 'price_per_format' => 215.00, 'packaging' => 'bulk'],
                    ['format' => '20 tons', 'price_per_format' => 800.00, 'packaging' => 'bulk container'],
                ],
                'default' => [
                    ['format' => 'sample', 'price_per_format' => 100.00, 'packaging' => 'secure container'],
                    ['format' => 'bulk', 'price_per_format' => 500.00, 'packaging' => 'industrial packaging'],
                ],
            ],
            'Industrial Products' => [
                'Textiles' => [
                    ['format' => 'yard', 'price_per_format' => 28.75, 'packaging' => 'roll'],
                    ['format' => '10 yards', 'price_per_format' => 275.00, 'packaging' => 'roll'],
                    ['format' => '50 yards', 'price_per_format' => 1299.99, 'packaging' => 'industrial roll'],
                ],
                'Leather' => [
                    ['format' => 'sq ft', 'price_per_format' => 65.00, 'packaging' => 'roll'],
                    ['format' => '10 sq ft', 'price_per_format' => 625.00, 'packaging' => 'roll'],
                    ['format' => '50 sq ft', 'price_per_format' => 2999.99, 'packaging' => 'industrial roll'],
                ],
                'Plastics' => [
                    ['format' => 'sheet', 'price_per_format' => 42.50, 'packaging' => 'wrapped'],
                    ['format' => '10 sheets', 'price_per_format' => 399.99, 'packaging' => 'pallet'],
                    ['format' => '50 sheets', 'price_per_format' => 1899.99, 'packaging' => 'industrial pallet'],
                ],
                'default' => [
                    ['format' => 'unit', 'price_per_format' => 50.00, 'packaging' => 'industrial packaging'],
                    ['format' => 'bulk', 'price_per_format' => 450.00, 'packaging' => 'pallet'],
                ],
            ],
            'Automotive Components' => [
                'Auto Parts' => [
                    ['format' => 'basic kit', 'price_per_format' => 89.99, 'packaging' => 'box'],
                    ['format' => 'standard kit', 'price_per_format' => 149.99, 'packaging' => 'case'],
                    ['format' => 'premium kit', 'price_per_format' => 249.99, 'packaging' => 'professional case'],
                ],
                'Lubricants' => [
                    ['format' => '1L', 'price_per_format' => 32.50, 'packaging' => 'bottle'],
                    ['format' => '5L', 'price_per_format' => 149.99, 'packaging' => 'can'],
                    ['format' => '20L', 'price_per_format' => 549.99, 'packaging' => 'drum'],
                ],
                'Accessories' => [
                    ['format' => 'basic set', 'price_per_format' => 45.75, 'packaging' => 'box'],
                    ['format' => 'premium set', 'price_per_format' => 89.99, 'packaging' => 'case'],
                    ['format' => 'luxury set', 'price_per_format' => 149.99, 'packaging' => 'premium case'],
                ],
                'default' => [
                    ['format' => 'unit', 'price_per_format' => 40.00, 'packaging' => 'box'],
                    ['format' => 'set', 'price_per_format' => 120.00, 'packaging' => 'case'],
                ],
            ],
            'default' => [
                ['format' => 'unit', 'price_per_format' => 25.00, 'packaging' => 'standard'],
                ['format' => 'bulk', 'price_per_format' => 100.00, 'packaging' => 'industrial'],
            ],
        ];

        // Check if we have specific formats for this category
        if (isset($categoryFormats[$categoryName])) {
            $formats = $categoryFormats[$categoryName];

            // Check if we have specific formats for this product type
            foreach ($formats as $key => $formatList) {
                if ($key !== 'default' && stripos($productName, $key) !== false) {
                    return $formatList;
                }
            }

            // If no specific product match, return default for this category
            if (isset($formats['default'])) {
                return $formats['default'];
            }
        }

        // If no category match, return global default
        return $categoryFormats['default'] ?? $defaultFormats;
    }
}
