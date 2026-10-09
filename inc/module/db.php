<?php 
if (!defined("ZM_PB_VER")) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;

if ($request_method === 'POST') {
	if( ! isset($_POST['zm_pb_forms_nonce']) || empty($_POST['zm_pb_forms_nonce']) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
	if( ! zm_pb_check_token( ZM_PB_FORMS_PRENONCE , $_POST['zm_pb_forms_nonce'], ZM_PB_NONCE_SALT) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));

	if( ! isset($_POST['zm_pb_admin_nonce']) || empty($_POST['zm_pb_admin_nonce'])) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
	if( ! zm_pb_check_token( ZM_PB_ADMIN_PRENONCE , $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
}

if( $subpage === 'module_db' ){

    $isSuperAdmin = zm_pb_check_super_admin();

    if (!$isSuperAdmin && ZM_PB_CHECK_SUPERADM) {
		
        $alertMessage = ZM_PB_ADMINLANG->module->alerts->access_denied;
        $alertType = 'danger';
        $smarty->assign('alertType', $alertType );
        $smarty->assign('alertMessage', $alertMessage);
		$smarty->assign('alertHtml', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'alert.tpl' ) );

    } else {

		$tableDefinitions = [
			'zm_pb_module_settings' => function () {
				Capsule::schema()->create("zm_pb_module_settings", function ($table) {
					$table->increments('id');
					$table->enum('type', ['required', 'global_module', 'local_module', 'client', 'custom'])->default('custom');
					$table->string('setting_name', 128)->unique();
					$table->enum('setting_storage_type', ['string', 'json', 'boolean', 'int', 'float'])->default('json');
					$table->text('setting_value')->nullable();
				});

				Capsule::table('zm_pb_module_settings')->insert([
					[
						'type' => 'required',
						'setting_storage_type' => 'json',
						'setting_name' => 'main_settings',
						'setting_value' => json_encode(['data' => '']),
					],
					[
						'type' => 'required',
						'setting_storage_type' => 'json',
						'setting_name' => 'sitemap_settings',
						'setting_value' => json_encode(['data' => '']),
					],
					[
						'type' => 'required',
						'setting_storage_type' => 'json',
						'setting_name' => 'custom_header',
						'setting_value' => json_encode(['data' => '']),
					],
					[
						'type' => 'required',
						'setting_storage_type' => 'json',
						'setting_name' => 'custom_footer',
						'setting_value' => json_encode(['data' => '']),
					],
					[
						'type' => 'required',
						'setting_storage_type' => 'json',
						'setting_name' => 'page_overrides',
						'setting_value' => json_encode(['data' => '']),
					],
				]);
			},
			'zm_pb_pages' => function () {
				Capsule::schema()->create("zm_pb_pages", function ($table) {
					$table->increments('id');
					$table->string('name', 128);
					$table->string('slug', 128);
					$table->string('template_file')->nullable();
					$table->enum('auth_type', ['auth', 'noauth', 'mixed'])->default('noauth');
					$table->enum('status', ['draft', 'publish', 'delayed', 'canceled'])->default('draft');
					$table->enum('type', ['system', 'page', 'post'])->default('page');
					$table->json('langs')->nullable();
					$table->timestamps();

					$table->unique(['slug', 'auth_type']);
				});
			},
			'zm_pb_pages_settings' => function () {
				Capsule::schema()->create("zm_pb_pages_settings", function ($table) {
					$table->increments('id');
					$table->unsignedInteger('page_id');
					$table->string('lang', 16)->nullable();
					$table->enum('lang_status', ['draft', 'publish', 'delayed'])->default('draft');
					$table->boolean('lang_active')->default(false);
					$table->json('settings')->nullable();
					$table->longText('content')->nullable();
					$table->timestamps();

					$table->index(['page_id', 'lang']);
					$table->foreign('page_id')->references('id')->on('zm_pb_pages')->onDelete('cascade');
				});
			},
			'zm_pb_pages_revisions' => function () {
				Capsule::schema()->create("zm_pb_pages_revisions", function ($table) {
					$table->increments('id');
					$table->unsignedInteger('page_id');
					$table->json('page_main')->nullable();
					$table->json('page_content')->nullable();
					$table->json('page_meta')->nullable();
					$table->json('page_sitemap')->nullable();
					$table->timestamp('created_at')->nullable();
					$table->index(['page_id']);
					$table->foreign('page_id')->references('id')->on('zm_pb_pages')->onDelete('cascade');
				});
			},
			'zm_pb_sitemap' => function () {
				Capsule::schema()->create("zm_pb_sitemap", function ($table) {
					$table->increments('id');
					$table->unsignedInteger('page_id');
					$table->boolean('active')->default(true);
					$table->string('url', 256)->unique()->nullable();
					$table->enum('changefreq', ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'])->default('monthly');
					$table->decimal('priority', 2, 1)->default(0.5);
					$table->timestamps();
					$table->enum('sitemap_type', ['page', 'post'])->default('page');

					$table->index('page_id');
					$table->index('sitemap_type');
					$table->foreign('page_id')->references('id')->on('zm_pb_pages')->onDelete('cascade');
				});
			},
			'zm_pb_attachments' => function () {
				Capsule::schema()->create("zm_pb_attachments", function ($table) {
					$table->increments('id');
					$table->string('name', 128)->nullable();
					$table->string('filename', 128)->unique()->nullable();
					$table->string('mime_type', 64)->nullable();
					$table->string('alt', 256)->nullable();
					$table->string('title', 256)->nullable();
					$table->string('description', 1024)->nullable();
					$table->string('url', 256)->unique()->nullable();
					$table->json('sizes')->nullable();
					$table->boolean('optimization_attempted')->default(false);
					$table->timestamp('created_at')->nullable();
					$table->timestamp('updated_at')->nullable();

					$table->index('name');
					$table->index('filename');
					$table->index('mime_type');
				});
			},
			'zm_pb_redirects' => function () {
				Capsule::schema()->create("zm_pb_redirects", function ($table) {
					$table->increments('id');
					$table->boolean('active')->default(true);
					$table->string('from', 128);
					$table->string('to', 128);
					$table->unsignedSmallInteger('status_code')->default(301);
					$table->enum('type', ['service','system','simple'])->default('simple');
					$table->enum('method', ['GET', 'POST', 'PUT', 'DELETE', 'ALL'])->default('GET');
					$table->json('conditions')->nullable();
					$table->timestamp('created_at')->nullable();
					$table->timestamp('updated_at')->nullable();

					$table->unique(['from', 'method']);
					$table->index('active');
				});
			},
		];

		$columnDefinitions = [
			// zm_pb_module_settings
			'zm_pb_module_settings.type' => function () {
				Capsule::schema()->table('zm_pb_module_settings', function ($table) {
					$table->enum('type', ['required', 'global_module', 'local_module','client', 'custom'])->default('custom');
				});
			},
			'zm_pb_module_settings.setting_name' => function () {
				Capsule::schema()->table('zm_pb_module_settings', function ($table) {
					$table->string('setting_name', 128)->unique();
				});
			},
			'zm_pb_module_settings.setting_storage_type' => function () {
				Capsule::schema()->table('zm_pb_module_settings', function ($table) {
					$table->enum('setting_storage_type', ['string', 'json', 'boolean', 'integer', 'float'])->default('json');
				});
			},
			'zm_pb_module_settings.setting_value' => function () {
				Capsule::schema()->table('zm_pb_module_settings', function ($table) {
					$table->text('setting_value')->nullable();
				});
			},

			// zm_pb_pages
			'zm_pb_pages.name' => function () {
				Capsule::schema()->table('zm_pb_pages', function ($table) {
					$table->string('name', 128);
				});
			},
			'zm_pb_pages.slug' => function () {
				Capsule::schema()->table('zm_pb_pages', function ($table) {
					$table->string('slug', 128);
				});
			},
			'zm_pb_pages.template_file' => function () {
				Capsule::schema()->table('zm_pb_pages', function ($table) {
					$table->string('template_file')->nullable();
				});
			},
			'zm_pb_pages.auth_type' => function () {
				Capsule::schema()->table('zm_pb_pages', function ($table) {
					$table->enum('auth_type', ['auth', 'noauth', 'mixed'])->default('noauth');
				});
			},
			'zm_pb_pages.status' => function () {
				Capsule::schema()->table('zm_pb_pages', function ($table) {
					$table->enum('status', ['draft', 'publish', 'delayed', 'canceled'])->default('draft');
				});
			},
			'zm_pb_pages.type' => function () {
				Capsule::schema()->table('zm_pb_pages', function ($table) {
					$table->enum('type', ['system', 'page', 'post'])->default('page');
				});
			},
			'zm_pb_pages.langs' => function () {
				Capsule::schema()->table('zm_pb_pages', function ($table) {
					$table->json('langs')->nullable();
				});
			},
			'zm_pb_pages.created_at' => function () {
				Capsule::schema()->table('zm_pb_pages', function ($table) {
					$table->timestamp('created_at')->nullable();
				});
			},
			'zm_pb_pages.updated_at' => function () {
				Capsule::schema()->table('zm_pb_pages', function ($table) {
					$table->timestamp('updated_at')->nullable();
				});
			},

			// zm_pb_pages_settings
			'zm_pb_pages_settings.page_id' => function () {
				Capsule::schema()->table('zm_pb_pages_settings', function ($table) {
					$table->unsignedInteger('page_id');
				});
			},
			'zm_pb_pages_settings.lang' => function () {
				Capsule::schema()->table('zm_pb_pages_settings', function ($table) {
					$table->string('lang', 16)->nullable();
				});
			},
			'zm_pb_pages_settings.lang_status' => function () {
				Capsule::schema()->table('zm_pb_pages_settings', function ($table) {
					$table->enum('lang_status', ['draft', 'publish', 'delayed'])->default('draft');
				});
			},
			'zm_pb_pages_settings.lang_active' => function () {
				Capsule::schema()->table('zm_pb_pages_settings', function ($table) {
					$table->boolean('lang_active')->default(false);
				});
			},
			'zm_pb_pages_settings.settings' => function () {
				Capsule::schema()->table('zm_pb_pages_settings', function ($table) {
					$table->json('settings')->nullable();
				});
			},
			'zm_pb_pages_settings.content' => function () {
				Capsule::schema()->table('zm_pb_pages_settings', function ($table) {
					$table->longText('content')->nullable();
				});
			},
			'zm_pb_pages_settings.created_at' => function () {
				Capsule::schema()->table('zm_pb_pages_settings', function ($table) {
					$table->timestamp('created_at')->nullable();
				});
			},
			'zm_pb_pages_settings.updated_at' => function () {
				Capsule::schema()->table('zm_pb_pages_settings', function ($table) {
					$table->timestamp('updated_at')->nullable();
				});
			},

			// zm_pb_pages_revisions

			'zm_pb_pages_revisions.page_id' => function () {
				Capsule::schema()->table('zm_pb_pages_revisions', function ($table) {
					$table->unsignedInteger('page_id');
				});
			},
			'zm_pb_pages_revisions.page_main' => function () {
				Capsule::schema()->table('zm_pb_pages_revisions', function ($table) {
					$table->json('page_main')->nullable();
				});
			},
			'zm_pb_pages_revisions.page_content' => function () {
				Capsule::schema()->table('zm_pb_pages_revisions', function ($table) {
					$table->json('page_content')->nullable();
				});
			},
			'zm_pb_pages_revisions.page_meta' => function () {
				Capsule::schema()->table('zm_pb_pages_revisions', function ($table) {
					$table->json('page_meta')->nullable();
				});
			},
			'zm_pb_pages_revisions.page_sitemap' => function () {
				Capsule::schema()->table('zm_pb_pages_revisions', function ($table) {
					$table->json('page_sitemap')->nullable();
				});
			},
			'zm_pb_pages_revisions.created_at' => function () {
				Capsule::schema()->table('zm_pb_pages_revisions', function ($table) {
					$table->timestamp('created_at')->nullable();
				});
			},

			// zm_pb_sitemap
			'zm_pb_sitemap.page_id' => function () {
				Capsule::schema()->table('zm_pb_sitemap', function ($table) {
					$table->unsignedInteger('page_id');
				});
			},
			'zm_pb_sitemap.active' => function () {
				Capsule::schema()->table('zm_pb_sitemap', function ($table) {
					$table->boolean('active')->default(true);
				});
			},
			'zm_pb_sitemap.url' => function () {
				Capsule::schema()->table('zm_pb_sitemap', function ($table) {
					$table->string('url', 256)->unique()->nullable();
				});
			},
			'zm_pb_sitemap.changefreq' => function () {
				Capsule::schema()->table('zm_pb_sitemap', function ($table) {
					$table->enum('changefreq', ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'])->default('monthly');
				});
			},
			'zm_pb_sitemap.priority' => function () {
				Capsule::schema()->table('zm_pb_sitemap', function ($table) {
					$table->decimal('priority', 2, 1)->default(0.5);
				});
			},
			'zm_pb_sitemap.created_at' => function () {
				Capsule::schema()->table('zm_pb_sitemap', function ($table) {
					$table->timestamp('created_at')->nullable();
				});
			},
			'zm_pb_sitemap.updated_at' => function () {
				Capsule::schema()->table('zm_pb_sitemap', function ($table) {
					$table->timestamp('updated_at')->nullable();
				});
			},
			'zm_pb_sitemap.sitemap_type' => function () {
				Capsule::schema()->table('zm_pb_sitemap', function ($table) {
					$table->enum('sitemap_type', ['page', 'post'])->default('page');
				});
			},

			// zm_pb_attachments

			'zm_pb_attachments.name' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->string('name', 128)->nullable();
				});
			},
			'zm_pb_attachments.filename' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->string('filename', 128)->unique()->nullable();
				});
			},
			'zm_pb_attachments.mime_type' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->string('mime_type', 64)->nullable();
				});
			},
			'zm_pb_attachments.alt' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->string('alt', 256)->nullable();
				});
			},
			'zm_pb_attachments.title' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->string('title', 256)->nullable();
				});
			},
			'zm_pb_attachments.description' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->string('description', 1024)->nullable();
				});
			},
			'zm_pb_attachments.url' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->string('url', 256)->unique()->nullable();
				});
			},
			'zm_pb_attachments.sizes' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->json('sizes')->nullable();
				});
			},
			'zm_pb_attachments.optimization_attempted' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->boolean('optimization_attempted')->default(false);
				});
			},
			'zm_pb_attachments.created_at' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->timestamp('created_at')->nullable();
				});
			},
			'zm_pb_attachments.updated_at' => function () {
				Capsule::schema()->table('zm_pb_attachments', function ($table) {
					$table->timestamp('updated_at')->nullable();
				});
			},

			// zm_pb_redirects

			'zm_pb_redirects.active' => function () {
				Capsule::schema()->table('zm_pb_redirects', function ($table) {
					$table->boolean('active')->default(true);
				});
			},
			'zm_pb_redirects.from' => function () {
				Capsule::schema()->table('zm_pb_redirects', function ($table) {
					$table->string('from', 256);
				});
			},
			'zm_pb_redirects.to' => function () {
				Capsule::schema()->table('zm_pb_redirects', function ($table) {
					$table->string('to', 256);
				});
			},
			'zm_pb_redirects.status_code' => function () {
				Capsule::schema()->table('zm_pb_redirects', function ($table) {
					$table->unsignedSmallInteger('status_code')->default(301);
				});
			},

			'zm_pb_redirects.type' => function () {
				Capsule::schema()->table('zm_pb_redirects', function ($table) {
					$table->enum('type', ['service','system','simple'])->default('simple');
				});
			},
			'zm_pb_redirects.method' => function () {
				Capsule::schema()->table('zm_pb_redirects', function ($table) {
					$table->enum('method', ['GET', 'POST', 'PUT', 'DELETE', 'ALL'])->default('GET');
				});
			},
			'zm_pb_redirects.conditions' => function () {
				Capsule::schema()->table('zm_pb_redirects', function ($table) {
					$table->json('conditions')->nullable();
				});
			},
			'zm_pb_redirects.created_at' => function () {
				Capsule::schema()->table('zm_pb_redirects', function ($table) {
					$table->timestamp('created_at')->nullable();
				});
			},
			'zm_pb_redirects.updated_at' => function () {
				Capsule::schema()->table('zm_pb_redirects', function ($table) {
					$table->timestamp('updated_at')->nullable();
				});
			},
		];

		$requiredColumnsByTable = [
			'zm_pb_module_settings' => ['id', 'type', 'setting_storage_type', 'setting_name', 'setting_value'],
			'zm_pb_pages' => [
				'id', 'name', 'slug', 'template_file', 'langs',
				'auth_type', 'status', 'type', 'created_at', 'updated_at'
			],
			'zm_pb_pages_settings' => [
				'id', 'page_id', 'lang', 'lang_status',
				'lang_active', 'settings', 'content',
				'created_at', 'updated_at'
			],
			'zm_pb_pages_revisions' => [
				'id', 'page_id', 
				'page_main', 'page_content', 'page_meta', 'page_sitemap',
				'created_at'
			],
			'zm_pb_sitemap' => [
				'id', 'page_id', 'active', 'url', 'changefreq', 'priority',
				'created_at', 'updated_at', 'sitemap_type'
			],
			'zm_pb_attachments' => [
				'id', 'name', 'filename', 'mime_type', 'alt', 'title', 'description',
				'url', 'sizes', 'optimization_attempted', 'created_at', 'updated_at'
			],
			'zm_pb_redirects' => [
				'id', 'active', 'from', 'to', 'status_code', 'type',
				'method', 'conditions', 'created_at', 'updated_at'
			],
		];

        require_once ZM_PB_INCDIR . 'menu_schema.php';
        $tableDefinitions = array_merge($tableDefinitions, zm_pb_menu_table_definitions());
        foreach (zm_pb_menu_columns() as $menuTable => $menuColumns) {
            $requiredColumnsByTable[$menuTable] = array_keys($menuColumns);
            foreach ($menuColumns as $menuColumn => $definition) {
                $columnDefinitions[$menuTable . '.' . $menuColumn] = function () use ($menuTable, $definition) {
                    Capsule::schema()->table($menuTable, $definition);
                };
            }
        }

        if ( $method_action === 'module_db_action' && $request_method != 'GET' ) {
            $selectedItems = isset($_POST['selected_items']) && is_array($_POST['selected_items']) ? $_POST['selected_items'] : [];
            $dbAction = zm_pb_stlc($_POST['db_action']);
            $successCount = 0;
            $errors = [];

			if($dbAction === 'delete') Capsule::statement('SET FOREIGN_KEY_CHECKS=0');

            foreach ($selectedItems as $itemKey) {
                $parts = explode(':', $itemKey);
                if (count($parts) < 2) {
                    continue;
                }

                $itemType = $parts[0];
                $tableName = $parts[1];
                $columnName = $parts[2] ?? null;

                try {
                    if ($dbAction === 'fix') {
                        if ($itemType === 'table') {
                            if ( !zm_pb_has_table($tableName) && isset($tableDefinitions[$tableName]) ) {
                                $tableDefinitions[$tableName]();
                                $successCount++;
                            }
                        } elseif ($itemType === 'column' && $columnName) {
                            $colKey = $tableName . '.' . $columnName;
                            if ( zm_pb_has_table($tableName) && !zm_pb_has_column($tableName, $columnName) && isset($columnDefinitions[$colKey]) ) {
                                $columnDefinitions[$colKey]();
                                $successCount++;
                            }
                        }
                    } 
                    elseif ($dbAction === 'delete') {
                        if ($itemType === 'column' && $columnName) {

                            if (in_array($columnName, ['page_id', 'menu_id'], true)) {
                                try {
                                    Capsule::schema()->table($tableName, function ($table) use ($columnName) {
                                        $table->dropForeign([$columnName]);
                                    });
                                } catch (Exception $e) {
                                    // Older schemas may have no foreign key here.
                                }
                            }

                            if (zm_pb_has_table($tableName) && zm_pb_has_column($tableName, $columnName)) {
                                Capsule::schema()->table($tableName, function ($table) use ($columnName) {
                                    $table->dropColumn($columnName);
                                });
                                $successCount++;
                            }
                        } elseif ($itemType === 'table') {
                            if (zm_pb_has_table($tableName)) {
                                Capsule::schema()->dropIfExists($tableName);
                                $successCount++;
                            }
                        }
                    }
                        
                } catch (Exception $e) {
                    $errors[] = $itemKey . ': ' . $e->getMessage();
                }
            }

			if($dbAction === 'delete') Capsule::statement('SET FOREIGN_KEY_CHECKS=1');

            if (!empty($errors)) {
                $alertType = 'danger';
                $alertMessage = ZM_PB_ADMINLANG->module->module_db->alerts->db_operation_error[0] . ': ' . $successCount . ZM_PB_ADMINLANG->module->module_db->alerts->db_operation_error[1] . ': ' . implode(' | ', $errors);
            } else {
                $alertType = 'success';
                $alertMessage = ZM_PB_ADMINLANG->module->module_db->alerts->db_operation_success . ': ' . $successCount;
            }

			exit( json_encode(['status'=>$alertType, 'title'=> ZM_PB_ADMINLANG->other->success,'message'=> $alertMessage ]) );
        }


		$tableStatusRows = [];
		foreach (array_keys($tableDefinitions) as $tableName) {
		    $exists = zm_pb_has_table($tableName);
		    $rowCount = null;
		    if ($exists) {
		        try {
				$rowCount = Capsule::table($tableName)->count();
		        } catch (Exception $e) {
				$rowCount = null;
		        }
		    }
		    $tableStatusRows[] = [
		        'type' => 'table',
		        'table' => $tableName,
		        'column' => '',
		        'exists' => $exists,
		        'row_count' => $rowCount,
		        'item_key' => 'table:' . $tableName
		    ];
		}

		$columnStatusRows = [];
		foreach ($requiredColumnsByTable as $tableName => $columns) {
		    foreach ($columns as $columnName) {
		        $tableExists = zm_pb_has_table($tableName);
		        $columnExists = $tableExists ? zm_pb_has_column($tableName, $columnName) : false;
		        $columnStatusRows[] = [
					'type' => 'column',
					'table' => $tableName,
					'column' => $columnName,
					'exists' => $columnExists,
					'row_count' => null,
					'can_fix' => isset($columnDefinitions[$tableName . '.' . $columnName]),
					'item_key' => 'column:' . $tableName . ':' . $columnName
		        ];
		    }
		}

		$columnRowsByTable = [];
		foreach ($columnStatusRows as $columnRow) {
		    $columnRowsByTable[$columnRow['table']][] = $columnRow;
		}
		foreach ($tableStatusRows as &$tableRow) {
		    $tableName = $tableRow['table'];
		    $tableColumns = $columnRowsByTable[$tableName] ?? [];
		    $missingCount = 0;
		    foreach ($tableColumns as $col) {
		        if (!$col['exists']) $missingCount++;
		    }
		    $tableRow['columns'] = $tableColumns;
		    $tableRow['columns_total'] = count($tableColumns);
		    $tableRow['columns_missing'] = $missingCount;
		}
		unset($tableRow);

		$smarty->assign('tableStatusRows', $tableStatusRows);
		$smarty->assign('columnStatusRows', $columnStatusRows);
    }
}
