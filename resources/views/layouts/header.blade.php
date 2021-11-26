<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-6">
		<h2><?= $module_page ?> - <?= $title_page ?></h2>
		<ol class="breadcrumb">
			<li><a href="{{ url('/') }}">Home</a></li>
			@if(isset($group_page))
			<li><a href="{{ url($url_group) }}"><?= $group_page ?></a></li>
			@endif

			@if(isset($group_module_page))
			<li><a href="#"><?= $group_module_page ?></a></li>
			@endif

			@if(isset($group_module_page2))
			<li><a href="#"><?= $group_module_page2 ?></a></li>
			@endif

			@if(isset($url_module))
			<li><a href="{{ url($url_module) }}"><?= $module_page ?></a></li>
			@else
			<li><a href="{{ url($url_page) }}"><?= $module_page ?></a></li>
			@endif

			@if(isset($action_page))
			<li><a href="{{ url($url_page) }}"><?= $action_page ?></a></li>
			@endif

			@if(isset($url_page_action))
			<li class="active"><a href="{{ url($url_page . '' . $url_page_action) }}"><strong><?= $title_page ?></a></strong></li>
			@else
			<li class="active"><a href="{{ url($url_page) }}"><strong><?= $title_page ?></a></strong></li>
			@endif

		</ol>
	</div>
	<div class="col-lg-6" style="padding-top: 30px; text-align: right">
		@if(isset($headerBtn))
			@foreach ($headerBtn as $hBtn)
				@if(isset($hBtn->modal))
					<button class="btn {{ $hBtn->class }}" data-toggle="modal" data-target="#{{ $hBtn->modal }}">
						<i class="{{ $hBtn->iconClass }}"></i> {{ $hBtn->label }}
					</button>
					@else
					<a href="{{ url($hBtn->url) }}">
						<button type="button" class="btn {{ $hBtn->class }}">
							<i class="{{ $hBtn->iconClass }}"></i> {{ $hBtn->label }}
						</button>
					</a>
				@endif
			@endforeach
		@else
			@if(isset($modal))
				<button class="btn btn-primary" data-toggle="modal" data-target="#<?= $data_target_modal ?>">
					<i class="fa fa-plus"></i> Novo
				</button>
			@else
				@if($fileView == 'list')
					@if(isset($no_button) && $no_button == 'yes')
					@else
						<a href="{{ url($url_page ."/insert") }}"><button type="button" class="btn btn-primary">
							<i class="fa fa-plus"></i> Novo</button>
						</a>
					@endif
				@elseif($fileView == 'form')
					<a href="{{ url($url_page) }}">
						<button type="button" class="btn btn-primary">
							<i class="fa fa-list"></i> Lista
						</button>
					</a>
				@endif
			@endif
		@endif
	</div>
</div>
