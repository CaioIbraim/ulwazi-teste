<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
	    <meta charset="utf-8" />

	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	    <title>...</title>
	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	    <!--     Fonts and icons     -->
	    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	    <!-- CSS Files -->
	    <link href="<?= base_url(); ?>theme/assets/css/bootstrap.min.css" rel="stylesheet" />
	    <link href="<?= base_url(); ?>theme/assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
	    <!-- CSS Just for demo purpose, don't include it in your project -->
	    <link href="<?= base_url(); ?>theme/assets/css/demo.css" rel="stylesheet" />
	</head>

	<body class="login-page sidebar-collapse">
	    <div class="page-header" filter-color="orange">
	        <div class="page-header-image" style="background-image:url(<?= base_url(); ?>theme/assets/img/login.jpg)"></div>
	        <div class="container">
	            <div class="col-md-4 content-center">
	                <div class="card card-login card-plain">
											<h3>{message}</h3>
											<a href="http://localhost/pesquisa/main">Voltar</a>
	                </div>
	            </div>
	        </div>
	        <footer class="footer">
	            <div class="container">
	                <nav>
	                    <ul>
	                        <li>
	                            <a href="https://www.creative-tim.com">
	                                Creative Tim
	                            </a>
	                        </li>
	                        <li>
	                            <a href="http://presentation.creative-tim.com">
	                                About Us
	                            </a>
	                        </li>
	                        <li>
	                            <a href="http://blog.creative-tim.com">
	                                Blog
	                            </a>
	                        </li>
	                        <li>
	                            <a href="https://github.com/creativetimofficial/now-ui-kit/blob/master/LICENSE.md">
	                                MIT License
	                            </a>
	                        </li>
	                    </ul>
	                </nav>
	                <div class="copyright">
	                    &copy;
	                    <script>
	                        document.write(new Date().getFullYear())
	                    </script>, Designed by
	                    <a href="http://www.invisionapp.com" target="_blank">Invision</a>. Coded by
	                    <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
	                </div>
	            </div>
	        </footer>
	    </div>
	</body>
	<!--   Core JS Files   -->
	<script src="<?= base_url(); ?>theme/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>theme/assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>theme/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
	<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
	<script src="<?= base_url(); ?>theme/assets/js/plugins/bootstrap-switch.js"></script>
	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="<?= base_url(); ?>theme/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
	<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
	<script src="<?= base_url(); ?>theme/assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
	<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
	<script src="<?= base_url(); ?>theme/assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

	</html>
