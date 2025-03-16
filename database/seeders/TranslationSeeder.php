<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Translation;

class TranslationSeeder extends Seeder
{
    public function run()
    {
        $translations = [
            'nav' => [
                'en' => [
                    'nav.home' => 'Home',
                    'nav.services' => 'Services',
                    'nav.products' => 'Products',
                    'nav.capabilities' => 'Capabilities',
                    'nav.promise' => 'Our Promise',
                    'nav.contact' => 'Contact',
                    'nav.language' => 'Español',
                ],
                'es' => [
                    'nav.home' => 'Inicio',
                    'nav.services' => 'Servicios',
                    'nav.products' => 'Productos',
                    'nav.capabilities' => 'Capacidades',
                    'nav.promise' => 'Nuestra Promesa',
                    'nav.contact' => 'Contacto',
                    'nav.language' => 'English',
                ]
            ],
            'hero' => [
                'en' => [
                    'hero.import' => 'Import',
                    'hero.export' => '& Export',
                    'hero.description1' => 'We bridge gaps for businesses and customers in Latin America looking for high-quality Canadian products and services, ensuring efficient and reliable supply chains across diverse industries.',
                    'hero.description2' => 'We identify specific products, industries, and markets in Latin America with the greatest potential for growth and success, enabling Canadian businesses to capitalize on emerging opportunities.',
                    'hero.explore' => 'Explore More',
                ],
                'es' => [
                    'hero.import' => 'Importación',
                    'hero.export' => 'y Exportación',
                    'hero.description1' => 'Conectamos empresas y clientes en América Latina que buscan productos y servicios canadienses de alta calidad, asegurando cadenas de suministro eficientes y confiables en diversas industrias.',
                    'hero.description2' => 'Identificamos productos, industrias y mercados específicos en América Latina con el mayor potencial de crecimiento y éxito, permitiendo a las empresas canadienses capitalizar oportunidades emergentes.',
                    'hero.explore' => 'Explorar Más',
                ]
            ],
            'services' => [
                'en' => [
                    'services.importExport' => 'Import/Export',
                    'services.warehousing' => 'Warehousing',
                    'services.freight' => 'Freight',
                    'services.facilitation' => 'Facilitation',
                    'services.distribution' => 'and Distribution',
                    'services.forwarding' => 'Forwarding',
                    'services.importExportDesc' => 'We specialize in facilitating seamless import and export operations between Canada and Latin America. Our expertise covers a wide range of products, ensuring compliance with international trade regulations and optimizing the flow of goods across borders.',
                    'services.warehousingDesc' => 'Our strategic warehousing locations in Canada and key Latin American countries allow for efficient storage and distribution of your products. We offer inventory management services to ensure your goods are always available when and where they\'re needed.',
                    'services.freightDesc' => 'We provide comprehensive freight forwarding services, managing the transportation of your goods via air, sea, and land. Our established network of carriers ensures reliable and cost-effective shipping solutions between Canada and Latin America.',
                    'services.orderForm' => 'Product Order Form',
                    'services.formDesc' => 'Fill out the form below to order products or request a quote for our import/export services.',
                    'services.quantity' => 'Quantity',
                    'services.enterQuantity' => 'Enter quantity',
                    'services.category' => 'Product Category',
                    'services.selectCategory' => 'Select product category',
                    'services.product' => 'Product',
                    'services.selectProduct' => 'Select product',
                    'services.totalQuote' => 'Total Quote:',
                    'services.getQuote' => 'Get Quote',
                    'services.emailQuote' => 'Email for Quote',
                    'services.enterEmail' => 'Enter your email',
                    'services.submitQuote' => 'Submit Quote Request',
                    'services.processing' => 'Processing...',
                    'services.quoteReceived' => 'Quote Request Received',
                ],
                'es' => [
                    'services.importExport' => 'Importación/Exportación',
                    'services.warehousing' => 'Almacenamiento',
                    'services.freight' => 'Transporte',
                    'services.facilitation' => 'Facilitación',
                    'services.distribution' => 'y Distribución',
                    'services.forwarding' => 'de Carga',
                    'services.importExportDesc' => 'Nos especializamos en facilitar operaciones fluidas de importación y exportación entre Canadá y América Latina. Nuestra experiencia abarca una amplia gama de productos, asegurando el cumplimiento de las regulaciones comerciales internacionales y optimizando el flujo de mercancías a través de las fronteras.',
                    'services.warehousingDesc' => 'Nuestras ubicaciones estratégicas de almacenamiento en Canadá y países clave de América Latina permiten un almacenamiento y distribución eficientes de sus productos. Ofrecemos servicios de gestión de inventario para garantizar que sus productos estén siempre disponibles cuando y donde se necesiten.',
                    'services.freightDesc' => 'Proporcionamos servicios integrales de transporte de carga, gestionando el transporte de sus mercancías por aire, mar y tierra. Nuestra establecida red de transportistas garantiza soluciones de envío confiables y rentables entre Canadá y América Latina.',
                    'services.orderForm' => 'Formulario de Pedido',
                    'services.formDesc' => 'Complete el formulario a continuación para solicitar productos o pedir una cotización para nuestros servicios de importación/exportación.',
                    'services.quantity' => 'Cantidad',
                    'services.enterQuantity' => 'Ingrese cantidad',
                    'services.category' => 'Categoría de Producto',
                    'services.selectCategory' => 'Seleccione categoría',
                    'services.product' => 'Producto',
                    'services.selectProduct' => 'Seleccione producto',
                    'services.totalQuote' => 'Cotización Total:',
                    'services.getQuote' => 'Obtener Cotización',
                    'services.emailQuote' => 'Email para Cotización',
                    'services.enterEmail' => 'Ingrese su email',
                    'services.submitQuote' => 'Enviar Solicitud',
                    'services.processing' => 'Procesando...',
                    'services.quoteReceived' => 'Solicitud Recibida',
                ]
            ],
            'products' => [
                'en' => [
                    'products.title' => 'Products',
                    'products.seeAll' => 'See All',
                    // Food Products
                    'products.food.title' => 'Food Products',
                    'products.food.subtitle' => 'Culinary Essentials',
                    'products.food.description' => 'Wide range including rice, sugar, flour, grains, oils, meats, fruits, vegetables, confectionery, and beverages.',
                    // Natural Products
                    'products.natural.title' => 'Natural and Medicinal Products',
                    'products.natural.subtitle' => 'Wellness Solutions',
                    'products.natural.description' => 'Aromatic herbs, medicinal plants, essential oils, natural cosmetics, and pharmaceutical products.',
                    // Raw Materials
                    'products.raw.title' => 'Raw Materials',
                    'products.raw.subtitle' => 'Agricultural Supplies',
                    'products.raw.description' => 'Flowers, agricultural supplies, animal feed, fertilizers, and raw materials for food and pharma production.',
                    // Minerals
                    'products.minerals.title' => 'Minerals and Derivatives',
                    'products.minerals.subtitle' => 'Resource Commodities',
                    'products.minerals.description' => 'Precious metals, gems, coal, petroleum, and their derivatives.',
                    // Industrial Products
                    'products.industrial.title' => 'Industrial Products',
                    'products.industrial.subtitle' => 'Manufacturing Essentials',
                    'products.industrial.description' => 'Textiles, leather, plastics, chemicals, metals, wood products, construction materials, and industrial equipment.',
                    // Automotive
                    'products.automotive.title' => 'Automotive Components',
                    'products.automotive.subtitle' => 'Vehicle Parts',
                    'products.automotive.description' => 'Auto parts, accessories, lubricants, and specialized components for the automotive industry.',
                    // Packaging
                    'products.packaging.title' => 'Packaging Solutions',
                    'products.packaging.subtitle' => 'Protective Materials',
                    'products.packaging.description' => 'Sustainable packaging, containers, wrapping materials, and specialized shipping solutions.',
                    // Machinery
                    'products.machinery.title' => 'Machinery & Equipment',
                    'products.machinery.subtitle' => 'Industrial Tools',
                    'products.machinery.description' => 'Manufacturing machinery, agricultural equipment, processing tools, and industrial automation systems.',
                    // Software
                    'products.software.title' => 'Software and Technology',
                    'products.software.subtitle' => 'Digital Solutions',
                    'products.software.description' => 'Software solutions, hardware products, IT services, and cutting-edge technological innovations.',
                    // Renewable
                    'products.renewable.title' => 'Renewable Energy',
                    'products.renewable.subtitle' => 'Sustainable Power',
                    'products.renewable.description' => 'Solar panels, wind turbines, energy storage solutions, and eco-friendly power generation systems.',
                    // Electronics
                    'products.electronics.title' => 'Electronics',
                    'products.electronics.subtitle' => 'Consumer Devices',
                    'products.electronics.description' => 'Consumer electronics, components, communication devices, and entertainment systems.',
                    // Medical
                    'products.medical.title' => 'Medical Equipment',
                    'products.medical.subtitle' => 'Healthcare Technology',
                    'products.medical.description' => 'Diagnostic equipment, medical devices, laboratory supplies, and healthcare technology solutions.',
                ],
                'es' => [
                    'products.title' => 'Productos',
                    'products.seeAll' => 'Ver Todos',
                    // Food Products
                    'products.food.title' => 'Productos Alimenticios',
                    'products.food.subtitle' => 'Esenciales Culinarios',
                    'products.food.description' => 'Amplia gama que incluye arroz, azúcar, harina, granos, aceites, carnes, frutas, verduras, confitería y bebidas.',
                    // Natural Products
                    'products.natural.title' => 'Productos Naturales y Medicinales',
                    'products.natural.subtitle' => 'Soluciones de Bienestar',
                    'products.natural.description' => 'Hierbas aromáticas, plantas medicinales, aceites esenciales, cosméticos naturales y productos farmacéuticos.',
                    // Raw Materials
                    'products.raw.title' => 'Materias Primas',
                    'products.raw.subtitle' => 'Suministros Agrícolas',
                    'products.raw.description' => 'Flores, suministros agrícolas, alimentos para animales, fertilizantes y materias primas para la producción de alimentos y farmacéutica.',
                    // Minerals
                    'products.minerals.title' => 'Minerales y Derivados',
                    'products.minerals.subtitle' => 'Recursos Básicos',
                    'products.minerals.description' => 'Metales preciosos, gemas, carbón, petróleo y sus derivados.',
                    // Industrial Products
                    'products.industrial.title' => 'Productos Industriales',
                    'products.industrial.subtitle' => 'Esenciales de Manufactura',
                    'products.industrial.description' => 'Textiles, cuero, plásticos, químicos, metales, productos de madera, materiales de construcción y equipos industriales.',
                    // Automotive
                    'products.automotive.title' => 'Componentes Automotrices',
                    'products.automotive.subtitle' => 'Partes de Vehículos',
                    'products.automotive.description' => 'Autopartes, accesorios, lubricantes y componentes especializados para la industria automotriz.',
                    // Packaging
                    'products.packaging.title' => 'Soluciones de Embalaje',
                    'products.packaging.subtitle' => 'Materiales Protectores',
                    'products.packaging.description' => 'Embalaje sostenible, contenedores, materiales de envoltura y soluciones especializadas de envío.',
                    // Machinery
                    'products.machinery.title' => 'Maquinaria y Equipo',
                    'products.machinery.subtitle' => 'Herramientas Industriales',
                    'products.machinery.description' => 'Maquinaria de fabricación, equipos agrícolas, herramientas de procesamiento y sistemas de automatización industrial.',
                    // Software
                    'products.software.title' => 'Software y Tecnología',
                    'products.software.subtitle' => 'Soluciones Digitales',
                    'products.software.description' => 'Soluciones de software, productos de hardware, servicios de TI e innovaciones tecnológicas de vanguardia.',
                    // Renewable
                    'products.renewable.title' => 'Energía Renovable',
                    'products.renewable.subtitle' => 'Energía Sostenible',
                    'products.renewable.description' => 'Paneles solares, turbinas eólicas, soluciones de almacenamiento de energía y sistemas de generación de energía ecológicos.',
                    // Electronics
                    'products.electronics.title' => 'Electrónica',
                    'products.electronics.subtitle' => 'Dispositivos de Consumo',
                    'products.electronics.description' => 'Electrónica de consumo, componentes, dispositivos de comunicación y sistemas de entretenimiento.',
                    // Medical
                    'products.medical.title' => 'Equipo Médico',
                    'products.medical.subtitle' => 'Tecnología Sanitaria',
                    'products.medical.description' => 'Equipos de diagnóstico, dispositivos médicos, suministros de laboratorio y soluciones tecnológicas para el cuidado de la salud.',
                ]
            ],
            'capabilities' => [
                'en' => [
                    'capabilities.title' => 'Our Capabilities',
                    'capabilities.subtitle' => '& Expertise',
                    'capabilities.expertTeam' => 'Expert Team',
                    'capabilities.teamMembers' => '25+ Team Members',
                    'capabilities.toronto' => 'Toronto, Canada',
                    'capabilities.teamDesc' => 'Our team consists of dedicated professionals with deep market knowledge in both Canadian and Latin American markets. With expertise spanning various industries and product categories, our specialists provide invaluable insights and guidance to businesses looking to expand their reach across borders. Each team member brings unique regional expertise and industry connections to help navigate complex international trade requirements.',
                    'capabilities.partnerships' => 'Strategic Partnerships',
                    'capabilities.partners' => '3+ Strategic Partners',
                    'capabilities.latinAmerica' => 'Latin America',
                    'capabilities.partnershipsDesc' => 'We\'ve established strong relationships with key partners throughout Latin America, creating a robust network that facilitates seamless trade operations. These strategic alliances with local distributors, logistics providers, and regulatory experts enable us to overcome regional challenges and capitalize on emerging opportunities. Our partnerships provide our clients with reliable local representation and market access across the region.',
                    'capabilities.coverage' => 'Market Coverage',
                    'capabilities.countries' => '3+ Countries Served',
                    'capabilities.coverageDesc' => 'We maintain an active presence in major Latin American markets, ensuring comprehensive coverage and local expertise. Our operations span multiple countries, allowing us to identify regional trends and market-specific opportunities. This extensive coverage enables us to connect Canadian businesses with the most promising markets for their products and services, while providing valuable insights into local consumer preferences and regulatory requirements.',
                    'capabilities.hub' => 'Toronto Hub',
                    'capabilities.hq' => 'Toronto, Canada HQ',
                    'capabilities.northAmerica' => 'North America',
                    'capabilities.hubDesc' => 'Our centralized operations in Toronto serve as the strategic hub connecting North and South America. This prime location allows us to efficiently coordinate import and export activities between Canada and Latin American countries. Our Toronto headquarters houses our core team of trade specialists, logistics coordinators, and market analysts who work together to ensure smooth operations and exceptional service for all our clients.',
                    'capabilities.capacity' => 'Capacity',
                    'capabilities.region' => 'Region',
                    'capabilities.learnMore' => 'Learn More',
                ],
                'es' => [
                    'capabilities.title' => 'Nuestras Capacidades',
                    'capabilities.subtitle' => 'y Experiencia',
                    'capabilities.expertTeam' => 'Equipo Experto',
                    'capabilities.teamMembers' => '25+ Miembros',
                    'capabilities.toronto' => 'Toronto, Canadá',
                    'capabilities.teamDesc' => 'Nuestro equipo está formado por profesionales dedicados con profundo conocimiento del mercado tanto en Canadá como en América Latina. Con experiencia en diversas industrias y categorías de productos, nuestros especialistas brindan información y orientación invaluables a empresas que buscan expandir su alcance a través de las fronteras. Cada miembro del equipo aporta experiencia regional única y conexiones en la industria para ayudar a navegar por los complejos requisitos del comercio internacional.',
                    'capabilities.partnerships' => 'Alianzas Estratégicas',
                    'capabilities.partners' => '3+ Socios Estratégicos',
                    'capabilities.latinAmerica' => 'América Latina',
                    'capabilities.partnershipsDesc' => 'Hemos establecido relaciones sólidas con socios clave en toda América Latina, creando una red robusta que facilita operaciones comerciales fluidas. Estas alianzas estratégicas con distribuidores locales, proveedores de logística y expertos en regulación nos permiten superar desafíos regionales y capitalizar oportunidades emergentes. Nuestras asociaciones brindan a nuestros clientes representación local confiable y acceso al mercado en toda la región.',
                    'capabilities.coverage' => 'Cobertura de Mercado',
                    'capabilities.countries' => '3+ Países Atendidos',
                    'capabilities.coverageDesc' => 'Mantenemos una presencia activa en los principales mercados latinoamericanos, asegurando una cobertura integral y experiencia local. Nuestras operaciones abarcan múltiples países, lo que nos permite identificar tendencias regionales y oportunidades específicas del mercado. Esta amplia cobertura nos permite conectar empresas canadienses con los mercados más prometedores para sus productos y servicios, al tiempo que proporcionamos información valiosa sobre las preferencias de los consumidores locales y los requisitos regulatorios.',
                    'capabilities.hub' => 'Centro en Toronto',
                    'capabilities.hq' => 'Sede en Toronto, Canadá',
                    'capabilities.northAmerica' => 'América del Norte',
                    'capabilities.hubDesc' => 'Nuestras operaciones centralizadas en Toronto sirven como centro estratégico que conecta América del Norte y del Sur. Esta ubicación privilegiada nos permite coordinar eficientemente las actividades de importación y exportación entre Canadá y los países latinoamericanos. Nuestra sede de Toronto alberga nuestro equipo central de especialistas en comercio, coordinadores de logística y analistas de mercado que trabajan juntos para garantizar operaciones fluidas y un servicio excepcional para todos nuestros clientes.',
                    'capabilities.capacity' => 'Capacidad',
                    'capabilities.region' => 'Región',
                    'capabilities.learnMore' => 'Más Información',
                ]
            ],
            'stats' => [
                'en' => [
                    'stats.our' => 'Our',
                    'stats.promise' => 'Our Promise to You',
                    'stats.promiseDesc' => 'We are committed to excellence, sustainability, and creating value for all stakeholders in the Latin American market. Our goal is to foster long-term partnerships based on trust, transparency, and mutual growth for Canadian businesses expanding into Latin America.',
                    'stats.connecting' => 'Connecting',
                    'stats.canada' => 'Canada &',
                    'stats.latinAmerica' => 'Latin America',
                    'stats.mission' => 'Mission',
                    'stats.missionDesc' => 'Our mission is to bridge the gap between Canadian businesses and Latin American markets through sustainable, ethical, and efficient import/export solutions. We identify opportunities, navigate complexities, and build lasting partnerships that benefit both regions while maintaining our commitment to environmental responsibility in all operations.',
                    'stats.satisfaction' => 'Client Satisfaction',
                    'stats.latinPartners' => 'Latin American Partners',
                    'stats.sustainable' => 'Sustainable Partners',
                    'stats.years' => 'Years in Latin America',
                ],
                'es' => [
                    'stats.our' => 'Nuestra',
                    'stats.promise' => 'Promesa para Ti',
                    'stats.promiseDesc' => 'Estamos comprometidos con la excelencia, la sostenibilidad y la creación de valor para todas las partes interesadas en el mercado latinoamericano. Nuestro objetivo es fomentar asociaciones a largo plazo basadas en la confianza, la transparencia y el crecimiento mutuo para las empresas canadienses que se expanden a América Latina.',
                    'stats.connecting' => 'Conectando',
                    'stats.canada' => 'Canadá y',
                    'stats.latinAmerica' => 'América Latina',
                    'stats.mission' => 'Misión',
                    'stats.missionDesc' => 'Nuestra misión es cerrar la brecha entre las empresas canadienses y los mercados latinoamericanos a través de soluciones de importación/exportación sostenibles, éticas y eficientes. Identificamos oportunidades, navegamos por complejidades y construimos asociaciones duraderas que benefician a ambas regiones mientras mantenemos nuestro compromiso con la responsabilidad ambiental en todas las operaciones.',
                    'stats.satisfaction' => 'Satisfacción del Cliente',
                    'stats.latinPartners' => 'Socios Latinoamericanos',
                    'stats.sustainable' => 'Socios Sostenibles',
                    'stats.years' => 'Años en América Latina',
                ]
            ],
            'footer' => [
                'en' => [
                    'footer.address' => 'Address',
                    'footer.addressValue' => '47 W 13th St, New York, NY 10011, USA',
                    'footer.mail' => 'Mail',
                    'footer.mailValue' => 'PeterThornton@gmail.com',
                    'footer.telephone' => 'Telephone',
                    'footer.telephoneValue' => '8542546781',
                    'footer.instagram' => 'Instagram',
                    'footer.instagramValue' => '@hsdgsff.hujghf',
                    'footer.facebook' => 'Facebook',
                    'footer.facebookValue' => 'sdgsff.hujghf',
                    'footer.getInTouch' => 'Get In Touch',
                    'footer.getInTouchDesc' => 'Have questions about our services or products? Send us a message and we\'ll get back to you as soon as possible.',
                    'footer.name' => 'Name',
                    'footer.yourName' => 'Your name',
                    'footer.email' => 'Email',
                    'footer.yourEmail' => 'Your email',
                    'footer.message' => 'Message',
                    'footer.yourMessage' => 'Your message',
                    'footer.sendMessage' => 'Send Message',
                    'footer.sending' => 'Sending...',
                    'footer.messageSent' => 'Message Sent!',
                    'footer.home' => 'Home',
                    'footer.services' => 'Services',
                    'footer.howItWorks' => 'How it\'s Work',
                    'footer.contactUs' => 'Contact Us',
                    'footer.partners' => 'Partners',
                    'footer.careers' => 'Careers',
                    'footer.rights' => 'All rights reserved',
                ],
                'es' => [
                    'footer.address' => 'Dirección',
                    'footer.addressValue' => '47 W 13th St, Nueva York, NY 10011, EE.UU.',
                    'footer.mail' => 'Correo',
                    'footer.mailValue' => 'PeterThornton@gmail.com',
                    'footer.telephone' => 'Teléfono',
                    'footer.telephoneValue' => '8542546781',
                    'footer.instagram' => 'Instagram',
                    'footer.instagramValue' => '@hsdgsff.hujghf',
                    'footer.facebook' => 'Facebook',
                    'footer.facebookValue' => 'sdgsff.hujghf',
                    'footer.getInTouch' => 'Contáctanos',
                    'footer.getInTouchDesc' => '¿Tienes preguntas sobre nuestros servicios o productos? Envíanos un mensaje y te responderemos lo antes posible.',
                    'footer.name' => 'Nombre',
                    'footer.yourName' => 'Tu nombre',
                    'footer.email' => 'Email',
                    'footer.yourEmail' => 'Tu email',
                    'footer.message' => 'Mensaje',
                    'footer.yourMessage' => 'Tu mensaje',
                    'footer.sendMessage' => 'Enviar Mensaje',
                    'footer.sending' => 'Enviando...',
                    'footer.messageSent' => '¡Mensaje Enviado!',
                    'footer.home' => 'Inicio',
                    'footer.services' => 'Servicios',
                    'footer.howItWorks' => 'Cómo Funciona',
                    'footer.contactUs' => 'Contáctanos',
                    'footer.partners' => 'Socios',
                    'footer.careers' => 'Carreras',
                    'footer.rights' => 'Todos los derechos reservados',
                ]
            ],
            'mobile' => [
                'en' => [
                    'mobile.home' => 'Home',
                    'mobile.services' => 'Services',
                    'mobile.products' => 'Products',
                    'mobile.capabilities' => 'Capabilities',
                    'mobile.promise' => 'Our Promise',
                    'mobile.contact' => 'Contact',
                    'mobile.language' => 'Español',
                ],
                'es' => [
                    'mobile.home' => 'Inicio',
                    'mobile.services' => 'Servicios',
                    'mobile.products' => 'Productos',
                    'mobile.capabilities' => 'Capacidades',
                    'mobile.promise' => 'Nuestra Promesa',
                    'mobile.contact' => 'Contacto',
                    'mobile.language' => 'English',
                ]
            ]
        ];

        // Loop through all translation sections
        foreach ($translations as $sectionName => $languages) {
            // Find or create the section
            $section = Section::firstOrCreate(['name' => $sectionName]);

            foreach ($languages as $lang => $items) {
                foreach ($items as $key => $value) {
                    Translation::updateOrCreate(
                        [
                            'section_id' => $section->id,
                            'language' => $lang,
                            'key' => $key
                        ],
                        [
                            'value' => $value
                        ]
                    );
                }
            }
        }
    }
}
