<?php
$pageTitle = __('Browse Documents');
echo head(array('title'=>$pageTitle, 'bodyclass' => 'items browse'));
?>

<div id="primary" class="browse">

    <h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

    <?php echo item_search_filters(); ?>

    <!--<ul class="items-nav navigation" id="secondary-nav">
        <?php echo public_nav_items(); ?>
    </ul>-->

    <?php echo pagination_links(); ?>

    <?php if ($total_results > 0): ?>

    <?php
    $sortLinks[__('Title')] = 'Dublin Core,Title';
    $sortLinks[__('Date')] = 'Item Type Metadata,Sortable Date';
    ?>
    <div id="sort-links">
        <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
    </div>

    <table>
        <thead>
            <th><?php echo __('Title'); ?></th>
            <th><?php echo __('Title (English)'); ?></th>
            <th><?php echo __('Document ID'); ?></th>
            <th><?php echo __('Date'); ?></th>
            <th><?php echo __('Transcription'); ?></th>
            <th><?php echo __('Translation'); ?></th>
        </thead>
        <tbody>
        <?php foreach (loop('items') as $item): ?>
            <tr class="item hentry">
                <td class="item-meta">
                    <h3><?php echo link_to_item(metadata($item, array('Dublin Core', 'Title'), array('class'=>'permalink'))); ?></h3>

                <?php if (metadata($item, 'has thumbnail')): ?>
                    <span class="feature"><?php echo __('Image Available'); ?></span>
                    <div class="item-img">
                    <?php echo link_to_item(item_image('thumbnail')); ?>
                    </div>
                <?php endif; ?>

                <?php if ($text = metadata($item, array('Item Type Metadata', 'Text'), array('snippet'=>250))): ?>
                    <div class="item-description">
                    <p><?php echo $text; ?></p>
                    </div>
                <?php elseif ($description = metadata($item, array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
                    <div class="item-description">
                    <?php echo $description; ?>
                    </div>
                <?php endif; ?>

                <?php if (metadata($item, 'has tags')): ?>
                    <div class="tags"><p><strong><?php echo __('Tags'); ?>: </strong>
                    <?php echo tag_string('items'); ?></p>
                    </div>
                <?php endif; ?>

                <?php echo fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

                </td><!-- end class="item-meta" -->
                <td><?php echo ($english = metadata('item', array('Item Type Metadata', 'Title (English)'))) ? $english : ''; ?></td>
                <td class="item-id"><?php echo ($docID = metadata('item', array('Dublin Core', 'Identifier'))) ? $docID : ''; ?></td>
                <td class="item-date"><?php echo ($date = metadata('item', array('Dublin Core', 'Date'))) ? $date : ''; ?></td>
                <td class="check"><?php echo (metadata($item, array('Item Type Metadata', 'Transcription')) ? '&#x2713;' : ''); ?></td>
                <td class="check"><?php echo (metadata($item, array('Item Type Metadata', 'Translation')) ? '&#x2713;' : ''); ?></td>
            </tr><!-- end class="item hentry" -->
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <?php echo fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

    <?php echo pagination_links(); ?>
</div>

</div><!-- end primary -->

<?php echo foot(); ?>
