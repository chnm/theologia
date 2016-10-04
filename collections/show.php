<?php
$collectionId = $collection->id;
echo head(array('title'=>metadata('collection', array('Dublin Core', 'Title')), 'bodyclass' => 'collections show')); ?>

<?php $collectionTitles = metadata('collection', array('Dublin Core', 'Title'), array('all' => 'true')); ?>
<?php if (count($collectionTitles) > 1): ?>
    <?php foreach ($collectionTitles as $collectionTitle): ?>
        <?php echo $collectionTitle; ?>
    <?php endforeach; ?>
<?php else: ?>
    <h1><?php echo metadata('collection', array('Dublin Core', 'Title')); ?></h1>
<?php endif; ?>
<div id="primary" class="show">
    <?php if ($collectionDescription = metadata('collection', array('Dublin Core', 'Description'))): ?>
    <div id="description" class="element">
        <h2><?php echo __('Description'); ?></h2>
        <div class="element-text"><?php echo $collectionDescription; ?></div>
    </div><!-- end description -->
    <?php endif; ?>
    <?php if (metadata('collection', array('Dublin Core', 'Contributor'))): ?>
    <div id="collectors" class="element">
        <h2><?php echo __('Contributor(s)'); ?></h2>
        <div class="element-text">
            <ul>
                <li><?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('delimiter'=>'</li><li>')); ?></li>
            </ul>
        </div>
    </div><!-- end collectors -->
    <?php endif; ?>
    <?php if ($rights = metadata('collection', array('Dublin Core', 'Rights'))): ?>
        <h2><?php echo __('Rights'); ?></h2>
        <div class="element-text"><?php echo $rights; ?></div>
    <?php endif; ?>
    <?php echo fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>
</div>
<div id="secondary">
    <div id="collection-items">
        <?php $collectionItems = get_records('item', array('collection' => $collectionId), 3); ?>
        <?php foreach (loop('items', $collectionItems) as $item): ?>
            <div class="item resource">
                <?php if (metadata($item, 'has thumbnail')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image('thumbnail', array('alt'=>metadata($item,array('Dublin Core', 'Title'))))); ?>
                </div>
                <?php endif; ?>

                <h3><?php echo link_to_item(metadata($item, array('Dublin Core', 'Title')), array('class'=>'permalink'), 'show', $item); ?></h3>
                <?php if ($date = metadata($item, array('Dublin Core', 'Date'))): ?>
                    <div class="item-date">
                    <?php echo $date; ?>
                    </div>
                <?php endif; ?>
            </div>
    <?php endforeach; ?>
    </div><!-- end collection-items -->
    <?php if (count($collectionItems) > 0): ?>
    <p class="view-items-link"><?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))), array('collection' => $collectionId)); ?></p>
    <?php endif; ?>
</div>
<?php echo foot(); ?>
