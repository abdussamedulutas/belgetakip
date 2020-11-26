<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-header">
            <a class="navbar-brand" href="<?=$data->userPanelLink?>/sondurum"><img src="images/logo.png" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li>
					<a class="sidebar-control sidebar-main-toggle hidden-xs">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="uploads/<?=userimage()?>" alt="">
						<span><?=$_SESSION["name"]?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?=$workspaceDir?>/<?=safeName($_SESSION["name"])?>/logout"><i class="icon-switch2"></i> Çıkış Yap</a></li>
					</ul>
				</li>
			</ul>
		</div>
    </div>
