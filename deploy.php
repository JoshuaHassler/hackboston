<?php
namespace Deployer;
require 'recipe/laravel.php';

// Configuration

set('repository', 'https://github.com/JoshuaHassler/hackboston.git');
set('http_user', 'ec2-user');
set('branch', 'jhassler_dev');
set('keep_releases', 3);

// Servers

server('production', '34.223.240.196')
    ->user('ec2-user')
    ->identityFile()
    ->forwardAgent()
    ->set('deploy_path', '/var/www');

// Tasks
/**
 * Deploy start, prepare deploy directory
 */
task('deploy:start', function() {
    cd('~');
    run("if [ ! -d {{deploy_path}} ]; then mkdir -p {{deploy_path}}; fi");
    cd('{{deploy_path}}');
    run("eval \"$(ssh-agent)\"");
})->setPrivate();

/**Set Storage chmod*/
task('deploy:storage', function() {
    cd('{{deploy_path}}');
    run('chmod -R 777 current/storage');
})->setPrivate();

/**
 * Migrate laravel
 */
task('deploy:laravel', function() {
    cd('{{deploy_path}}/current');
    run("cp /var/www/.env ./.env");
    run("php artisan key:generate");
    run("php artisan migrate");
//    run("php artisan passport:install");
})->setPrivate();

/**
 * Main task
 */
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:vendors',
    'deploy:symlink',
    'deploy:storage',
    'deploy:laravel',
    'cleanup',
])->desc('Deploy your project');
before('deploy:prepare', 'deploy:start');
after('deploy:shared', 'deploy:writable');
after('deploy', 'success');
