@php
	$posts = get_posts(
		array(
			'id' 				=> $post->ID,
			'post_type' 		=> 'post',
			'post_status' 		=> 'publish',
			'category_name'		=> 'kegiatan',
			'orderby'			=> 'DESC',			
			'posts_per_page'	=>	5	
		)
	);
@endphp

<div class="c-block__heading u-theme--border-color--darker">
	<h3 class="c-block__heading-title u-theme--color--darker">Kegiatan</h3>
	<a href="../category/kegiatan/" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">Lihat seluruhnya</a>
</div>

<div class="c-block-wrap__content">
	@if ($posts)
		@foreach ($posts as $post)	
			@php
				$title = $post->post_title;
				$date =	get_the_date('d M Y', $post);
				$url =	get_the_permalink($post);
				$excerpt = substr_replace(get_the_excerpt($post), "", 50);
			@endphp
	
			<div class="c-block c-block__text  u-theme--border-color--darker u-border--left u-padding--double--bottom u-spacing--half">
				<h3 class="u-theme--color--darker u-font--primary--s">
					<a href="{{ $url }}"><strong>{{ $title }}</strong></a>
				</h3>
				<span class="c-block__meta u-theme--color--dark u-font--secondary--xs">{{ $excerpt }}</span>
			</div>
		@endforeach
	@endif
</div>

{!! wp_reset_query() !!}