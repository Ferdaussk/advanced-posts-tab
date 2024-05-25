<?php
/**
 * @===================//// Template design
 */

echo '<div class="apostst-gallery-filtering-six apostst-gallery-filtering-common">';
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-xl-12">';
				echo '<div class="apostst-gallery-menu-six d-flex apostst-my-commonsk-class pb-40">';
				include( __DIR__ . '/texo-datas/items.php' );
				echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '<div class="row apostst-grid-six apostst-grid-common section" id="boxContainer">';
			include( __DIR__ . '/texo-datas/datas-all.php' );
		echo '</div>';
	echo '</div>';
echo '</div>';
