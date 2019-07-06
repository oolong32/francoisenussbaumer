<?php
use craft\elements\Asset;
use craft\helpers\UrlHelper;
use craft\elements\Category;
use craft\elements\Entry;

return [
  'endpoints' => [
    'api/paintings.json' => [
      'resourceKey' => 'paintings',
      'elementType' => Asset::class,
      'criteria' => ['volume' => 'paintings'],
      'transformer' => function(Asset $asset) {
        return [
          'id' => $asset->id,
          'dateCreated' => $asset->dateCreated,
          'filename' => $asset->filename,
          'title' => $asset->title,
          'type' => $asset->picType->one()->title,
          'typeId' => $asset->picType->one()->id,
          'imgUrl' => $asset->url,
          'jsonUrl' => UrlHelper::url("api/painting/{$asset->id}.json"),
          'categoryUrl' => UrlHelper::url("api/category/{$asset->picType->one()->id}.json"),
        ];
      }
    ],
    'api/painting/<assetId:\d+>.json' => function($assetId) {
      return [
        'resourceKey' => 'painting',
        'elementType' => Asset::class,
        'criteria' => ['volume' => 'paintings', 'id' => $assetId],
        'transformer' => function(Asset $asset) {
          return [
            'id' => $asset->id,
            'filename' => $asset->filename,
            'dateCreated' => $asset->dateCreated,
            'title' => $asset->title,
            'width' => $asset->picWidth,
            'height' => $asset->picHeight,
            'technique' => $asset->picTechnique,
            'type' => $asset->picType->one()->title,
            'typeId' => $asset->picType->one()->id,
            'imgUrl' => $asset->url,
            'categoryUrl' => UrlHelper::url("api/category/{$asset->picType->one()->id}.json"),
          ];
        }
      ];
    },
    'api/category/<categoryId:\d+>.json' => function($categoryId) {
      return [
        'resourceKey' => 'paintingsPerCategory',
        'elementType' => Asset::class,
        'criteria' => ['volume' => 'paintings', 'relatedTo' => $categoryId],
        'transformer' => function(Asset $asset) {
          return [
            'id' => $asset->id,
            'dateCreated' => $asset->dateCreated,
            'filename' => $asset->filename,
            'title' => $asset->title,
            'type' => $asset->picType->one()->title,
            'imgUrl' => $asset->url,
            "jsonUrl" => UrlHelper::url("api/painting/{$asset->id}.json"),
          ];
        } 
      ];
    } 
  ]
];
