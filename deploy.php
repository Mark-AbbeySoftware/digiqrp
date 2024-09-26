<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('application', 'DigiQRP Laravel 8 Application'); // The Application Title
set('repository', 'git@personalAccount.github.com:LaravelCrafter/digiqrp.git');
set('keep_releases', 4);                                                            // Number of releases to keep on hosts
set('default_timeout', 1200);

add('shared_files', array('.env','public/sitemap.xml'));                       // Shared files between deploys
add('shared_dirs', array('storage', 'vendor', 'node_modules','Laravel'));      // Shared dirs between deploys
add('writable_dirs', array('storage', 'vendor', 'node_modules'.'Laravel'));    // Writable dirs by web server

// Hosts

host('digiqrp.com')
    ->set('remote_user', 'mag')
    ->set('identityFile','~/.ssh/id_rsa')
    ->set('writable_use_sudo', true)
    ->set('http_user', 'www-data')
    ->set('use_relative_symlink', false)
    ->set('branch', 'main')
    //->set('composer_options', '{{composer_action}} --verbose --no-dev --prefer-dist --no-interaction')
    ->set('deploy_path', '/var/www/digiqrp')
    ->set('ssh_multiplexing', true)
    ->set('git_tty', false)                         // [Optional] Allocate tty for git clone. Default value is false.
    ->set('ssh_type', 'native');                    // How we communicate with the host system

// Hooks

after('deploy:failed', 'deploy:unlock');
