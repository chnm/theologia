<?php echo head(array('title' => metadata($item, array('Dublin Core', 'Title')), 'bodyclass' => 'items show')); ?>

<h1>
    <?php echo metadata($item, array('Dublin Core', 'Title')); ?>
</h1>

<div id="primary">
    <?php if (metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <?php $itemFiles = $item->Files; ?>
        <?php $firstFile = $itemFiles[0]; ?>
        <?php echo file_markup($firstFile, array('imageSize' => 'fullsize')); ?>
    </div>
    <?php endif; ?>

    <?php echo all_element_texts($item); ?>

    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

</div><!-- end primary -->

<div id="secondary">
    <!-- The following returns all of the files associated with an item. -->
    <?php if (metadata($item, 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2>Files</h2>
        <?php foreach ($itemFiles as $itemFile): ?>
        <?php if (metadata($itemFile, array('Dublin Core', 'Title'))): ?>
            <?php $fileTitle = metadata($itemFile, array('Dublin Core', 'Title')); ?>
        <?php else: ?>
            <?php $fileTitle = 'Untitled'; ?>
        <?php endif; ?>
            <div class="poster element-text"><a href="<?php echo metadata($itemFile, 'uri') ?>" target="_blank"><?php echo $fileTitle; ?></a></div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>



    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata($item, 'has tags')): ?>
    <div id="item-tags" class="element">
        <h2>Tags</h2>
        <div class="element-text tags"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif; ?>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (get_collection_for_item()): ?>
        <div id="collection" class="element">
            <h2>Collection</h2>
            <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
        </div>
    <?php endif; ?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2>Citation</h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>

</div><!-- end secondary -->

<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>

<script type="text/javascript">
(function($) {
    $(document).ready(function() {
        $('div.metadata').prepend('<div class="toggle open"></div>');
        $('div.metadata').on('click', '.toggle', function() {
            $('.metadata .short, .metadata .long').slideToggle();
            $(this).toggleClass('open').toggleClass('closed');
        });
    });
})(jQuery)
</script>

<?php echo foot();
