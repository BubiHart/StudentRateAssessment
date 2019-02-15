<?php
foreach ($rate as $item) {
    echo $item->name . ' '. $item->group->code. ' '. $item->average. ' '. $item->combined. '<br>';
}

?>


