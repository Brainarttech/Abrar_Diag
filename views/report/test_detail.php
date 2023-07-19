<?php
/**
 * Created by PhpStorm.
 * User: Multiline
 * Date: 9/18/2018
 * Time: 9:30 AM
 */
$provider = $model;
$i=0;
?>

<style>
    .wid{
        width: 40% !important;
    }
</style>

<table style="width:100%;" class="kv-grid-table m-table table-sm table table-bordered table-condensed">
    <thead style="visibility: collapse">
    <tr>

        <th class="wid"></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>



    <?php foreach($provider->saleitems as $item){

        $consultant_amount = $consultant_amount + $item->consultant_amount;
        $total_consultant =  $total_consultant + $item->consultant_amount;
        $i++;
        ?>
        <tr>

            <td>
                <?= $item->item_name?>

                <?php foreach ($item['extra'] as $extra){?>

                    <li><?= $extra->item_name?> - <?= $extra->item_rate?>[<?= number_format($extra->item_quantity)?>]</li>

                    <?php
                    $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);

                } ?>

            </td>

            <td>
                <?= $item['item']['category']->name?>

            </td>

            <td>
                <?= $item->item_price + $total_extra?>
                <?php $total_items = $total_items + ($item->item_price + $total_extra);?>
            </td>

        </tr>
        <?php
    } ?>

    </tbody>
</table>
