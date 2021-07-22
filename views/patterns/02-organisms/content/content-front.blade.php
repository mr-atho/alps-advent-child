@php
  global $post;
  $cf = get_option('alps_cf_converted');
  $cf_ = '';
  if ($cf) {
    $cf_ = '_';
  }
  // SIDEBAR CONFIGURATION OPTIONS
  $active_sidebar = is_active_sidebar('sidebar-page');
  $entry_hide_sidebar = get_post_meta($post->ID, $cf_.'hide_sidebar', true);
  $theme_hide_sidebar = get_alps_option('index_hide_sidebar');

  // If has sidebar and hide sidebar is not true for entry or theme
  if ($active_sidebar && !$entry_hide_sidebar && !$theme_hide_sidebar) {
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--xl--3-col';
  } else {
    $section_offset = 'u-shift--left--1-col--at-large';
    $article_offset = '';
  }
@endphp
@include('patterns.02-organisms.sections.page-header-hero-extend') 

	<div class="c-article__body">
      <div class="u-spacing">
			
		  
        @include('patterns.01-molecules.navigation.breadcrumbs')
        @php the_content() @endphp
        @include('patterns.02-organisms.sections.related-pages')
        @if (is_active_sidebar('section-page-bottom'))
          @php dynamic_sidebar('section-page-bottom') @endphp
        @endif
		
		@include('patterns.02-organisms.sections.front-testimoni')
		@include('patterns.02-organisms.sections.front-latest')
      </div>
    </div>

