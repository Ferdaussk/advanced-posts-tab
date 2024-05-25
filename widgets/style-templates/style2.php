<?php
/**
 * @===================//// Template design
 */
echo '<div class="apostst-gallery-filtering-two apostst-gallery-filtering-common">';
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-xl-12">';
				echo '<div class="apostst-gallery-menu-two pb-40 d-flex apostst-my-commonsk-class">';
					include( __DIR__ . '/texo-datas/items.php' );
				echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '<div class="row apostst-grid-two apostst-grid-common section" id="boxContainer">';
			include( __DIR__ . '/texo-datas/datas-all.php' );
		echo '</div>';
	echo '</div>';
echo '</div>';