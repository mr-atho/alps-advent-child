@php
	$posts = get_posts(
		array(
			'id' 				=> $post->ID,
			'post_type' 		=> 'post',
			'post_status' 		=> 'publish',
			'orderby'			=> 'DESC',			
			'posts_per_page'	=> 5,	
			'tax_query'			=> array( 
				array(
					'taxonomy' 	=> 'post_format',
					'field'		=> 'slug',
					'terms' 	=> array('post-format-video')
				)
			)
		)
	);
@endphp

<section class="l-grid l-grid--7-col u-shift--left--1-col--at-large l-grid-wrap--6-of-7 u-spacing--double--until-large u-padding--double--top">
	<div class="c-article l-grid-item l-grid-item--l--4-col u-spacing--triple">
		<div class="c-block-wrap u-spacing--double">
			<div class="c-block__heading u-theme--border-color--darker">
				<h3 class="c-block__heading-title u-theme--color--darker">Video</h3>
				<a href="../category/video/" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">Lihat seluruhnya</a>
			</div>
			<div class="c-block-wrap__content u-spacing--double">
				
				@if ($posts)
					@foreach ($posts as $post)	
						@php
							$id = $post->ID;
							$title = $post->post_title;
							$date =	get_the_date('d M Y', $post);
							$url =	get_the_permalink($post);
							$excerpt = substr_replace(get_the_excerpt($post), "", 50);
							$category = get_the_category($post->ID);
							$image_id = get_post_thumbnail_id($post);
							$image_url = find_img_src($post);							
							$video = get_first_oembed_from_content($post->post_content);
							$video_thumbnail = get_video_thumbnail($video);
						@endphp
				
						<div class="c-media-block c-block c-block--reversed l-grid-wrap l-grid-wrap--6-of-7  l-grid--7-col">
							<div class="c-block__image l-grid-item--2-col l-grid-item--m--1-col l-grid-item--l--1-col u-padding--zero--sides">
								<div class="c-block__image-wrap ">
									<picture class="picture">
									<!--[if IE 9]><video style="display: none;"><![endif]-->
									<source srcset="{{ $video_thumbnail }}" media="(min-width: 500px)">
									<!--[if IE 9]></video><![endif]-->
									<img itemprop="image" srcset="{{ $video_thumbnail }}" alt="{{ $title }}">
									</picture>
								</div>
							</div>
							<!-- image -->
							<div class="c-block__content u-spacing l-grid-item--4-col l-grid-item--m--3-col l-grid-item--l--3-col u-flex--justify-start u-border--left">
								<div class="u-spacing c-block__group ">
									<div class="u-width--100p u-spacing">
										<h3 class="c-block__title u-theme--color--dark u-font--primary--l "><a href="{{ $url }}">{{ $title }}</a>
										</h3>
									</div>
									<div class="c-block__meta u-theme--color--base">
										<span class="c-block__category u-text-transform--upper">{{ $category[0]->cat_name }}</span>
										<time class="c-block__date u-text-transform--upper" datetime="{{ $date }}">{{ $date }}</time>
									</div>
								</div>
							</div>
							<!-- content -->
						</div>
						<!-- c-media-block -->
					@endforeach				
				@endif
			</div>
			
			<a href="../category/video/" class="c-block__button o-button o-button--outline u-space--left">
				Selengkapnya
				<span class="u-icon u-icon--m u-path-fill--base u-space--half--left"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>o-arrow__long--left</title><path d="M18.29,8.59l-3.5-3.5L13.38,6.5,15.88,9H.29v2H15.88l-2.5,2.5,1.41,1.41,3.5-3.5L19.71,10Z" fill="#9b9b9b"></path></svg>
				</span>
			</a>
			
		</div>
	</div>
</section>
{!! wp_reset_query() !!}