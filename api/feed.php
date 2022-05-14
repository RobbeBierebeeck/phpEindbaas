<?php

use Drop\Core\Post;

include_once(__DIR__ . '/../vendor/autoload.php');
header('content-type: application/json');
try {
  $posts = Post::getApi();

   $result = array(
        'status' => 'success',
        'data' => array()
    );
    foreach ($posts as $post) {
        $result['data'][] = array(
            'id'=>$post['id'],
            'postTitle' => $post['title'],
            'postLink' => 'http://' . $_SERVER['HTTP_HOST'] ."/phpEindbaas/project.php?post=" . $post['id'],
            'postDateAdded' => $post['posted_at'],
            'postImageThumbnail' => $post['image']
        );
    }

} catch (Exception $e) {
    $result = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];

}
echo json_encode($result);
