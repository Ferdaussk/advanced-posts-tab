<?php
/**
 * @===================//// Template design
 */
echo '<div class="apostst-gallery-filtering-one apostst-gallery-filtering-common">';
  echo '<div class="container">';
    echo '<div class="row">';
      echo '<div class="col-xl-12">';
        echo '<div class="apostst-gallery-menu pb-40 apostst-my-commonsk-class">';
        include( __DIR__ . '/texo-datas/items.php' );
        echo '</div>';
      echo '</div>';
    echo '</div>';
    echo '<div class="row apostst-grid apostst-grid-common section" id="boxContainer">';
    include( __DIR__ . '/texo-datas/datas-all.php' );
    echo '</div>';
  echo '</div>';
echo '</div>';