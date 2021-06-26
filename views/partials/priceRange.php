<?php

?>
<div class="price-range"><!--price-range-->
    <h2>Стоимость</h2>
    <div class="well text-center">
        <input type="text" class="span2" value="" data-slider-min=<?= $products_cost_min ?> data-slider-max=<?= $products_cost_max ?> data-slider-step="5" data-slider-value="[<?= $products_cost_min+100 ?>,<?= $products_cost_max-100 ?>]" id="sl2" ><br />
        <b class="pull-left">$ <?= $products_cost_min ?></b> <b class="pull-right">$ <?= $products_cost_max ?></b>
    </div>
</div><!--/price-range-->