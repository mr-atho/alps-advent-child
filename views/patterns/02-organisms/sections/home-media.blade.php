@php
	$posts = get_posts(
		array(
			'id' => $post->ID,
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby'	=>	'DESC',			
			'posts_per_page'	=>	7,	
			'tax_query'	=> array( 
				array(
					'taxonomy' 	=> 'post_format',
					'field'		=> 'slug',
					'terms' 	=> array('post-format-image')
				)
			)
		)
	);

	$i = 0;
@endphp


<div class="c-block__heading u-theme--border-color--darker">
	<h3 class="c-block__heading-title u-theme--color--darker">Media</h3>
	<a href="../category/media/" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">Lihar seluruhnya</a>
</div>

<div class="c-block-wrap__content u-spacing">
	
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
				@endphp
		
				@if($i == 0)
				<div class="c-media-block c-block c-block__inline c-block--reversed l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7">
					<div class="c-block__image l-grid-item l-grid-item--s--3-col u-padding--zero--sides c-block__icon c-block__icon--gallery o-background-image u-background--cover">
						<div class="c-block__image-wrap ">
							<style type="text/css">								
								.o-background-image {
									background-image: url({{ $image_url }});
								}		
							</style>
						</div>
					</div>
					<!-- image -->

					<div class="c-block__content u-spacing l-grid-item l-grid-item--s--3-col u-border-left--black--at-large u-theme--border-color--darker--left u-color--gray u-background-color--gray--light can-be--dark-dark u-padding--top u-padding--bottom u-flex--justify-between">
						<div class="u-spacing c-block__group ">
							<div class="u-width--100p u-spacing">
								<h3 class="c-block__title u-theme--color--dark u-font--primary--l "><a href="{{ $url }}">{{ $title }}</a></h3>
								<p class="c-block__description">{{ $excerpt }}</p>
							</div>
							<div class="c-block__meta u-theme--color--base">
								<span class="c-block__category u-text-transform--upper">{{ $category[0]->cat_name }}</span>
								<time class="c-block__date u-text-transform--upper" datetime="2017-12-28">{{ $date }}</time>
							</div>
						</div>
					</div>
					<!-- content -->
				</div>
				
</div>
</div>
</section>
				
			<section class="l-section__block-row l-section__block-row--6-col l-grid l-grid--7-col">
				<div class="l-grid-item u-padding--zero--sides u-flex">
				@else
					<div class="c-media-block c-block c-block__stacked l-grid-wrap l-grid--7-col l-grid-item--3-col l-grid-item--m--2-col l-grid-item--xl--1-col">
						<div class="c-block__image l-grid-item--3-col l-grid-item--m--2-col l-grid-item--xl--1-col u-padding--zero--sides u-space--right c-block__icon c-block__icon--gallery">
							<div class="c-block__image-wrap ">
								<img src="{{ $image_url }}">
							</div>
						</div>
						<!-- image -->
						<div class="c-block__content u-spacing l-grid-item--3-col l-grid-item--m--2-col l-grid-item--xl--1-col u-border--left">
							<div class="u-spacing c-block__group ">
								<div class="u-width--100p u-spacing">
									<h3 class="c-block__title u-theme--color--dark u-font--primary--s ">{{ $title }}
									</h3>
								</div>
								<div class="c-block__meta u-theme--color--base u-font--secondary--xs">
									<span class="c-block__category u-text-transform--upper">{{ $category[0]->cat_name }}</span>
								</div>
							</div>
						</div>
						<!-- content -->
					</div>
				@endif
					
				@php
					$i++;
				@endphp
			@endforeach
				
		@endif
	<!-- c-media-block -->
{!! wp_reset_query() !!}