@extends('site.layout.site')

@section('title', $pageComponents['description_pt'])

@section('content')
	@if(isset($pageComponents))
		@foreach ($pageComponents->contentSection as $contentSection)
			@includeIf("site.components.{$contentSection->component}", [ 'pageData' => $contentSection ])
		@endforeach
	@endif
@endsection

@section('scripts')
@parent

@endsection
