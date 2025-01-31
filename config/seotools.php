<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "İzmir Web Tasarım", // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır.', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['izmir', 'web tasarım', 'sosyal medya', 'google seo optimizasyonu','seo uzmanı'],
            'canonical'    => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => 'all', // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => 'u7yBJvNyu8FoZAzp0yivLAprhD9qhBe3tPwPOp1toQM',
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'        => "İzmir Web Tasarım", // set false to total remove
            'description' => 'İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır.', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => 'website',
            'site_name'   => 'İzmir Web Tasarım',
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'        => "İzmir Web Tasarım", // set false to total remove
            'description' => 'İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır.', // set false to total remove
            'url'         => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
