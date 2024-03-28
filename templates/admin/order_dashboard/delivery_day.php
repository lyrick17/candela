<?php 
    date_default_timezone_set('Asia/Manila');

    $currentDay = date('l');
    $dateMessage = date('l, F j, Y');
?>
<div id="time-date" class="font-30 m-2">
    <?php echo $dateMessage . "\n"; ?>
</div>
<div class="font-20 m-2">
    <?php
    if ($currentDay === 'Friday') {
        echo "It's delivery day! Please be reminded to deliver the orders to the customers!";
    }
    ?>
</div>