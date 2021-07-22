@php
	$testimony_posts = collect(get_posts([
		'post-type'			=>	'post',
		'orderby'			=>	'DESC',
		'category_name'		=>	'testimoni',
		'posts_per_page'	=>	3,		
	]))->map(function($post) {
		return (object) [
			'title'			=>	get_the_title($post),
			'image'			=>	get_the_post_thumbnail_url($post),
			'excerpt'		=>	substr_replace(get_the_excerpt($post), "", 100),
			'url'			=>	get_permalink($post),
		];
	});
@endphp

<section class="c-section c-testimonies-media u-spacing u-posititon--relative u-theme--background-color--darker u-color--white">
	<div class="c-testimonies-media--inner u-spacing--double ">
		<div class="c-testimonies-media__heading">
			<div class="c-block__heading u-theme--border-color--base">
				<h3 class="c-block__heading-title">Testimoni Siswa &#124; Orang Tua &#124; Alumni</h3>
				<span class="c-block__heading-link u-theme--color--light u-theme--link-hover--lighter"><a href="category/testimoni" >Lihat testimoni lainnya</a></span>
				
			</div>
		</div>
		<div class="l-main__content l-grid l-grid--7-col u-shift--left--1-col--at-xxlarge l-grid-wrap--4-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">			
			@foreach ($testimony_posts as $key=>$testimony_post)
			<div class="l-grid-item u-spacing u-border--left u-theme--border-color--base">

				<div class="c-block__image">
					<div class="c-block__image-wrap ">
						<picture class="picture">
							<img itemprop="image" srcset="{{ $testimony_post->image }}" alt="Alt Text">
						</picture>
					</div>
				</div>
				
				<div class="c-block__group u-spacing u-flex--justify-start">				
					<h4>{{ $testimony_post->title }}</h4>
					<p>{{ $testimony_post->excerpt }}</p><br>
					<a href="{{ $testimony_post->url }}" class="c-block__button o-button o-button--outline--white" tabindex="-1">
						<span class="u-icon u-icon--xs u-path-fill--base u-space--half--right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10.01 10"><title>o-cion</title><path d="M10,2.31H0V0H10ZM6.36,3.85H0v2.3H6.36ZM8.22,7.7H0V10H8.22Z" fill="#231f20"></path></svg></span>
						Selengkapnya
					</a>					
				</div>
			</div>
			@endforeach	
		</div>
	</div>	
</section>