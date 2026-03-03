<?php
$color = $color ?? 'sky'; 
$text = $text ?? 'Submit';

// สร้าง CSS class ตาม color
$btnClass = 'btn';
switch($color) {
    case 'sky':
        $btnClass .= ' btn-sky';
        break;
    case 'primary':
        $btnClass .= ' btn-primary';
        break;
    default:
        $btnClass .= ' btn-sky';
}
?>

<button class="<?= $btnClass ?>">
    <?= $text ?>
</button>