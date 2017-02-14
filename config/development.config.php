<?php
return [
  // Additional modules to include when in development mode
  'modules' => [
  ],
  // Configuration overrides during development mode
  'module_listener_options' => [
    'config_glob_paths' => [realpath(__DIR__) . '/autoload/{,*.}{global,local}-development.php'],
    'config_cache_enabled' => false,
    'module_map_cache_enabled' => false,
  ],
  'db_dsn' => [
    'driver' => 'pdo_pgsql',
    'database' => 'game',
    'username' => 'game',
    'password' => '1dl3rpgm3',
    'hostname' => 'localhost',
  ],
];
