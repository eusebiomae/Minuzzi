@php
  $payload = GigaGetData::footer();
@endphp
<header class="section page-header">
	<!--RD Navbar-->
	<div class="rd-navbar-wrap">
		<nav class="rd-navbar rd-navbar-modern rd-navbar-modern-1" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="50px" data-xl-stick-up-offset="50px" data-xxl-stick-up-offset="50px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true" data-lg-auto-height="false" data-xl-auto-height="false" data-xxl-auto-height="false">
			<div class="rd-navbar-main-outer">
				<div class="rd-navbar-main">
					<!--RD Navbar Panel-->
					<div class="rd-navbar-panel">
						<!--RD Navbar Toggle-->
						<button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
						<!--RD Navbar Brand-->
						<div class="rd-navbar-brand">
							<!--Brand--><a class="brand" href="/home"><img class="brand-logo-dark" src="{{$payload->image}}" alt="" width="209" height="39"/><img class="brand-logo-light" src="enar/images/logo-inverse-416x78.png" alt="" width="208" height="39"/></a>
						</div>
					</div>
					<div class="rd-navbar-nav-wrap ml-auto">
						<ul class="rd-navbar-nav">
							@foreach (GigaGetData::menu() as $item)
								@if ($item->flg_page == 'register')
									<li class="rd-nav-item {{ isActiveRoute($item->flg_page) }}">
										<a class="button button-gray-800 mb-3 m-lg-0" href="{{ $item->url }}" title="{{ $item->description_pt }}" target="_blank">{{ $item->description_pt }}</a>
									</li>
									@continue
								@endif
							<li class="rd-nav-item {{ isActiveRoute($item->flg_page) }}">
								<a class="rd-nav-link" href="{{ $item->url }}" title="{{ $item->description_pt }}">{{ $item->description_pt }}</a>
							</li>
							@endforeach

							<li class="rd-nav-item d-md-inline-flex d-block">
								@if (Auth::guard('studentArea')->check())
									<a class="btn btn_2 d-none d-md-block" href="/student_area" target="_blank">
										<span title="{{ firstLastName(Auth::guard('studentArea')->user()->name) }}" class="fa-2x fa-user-circle" style="position: relative; bottom:-6px;"></span>
									</a>
									<a href="/student_area" class="rd-nav-link" target="_blank">
										<span class="fa-2x fa-user-circle d-block d-md-none"></span>
									</a>
									<a href="{{ route('studentArea.logout') }}" class="btn btn_2 d-none d-md-block">
										<span title="Sair" class="fa fa-2x fa-sign-out" style="position: relative; bottom:-6px;"></span>
									</a>
									<a href="{{ route('studentArea.logout') }}" class="rd-nav-link d-block d-md-none">
										<span title="Sair" class="fa fa-2x fa-sign-out"></span>
									</a>
								@else
									<a href="/student_area" class="rd-nav-link" target="_blank">
										<span class="fa fa-2x fa-sign-in btn btn_2" title="Área do Participante"></span>
										<span class="d-block d-md-none">
											Área do Participante
											</span>
									</a>
								@endif
							</li>


							{{-- <li class="rd-nav-item"><a class="rd-nav-link" href="/calendar" title="Calendário">Calendário</a></li>
							<li class="rd-nav-item"><a class="rd-nav-link" href="/avaliation" title="Fale Conosco">Provas e Gabaritos</a></li>
							<li class="rd-nav-item"><a class="rd-nav-link" href="/faq"title="Perguntas Frequêntes">FAQ</a></li>
							<li class="rd-nav-item"><a class="rd-nav-link" href="/contact" title="Fale Conosco">Fale Conosco</a></li> --}}
						</ul>
					</div>
					<div class="rd-navbar-elements">
						{{-- <a class="rd-navbar-basket linearicons-cart rd-navbar-fixed-element-2" href="../cart-page.html"><span>2</span></a> --}}
						{{-- <a href="/register" class="button button-gradient-outline">
							<span class="bg py-2 px-4">
								Participar
							</span>
						</a> --}}
						<button class="sidebar-toggle sidebar-toggle-1 rd-navbar-fixed-element-1" style="position: relative; bottom:-4px;" data-multitoggle=".sidebar-wrap" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate=""><span></span></button>
					</div>
				</div>
			</div>
			<button class="sidebar-toggle sidebar-toggle-2" data-multitoggle=".sidebar-wrap" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate=""><span></span></button>
			<div class="sidebar-wrap">
				<div class="sidebar">
					<img src="{{$payload->image}}" alt="" width="333" height="262"/>
					<ul class="contacts-creative">
						<li>
							<div class="unit unit-spacing-md">
								<div class="unit-left"><span class="icon linearicons-telephone"></span></div>
								<div class="unit-body">
									Telefone: <a href="tel:{{preg_replace('/\D/','',$payload->phone1)}}">{{$payload->phone}}</a>
									<br>
									Pr. Oziel: <a href="tel:{{preg_replace('/\D/','',$payload->cell_phone1)}}">{{$payload->cell_phone1}}</a>
									<br>
									Henrique: <a href="tel:{{preg_replace('/\D/','',$payload->cell_phone2)}}">{{$payload->cell_phone2}}</a>
									<br>
									E-mail <a href="mailto:{{$payload->email1}}">{{$payload->email}}</a>
								</div>
							</div>
						</li>
						<li>
							<div class="unit unit-spacing-md">
								<div class="unit-left"><span class="icon linearicons-map2"></span></div>
							<div class="unit-body"><a href="../#">{{$payload['address']}}</a></div>
							</div>
						</li>
						<li class="rd-nav-item" style="display: inline-flex;">
							@if (Auth::guard('studentArea')->check())
							<a href="/student_area" class="rd-nav-link" target="_blank">
								<i class="icon-user-1 d-block d-md-none"></i>
								<button type="button" class="btn btn_1  d-md-block" style="font-size: 14px;">
									{{ firstLastName(Auth::guard('studentArea')->user()->name) }}
								</button>
							</a>
							<a href="/student_area" class="rd-nav-link" target="_blank">
								<i class="icon-user-1 d-block d-md-none"></i>
							</a>
							<a href="{{ route('studentArea.logout') }}" class="btn btn_2 d-none d-md-block">
								<i class="fa fa-sign-out"></i>
							</a>
							@else
							<a href="/student_area" class="rd-nav-link" target="_blank">
								<i class="icon-user-1 d-block d-md-none"></i>
								<button type="button" class="btn btn_1  d-md-block" style="font-size: 14px;">
									Área do Participante
								</button>
							</a>
							@endif
						</li>
					</ul>
				</div>
				<div class="sidebar-panel-site">
					<ul class="list-social">
						<li><a class="icon mdi mdi-facebook" href="{{$payload->facebook}}"></a></li>
						<li><a class="icon mdi mdi-instagram" href="{{$payload->instagram}}"></a></li>
						<li><a class="icon mdi mdi-youtube-play" href="{{$payload->youtube}}"></a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>
