<?php
	$posttags = get_the_tags();
	$html = '<div class="tags">';
	if ($posttags) {
	  foreach($posttags as $tag) {
	    $html .=  '<div class="d-inline-block my-8 mr-12"> <a class="text-uppercase badge small badge-light px-20 py-8" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></div>'; 
	  }
	}
	$html .= '</div>';
	echo $html;
?>