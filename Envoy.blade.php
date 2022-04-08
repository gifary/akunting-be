@setup
    require __DIR__.'/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

    try {
        $dotenv->load();
        $dotenv->required(['DEPLOY_USER_DEV', 'DEPLOY_SERVER_DEV', 'DEPLOY_BASE_DIR_DEV'])->notEmpty();
    } catch ( Exception $e )  {
        echo $e->getMessage();
    }

    $user = env('DEPLOY_USER_DEV');
    $repo = env('DEPLOY_REPO');

    if (!isset($baseDir)) {
        $app_dir = env('DEPLOY_BASE_DIR_DEV');
    }
@endsetup

@servers(['web' => env('DEPLOY_USER_DEV').'@'.env('DEPLOY_SERVER_DEV')])

@story('updateCodeDev')
    update_code_dev
@endstory

@task('update_code_dev', ['on' => 'web'])
    echo 'update code'
    cd {{ $app_dir }}
    git pull origin development
    composer install --ignore-platform-reqs --prefer-dist --no-scripts -q -o
    composer dump-autoload
    php artisan migrate --force
    php artisan optimize
@endtask
