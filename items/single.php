<div class="item record">
    <?php
    $title = metadata($item, array('Dublin Core', 'Title'));
    // $titleEng = metadata($item, array('Item Type Metadata', 'Title (English)'));
    $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 150));
    ?>
    <h3>
        <?php echo link_to($item, 'show', strip_formatting($title)); ?>
        <!-- <?php if ($titleEng): ?>
        <br>
        <?php echo $titleEng; ?>
        <?php endif; ?> -->
    </h3>
    <?php if (metadata($item, 'has files')) {
        echo link_to_item(
            item_image('thumbnail', array(), 0, $item),
            array('class' => 'image'), 'show', $item
        );
    }
    ?>
    <?php if ($date = metadata($item, array('Dublin Core', 'Date'))): ?>
        <p class="item-date"><?php echo $date; ?></p>
    <?php endif; ?>
    <?php if ($description): ?>
        <p class="item-description"><?php echo $description; ?></p>
    <?php endif; ?>
</div>
