<?php
// FontEmoticons comment thread Extension for Bolt

namespace Bolt\Extension\Mikescops\FontEmoticons;

use Bolt\BaseExtension;
use Bolt\Extensions\Snippets\Location as SnippetLocation;

class Extension extends BaseExtension
{
    public function getName()
    {
        return "Font Emoticons";
    }

    public function initialize()
    {
        if ($this->app['config']->getWhichEnd()=== 'frontend'){
            $this->addTwigFunction('emocontent', 'emocontent');

            $this->addSnippet('aftercss', '<link rel="stylesheet" type="text/css" href="'. $this->app['paths']['extensions'] .'vendor/mikescops/fontemoticons/css/fontello.css">');
        }
    }

    public function emocontent($content="")
    {

        $html = $this->smiley($content);

        return new \Twig_Markup($html, 'UTF-8');
    }

    function smiley($content) {
        $smiley_array =  [':)',':D','8)'];
$smiley_xhtml =  ['happy','grin','sunglasses'];

for ($i = 0; $i<count($smiley_array); $i++)
{
    $word = $smiley_array[$i];
    $smiley_img = '<i class="icon-emo-' . $smiley_xhtml[$i] . '"></i>';    
    $content = str_replace($word, $smiley_img, $content);
}
return $content;
}



}
