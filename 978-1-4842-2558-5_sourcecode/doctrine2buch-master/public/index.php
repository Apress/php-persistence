<?php
include_once('../EntityManager.php');
$em = new EntityManager('localhost', 'app', 'root', '');
$user = $em->getUserRepository()->findOneById(1);
?>
<p><h1><?echo $user->assembleDisplayName(); ?></h1></p>
<ul>
<?php foreach($user->getPosts() as $post) { ?>
<li><?php echo $post->getTitle(); ?></li>
<?php } ?>
</ul>