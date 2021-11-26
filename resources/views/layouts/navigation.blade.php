<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">

		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="dropdown profile-element">
					<span>
						<a href="{{ url('/admin/') }}">
							@if (isset(Session::get('company')->image))
							<img alt="image" class="" src="{!! asset(Session::get('company')->image) !!}" style="width: 100%;" />
							@else
							<img alt="image" class="img-circle" src="assets/images/site/Logo Negativo.png" style="width: 100%;" />

							@endif
						</a>
					</span>
					<a data-toggle="dropdown" class="dropdown-toggle" href="{{ url('/student_area/') }}">
						<span class="block m-t-xs" style="margin-top: 15px; font-size: 11px; text-align: center;">
							<strong class="font-bold">{{ Session::get('company')->name ?? '' }}</strong>
						</span>
					</a>
				</div>

				<div class="logo-element">
					<img alt="image" class="img-circle" src="assets/images/site/LogoMini Negativo Roxo.png" style="width: 100%;" />
				</div>
			</li>

			<li class="{{ isActiveRoute('admin.dashboard') }}">
				<a href="{{ url('/admin/') }}"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
			</li>

			@foreach (GigaGetData::pageConfig() as $pageConfig)
				<li class="">
					@if (isset($pageConfig->module))
						<a href="#">
							<i class="{{ $pageConfig->module->icon }}"></i>
							<span class="nav-label">{{ $pageConfig->module->desc }}</span>
							<span class="fa arrow"></span>
						</a>

						<ul class="nav nav-second-level collapse">
							@isset ($pageConfig->pages)
								@foreach ($pageConfig->pages as &$page)
								<li class="">
									<a href="{{ url($page->url) }}">
										<i class="{{ $page->icon }}"></i>
										<span class="nav-label">{{ $page->desc }}</span>
									</a>
								</li>
								@endforeach
							@endisset

							@isset($pageConfig->subModule)
								<li class="">
									@foreach ($pageConfig->subModule as &$subModule)
										@isset($subModule->module)
											<a href="#">
												<i class="{{ $subModule->module->icon }}"></i>
												<span class="nav-label">{{ $subModule->module->desc }}</span>
												<span class="fa arrow"></span>
											</a>
										@endisset

										<ul class="nav nav-third-level">
											@isset($subModule->pages)
												@foreach ($subModule->pages as $subModulePage)
													<li>
														<a href="{{ url($subModulePage->url) }}">
															<i class="{{ $subModulePage->icon }}"></i>
															<span class="nav-label">{{ $subModulePage->desc }}</span>
														</a>
													</li>
												@endforeach
											@endisset
										</ul>
									@endforeach
								</li>
							@endisset
						</ul>
					@elseif (isset($pageConfig->pages))
						@foreach ($pageConfig->pages as &$page)
							<a href="{{ url($page->url) }}">
								<i class="{{ $page->icon }}"></i>
								<span class="nav-label">{{ $page->desc }}</span>
							</a>
						@endforeach
					@endif
				</li>
			@endforeach

		</ul>

	</div>
</nav>
