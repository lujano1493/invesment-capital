
@php
	$titleDesc= isset($titleDesc) ? $titleDesc :$title ;
@endphp
<li class="nav-item {{  Route::is( $route ) ? 'active':''  }}" data-toggle="tooltip" data-placement="right" title="{{ $titleDesc }}">
  <a class="nav-link" href="{{route($route)}}">
    <i class="fa {{ $icon }}"></i>
    <span class="nav-link-text"> {{ $title }} </span>
  </a>
</li>