@extends('layouts.app')

@section('title', $config->title)

@section('content')
@include($config->header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-content">
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active">
						<a data-toggle="tab" href="#tab-1">
							Dados Galeria
						</a>
					</li>
					<li class="disabled">
						<a class="disabled" disabled data-toggle="tab" href="#tab-2">
							Dados de imagens
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="tab-1" class="tab-pane active">
						@include('admin.pages.galery.formGalery', [
							'urlAction' => '/admin/galery/save'
						])
					</div>

					<div id="tab-2" class="tab-pane">
						@include('admin.pages.galery.formGaleryImgs', [
							'urlAction' => '/admin/galery/save-imgs'
						])
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
