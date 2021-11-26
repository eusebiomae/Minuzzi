@extends('layouts.app')

@section('title', 'Galeria')

@section('css')
@parent
@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-content">
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active">
						<a data-toggle="tab" href="#tab-1">
							Dados do Álbum
						</a>
					</li>
					<li class = "{!! isset($data) ? '' : 'disabled' !!}">
						<a data-toggle="tab" href="#tab-2">
							Imagens
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="tab-1" class="tab-pane active">
						@include('admin.galery.formGalery', [
							'urlAction' => '/admin/galery/save'
						])
					</div>

					<div id="tab-2" class="tab-pane {!! isset($data) ? '' : 'disabled' !!}">
						@include('admin.galery.formGaleryImgs', [
							'urlAction' => '/admin/galery/save-imgs'
						])
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
