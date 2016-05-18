<?php
/**
 * Plugin Name: Media Playback Speed
 * Description: Appends playback buttons to the Audio Media Player
 * Author: Daron Spence
 */

add_filter( 'wp_audio_shortcode', function( $html, $atts, $audio, $post_id, $library ){
	
	ob_start(); 
?>
		<script type="text/template" id="playback-buttons-<?php echo $post_id; ?>">
			<button onclick="changePbRate(.5)">.5x</button>
			<button onclick="changePbRate(1)">1x</button>
			<button onclick="changePbRate(2)">2x</button>
			<button onclick="changePbRate(4)">4x</button>
		</script>
		<script type="text/javascript">
			var $buttons = document.getElementById("playback-buttons-<?php echo $post_id; ?>");
			var $mediajs = $buttons.previousElementSibling;
			$mediajs.insertAdjacentHTML('afterend', $buttons.innerHTML );

			function changePbRate( rate ){
				var els = document.getElementsByTagName( 'audio' );
				for ( i = 0; i < els.length; i++ ){
					els[i].playbackRate = rate;
				}
			}
		</script>

<?php 
	
	$buttons = ob_get_clean();

	$html .= $buttons;

	return $html;

}, 10, 4 );