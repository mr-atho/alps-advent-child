@php
	$posts = get_posts(
		array(
			'id' => $post->ID,
			'post_type' => 'post',
			'post_status' => 'publish',
			'category_name'	=>	'berita',
			'orderby'	=>	'DESC',			
			'posts_per_page'	=>	2	
		)
	);
@endphp

<section class="c-section c-section__block-feed u-spacing--double">
	<div class="c-block__heading u-theme--border-color--darker">
		<h3 class="c-block__heading-title u-theme--color--darker">Berita Terbaru</h3>
		<a href="../berita" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">Lihat Seluruhnya</a>
	</div>
	
	<div class="l-grid l-grid--7-col u-no-gutters">
	@if ($posts)
		@foreach ($posts as $post)	
			@php
				$id = $post->ID;
				$title = $post->post_title;
				$date =	get_the_date('d M Y', $post);
				$url =	get_the_permalink($post);
				$image_id = get_post_thumbnail_id($post);
				$image_url = get_the_post_thumbnail_url($post);
				$excerpt = substr_replace(get_the_excerpt($post), "", 200);
				$author_id = $post->post_author;
				$author_name = get_the_author_meta('display_name', $post->post_author);
				$author_nickname = get_the_author_meta('nickname', $post->post_author);
				$author_url = get_author_posts_url('user_url', $post->post_author);						
				$video = get_first_oembed_from_content($post->post_content);
				$video_thumbnail = get_video_thumbnail($video);
			@endphp
		
		<div class="l-grid-item l-grid-item l-grid-item--s--3-col l-grid-item--xl--2-col">
			<div class="c-media-block c-block c-block__stacked u-space--right u-space--double--bottom">
				<div class="c-block__image ">
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
				<div class="c-block__content u-spacing u-border--left u-color--gray u-theme--border-color--darker--left">
					<div class="u-spacing c-block__group ">
						<div class="u-width--100p u-spacing">
							<h3 class="c-block__title u-theme--color--darker u-font--primary--m ">
								<a href="{{ $url }}" class="c-block__title-link u-theme--link-hover--dark">{{ $title }}
								</a>
							</h3>
							
							<span class="c-block__date u-text-transform--upper u-theme--color--dark u-font--secondary--xs">
								<strong>{{ $date }} | 
								oleh <a href="../author/{{ $author_nickname }}">{{ $author_name }}</a></strong>
							</span>
							<p class="c-block__description">{{ $excerpt }} ...</p>
						</div>
						<div class="c-block__meta hide">
						</div>
						<a href="{{ $url }}" class="c-block__button o-button o-button--outline">
							Selengkapnya
							<span class="u-icon u-icon--m u-path-fill--base u-space--half--left"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>o-arrow__long--left</title><path d="M18.29,8.59l-3.5-3.5L13.38,6.5,15.88,9H.29v2H15.88l-2.5,2.5,1.41,1.41,3.5-3.5L19.71,10Z" fill="#9b9b9b"></path></svg>
							</span>
						</a>
					</div>
				</div>
				<!-- content -->
			</div>
			<!-- c-media-block -->
		</div>

		@endforeach
	@endif
	</div>
	
</section>

{!! wp_reset_query() !!}