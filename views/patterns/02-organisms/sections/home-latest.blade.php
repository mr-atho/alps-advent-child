@php
	$posts = get_posts(
		array(
			'id' => $post->ID,
			'post_type' => 'post',
			'post_status' => 'publish',
			'category_name'	=>	'berita',
			'orderby'	=>	'DESC',			
			'posts_per_page'	=>	4	
		)
	);
@endphp

<div class="c-block__heading u-theme--border-color--darker">
	<h3 class="c-block__heading-title u-theme--color--darker">Berita Utama</h3>
	<a href="../category/berita/" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">Lihat seluruhnya</a>
</div>

<div class="c-block-wrap__content u-spacing--double">
	@if ($posts)
		@foreach ($posts as $post)	
			@php
				$id = $post->ID;
				$title = $post->post_title;
				$date =	get_the_date('d M Y', $post);
				$url =	get_the_permalink($post);
				$image_id = get_post_thumbnail_id($post);
				$image_url = get_the_post_thumbnail_url($post);
				$excerpt = substr_replace(get_the_excerpt($post), "", 150);
				$author_id = $post->post_author;
				$author_name = get_the_author_meta('display_name', $post->post_author);
				$author_nickname = get_the_author_meta('nickname', $post->post_author);
				$author_url = get_author_posts_url('user_url', $post->post_author);						
				$video = get_first_oembed_from_content($post->post_content);
				$video_thumbnail = get_video_thumbnail($video);
			@endphp
			<div class="c-media-block c-block c-block__stacked--until-small u-spacing--until-small l-grid--7-col l-grid-wrap l-large-break">
				<div class="c-block__image l-grid-item l-grid-item--s--2-col l-grid-item--l--1-col u-padding--zero--sides">
					<div class="c-block__image-wrap ">
						<picture class="picture">
							@if($image_url)
							<!--[if IE 9]><video style="display: none;"><![endif]-->
							<source srcset="{{ $image_url }}" media="(min-width: 500px)">
							<!--[if IE 9]></video><![endif]-->
							<img itemprop="image" srcset="{{ $image_url }}" alt="{{ $title }}">
							@else
								@if($video_thumbnail)
								<!--[if IE 9]><video style="display: none;"><![endif]-->
								<source srcset="{{ $video_thumbnail }}" media="(min-width: 500px)">
								<!--[if IE 9]></video><![endif]-->
								<img itemprop="image" srcset="{{ $video_thumbnail }}" alt="{{ $title }}">
								@else
								<!--[if IE 9]><video style="display: none;"><![endif]-->
								<source srcset="{{ $image_url }}" media="(min-width: 500px)">
								<!--[if IE 9]></video><![endif]-->
								<img itemprop="image" srcset="<?php bloginfo('template_directory'); ?>/assets/images/noimage.jpg" alt="{{ $title }}">
								@endif
							@endif
						</picture>
					</div>
				</div>
				<!-- image -->
				<div class="c-block__content u-spacing l-grid-item l-grid-item--s--4-col l-grid-item--l--3-col u-flex--justify-start u-padding--left">
					<div class="u-spacing c-block__group ">
						<div class="u-width--100p u-spacing">
							<h3 class="c-block__title u-theme--color--dark u-font--primary--l ">
								<a href="{{ $url }}" class="c-block__title-link u-theme--link-hover--dark">{{ $title }}</a>
							</h3>
						</div>
						<p class="c-block__description">{{ $excerpt }} ...</p>
						<div class="c-block__meta u-theme--color--base">
							<span class="c-block__category u-text-transform--upper">{{ $author_name }}</span>
							<time class="c-block__date u-text-transform--upper" datetime="{{ $date }}">{{ $date }}</time>
						</div>
					</div>
				</div>
				<!-- content -->
			</div>
		@endforeach
	@endif
	<!-- c-media-block -->
</div>
{!! wp_reset_query() !!}