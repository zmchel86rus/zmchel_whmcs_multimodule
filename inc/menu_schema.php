<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;

/** One definition shared by activation and the database repair screen. */
function zm_pb_menu_columns()
{
    return [
        'zm_pb_menus' => [
            'id' => function ($t) { $t->increments('id'); },
            'name' => function ($t) { $t->string('name', 128); },
            'active' => function ($t) { $t->boolean('active')->default(true); },
            'mode' => function ($t) { $t->string('mode', 16)->default('append'); },
            'device' => function ($t) { $t->string('device', 16)->default('mixed'); },
            'auto_add' => function ($t) { $t->boolean('auto_add')->default(false); },
            'created_at' => function ($t) { $t->timestamp('created_at')->nullable(); },
            'updated_at' => function ($t) { $t->timestamp('updated_at')->nullable(); },
        ],
        'zm_pb_menu_items' => [
            'id' => function ($t) { $t->increments('id'); },
            'menu_id' => function ($t) { $t->unsignedInteger('menu_id')->index(); $t->foreign('menu_id')->references('id')->on('zm_pb_menus')->onDelete('cascade'); },
            'parent_id' => function ($t) { $t->unsignedInteger('parent_id')->default(0); },
            'position' => function ($t) { $t->unsignedInteger('position')->default(0); },
            'type' => function ($t) { $t->string('type', 16)->default('custom'); },
            'page_id' => function ($t) { $t->unsignedInteger('page_id')->nullable(); },
            'label' => function ($t) { $t->string('label', 255)->default(''); },
            'labels' => function ($t) { $t->json('labels')->nullable(); },
            'url' => function ($t) { $t->string('url', 2048)->default(''); },
            'localize_url' => function ($t) { $t->boolean('localize_url')->default(true); },
            'target' => function ($t) { $t->string('target', 16)->default('_self'); },
            'title' => function ($t) { $t->string('title', 255)->default(''); },
            'description' => function ($t) { $t->text('description')->nullable(); },
            'classes' => function ($t) { $t->string('classes', 255)->default(''); },
            'rel' => function ($t) { $t->string('rel', 255)->default(''); },
            'icon' => function ($t) { $t->string('icon', 128)->default(''); },
            'visibility' => function ($t) { $t->string('visibility', 16)->default('mixed'); },
        ],
        'zm_pb_menu_locations' => [
            'id' => function ($t) { $t->increments('id'); },
            'location' => function ($t) { $t->string('location', 48)->unique(); },
            'menu_id' => function ($t) { $t->unsignedInteger('menu_id')->index(); $t->foreign('menu_id')->references('id')->on('zm_pb_menus')->onDelete('cascade'); },
        ],
    ];
}

function zm_pb_menu_table_definitions()
{
    $definitions = [];
    foreach (zm_pb_menu_columns() as $name => $columns) {
        $definitions[$name] = function () use ($name, $columns) {
            Capsule::schema()->create($name, function ($table) use ($columns) {
                foreach ($columns as $column) $column($table);
            });
        };
    }
    return $definitions;
}
