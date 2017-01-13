<?php
include '../vendor/autoload.php';
include '../config/doctrine.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$cachingBackend = new \Doctrine\Common\Cache\FilesystemCache('/tmp/doctrine2');
/* $config->setMetadataCacheImpl($cachingBackend);
$config->setQueryCacheImpl($cachingBackend);
$config->setResultCacheImpl($cachingBackend); */
$em = EntityManager::create($dbParams, $config);

$em->getEventManager()->addEventSubscriber(
    new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit('utf8', 'utf8_unicode_ci')
);

$app = new \Slim\Slim(array(
    'view' => '\Slim\LayoutView',
    'layout' => 'layouts/main.phtml',
    'templates.path' => __DIR__ . '/../templates/'
));

$app->get('/', function () use ($app, $em) {
    $posts = $em->getRepository('Entity\Post')->findAll();
    $app->render('index.phtml', array('posts' => $posts, 'app' => $app));
})->name('/');

$app->get('/:label/', function ($label) use ($app, $em) {
    $tag = $em->getRepository('Entity\Tag')->findOneByLabel($label);
    $app->render('tag.phtml', array('label' => $label, 'tag' => $tag, 'app' => $app));
})->name('/tag');

$app->get('/post/:id', function ($id) use ($app, $em) {
    $post = $em->getRepository('Entity\Post')->findOneById($id);
    $app->render('post.phtml', array('post' => $post, 'app' => $app));
})->name('/post');

$app->get('/user/:id', function ($id) use ($app, $em) {
    $user = $em->getRepository('Entity\User')->findOneById($id);
    $app->render('user.phtml', array('user' => $user, 'app' => $app));
})->name('/user');;

$app->get('/edit/post/:id', function ($id) use ($app, $em) {
    $post = $em->getRepository('Entity\Post')->findOneById($id);

    if ($post->getUser()->getId() != 1)
        die("Not allowed to edit post!");

    $app->render('edit.phtml', array('app' => $app, 'post' => $post));
})->name('/edit/post-form');

$app->post('/edit/post', function () use ($app, $em) {
    $post = $em->getRepository('Entity\Post')->findOneById($_POST['id']);

    if ($post->getUser()->getId() != 1)
        die("Not allowed to edit post!");

    $post->setTitle($_POST['title']);
    $post->setContent($_POST['text']);
    $em->flush();
    $app->redirect('/post/' . $post->getId());

})->name('/edit/post-process');

$app->get('/add/post', function () use ($app, $em) {
    $app->render('add.phtml', array('app' => $app));
})->name('/add/post-form');

$app->post('/add/post', function () use ($app, $em) {
    $newPost = new \Entity\Post();
    $newPost->setTitle($_POST['title']);
    $newPost->setContent($_POST['text']);
    $em->persist($newPost);
    $user = $em->getRepository('Entity\User')->findOneById(1);
    $newPost->setUser($user);
    $em->flush();
    $app->redirect('/user/1');
})->name('/add/post-process');

$app->get('/delete/post/:id', function ($id) use ($app, $em) {
    $post = $em->getRepository('Entity\Post')->findOneById($id);

    if ($post->getUser()->getId() != 1)
        die("Not allowed to delete post!");

    $em->remove($post);
    $em->flush();
    $app->redirect('/user/1');
})->name('/delete/post');

$app->run();