<div class="row border-bottom" style="display: inherit">
	<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
			{{-- <form role="search" class="navbar-form-custom" method="post" action="/search">
				<div class="form-group">
					<input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search" />
				</div>
			</form> --}}
		</div>
		{{-- <ul class="nav navbar-top-links navbar-right">
			<li>
				<div class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{  Auth::user()->name }}</strong></a>
					<ul class="dropdown-menu animated fadeInRight m-t-xs">
							<li><a href="/admin/user/update/{{  Auth::user()->id }}">Meus Dados</a></li>
							<li class="divider"></li>
							<li><a href="{{ route('admin.logout') }}">Logout</a></li>
					</ul>
				</div>
			</li>
			<li>
				<img src="{{ empty(Auth::user()->image) ? '/images/user/user.png' : '/storage/user/' . Auth::user()->image }}" class="img-profile" alt="image">
			</li>
		</ul> --}}
		<ul class="nav navbar-top-links navbar-right">
			<li style="padding-right: 5px">
				<span class="text-muted text-xs block">
					<a href="/admin/user/update/{{  Auth::user()->id }}">{{  Auth::user()->name }}</a>
				</span>
			</li>
			<li>
				<img src="{{ empty(Auth::user()->image) ? '/images/user/user.png' : '/storage/user/' . Auth::user()->image }}" class="img-profile" alt="{{  Auth::user()->name }}">
			</li>
			<li>
				<a href="{{ route('admin.logout') }}">
					<i class="fas fa-sign-out-alt"></i>Sair
				</a>
			</li>
		</ul>
	</nav>
</div>
