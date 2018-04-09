<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<head>
<title>Fashion Gaze a Fashion Category Bootstrap responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="Fashion Gaze a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

<!-- gallery -->
<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/lightGallery.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/component.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/assets/admin/css/layout.css" type="text/css">

<!-- //gallery -->
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<script src="<?php echo base_url();?>assets/js/modernizr.custom.js"></script>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Arimo:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,hebrew,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Covered+By+Your+Grace" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Merriweather+Sans" rel="stylesheet">

<style>

a{
    color: inherit;
}

a:focus, a:hover {
text-decoration: none;	
color: inherit;
}

.banner .navbar{
	position: relative !important;
}
.image-box {
    position: relative;
    height: 172px;
    width: 172px;
    display: block;
    border-radius: 4px;
    background-size: cover;
    background-position: center center;
}

.main {
    font-size: 16px;
    font-weight: 600;
    padding-top: 10px;
}

.secondary{
font-size: 14px;
}

.info {
	 font-family: 'Proxima Nova Semibold';
    text-align: center;
    line-height: 1.6;
}

.bold{
	font-weight: 600;
}

.focus-border {
    border: 1px solid #e7eaed;
    border-radius: 4px;
    margin-right: 5px;
}

.queue{
	 padding: 10px 0;
    background-color: #f6f7f8;
    position: relative;
    font-family: 'Proxima Nova Semibold';
    /*z-index: 30;*/
}

.nopadding {
   /*padding-right: 3px !important;*/
   padding-left: 2px !important;
   /*padding: 0 !important;*/
   /*margin: 0 !important;*/
}

.queue-box {
	position: relative;
    max-height: 70px;
    max-width:70px;
    display: block;
    padding-top:4px;
    /*border-radius: 4px;*/
   /* background-size: cover;*/
    background-position: center center;
}

}

}

</style>

</head>


<div class="banner" id="home">
		<!-- <div class="container"> -->
			<nav class="navbar navbar-default cl-effect-5"  id="cl-effect-5">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="#">Scentlux</a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a class="active scroll" href="#models"><span data-hover="men">MEN</span></a></li> 
						<li><a class="scroll" href="#services"><span data-hover="women">WOMEN</span></a></li>
						<li><a class="scroll" href="#gallery"><span data-hover="howitworks">HOW IT WORKS</span></a></li> 
						<li><a class="scroll" href="#gallery"><span data-hover="Gift">GIFT</span></a></li> 
<!-- 						<li><a class="scroll" href="#team"><span data-hover="Team">Team</span></a></li>
						<li><a class="scroll" href="#contact"><span data-hover="Contact">Contact</span></a></li>  -->
         			</ul>
       			</div>
        		<!-- /.navbar-collapse -->
			</nav>	   
		<!-- </div> -->
		
		<ul class="top-links ">
			<li><a href="#dropdown"><?php echo $this->session->userdata('name') ?> &nbsp<i class="fa fa-user"></i> <span class="caret"></span></a></li>
			<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
		</ul>
	</div>

	<!-- queue -->
	<div class="col-md-12 queue">
		<div class="container">
			<?php
			$month = date("n");
			$j = 1;
			for ($i=$month; $i <= $month+6 ; $i++) { 
				$dateObj   = DateTime::createFromFormat('!m', $i);
				$monthname = $dateObj->format('M'); 
			?>
			<?php if (!empty($this->session->userdata['cart'][$j-1])): ?>
				<div class="col-md-1 focus-border nopadding">
					<a href="#"><span aria-hidden="">&times;</span></a>
					<img id="queue<?php echo $j ?>" class="queue-box" src="<?php echo base_url()?><?php echo $this->session->userdata['cart'][$j-1]['image'] ?>">
					<!-- <img id="queue" src="<?php echo base_url();?>assets/images/ga2.jpg" alt=""> -->
					<div class="secondary"><?php echo $monthname.' '.date('Y'); ?></div>
				</div>
			<?php else: ?>
				<div class="col-md-1 focus-border nopadding">
					<img id="queue<?php echo $j ?>" class="queue-box" src="<?php echo base_url();?>assets/images/empty-bottle.png" alt="">
					<!-- <img id="queue" src="<?php echo base_url();?>assets/images/ga2.jpg" alt=""> -->
					<div class="secondary"><?php echo $monthname.' '.date('Y'); ?></div>
				</div>
				
			<?php endif ?>

			<?php 
			$j++;
			} ?>
		</div>
	</div>

	<div class="container info" style="padding-top: 30px;">
		<?php foreach ($product as $data): ?>

			<div class="col-md-2 box" id="<?php echo $data->id ?>" style="padding-bottom: 30px;">
				<div class="focus-image image-box" style="background-image: url(<?php echo base_url($data->image);?>);"></div>
				<div class="main"><?php echo $data->brand ?></div>
<!-- 				<input type="hidden" name="image" id="image" value="<?php echo base_url($data->image);?>">  -->
				<div class="secondary"><?php echo $data->name.'<br>'. $data->type ?></div>
				<div class="overbox">
					<button class="title overtext" value="<?php echo base_url($data->image);?>" >Add to queue</button>
				</div>
			</div>
			
		<?php endforeach ?>
	</div>

<script type="text/javascript">
	var month = 0;
	$(document).ready(function () {

		$('.box').on('click', function() {
			// var id_product = e.relatedTarget.dataset.product;
			var product = $(this).attr('id');
			var member = <?php echo $this->session->userdata('id_member'); ?>;
			$.ajax({
				type: "POST",
				url: "<?php echo site_url()?>/Shop/add_queue",
				dataType: "json",
				data: {product:product, member:member, month:month},               
				success: function(data){
					if (true) {
						month++;
					}
				}
			});
		});

		$('.overtext').on('click', function() {
			var image = $(this).val();
			var i = 1;
			while (i < 12) {
				if (document.getElementById('queue'+i).src == '<?php echo base_url();?>assets/images/empty-bottle.png') {
					document.getElementById('queue'+i).src = image;
					break;
				}else{
					i++;
				}
			}
		});
	});

// 	function add_queue() {
// 	// var image = $(this).css('background-image');
// 	var image = $(this).val();
// 	alert(image);
// 	die();
// 	 var i = 1;
// 	 while (i < 12) {
// 	 	if (document.getElementById('queue'+i).src == '<?php echo base_url();?>assets/images/empty-bottle.png') {
//         document.getElementById('queue'+i).src = '<?php echo base_url();?>assets/images/parfume/img-478.jpg';
//         break;
//     }else{
//     	 i++;
//     }
// }    
// }
</script>

</html>