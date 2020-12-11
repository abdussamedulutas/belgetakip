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
								<a href="#" class="media-left"><img src="<?=userimage()?>" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?=username();?></span>
									<div class="text-size-mini text-muted">
										<i class="icon-user-check text-size-small"></i> &nbsp;<?=userrole()?>
									</div>
								</div>
								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="<?="$data->userPanelLink/hesap"?>"><i class="icon-cog"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<li class="navigation-header"><span>Menü</span> <i class="icon-menu" title="Menü"></i></li>
								<li><a href="<?="$data->userPanelLink/sondurum"?>"><i class="icon-checkmark4"></i> <span>Son Gelişmeler</span></a></li>
								<li><a href="<?="$data->userPanelLink/dosyalar"?>"><i class="icon-file-text2"></i> <span>Dosyalar</span></a></li>
								<li><a href="<?="$data->userPanelLink/hatirlatma"?>"><i class="icon-alarm"></i> <span>Hatırlatmalar</span> </a></li>
								<li><a href="<?="$data->userPanelLink/eksikevraklar"?>"><i class="icon-file-minus"></i> <span>Eksik Evraklar</span></a></li>
								<li><a href="<?="$data->userPanelLink/acenteler"?>"><i class="icon-address-book"></i> <span>Acenteler</span> </a></li>
								<li>
									<a href="#"><i class="icon-drawer3"></i> <span>Form işlemleri</span></a>
									<ul>
										<li><a href="<?="$data->userPanelLink/form/ayarlar"?>">Dosya Düzeni</a></li>
										<li><a href="<?="$data->userPanelLink/form/gerekenler"?>">Zorunlu Evraklar</a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-users4"></i> <span>Personeller</span></a>
									<ul>
										<li><a href="<?="$data->userPanelLink/yoneticiler"?>">Yöneticiler</a></li>
										<li><a href="<?="$data->userPanelLink/personeller"?>">Personeller</a></li>
										<li><a href="<?="$data->userPanelLink/avukatlar"?>">Avukatlar</a></li>
										<li><a href="<?="$data->userPanelLink/kullanicilar"?>">Kullanıcılar</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
            </div>
