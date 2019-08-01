<?php
/**
 * Plugin Name: WP-Ads
 * Description: Реклама в Wordpress
 * Plugin URI:  Ссылка на инфо о плагине
 * Author URI:  https://github.com/Modder182
 * Author:      Modder182
 * Version:     1.0
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 */

class Ads_Widgets extends WP_Widget 
{
	function Ads_Widgets()
	{
		$widget_ops = array('classname' => 'Ads_Widgets', 'description' => 'Показывает рекламу' );
		$this->WP_Widget('Ads_Widgets', 'Рекламный Виджет', $widget_ops);
	}
		function form($instance)
		{
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
				$title = $instance['title'];
				$message = esc_attr($instance['message']);
				$link = esc_attr($instance['link']);
				?>
				<p><label for="<?php echo $this->get_field_id('title'); ?>">Заголовок: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
				<p><label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Рекламный Баннер'); ?></label>
						  <textarea rows="4" cols="50" class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>"><?php echo ($message); ?> </textarea>
												</p>
												<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Ссылка'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
				</p>
				<?php
		}
		function update($new_instance, $old_instance)
		{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['message'] = $new_instance['message'];
		$instance['link'] = $new_instance['link'];
			return $instance;
		}
		function widget($args, $instance) {
			extract( $args );
			$title								= apply_filters('widget_title', $instance['title']);
			$message	  = $instance['message'];
			$link 				  = $instance['link'];
			?>
				<?php echo $before_widget; ?>
					<?php if ( $title )
						echo $before_title . $title . $after_title; ?>
						<ul>
							<li><?php echo '<a href="'.$link.'" target="_blank"><img src='.$message." '/>"; ?></a></li>
							<style><?php echo 'li { list-style-type: none; }' ?></style>
						</ul>
				<?php echo $after_widget; ?>
			<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("Ads_Widgets");') );