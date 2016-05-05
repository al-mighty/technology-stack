<?php
// Начало Phalcon BS
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
//Подключаем автозагрузку композера

try {

    // Регистрируем автозагрузчик
    $loader = new Loader();

    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    // Создаем DI обьект контейнер сервисов и приложений
    $di = new FactoryDefault();

    //В качестве сервиса Настраиваем компонент View
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        $view->registerEngines(
            array(
                ".twig"=>'Phalcon\Mvc\View\Engine\Volt'
            )
        );
        return $view;
    });



    // Настраиваем базовый URI так, чтобы все генерируемые URI содержали директорию "tutorial"
//    $di->set('url', function () {
//        $url = new UrlProvider();
//        $url->setBaseUri('/tutorial/');
//        return $url;
//    });
    $di->set('url', function () {
        $url = new UrlProvider();
        $url->setBaseUri('/ExampleTwig/');
        return $url;
    });
    // Обрабатываем запрос
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo "123Exception: ", $e->getMessage();
}
//Конец phalcon BS


