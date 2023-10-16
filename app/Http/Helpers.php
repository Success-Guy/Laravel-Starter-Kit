<?php

use Butschster\Head\Facades\Meta;

class Helper {
  public static function seo(string $title, string $desc = '', string $img = '') {
    $titl        = "$title - HomeCruise.com";
    $des         = "HomeCruise, we make getting properties seemlessly friendy.";
    $description = ($desc == '') ? $des : $desc;

    $image = ($img != '')
      ? explode(',', $img)[0]
      : "/storage/apple-touch-icon.png";

    Meta::setDescription($description);

    $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('facebook');
    $og->setType('website')
      ->setSiteName('HomeCruise.com')
      ->setTitle($titl)
      ->addImage($image)
      ->setDescription($description);
    Meta::registerPackage($og);

    $card = new Butschster\Head\Packages\Entities\TwitterCardPackage('twitter');
    $card->setType('summary')
      ->setSite('HomeCruise.com')
      ->setTitle($titl)
      ->setDescription($title)
      ->setImage($image);
    Meta::registerPackage($card);

  }
}