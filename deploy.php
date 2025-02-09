<?php

namespace Deployer;

require 'recipe/laravel.php';

set('bin/php', function () {
    return '/usr/bin/php7.4';
});

// Config
set('application', 'DIGIRP CMS Web Application');                          // The Application Title
set('repository', 'git@abbeysoftware.github.com:Mark-AbbeySoftware/digiqrp.git');   // SCM Target
set('keep_releases',
    2);                                                           // Number of releases to keep on hosts
set('default_timeout', 1200);                                                      // default ssh timeout

add('shared_files', ['.env']);                                                             // shared files
add('shared_dirs', ['storage', 'vendor', 'bootstrap/cache','public/storage']);              // Shared dirs between deploys
add('writable_dirs', ['storage', 'vendor', 'bootstrap/cache','public/storage']);            // Writable dirs by web server

// Core Tasks

task('npm:install', function () {
    run("cd {{release_path}} && /usr/bin/npm install");
})->desc('Running npm install');

task('npm:build', function () {
    run("cd {{release_path}} && /usr/bin/npm run build");
})->desc('Running npm build');

task('build', function () {
    #cd('{{release_path}}');
    #run('/usr/bin/npm install');
    #run('/usr/bin/npm run build');
});

// Hosts

host('prod')
    ->set('hostname', 'digiqrp.com')
    ->set('remote_user', 'mag')
    ->set('identityFile', '~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/Personal/digiqrp/prod')
    ->set('writable_use_sudo', false)
    ->set('use_relative_symlink', true)
    ->set('http_user', 'mag')
    ->set('branch', 'main')
    ->set('ssh_multiplexing', true)
    ->set('git_tty', false)
    ->set('ssh_type', 'native');

host('stage')
    ->set('hostname', 'digiqrp.com')
    ->set('remote_user', 'mag')
    ->set('identityFile', '~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/Personal/digiqrp/stage')
    ->set('writable_use_sudo', false)
    ->set('use_relative_symlink', true)
    ->set('http_user', 'mag')
    ->set('branch', 'stage')
    ->set('ssh_multiplexing', true)
    ->set('git_tty', false)
    ->set('ssh_type', 'native');

host('develop')
    ->set('hostname', 'digiqrp.com')
    ->set('remote_user', 'mag')
    ->set('identityFile', '~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/Personal/digiqrp/dev')
    ->set('writable_use_sudo', false)
    ->set('use_relative_symlink', true)
    ->set('http_user', 'mag')
    ->set('branch', 'develop')
    ->set('ssh_multiplexing', true)
    ->set('git_tty', false)
    ->set('ssh_type', 'native');

// Hooks

after('deploy:update_code', 'build');
after('deploy:success', 'artisan:config:clear');
after('deploy:success', 'artisan:route:clear');
after('deploy:success', 'artisan:cache:clear');

after('deploy:failed', 'deploy:unlock');

