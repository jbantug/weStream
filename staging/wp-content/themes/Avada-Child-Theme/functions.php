<?php

define('anytv_default_width', '640');
define('anytv_default_height', '360');


// [ayoutube id="pExF95gdk80" list="PLyI74zGGymu-GgRctTwDzleQQPcSGIk-W"]
// [ayoutube id="scLS9G4YpiY" width="326" height="183"]

function anytv_shortcode_youtube($values)
{
	$atts = shortcode_atts(
		array
		(
			'id' => '',
			'width' => anytv_default_width,
			'height' => anytv_default_height,
			'list' => '',
		), $values);

	$list = $atts['list'];
	if ('' !== $list)
	{
		$list = '?list=' . $list;
	}

	return '<div class="center-block" style="max-width:'.$atts['width'].'px;max-height:'.$atts['height'].'px;"><div class="video-shortcode"><iframe title="YouTube video player" width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="http://www.youtube.com/embed/' . $atts['id'] . $list . '" marginwidth="0" marginheight="0" frameborder="0" allowfullscreen></iframe></div></div>';
}

add_shortcode('ayoutube', 'anytv_shortcode_youtube');

// [aiframe src="http://www.any.tv/"]

function anytv_shortcode_iframe($values)
{
	$atts = shortcode_atts(
		array
		(
			'src' => '',
			'width' => anytv_default_width,
			'height' => anytv_default_height,
		), $values);

		return '<div class="center-block" style="max-width:'.$atts['width'].'px;max-height:'.$atts['height'].'px;"><div class="video-shortcode"><iframe width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="' . $atts['src'] . '" marginwidth="0" marginheight="0" frameborder="0"></iframe></div></div>';

/*
	extract(anytv_parse_shortcode_height_first(1, array(
		'src' => 'http://www.any.tv/',
		'width' => anytv_default_width,
		'height' => anytv_default_width,
	), $values));

	return anytv_iframe($src, $width, $height);
*/
}

add_shortcode('aiframe', 'anytv_shortcode_iframe');

function anytv_shortcode_pdf($values)
{
	$atts = shortcode_atts(
		array
		(
			'src' => '',
			'width' => anytv_default_width,
			'height' => anytv_default_height,
		), $values);

		return '<div class="center-block" style="max-width:'.$atts['width'].'px;max-height:'.$atts['height'].'px;"><div class="video-shortcode"><iframe width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="http://docs.google.com/viewer?embedded=true&url=' . $atts['src'] . '" marginwidth="0" marginheight="0" frameborder="0"></iframe></div></div>';
}

add_shortcode('apdf', 'anytv_shortcode_pdf');


/*
function anytv_iframe($src, $width, $height)
{
	if (!anytv_starts_with($src, 'http'))
	{
		$src = 'http://' . $src;
	}

  return <<<EOS
<iframe src="$src" width="$width" height="$height" marginwidth="0" marginheight="0" frameborder="0"></iframe>
EOS;
}

function anytv_shortcode_iframe($atts)
{
	$atts = shortcode_atts(
		array
		(
			'id' => '',
			'width' => 640,
			'height' => 360
		), $atts);

<iframe src="" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>

		return '<div class="center-block" style="max-width:'.$atts['width'].'px;max-height:'.$atts['height'].'px;"><div class="video-shortcode"><iframe title="YouTube video player" width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="http://www.youtube.com/embed/' . $atts['id'] . '" frameborder="0" allowfullscreen></iframe></div></div>';
}
*/

//==============================================================================
// Helper functions
//

function anytv_starts_with($haystack, $needle) { return 0 === strpos($haystack, $needle, 0); }

/*
//
// Swap width and height if only one given
// * [pdf tgnbooks.com/the-great-gatsby.pdf 400] // assumes height:400
// * [pdf tgnbooks.com/the-great-gatsby.pdf 600 400] // assumes width:600 height:400
//
function anytv_parse_shortcode_height_first($widthIndex, $defaults, $values)
{
	if (is_array($values) && isSet($values[$widthIndex]) && !isSet($values[$widthIndex + 1]))
	{
		$newDefaults = array();
		$i = 0;

		foreach ($defaults as $key => $value)
		{
			if ($i == $widthIndex) // found the width
			{
				$widthKey = $key;
				$widthValue = $value;
			}
			else
			{
				$newDefaults[$key] = $value;

				if ($i == $widthIndex + 1) // found the height
				{
					$newDefaults[$widthKey] = $widthValue; // swap width and height positions
				}
			}

			$i++;
		}

		return anytv_parse_shortcode($newDefaults, $values);
	}

	return anytv_parse_shortcode($defaults, $values);
}

//
// [youtube]                            -> key:default,     width:default, height:default
// [youtube=X8gBdsBjpJw]                -> key:X8gBdsBjpJw, width:default, height:default (Equals (=) is optional)
// [youtube X8gBdsBjpJw]                -> key:X8gBdsBjpJw, width:default, height:default
// [youtube X8gBdsBjpJw 200]            -> key:X8gBdsBjpJw, width:200,     height:default
// [youtube X8gBdsBjpJw height=200]     -> key:X8gBdsBjpJw, width:default, height:200
// [youtube X8gBdsBjpJw height=200 300] -> (Unsupported: shorthand values must appear before key:value pairs)
//
function anytv_parse_shortcode($defaults, $values)
{
	// commented: can do this in one loop, not two
//	$out = shortcode_atts($defaults, $values);

	if (is_array($values)) // if ('' === $values) // $values === '' if [shortcode] has no atributes
	{
		$out = array();
		reset($defaults);

		// process shorthand values first in $defaults order
		if (isSet($values[0]))
		{
			$key = key($defaults);
			$out[$key] = ltrim($values[0], '='); // first value may start with '=', eg: [youtube=X8gBdsBjpJw] -> values[0] = '=X8gBdsBjpJw'

			for ($i = 1; false !== next($defaults) && isSet($values[$i]); $i++)
			{
				$key = key($defaults);
				$out[$key] = $values[$i];
			}
		}

		// process key:value pairs next, continuing from shorthand values in $defaults order
		while (list($key, $value) = each($defaults))
		{
			$out[$key] = array_key_exists($key, $values) ? $values[$key] : $value;
		}
	}
	else
	{
		$out = $defaults; // creates a copy of $defaults
	}

	return $out;
}

function anytv_parse_values_array($values)
{
	if (0 < count($values))
	{
		$keyValues = array();

		foreach ($values as $key => $value)
		{
			if ('' != $value)
			{
				$keyValues[] = $key . '=' . $value;
			}
		}

		return '?' . implode('&', $keyValues);
	}
	else
	{
		return '';
	}
}
*/
