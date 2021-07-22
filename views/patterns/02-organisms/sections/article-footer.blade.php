<footer class="c-article__footer u-spacing">
  @if (is_active_sidebar('footer-region-post'))
    <div class="u-spacing">
      @php dynamic_sidebar('footer-region-post') @endphp
    </div>
  @endif
  <div class="u-padding--left">
    @if (comments_open())
      <a class="c-social-tools__comment can-be--white o-kicker u-theme--color--base u-space--right js-toggle" data-prefix="this" data-toggled="c-comments"><span class="u-icon u-icon--xs u-theme--path-fill--base u-space--quarter--right">@include('patterns.00-atoms.icons.icon-contact')</span> {{ _e("Comment", "alps") }}</a>
    @endif
    @include('patterns.01-molecules.components.share-tools')
  </div>
</footer> <!-- /.c-article__footer -->
@include('patterns.02-organisms.sections.comments')
