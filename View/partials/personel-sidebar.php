<div class="sidebar sidebar-main sidebar-default">
				<div class="sidebar-content">
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-title h6">
							<span>Form Takip Uygulaması</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>
						<div class="category-content sidebar-user">
							<div class="media">
								<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?=usernamesurname();?></span>
									<div class="text-size-mini text-muted">
										<i class="icon-user-check text-size-small"></i> &nbsp;<?=userrole()?>
									</div>
								</div>
								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="<?="$data->userPanelLink/account"?>"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li><a href="<?="$data->userPanelLink/bildirimler/son"?>"><i class="icon-history"></i> <span>Son İşlemler</span></a></li>
								<li><a href="<?="$data->userPanelLink/form/list"?>"><i class="icon-users4"></i> <span>Tüm Formlar</span></a></li>
								<li><a href="<?="$data->userPanelLink/dosyalar"?>"><i class="icon-file-text2"></i> <span>Dosyalar</span></a></li>
							</ul>
						</div>
					</div>
				</div>
            </div>
