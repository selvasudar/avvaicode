<h1><?php the_title(); ?></h1>
<?php 
$term_id = get_query_var('cat');              
//Get the data from the database
$cat_data = stripslashes(get_option("taxonomy_$term_id"));                            
//and then display my category content
if (isset($cat_data)){
  echo do_shortcode($cat_data);
}
