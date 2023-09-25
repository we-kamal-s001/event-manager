<?php

return [
    "name"=> "Events",
    "title"=> "Module for VaahCMS",
    "slug"=> "events",
    "thumbnail"=> "https://img.site/p/300/160",
    "is_dev" => env('MODULE_EVENTS_ENV')?true:false,
    "excerpt"=> "description",
    "description"=> "description",
    "download_link"=> "",
    "author_name"=> "vaah",
    "author_website"=> "https://vaah.dev",
    "version"=> "0.0.1",
    "is_migratable"=> true,
    "is_sample_data_available"=> true,
    "db_table_prefix"=> "vh_events_",
    "providers"=> [
        "\\VaahCms\\Modules\\Events\\Providers\\EventsServiceProvider"
    ],
    "aside-menu-order"=> null
];
