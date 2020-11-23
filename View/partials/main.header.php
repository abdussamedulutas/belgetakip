<div class="page-header mb-10">
		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<?php $k=true;foreach($breadcrumb as $text=>$url): ?>
				<li><a href="<?=$url?>"><?php if($k): ?><i class="icon-home2 position-left"></i><?php endif; ?><?=$text?></a></li>
				<?php $k=false;endforeach; ?>
			</ul>
		</div>
    </div>
