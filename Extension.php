<?php
// Livefyre comment thread Extension for Bolt

namespace Bolt\Extension\Bolt\Livefyre;

use Bolt\Extensions\Snippets\Location as SnippetLocation;

class Extension extends \Bolt\BaseExtension
{
    public function getName()
    {
        return "Font Emoticons";
    }

    public function initialize()
    {
        $this->addTwigFunction('emo-content', 'emo-content');

        if (empty($this->config['content_replaced'])) { $this->config['content_replaced'] = "No content to replace set"; }
    }

    public function livefyre($title="")
    {
        $html = <<< EOM
            
            <link rel="stylesheet" type="text/css" href="/css/fontello.css">
            
            <script type="text/javascript">
			function smiley(text)
			{
			var smiley_array =  [':)',':D','8)'];
			var smiley_xhtml =  ['happy','grin','sunglasses'];

			for (var i = 0; i< smiley_array.length; i++)
			{
				var word = smiley_array[i].replace(')','\\)');
				word = new RegExp(word, 'gi');
				var smiley_img = '<i class="icon-emo-' + smiley_xhtml[i] + '"></i>';    
				text = text.replace(word, smiley_img);
			}
			return text;
			}
            
            document.write(smiley("{{ record.%content% }}"));

			</script>

EOM;


        $html = str_replace("%content%", $this->config['content_replaced'], $html);

        return new \Twig_Markup($html, 'UTF-8');
    }

    

}
