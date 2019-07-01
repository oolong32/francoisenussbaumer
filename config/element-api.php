<?php
use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
  'endpoints' => [
    'posts.json' => function() {
      return [
        'elementType' => Entry::class,
        'criteria' => ['section' => 'blog', 'limit' => '25', 'orderBy' => 'postData desc'],
        'elementsPerPage' => 25,
        'transformer' => function(Entry $entry) {
          return [
            'id' => $entry->id,
            'title' => $entry->title,
            'slug' => $entry->slug,
            'data' => $entry->postDate,
            'body' => $entry->body,
            'externalUrl' => $entry->externalUrl
          ];
        }
      ];
    }
  ]
];

?>
