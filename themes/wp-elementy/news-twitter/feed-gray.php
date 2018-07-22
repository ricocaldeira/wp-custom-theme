<?php
/*
Name: Gray layout
Version: 1.0.0
*/

?>
<?php foreach ($twitter as $index => $item): ?>
	<?php
	/* open row. */
	if ($row_index == 0 ): ?><div class="news-twitter-item"><?php endif; ?>

	<div class="news-tweet-content mb-10 gray-layout font-opensans">
		<?php
			$tweet_content = $item['text'];
			$tweet_content = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a class="author2" href="http://$1" target="_blank">http://$1</a>', $tweet_content);
			$tweet_content = preg_replace('/@([a-z0-9_]+)/i', '<a class="author" href="http://twitter.com/$1" target="_blank">@$1</a>', $tweet_content);
			?>
				<i class="fa fa-twitter"></i>
				<span class="tweet-time">
					<?php  echo wp_elementy_relative_time($item['created_at']); ?>
				</span>
				<div class="tweet-text">
					<?php echo balancetags($tweet_content); ?>
				</div>
			<?php	
		?>
	</div>

	<?php $row_index++; ?>

	<?php
	/* close row. */
	if ($row_index == $row || $items_count == $index ): $row_index = 0; ?></div><?php endif; ?>

<?php endforeach; ?>