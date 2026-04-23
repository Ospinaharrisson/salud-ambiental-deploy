<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Árbol base de breadcrumbs del panel administrativo
    |--------------------------------------------------------------------------
    | Estructura jerárquica que representa el contexto de cada sección del
    | panel. Cada nodo puede tener hijos (children) que definen sus submódulos.
    | Claves posibles en cada nodo:
    | - label: texto mostrado en el breadcrumb
    | - route: nombre base de la ruta (sin acción)
    | - model: clase asociada (string)
    | - param: nombre del parámetro en la URL (si aplica)
    | - children: subnodos (array)
    |--------------------------------------------------------------------------
    */

    'tree' => [

        // Nodo raíz del panel
        'admin' => [
            'label' => 'Administrador',
            'route' => 'admin.index',
            'model' => null,
            'param' => null,

            'children' => [

                // Contenido principal
                'home' => [
                    'label' => 'Contenido principal',
                    'route' => 'admin.home',
                    'model' => null,
                    'param' => null,
                    'children' => [
                        'article' => [
                            'label' => 'Noticias',
                            'route' => 'admin.home.article',
                            'model' => 'App\Models\Shared\Content\Article',
                            'param' => 'id',
                        ],
                        'banner' => [
                            'label' => 'banner principal',
                            'route' => 'admin.home.article',
                            'model' => 'App\Models\Shared\Content\Banner',
                            'param' => 'id',
                        ],
                        'media'=> [
                            'label'=> 'Muro social',
                            'route' => 'admin.home.media',
                            'model' => 'App\Models\Shared\Content\MediaGallery',
                            'param' => 'id'
                        ],
                        'featured'=> [
                            'label' => 'indicador destacado',
                            'route' => 'admin.home.featured',
                            'model' => 'App\Models\Shared\Content\FeaturedImage',
                            'param' => 'id'
                        ],
                        'insight' => [
                            'label' => 'indicadores del cilma',
                            'route' => 'admin.home.insight',
                            'model' => 'App\Models\Shared\Content\WeatherInsight',
                            'param' => 'id'
                        ],
                        'collection' => [
                            'label' => 'puntos de recolección',
                            'route' => 'admin.home.collection',
                            'model' => 'App\Models\Shared\Content\CollectionPoint',
                            'param' => 'id'
                        ],
                        'calendar' => [
                            'label' => 'calendario de eventos',
                            'route' => 'admin.home.calendar',
                            'model' => 'App\Models\Shared\Content\CalendarEvent',
                            'param' => 'id'
                        ],
                        'page' => [
                            'label' => 'Pagina principal',
                            'route' => 'admin.home.page',
                            'model' => 'App\Models\Shared\Home\HomePage',
                            'param' => 'id'
                        ],
                        'app' => [
                            'label' => 'Botones destacados',
                            'route' => 'admin.home.app',
                            'model' => 'App\Models\Shared\Content\AppButton',
                            'param' => 'id'
                        ],
                        'establishment' => [
                            'label' => 'Negocios saludables',
                            'route' => 'admin.home.establishment',
                            'model' => 'App\Models\Shared\Content\EstablishmentButton',
                            'param' => 'id'
                        ],
                        'line' => [
                            'label' => 'Lineas de interes',
                            'route' => 'admin.home.line',
                            'model' => 'App\Models\Shared\Content\LineOfInterest',
                            'param' => 'id'
                        ],
                        'module' => [
                            'label' => 'Menús del sistema',
                            'route' => 'admin.home.module',
                            'model' => 'App\Models\Shared\Home\Module',
                            'param' => 'id'
                        ],
                        'message' => [
                            'label' => 'Mensajes de usuarios',
                            'route' => 'admin.home.message',
                            'model' => 'App\Models\Shared\Home\UserMessage',
                            'param' => 'id'
                        ],
                        'district' => [
                            'label' => 'Distritos del sistema',
                            'route' => 'admin.home.district',
                            'model' => 'App\Models\Shared\Home\Module',
                            'param' => 'id'
                        ],
                        'network' => [
                            'label' => 'Redes de hospitales',
                            'route' => 'admin.home.network',
                            'model' => 'App\Models\Shared\Content\HealthNetwork',
                            'param' => 'id'
                        ],
                        'gallery' => [
                            'label' => 'Galerias',
                            'route' => 'admin.home.gallery',
                            'model' => 'App\Models\Shared\Home\GalleryEvent',
                            'param' => 'event_id',
                            'children' => [
                                'images' => [
                                    'label' => 'Imagenes',
                                    'route' => 'admin.home.gallery.images',
                                    'model' => 'App\Models\Shared\Home\GalleryImage',
                                    'param' => 'image_id',
                                ]
                            ]
                        ],
                        'video' => [
                            'label' => 'video principal',
                            'route' => 'admin.home.video',
                            'model' => 'App\Models\Shared\Home\HomeVideo',
                            'param' => 'id'
                        ]
                    ],
                ],

                // Temas
                'themes' => [
                    'label' => 'Temas',
                    'route' => 'admin.themes',
                    'model' => 'App\\Models\\Shared\\Home\\Module',
                    'param' => 'module',
                    'children' => [
                        'banner' => [
                            'label' => 'Banner del menú',
                            'route' => 'admin.themes.banner',
                            'model' => 'App\Models\Shared\Themes\ModuleBanner',
                            'param' => 'banner_id'
                        ],
                        'buttons' => [
                            'label' => 'Botones del menú',
                            'route' => 'admin.themes.buttons',
                            'model' => 'App\Models\Shared\Themes\ModuleButton',
                            'param' => 'button_id'
                        ],
                        'page' => [
                            'label' => 'paginas',
                            'route' => 'admin.themes.page',
                            'model' => 'App\Models\Shared\Themes\Page',
                            'param' => 'page_id',
                            'children' => [
                                'categories' => [
                                    'label' => 'categorias',
                                    'route' => 'admin.themes.page.categories',
                                    'model' => 'App\Models\Shared\Themes\PageAssetCategory',
                                    'param' => 'category_id',
                                    'children' => [
                                        'asset' => [
                                            'label' => 'archivos',
                                            'route' => 'admin.themes.page.categories.asset',
                                            'model' => 'App\Models\Shared\Content\PageAsset',
                                            'param' => 'asset_id'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'record' => [
                            'label' => 'Catálogo químico',
                            'route' => 'admin.themes.record',
                            'model' => 'App\Models\Shared\Themes\RecordsPage',
                            'param' => 'page_id',
                            'children' => [
                                'item' => [
                                    'label' => 'registros',
                                    'route' => 'admin.themes.record.item',
                                    'model' => 'App\Models\Shared\Themes\ChemicalItem',
                                    'param' => 'item_id',
                                ],
                            ]
                        ],
                        'questions' => [
                            'label' => 'preguntas relacionadas',
                            'route' => 'admin.themes.questions',
                            'model' => 'App\Models\Shared\Themes\ModuleQuestion',
                            'param' => 'question_id'
                        ],
                        'accredited' => [
                            'label' => 'establecimientos acreditados',
                            'route' => 'admin.themes.accredited',
                            'model' => 'App\Models\Shared\Content\EstablishmentAsset',
                            'param' => 'accredited_id'
                        ],
                        'favorable' => [
                            'label' => 'establecimientos favorables',
                            'route' => 'admin.themes.favorable',
                            'model' => 'App\Models\Shared\Content\EstablishmentAsset',
                            'param' => 'favorable_id'
                        ],
                        'navigation' => [
                            'label' => 'Listado de navegación',
                            'route' => 'admin.themes.navigation',
                            'model' => 'App\Models\Shared\Themes\NavCollection',
                            'param' => 'collection_id',
                            'children' => [
                                'entries' => [    
                                    'label' => 'archivos',
                                    'route' => 'admin.themes.navigation.entries',
                                    'model' => 'App\Models\Shared\Content\NavEntry',
                                    'param' => 'entry_id'
                                ]
                            ]
                        ]
                    ],
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Reglas globales para etiquetas dinámicas
    |--------------------------------------------------------------------------
    | Estas reglas aplican automáticamente cuando el nombre de la ruta contiene
    | ciertos sufijos como "create" o "edit".
    |--------------------------------------------------------------------------
    */

    'rules' => [

        'create' => [
            'label' => 'Crear',
            'callback' => null,
        ],

        'edit' => [
            'label' => 'Editar',
            'callback' => function ($modelInstance = null) {
                return $modelInstance->name ?? 'Editar';
            },
        ],
    ],
];
