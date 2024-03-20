<?php

return [
    'mode'                       => '',
    'format'                     => 'A4',
    'default_font_size'          => '12',
    'default_font'               => 'sans-serif',
    'margin_left'                => 10,
    'margin_right'               => 10,
    'margin_top'                 => 10,
    'margin_bottom'              => 10,
    'margin_header'              => 0,
    'margin_footer'              => 0,
    'orientation'                => 'P',
    'title'                      => 'Laravel mPDF',
    'author'                     => '',
    'watermark'                  => '',
    'show_watermark'             => false,
    'show_watermark_image'       => false,
    'watermark_font'             => 'sans-serif',
    'display_mode'               => 'fullpage',
    'auto_language_detection'    => false,
    'temp_dir'                   => storage_path('app'),
    'pdfa'                       => false,
    'pdfaauto'                   => false,
    'use_active_forms'           => false,
    'custom_font_dir' => base_path('resources/fonts/'), // don't forget the trailing slash!
    'custom_font_data' => [
        'georgia' => [ // must be lowercase and snake_case
            'R' => 'Nikosh.ttf',    // regular font,
            'B' => 'SolaimanLipi_Bold_10-03-12.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75  // bold font,

        ],
        'times_new_roman' => [ // must be lowercase and snake_case
            'R' => 'times-new-roman.ttf',    // regular font,
            'B' => 'times-new-roman-bold.ttf',

            'useKashida' => 75  // bold font,  // bold font,

        ],
        'helvetica' => [ // must be lowercase and snake_case
            'R' => 'Algerian_Regular.ttf',    // regular font,

            'useKashida' => 75
        ],
        'symbol' => [ // must be lowercase and snake_case
            'R' => 'UnifrakturMaguntia-Regular.ttf',    // regular font,
              // bold font,

            'useKashida' => 75
        ],
        'verdana' => [ // must be lowercase and snake_case
            'R' => 'ITCEDSCR.ttf',
           
            'useKashida' => 75
        ]
    ],
];
