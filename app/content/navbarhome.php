<ul class="navbar-nav ml-auto">
	<li class="nav-item ">
		<div class="row">
			<div class="col">
				<a class="nav-link" role="button" id="btn-user">
					<i class="fa fa-caret-up collapse" aria-hidden="true" id="top-ico-user"></i>&nbsp;
					<?= strtoupper($user['status_user']); ?> &nbsp;
					<i class="fa fa-caret-down" aria-hidden="true" id="down-ico-user"></i>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div id="sub-user" class="collapse">
					<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_navbar_home" id="btn-editProfile">
						<i class="fa fa-user-circle"></i> &nbsp;Profile
					</a>
					<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_navbar_home" id="btn-logout">
						<i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout
					</a>
				</div>
			</div>
		</div>
	</li>
</ul>
