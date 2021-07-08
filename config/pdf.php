<?php

return [
    'mode'                  => 'utf-8',
    'format'                => 'A4',
    'author'                => 'Omar',
    'subject'               => 'Pdf Maker',
    'keywords'              => 'KeyWords',
    'creator'               => 'Laravel Pdf',
    'display_mode'          => 'fullpage',
	'tempDir'               => base_path('storage/temp/'),
    'font_path' => base_path('resources/fonts/tawajal/'),
    'font_data' => [
        'tawajal' => [
            'R'  => 'Tajawal-Regular.ttf',    // regular font
            'useOTL' => 0xFF,
            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ]

    ]
];
