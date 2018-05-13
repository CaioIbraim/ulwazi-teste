<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{title}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="<?= base_url(); ?>/theme/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/theme/assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?= base_url(); ?>/theme/assets/css/demo.css" rel="stylesheet" />
</head>

<body class="landing-page sidebar-collapse">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="<?= base_url(); ?>conta/exibir/<?= $this->session->id; ?>" rel="tooltip" title="O {PERFIL}" data-placement="bottom">
                    {NOME}
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="<?= base_url(); ?>theme/assets/img/blurred-image-1.jpg">
                <ul class="navbar-nav">

                  <li class="nav-item">
                      <a class="nav-link" href="<?= base_url(); ?>main">
                          <i class="now-ui-icons files_paper"></i>
                          <p>Home</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="<?= base_url(); ?>follow/solicitations">
                          <i class="now-ui-icons files_paper"></i>
                          <p>Solicitações  {SOL}</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="<?= base_url(); ?>follow">
                          <i class="now-ui-icons files_paper"></i>
                          <p>Contatos</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="<?= base_url(); ?>pesquisas/cadastrarPesquisa">
                          <i class="now-ui-icons files_paper"></i>
                          <p>Criar Pesquisa</p>
                      </a>
                  </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>pesquisas">
                            <i class="now-ui-icons files_paper"></i>
                            <p>Minhas Pesquisas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-neutral" href="<?= base_url(); ?>login/logout">
                            <i class="now-ui-icons arrows-1_share-66"></i>
                            <p>Sair</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="wrapper">
        <div class="page-header page-header-small">
            <div class="page-header-image" data-parallax="true" style="background-image: url('<?= base_url(); ?>theme/assets/img/bg6.jpg');">
            </div>
            <div class="container">
                <div class="content-center">
                    <h1 class="title">{title}</h1>

                </div>
            </div>
        </div>


        <div class="section section-team text-center">
            <div class="container">

                <div class="team">
                    <div class="row">

                      {conteudo}

                    </div>
                </div>
            </div>
        </div>

        <footer class="footer footer-default">
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
