@extends('layouts.app')
@section('title', $module_page . ' ('. $title_page .')')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />

@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?= $title_page ?> <?= $module_page ?></h5>
				</div>
				<div class="ibox-content">
					<div class="full-height-scroll">
						@include('admin._components.dataTables')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@parent


@endsection
