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
        $smiley_array =  [' :)', ' :-)', '(-:', '(:', ':smile:', ':(', ':-(', ':sad:',';)', ';-)', ':wink:', ':P', ':-P', ':razz:', '-.-', '-_-', ':sleep:','>:)', '>:-)', ':devil:', ':twisted:',':o', ':-o', ':eek:', '8O', '8o', '8-O', '8-o', ':shock:', ':coffee:', ':D', ':-D', ':grin:','8)', '8-)', 'B)', 'B-)', ':cool:', 'x(', 'x-(', 'X(', 'X-(', ':angry:', 'O:)', '0:)','o:)','O:-)', '0:-)', 'o:-)', ':saint:', ":'(", ":'-(", ':cry:', ':shoot:', '|)', ':squint:', '^^', '^_^', ':lol:', ':/', ':-/', ':beer:'];
$smiley_xhtml =  ['happy','happy','happy','happy','happy','unhappy','unhappy','unhappy','wink2','wink2','wink2','tongue','tongue','tongue','sleep','sleep','sleep','devil','devil','devil','devil','surprised','surprised','surprised','surprised','surprised','surprised','surprised','surprised','coffee','grin','grin','grin','sunglasses' ,'sunglasses' ,'sunglasses' ,'sunglasses' ,'sunglasses','angry','angry','angry','angry','angry','saint','saint','saint','saint','saint','saint','saint','cry','cry','cry','shoot','squint','squint','laugh','laugh','laugh','displeased','displeased','beer'];

for ($i = 0; $i<count($smiley_array); $i++)
{
    $word = $smiley_array[$i];
    $smiley_img = '<i class="icon-emo-' . $smiley_xhtml[$i] . '"></i>';    
    $content = str_replace($word, $smiley_img, $content);
}
return $content;
}



}
