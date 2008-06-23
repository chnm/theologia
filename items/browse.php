<?php head(array('title'=>'Browse Items','bodyid'=>'items','bodyclass' => 'browse')); ?>

<?php
if (function_exists('COinSMultiple')):
    COinSMultiple($items);
endif;
?>

	<div id="primary" class="browse">
		<h2>Browse Items</h2>
		<ul class="items-nav navigation" id="secondary-nav">
			<?php echo nav(array('Browse All' => uri('items'), 'Browse by Tag' => uri('items/tags'))); ?>
		</ul>
		<?php echo htmlentities($_GET['tag']);?>
		<div id="pagination-top" class="pagination"><?php echo pagination_links(); ?></div>
		<?php foreach($items as $key => $item): ?>
			<div class="item hentry">
				<div class="item-meta">
				<h3><?php echo link_to_item($item, 'show', null, array('class'=>'permalink')); ?></h3>

				<?php if(has_thumbnail($item)): ?>
				<div class="item-img">
					<?php echo link_to_square_thumbnail($item); ?>						
				</div>
				<?php endif; ?>

				<?php if($text = item_metadata($item,'Text')): ?>
	    			<div class="item-description">
    				<p><?php echo snippet($text,0,250); ?></p>
    				</div>
				<?php elseif(!empty($item->description)): ?>
    				<div class="item-description">
    				<?php echo nls2p(h(snippet($item->description, 0, 250))); ?>
    				</div>
				<?php endif; ?>

				<?php if(count($item->Tags)): ?>
				<div class="tags"><p><strong>Tags:</strong>
				<?php echo tag_string($item, uri('items/browse/tag/')); ?></p>
				</div>
				<?php endif;?>

				</div>
			</div>
		<?php endforeach; ?>
		<div id="pagination-bottom" class="pagination"><?php echo pagination_links(); ?></div>
			
	</div>
	<div id="secondary">
		<!-- Featured Item -->
		<div id="featured-item" class="featured">
			<?php $featuredItem = random_featured_item();  ?>
			<h3>Featured Item</h3>
			<?php if ( $featuredItem ): ?>
			    <h4><?php echo link_to_item($featuredItem); ?></h4>
    			<?php if(has_thumbnail($featuredItem)): ?>
    			    <?php echo link_to_square_thumbnail($featuredItem, array('class'=>'image')); ?>
    			<?php endif; ?>
    			<p class="item-description"><?php echo h(snippet($featuredItem->description, 0, 150)); ?></p>	
    		<?php else: ?>
    				<p>You have no featured items. </p>	
    		<?php endif; ?>	
		</div><!--end featured-item-->
	</div>
<?php foot(); ?>