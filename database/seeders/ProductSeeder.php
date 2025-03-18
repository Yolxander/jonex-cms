<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductTranslation;
use function Symfony\Component\Translation\t;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define product categories based on the translation data
        $categories = [
            'food' => 'Food Products',
            'natural' => 'Natural and Medicinal Products',
            'raw' => 'Raw Materials',
            'minerals' => 'Minerals and Derivatives',
            'industrial' => 'Industrial Products',
            'automotive' => 'Automotive Components',
            'packaging' => 'Packaging Solutions',
            'machinery' => 'Machinery & Equipment',
            'software' => 'Software and Technology',
            'renewable' => 'Renewable Energy',
            'electronics' => 'Electronics',
            'medical' => 'Medical Equipment',
        ];

        // Create categories first
        $categoryModels = [];
        foreach ($categories as $slug => $name) {
            $category = Category::firstOrCreate([
                'name' => $name,
                'slug' => $slug,
                'live' => true
            ]);
            $categoryModels[$slug] = $category;
        }

        // Product data with translations
        $productData = [
            'food' => [
                'products' => [
                    ['name' => 'Premium Rice', 'sku' => 'FOOD-RICE-001', 'price' => 2.50],
                    ['name' => 'Refined Sugar', 'sku' => 'FOOD-SUGAR-001', 'price' => 1.75],
                    ['name' => 'All-Purpose Flour', 'sku' => 'FOOD-FLOUR-001', 'price' => 1.25],
                    ['name' => 'Extra Virgin Olive Oil', 'sku' => 'FOOD-OIL-001', 'price' => 15.99],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Food Products',
                        'subtitle' => 'Culinary Essentials',
                        'description' => 'Wide range including rice, sugar, flour, grains, oils, meats, fruits, vegetables, confectionery, and beverages.',
                    ],
                    'es' => [
                        'title' => 'Productos Alimenticios',
                        'subtitle' => 'Esenciales Culinarios',
                        'description' => 'Amplia gama que incluye arroz, azúcar, harina, granos, aceites, carnes, frutas, verduras, confitería y bebidas.',
                    ],
                ],
            ],
            'natural' => [
                'products' => [
                    ['name' => 'Aromatic Herbs Mix', 'sku' => 'NAT-HERB-001', 'price' => 8.75],
                    ['name' => 'Medicinal Plant Extract', 'sku' => 'NAT-PLANT-001', 'price' => 24.99],
                    ['name' => 'Essential Oils Set', 'sku' => 'NAT-OIL-001', 'price' => 45.50],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Natural and Medicinal Products',
                        'subtitle' => 'Wellness Solutions',
                        'description' => 'Aromatic herbs, medicinal plants, essential oils, natural cosmetics, and pharmaceutical products.',
                    ],
                    'es' => [
                        'title' => 'Productos Naturales y Medicinales',
                        'subtitle' => 'Soluciones de Bienestar',
                        'description' => 'Hierbas aromáticas, plantas medicinales, aceites esenciales, cosméticos naturales y productos farmacéuticos.',
                    ],
                ],
            ],
            'raw' => [
                'products' => [
                    ['name' => 'Exotic Flowers Bouquet', 'sku' => 'RAW-FLOW-001', 'price' => 18.50],
                    ['name' => 'Agricultural Supplies Kit', 'sku' => 'RAW-AGRI-001', 'price' => 120.00],
                    ['name' => 'Premium Animal Feed', 'sku' => 'RAW-FEED-001', 'price' => 35.75],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Raw Materials',
                        'subtitle' => 'Agricultural Supplies',
                        'description' => 'Flowers, agricultural supplies, animal feed, fertilizers, and raw materials for food and pharma production.',
                    ],
                    'es' => [
                        'title' => 'Materias Primas',
                        'subtitle' => 'Suministros Agrícolas',
                        'description' => 'Flores, suministros agrícolas, alimentos para animales, fertilizantes y materias primas para la producción de alimentos y farmacéutica.',
                    ],
                ],
            ],
            'minerals' => [
                'products' => [
                    ['name' => 'Precious Metals Sample', 'sku' => 'MIN-METAL-001', 'price' => 250.00],
                    ['name' => 'Gemstone Collection', 'sku' => 'MIN-GEM-001', 'price' => 375.50],
                    ['name' => 'Industrial Grade Coal', 'sku' => 'MIN-COAL-001', 'price' => 45.00],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Minerals and Derivatives',
                        'subtitle' => 'Resource Commodities',
                        'description' => 'Precious metals, gems, coal, petroleum, and their derivatives.',
                    ],
                    'es' => [
                        'title' => 'Minerales y Derivados',
                        'subtitle' => 'Recursos Básicos',
                        'description' => 'Metales preciosos, gemas, carbón, petróleo y sus derivados.',
                    ],
                ],
            ],
            'industrial' => [
                'products' => [
                    ['name' => 'Premium Textiles', 'sku' => 'IND-TEXT-001', 'price' => 28.75],
                    ['name' => 'Leather Materials', 'sku' => 'IND-LEATH-001', 'price' => 65.00],
                    ['name' => 'Industrial Plastics', 'sku' => 'IND-PLAST-001', 'price' => 42.50],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Industrial Products',
                        'subtitle' => 'Manufacturing Essentials',
                        'description' => 'Textiles, leather, plastics, chemicals, metals, wood products, construction materials, and industrial equipment.',
                    ],
                    'es' => [
                        'title' => 'Productos Industriales',
                        'subtitle' => 'Esenciales de Manufactura',
                        'description' => 'Textiles, cuero, plásticos, químicos, metales, productos de madera, materiales de construcción y equipos industriales.',
                    ],
                ],
            ],
            'automotive' => [
                'products' => [
                    ['name' => 'Auto Parts Kit', 'sku' => 'AUTO-PART-001', 'price' => 89.99],
                    ['name' => 'Premium Lubricants', 'sku' => 'AUTO-LUB-001', 'price' => 32.50],
                    ['name' => 'Vehicle Accessories', 'sku' => 'AUTO-ACC-001', 'price' => 45.75],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Automotive Components',
                        'subtitle' => 'Vehicle Parts',
                        'description' => 'Auto parts, accessories, lubricants, and specialized components for the automotive industry.',
                    ],
                    'es' => [
                        'title' => 'Componentes Automotrices',
                        'subtitle' => 'Partes de Vehículos',
                        'description' => 'Autopartes, accesorios, lubricantes y componentes especializados para la industria automotriz.',
                    ],
                ],
            ],
            'packaging' => [
                'products' => [
                    ['name' => 'Sustainable Packaging', 'sku' => 'PACK-SUS-001', 'price' => 18.25],
                    ['name' => 'Premium Containers', 'sku' => 'PACK-CONT-001', 'price' => 35.50],
                    ['name' => 'Shipping Solutions', 'sku' => 'PACK-SHIP-001', 'price' => 42.75],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Packaging Solutions',
                        'subtitle' => 'Protective Materials',
                        'description' => 'Sustainable packaging, containers, wrapping materials, and specialized shipping solutions.',
                    ],
                    'es' => [
                        'title' => 'Soluciones de Embalaje',
                        'subtitle' => 'Materiales Protectores',
                        'description' => 'Embalaje sostenible, contenedores, materiales de envoltura y soluciones especializadas de envío.',
                    ],
                ],
            ],
            'machinery' => [
                'products' => [
                    ['name' => 'Manufacturing Machinery', 'sku' => 'MACH-MAN-001', 'price' => 1250.00],
                    ['name' => 'Agricultural Equipment', 'sku' => 'MACH-AGRI-001', 'price' => 875.50],
                    ['name' => 'Processing Tools', 'sku' => 'MACH-TOOL-001', 'price' => 325.75],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Machinery & Equipment',
                        'subtitle' => 'Industrial Tools',
                        'description' => 'Manufacturing machinery, agricultural equipment, processing tools, and industrial automation systems.',
                    ],
                    'es' => [
                        'title' => 'Maquinaria y Equipo',
                        'subtitle' => 'Herramientas Industriales',
                        'description' => 'Maquinaria de fabricación, equipos agrícolas, herramientas de procesamiento y sistemas de automatización industrial.',
                    ],
                ],
            ],
            'software' => [
                'products' => [
                    ['name' => 'Business Software Solutions', 'sku' => 'SOFT-BUS-001', 'price' => 299.99],
                    ['name' => 'IT Services Package', 'sku' => 'SOFT-IT-001', 'price' => 499.50],
                    ['name' => 'Tech Innovation Suite', 'sku' => 'SOFT-TECH-001', 'price' => 799.00],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Software and Technology',
                        'subtitle' => 'Digital Solutions',
                        'description' => 'Software solutions, hardware products, IT services, and cutting-edge technological innovations.',
                    ],
                    'es' => [
                        'title' => 'Software y Tecnología',
                        'subtitle' => 'Soluciones Digitales',
                        'description' => 'Soluciones de software, productos de hardware, servicios de TI e innovaciones tecnológicas de vanguardia.',
                    ],
                ],
            ],
            'renewable' => [
                'products' => [
                    ['name' => 'Solar Panel Kit', 'sku' => 'REN-SOLAR-001', 'price' => 1250.00],
                    ['name' => 'Wind Turbine Components', 'sku' => 'REN-WIND-001', 'price' => 2750.50],
                    ['name' => 'Energy Storage Solutions', 'sku' => 'REN-STORE-001', 'price' => 1899.99],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Renewable Energy',
                        'subtitle' => 'Sustainable Power',
                        'description' => 'Solar panels, wind turbines, energy storage solutions, and eco-friendly power generation systems.',
                    ],
                    'es' => [
                        'title' => 'Energía Renovable',
                        'subtitle' => 'Energía Sostenible',
                        'description' => 'Paneles solares, turbinas eólicas, soluciones de almacenamiento de energía y sistemas de generación de energía ecológicos.',
                    ],
                ],
            ],
            'electronics' => [
                'products' => [
                    ['name' => 'Consumer Electronics', 'sku' => 'ELEC-CONS-001', 'price' => 299.99],
                    ['name' => 'Communication Devices', 'sku' => 'ELEC-COMM-001', 'price' => 199.50],
                    ['name' => 'Entertainment Systems', 'sku' => 'ELEC-ENT-001', 'price' => 499.00],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Electronics',
                        'subtitle' => 'Consumer Devices',
                        'description' => 'Consumer electronics, components, communication devices, and entertainment systems.',
                    ],
                    'es' => [
                        'title' => 'Electrónica',
                        'subtitle' => 'Dispositivos de Consumo',
                        'description' => 'Electrónica de consumo, componentes, dispositivos de comunicación y sistemas de entretenimiento.',
                    ],
                ],
            ],
            'medical' => [
                'products' => [
                    ['name' => 'Diagnostic Equipment', 'sku' => 'MED-DIAG-001', 'price' => 2499.99],
                    ['name' => 'Medical Devices', 'sku' => 'MED-DEV-001', 'price' => 1299.50],
                    ['name' => 'Laboratory Supplies', 'sku' => 'MED-LAB-001', 'price' => 799.00],
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Medical Equipment',
                        'subtitle' => 'Healthcare Technology',
                        'description' => 'Diagnostic equipment, medical devices, laboratory supplies, and healthcare technology solutions.',
                    ],
                    'es' => [
                        'title' => 'Equipo Médico',
                        'subtitle' => 'Tecnología Sanitaria',
                        'description' => 'Equipos de diagnóstico, dispositivos médicos, suministros de laboratorio y soluciones tecnológicas para el cuidado de la salud.',
                    ],
                ],
            ],
        ];

        // Create products and their translations
        foreach ($productData as $categorySlug => $data) {
            $category = $categoryModels[$categorySlug];

            foreach ($data['products'] as $productInfo) {
                // Create the product
                $product = Product::create([
                    'name' => $productInfo['name'],
                    'description' => $data['translations']['en']['description'], // Default description in English
                    'sku' => $productInfo['sku'],
                    'price' => $productInfo['price'],
                    'category_id' => $category->id,
                    'live' => true
                ]);

                // Create translations for the product
                foreach (['en', 'es'] as $locale) {
                    ProductTranslation::create([
                        'product_id' => $product->id,
                        'language' => $locale,
                        'title' => $locale === 'en' ? $productInfo['name'] : $this->translateProductName($productInfo['name'], $locale),
                        'description' => $data['translations'][$locale]['description'],
                        'subtitle' => $data['translations'][$locale]['subtitle'],
                    ]);
                }
            }
        }
    }

    /**
     * Simple function to simulate translation of product names to Spanish
     * In a real application, you would use a translation service or have actual translations
     *
     * @param string $name
     * @param string $locale
     * @return string
     */
    private function translateProductName($name, $locale)
    {
        if ($locale !== 'es') {
            return $name;
        }

        // Simple mapping for demonstration purposes
        $translations = [
            'Premium Rice' => 'Arroz Premium',
            'Refined Sugar' => 'Azúcar Refinada',
            'All-Purpose Flour' => 'Harina Multiusos',
            'Extra Virgin Olive Oil' => 'Aceite de Oliva Extra Virgen',
            'Aromatic Herbs Mix' => 'Mezcla de Hierbas Aromáticas',
            'Medicinal Plant Extract' => 'Extracto de Plantas Medicinales',
            'Essential Oils Set' => 'Set de Aceites Esenciales',
            'Exotic Flowers Bouquet' => 'Ramo de Flores Exóticas',
            'Agricultural Supplies Kit' => 'Kit de Suministros Agrícolas',
            'Premium Animal Feed' => 'Alimento Premium para Animales',
            'Precious Metals Sample' => 'Muestra de Metales Preciosos',
            'Gemstone Collection' => 'Colección de Piedras Preciosas',
            'Industrial Grade Coal' => 'Carbón de Grado Industrial',
            'Premium Textiles' => 'Textiles Premium',
            'Leather Materials' => 'Materiales de Cuero',
            'Industrial Plastics' => 'Plásticos Industriales',
            'Auto Parts Kit' => 'Kit de Autopartes',
            'Premium Lubricants' => 'Lubricantes Premium',
            'Vehicle Accessories' => 'Accesorios para Vehículos',
            'Sustainable Packaging' => 'Embalaje Sostenible',
            'Premium Containers' => 'Contenedores Premium',
            'Shipping Solutions' => 'Soluciones de Envío',
            'Manufacturing Machinery' => 'Maquinaria de Fabricación',
            'Agricultural Equipment' => 'Equipo Agrícola',
            'Processing Tools' => 'Herramientas de Procesamiento',
            'Business Software Solutions' => 'Soluciones de Software Empresarial',
            'IT Services Package' => 'Paquete de Servicios de TI',
            'Tech Innovation Suite' => 'Suite de Innovación Tecnológica',
            'Solar Panel Kit' => 'Kit de Paneles Solares',
            'Wind Turbine Components' => 'Componentes de Turbinas Eólicas',
            'Energy Storage Solutions' => 'Soluciones de Almacenamiento de Energía',
            'Consumer Electronics' => 'Electrónica de Consumo',
            'Communication Devices' => 'Dispositivos de Comunicación',
            'Entertainment Systems' => 'Sistemas de Entretenimiento',
            'Diagnostic Equipment' => 'Equipo de Diagnóstico',
            'Medical Devices' => 'Dispositivos Médicos',
            'Laboratory Supplies' => 'Suministros de Laboratorio',
        ];

        return $translations[$name] ?? $name . ' (ES)';
    }
}
