@php
  global $post;
@endphp
<main class="l-main">
	@include('patterns.02-organisms.sections.page-header')
	@include('patterns.02-organisms.sections.page-header-feature')
	
	<section class="l-grid l-grid--7-col l-grid-wrap--6-of-7 u-spacing--double--until-large u-padding--double--top">
		<div class="l-grid-item l-grid-item--l--4-col u-padding--zero--sides ">
			<div class="c-block-wrap u-spacing--double u-padding--right">
				@include('patterns.02-organisms.sections.home-latest')
			</div>
		</div>

		<div class="l-grid-item l-grid-item--l--2-col u-padding--zero--sides">
			<div class="c-block-wrap u-spacing--double u-padding--right">
				@include('patterns.02-organisms.sections.home-activity')
			</div>
		</div>
	</section>
	
	<section class="l-grid l-grid--7-col l-grid-wrap--6-of-7 u-spacing--double--until-large u-padding--double--top">
        <div class="l-grid-item u-padding--zero--sides u-spacing--double">
			<div class="c-block-wrap u-spacing u-padding--right">
				@include('patterns.02-organisms.sections.home-media')
		
		</div>
	</section>
	
	@include('patterns.02-organisms.sections.home-video')
</main>