<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title><?php echo isset($title) ? 'EY | '.$title : 'EY' ; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>/assets/css/style.css"> 
	<style type="text/css">
	  @keyframes blink {50% { color: transparent }}
	.loader__dot { animation: 1s blink infinite }
	.loader__dot:nth-child(2) { animation-delay: 250ms }
	.loader__dot:nth-child(3) { animation-delay: 500ms }
    </style>
</head>
<body>
<div class="main-wrapper">
<div class="account-page">
	<div class="container">
		<h3 class="account-title">Login</h3>
		<div class="account-box">
			<div class="account-wrapper">
				<div class="account-logo">
					<a href="#">
                    <svg id="a" data-name="Artwork" xmlns="http://www.w3.org/2000/svg" height="75" class="cmp-logo__image" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1000.5 402.22">
                        <defs>
                            <style>
                        
                            </style>
                            <clipPath id="ey-logo-first-line">
                            <rect class="slideOut" x="392.42" y="248.61" width="607.58" height="78.66"></rect>
                            </clipPath>
                            <clipPath id="ey-logo-second-line">
                            <rect class="slideOut" x="392.42" y="334.54" width="607.58" height="66.72"></rect>
                            </clipPath>
                        </defs>
                        <polygon class="g" points="267.91 202.77 234.19 267.54 200.56 202.77 134.74 202.77 204.09 322.86 204.09 401.26 263.44 401.26 263.44 322.86 332.89 202.77 267.91 202.77"></polygon>
                        <polygon class="f" points="392.42 0 0 143.22 392.42 73.9 392.42 0"></polygon>
                        <polygon class="g" points="3.43 401.26 162.23 401.26 162.23 355.61 62.96 355.61 62.96 322.86 134.74 322.86 134.74 281.18 62.96 281.18 62.96 248.42 142.37 248.42 116.02 202.77 3.43 202.77 3.43 401.26"></polygon>
                        <g clip-path="url(#ey-logo-second-line)" id="ey-logo-text-second-line">
                            <path class="g" d="M865.51,378.72c0,1.43-.1,3.23-.19,3.9h-27.2c.48,6.28,4.76,8.85,9.61,8.85,2.85,0,5.52-.86,7.8-3.14l7.99,6.75c-4.18,5.23-10.56,7.13-16.26,7.13-13.13,0-20.64-10.08-20.64-23.3,0-14.36,8.85-23.49,19.88-23.49,11.79,0,19.02,10.37,19.02,23.3ZM838.31,373.87h15.98c-.38-5.04-3.61-8.47-8.18-8.47-5.42,0-7.51,4.76-7.8,8.47Z"></path>
                            <path class="g" d="M1000,378.72c0,1.43-.1,3.23-.19,3.9h-27.2c.48,6.28,4.76,8.85,9.61,8.85,2.85,0,5.52-.86,7.8-3.14l7.99,6.75c-4.18,5.23-10.56,7.13-16.26,7.13-13.13,0-20.64-10.08-20.64-23.3,0-14.36,8.85-23.49,19.88-23.49,11.79,0,19.02,10.37,19.02,23.3ZM972.8,373.87h15.98c-.38-5.04-3.61-8.47-8.18-8.47-5.42,0-7.51,4.76-7.8,8.47Z"></path>
                            <path class="g" d="M950.16,385.29l7.42,7.04c-3.8,4.85-9.04,9.89-17.88,9.89-12.27,0-21.31-9.8-21.31-23.3,0-12.36,7.51-23.49,21.5-23.49,7.99,0,13.51,3.61,17.6,9.7l-7.61,7.7c-2.66-3.52-5.52-6.28-10.08-6.28-6.18,0-9.42,5.23-9.42,12.17,0,6.47,2.85,12.27,9.51,12.27,4.09,0,7.51-2.19,10.27-5.71Z"></path>
                            <path class="g" d="M911.54,401.26h-11.6v-24.44c0-6.28-1.43-10.46-7.7-10.46-5.9,0-7.8,3.52-7.8,10.18v24.73h-11.6v-44.89h11.6v3.04c2.38-2.38,5.9-3.99,10.94-3.99,12.17,0,16.17,9.42,16.17,20.45v25.4Z"></path>
                            <path class="g" d="M766.4,352.47c3.71,0,6.66-2.95,6.66-6.66s-2.95-6.66-6.66-6.66-6.66,2.95-6.66,6.66,2.95,6.66,6.66,6.66Z"></path>
                            <path class="g" d="M469.84,352.47c3.71,0,6.66-2.95,6.66-6.66s-2.95-6.66-6.66-6.66-6.66,2.95-6.66,6.66,2.95,6.66,6.66,6.66Z"></path>
                            <path class="g" d="M808.06,387.38v-17.12c-2.47-2.66-4.85-3.9-8.08-3.9-6.75,0-8.37,5.33-8.37,11.7,0,7.23,2.09,13.22,8.66,13.22,3.23,0,5.52-1.43,7.8-3.9ZM819.67,401.26h-11.6v-2.95c-3.8,2.76-6.09,3.9-10.18,3.9-12.94,0-18.45-11.22-18.45-23.78,0-13.6,6.47-23.02,18.17-23.02,3.9,0,7.61,1.05,10.46,3.61v-14.36l11.6-5.8v62.39Z"></path>
                            <rect class="g" x="760.51" y="356.37" width="11.6" height="44.89"></rect>
                            <path class="g" d="M753.75,340.39v9.32c-1.71-.57-3.99-.86-5.71-.86-3.33,0-4.85,1.05-4.85,3.9v3.61h9.61v10.84h-9.61v34.05h-11.6v-34.05h-6.28v-10.84h6.28v-5.42c0-8.37,5.23-11.79,13.7-11.79,2.47,0,6.09.29,8.47,1.24Z"></path>
                            <path class="g" d="M719.61,401.26h-11.6v-24.44c0-6.28-1.43-10.46-7.7-10.46-5.9,0-7.8,3.52-7.8,10.18v24.73h-11.6v-44.89h11.6v3.04c2.38-2.38,5.9-3.99,10.94-3.99,12.17,0,16.17,9.42,16.17,20.45v25.4Z"></path>
                            <path class="g" d="M652.93,355.42c-12.94,0-21.02,10.18-21.02,23.4,0,13.89,8.85,23.4,21.02,23.4s21.02-9.51,21.02-23.4-8.08-23.4-21.02-23.4ZM652.93,390.99c-7.42,0-9.04-7.13-9.04-12.17,0-6.94,2.85-12.27,9.04-12.27s9.04,5.33,9.04,12.27c0,5.04-1.62,12.17-9.04,12.17Z"></path>
                            <path class="g" d="M620.69,385.29l7.42,7.04c-3.8,4.85-9.04,9.89-17.88,9.89-12.27,0-21.31-9.8-21.31-23.3,0-12.36,7.51-23.49,21.5-23.49,7.99,0,13.51,3.61,17.6,9.7l-7.61,7.7c-2.66-3.52-5.52-6.28-10.08-6.28-6.18,0-9.42,5.23-9.42,12.17,0,6.47,2.85,12.27,9.51,12.27,4.09,0,7.51-2.19,10.27-5.71Z"></path>
                            <path class="g" d="M560.67,401.26h-11.6v-24.44c0-6.28-1.43-10.46-7.7-10.46-5.9,0-7.89,3.52-7.89,10.18v24.73h-11.6v-56.59l11.6-5.8v20.54c2.19-2.66,6.75-3.99,11.22-3.99,11.79,0,15.98,9.32,15.98,20.45v25.4Z"></path>
                            <path class="g" d="M514.73,387.76l-1.71,11.7c-2.38,1.9-8.08,2.76-11.13,2.76-7.04,0-12.08-5.61-12.08-13.41v-21.59h-7.8v-10.84h7.8v-11.7l11.6-5.8v17.5h13.13v10.84h-13.13v18.45c0,4.09,1.52,5.42,4.28,5.42s7.04-1.43,9.04-3.33Z"></path>
                            <rect class="g" x="464.04" y="356.37" width="11.6" height="44.89"></rect>
                            <polygon class="g" points="457.95 356.37 443.78 401.26 433.13 401.26 425.52 373.97 417.81 401.26 407.16 401.26 393.08 356.37 406.02 356.37 412.77 382.43 420.38 356.37 430.94 356.37 438.55 382.43 445.4 356.37 457.95 356.37"></polygon>
                        </g>
                        <g clip-path="url(#ey-logo-first-line)" id="ey-logo-text-first-line">
                            <path class="g" d="M846.68,310.72h-11.03v-3.14c-2.47,2.76-6.47,4.09-10.46,4.09-11.6,0-15.98-8.37-15.98-20.45v-25.4h11.22v24.44c0,6.09,1.24,10.65,7.51,10.65s7.51-4.76,7.51-10.27v-24.82h11.22v44.89Z"></path>
                            <path class="g" d="M881.68,297.59l-1.62,11.41c-2.28,1.81-6.47,2.66-9.23,2.66-6.85,0-12.17-5.14-12.17-13.32v-21.78h-6.47v-10.75h6.47v-11.7l11.22-5.71v17.41h10.65v10.75h-10.65v18.83c0,3.9,1.62,5.33,4.38,5.33s5.61-1.43,7.42-3.14Z"></path>
                            <path class="g" d="M711.24,310.72h-11.22v-24.44c0-6.09-1.33-10.56-7.61-10.56s-7.7,4.09-7.7,10.27v24.73h-11.22v-56.59l11.22-5.71v20.54c2.47-2.47,5.52-4.09,10.56-4.09,11.89,0,15.98,9.13,15.98,20.54v25.3Z"></path>
                            <path class="g" d="M1000,288.17c0,1.43-.1,3.23-.19,3.9h-27.2c.48,6.28,4.76,8.85,9.61,8.85,2.85,0,5.52-.86,7.8-3.14l7.99,6.75c-4.18,5.23-10.56,7.13-16.26,7.13-13.13,0-20.64-10.08-20.64-23.3,0-14.36,8.85-23.49,19.88-23.49,11.79,0,19.02,10.37,19.02,23.3ZM972.8,283.32h15.98c-.38-5.04-3.61-8.47-8.18-8.47-5.42,0-7.51,4.76-7.8,8.47Z"></path>
                            <path class="g" d="M924.39,310.72h-11.03v-3.14c-2.47,2.76-6.47,4.09-10.46,4.09-11.6,0-15.98-8.37-15.98-20.45v-25.4h11.22v24.44c0,6.09,1.24,10.65,7.51,10.65s7.51-4.76,7.51-10.27v-24.82h11.22v44.89Z"></path>
                            <path class="g" d="M755.85,288.17c0,1.43-.1,3.23-.19,3.9h-27.2c.48,6.28,4.76,8.85,9.61,8.85,2.85,0,5.52-.86,7.8-3.14l7.99,6.75c-4.18,5.23-10.56,7.13-16.26,7.13-13.13,0-20.64-10.08-20.64-23.3,0-14.36,8.85-23.49,19.88-23.49,11.79,0,19.02,10.37,19.02,23.3ZM728.64,283.32h15.98c-.38-5.04-3.61-8.47-8.18-8.47-5.42,0-7.51,4.76-7.8,8.47Z"></path>
                            <path class="g" d="M806.35,249.94v9.23c-2.57-.67-4.28-.95-5.8-.95-3.99,0-4.85,1.43-4.85,3.71v3.9h7.61v10.84h-7.61v34.05h-11.22v-34.05h-5.52v-10.84h5.52v-5.42c0-7.8,4.09-11.79,13.6-11.79,3.04,0,5.52.57,8.27,1.33Z"></path>
                            <path class="g" d="M668.34,297.59l-1.62,11.41c-2.28,1.81-6.28,2.66-9.04,2.66-6.85,0-12.17-5.14-12.17-13.32v-21.78h-7.8v-10.75h7.8v-11.7l11.22-5.71v17.41h10.46v10.75h-10.46v18.83c0,3.9,1.62,5.33,4.38,5.33s5.42-1.43,7.23-3.14Z"></path>
                            <path class="g" d="M616.12,288.17c0,1.43-.1,3.23-.19,3.9h-26.25c.48,6.28,4.85,8.85,9.7,8.85,2.85,0,5.42-.86,7.7-3.14l7.99,6.75c-3.71,4.95-10.46,7.13-16.45,7.13-12.84,0-20.45-10.08-20.45-23.21s8.27-23.59,19.97-23.59c12.55,0,17.98,11.41,17.98,23.3ZM589.87,283.32h15.98c-.48-5.04-3.42-8.47-8.27-8.47-5.14,0-7.42,4.76-7.7,8.47Z"></path>
                            <path class="g" d="M572.85,288.37c0,11.51-4.76,23.3-17.5,23.3-4.95,0-7.99-1.81-9.99-3.71v13.7l-11.22,5.61v-61.44h11.22v3.04c2.95-2.66,5.99-3.99,10.18-3.99,12.08,0,17.31,11.41,17.31,23.49ZM561.24,288.94c0-6.56-1.71-13.22-8.47-13.22-3.14,0-5.61,1.43-7.42,3.99v17.12c1.81,2.57,4.85,4.09,8.08,4.09,6.28,0,7.8-5.71,7.8-11.98Z"></path>
                            <path class="g" d="M526.34,310.72h-11.22v-3.14c-2.66,2.66-6.09,4.09-10.46,4.09-8.85,0-15.79-5.71-15.79-15.6s6.75-15.12,17.5-15.12c2.85,0,5.8.38,8.75,1.81v-2.38c0-4.18-2.76-5.9-7.7-5.9-3.52,0-6.85.86-10.37,2.95l-4.47-7.99c4.85-3.04,9.51-4.57,15.5-4.57,11.32,0,18.26,5.52,18.26,15.69v30.15ZM515.11,297.59v-5.71c-2.28-1.43-5.23-1.9-7.51-1.9-4.95,0-7.32,2.19-7.32,5.8,0,3.42,2.19,6.18,6.37,6.18,2.19,0,5.99-.76,8.47-4.38Z"></path>
                            <path class="g" d="M482.68,310.72h-11.22v-24.44c0-6.09-1.33-10.56-7.61-10.56s-7.7,4.09-7.7,10.27v24.73h-11.22v-56.59l11.22-5.71v20.54c2.47-2.47,5.52-4.09,10.56-4.09,11.89,0,15.98,9.13,15.98,20.54v25.3Z"></path>
                            <path class="g" d="M438.74,292.74c0,13.51-10.27,18.93-22.45,18.93-8.75,0-18.45-2.76-23.87-10.75l8.37-7.42c3.9,4.66,9.51,6.85,15.22,6.85,6.75,0,10.65-3.04,10.65-7.32,0-1.71-.67-3.42-3.52-4.85-2.09-1.05-4.66-1.71-9.7-2.95-3.14-.76-9.61-2.28-13.6-5.52-3.99-3.23-5.14-7.89-5.14-11.98,0-12.65,10.84-17.79,21.5-17.79,9.23,0,15.88,3.8,21.21,9.23l-8.37,8.18c-3.9-3.9-7.7-6.09-13.6-6.09-5.04,0-8.75,1.62-8.75,5.8,0,1.81.67,3.04,2.47,4.09,2.09,1.14,5.04,2,9.61,3.14,5.42,1.43,10.46,2.66,14.55,5.99,3.61,2.95,5.42,6.85,5.42,12.46Z"></path>
                            <path class="g" d="M961.57,267.92l-4.58,11.22c-1.71-1.62-3.71-2.76-6.47-2.76-5.33,0-6.65,4.47-6.65,9.89v24.44h-11.22v-44.89h11.22v3.14c2.57-2.57,5.8-4.09,9.42-4.09,3.14,0,5.9.95,8.27,3.04Z"></path>
                        </g>
                        </svg>
                    </a>
				</div>
				<?php if($this->session->flashdata('login_success')){ ?>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> <?php echo $this->session->flashdata('login_success'); ?>
					</div>
				<?php }else if($this->session->flashdata('login_error')){  ?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Error!</strong> <?php echo $this->session->flashdata('login_error'); ?>
					</div>
				<?php }?>
				<?php
			   $form_attribute=array(
						'name' => 'sign_in',
						'class' => '',
						'method' =>"POST",
						'autocomplete'=>"off",
						'id' => 'sign_in',
						'novalidate' => 'novalidate',
						);
				$hidden = array('action' => 'ALogin');
				// Form Open
				echo form_open('',$form_attribute,$hidden);
				?>
				<form action="" id="sign_in" name="sign_in">
					<div class="form-group form-focus">
						<label class="focus-label">Username or Email</label>
						<input class="form-control floating" type="text" name="username" id="username">
					</div>
					<div class="form-group form-focus">
						<label class="focus-label">Password</label>
						<input class="form-control floating" type="password" name="password" id="password">
					</div>
					<div id="login-message"></div>
					<div class="form-group text-center">
						<button class="btn btn-primary btn-block account-btn submit" type="submit">Login</button>
					</div>
					<div class="text-center">
						<!-- <a href="#">Forgot your password?</a> -->
					</div>
				<?php
					// Form Close
					echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript" src="<?=base_url(); ?>/assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>/assets/js/popper.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>/assets/js/app.js"></script>
<script type="text/javascript">
// Ajax post
$(document).ready(function() {
	$(".submit").click(function(event) {
		event.preventDefault();
		var form=$("#sign_in");
		$("#login-message").empty();
		$(".submit").addClass("disabled");
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "ajax/login",
			dataType: 'json',
			async: true,
			cache: false,
			data: form.serialize(),
			success: function(res) {
				if (res)
				{
					if(res.status==1){
						msg='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>'+res.message+'</div>';
                        $("#login-message").html(msg);
                        setTimeout(function(){ $(location).attr('href',res.redirect_url); }, 1000);
                        //$(location).attr('href',res.redirect_url);
						return false;
						//console.log(res);
					}else if (res.status==0){
						$(".submit").removeClass("disabled");
						msg='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>'+res.message+'</div>';
						$("#login-message").html(msg);
						return false;
						//console.log(res);
					}
				}
			}
		});
	});
	$(".alert").delay(4000).fadeOut(200, function() {
		$(this).alert('close');
	});
});
</script>
</body>
</html>