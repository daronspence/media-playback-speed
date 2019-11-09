<?php
/**
 * Plugin Name: Media Playback Speed
 * Description: Appends playback buttons to the Audio Player, Video Player & PLaylist shortcodes. Based on original by Daron Spence.
 * Author: LewisCowles
 * Version: 1.1.2
 */

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script(
		'cd2-media-playback-speed-js',
		plugins_url( 'playback-speed.js', __FILE__ ),
		[],
		'1.1.2',
		true
	);
}, 1, 100);

add_action( 'wp_footer', function(){
	$defaults = array(
		array('rate'=>0.5,'title'=>__('Playback Speed 0.5x','media-playback-speed'),'label'=>__('.5x','media-playback-speed')),
		array('rate'=>1.0,'title'=>__('Playback Speed 1x','media-playback-speed'),'label'=>__('1x','media-playback-speed')),
		array('rate'=>1.5,'title'=>__('Playback Speed 1.5x','media-playback-speed'),'label'=>__('1.5x','media-playback-speed')),
		array('rate'=>2.0,'title'=>__('Playback Speed 2x','media-playback-speed'),'label'=>__('2x','media-playback-speed')),
	);
?>
  <style>
	.mejs-button.blank-button>button {
		background: transparent;
		color: #ccc;
		font-size: 1em;
		width: auto;
	}
	</style>
	<script type="text/template" id="playback-buttons-template">
		<?php if(apply_filters('media-playback-speed-generate-controls', true)): ?>
			<?php foreach(apply_filters('media-playback-speed-data', $defaults) as $item): ?>
			<div class="mejs-button blank-button">
				<button type="button" class="playback-rate-button<?php echo (($item['rate'] == 1) ? ' mejs-active' : ''); ?>" data-value="<?php echo esc_attr($item['rate']); ?>" title="<?php echo esc_attr($item['title']); ?>" aria-label="<?php echo esc_attr($item['title']); ?>" tabindex="0"><?php echo esc_html($item['label']); ?></button>
			</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</script>
<?php
}, 1, 100 );
