<?php
/**
 * Search & Filter Pro
 *
 * Sample Results Template
 *
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 *
 * Note: these templates are not full page templates, rather
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think
 * of it as a template part
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 *
 */

if ( $query->have_posts() )
{

	?>

	<div class="search-filter-count-wrap"><div class="search-filter-count">Found <?php echo $query->found_posts; ?> Results<br /></div>
		<?php /* <div class="search-filter-pagination"> Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?><br /></div> */ ?>
	</div>
	<div class="pagination">

		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>

	<?php
	global $meta_sep, $blog_attr;
	echo '<div class="clearfix related-items style3-blog reach-blog hide-excerpt">';
	$blog_attr['style'] = 'shortcodes';
	$blog_attr['gutter_width'] = 0;
	$column = 'fourth';
	while ($query->have_posts())	{
		$query->the_post();
			echo '<div class="one-'.$column.' column-block be-hoverlay">';
			get_template_part( 'blog/loop', $blog_attr['style'] );
			echo '</div>'; // end column block
		$output .= '</div>';
	}
	echo '</div>'; // end of related-item;
	?>
	Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?><br />

	<div class="pagination">

		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>
	<?php
}
else
{
	echo "No Results Found";
}
?>
