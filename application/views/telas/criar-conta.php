                <form class="form" method="post" action="<?= base_url(); ?>p_conta/cadastrar">
                    <div class="header header-primary text-center">
                        <div class="logo-container">
                            <img src="<?= base_url(); ?>/theme/assets/img/now-logo.png" alt="">
                        </div>
                    </div>
                    <br>
                    <div class="content">
                        <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons users_circle-08"></i>
                            </span>
                            <input type="text" name="cel" class="form-control" placeholder="Celular...">
                        </div>
                        <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons text_caps-small"></i>
                            </span>
                            <input type="text" name="nome" placeholder="Nome ..." class="form-control" />
                        </div>
                        <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons text_caps-small"></i>
                            </span>
                            <input type="text" name="email" placeholder="Email ..." class="form-control" />
                        </div>
                        <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons text_caps-small"></i>
                            </span>
                            <input type="password" name="senha" placeholder="Senha ..." class="form-control" />
                        </div>
                        <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons text_caps-small"></i>
                            </span>
                            <input type="password" name="confsenha" placeholder="Confirmar senha ..." class="form-control" />
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button  class="btn btn-primary btn-round btn-lg btn-block">Criar</button>
                    </div>
                    <div class="pull-left">
                        <h6>
                            <a href="<?= base_url(); ?>" class="link">Voltar</a>
                        </h6>
                    </div>
                    <div class="pull-right">
                        <h6>
                            <a href="#pablo" class="link">Problemas?</a>
                        </h6>
                    </div>
                </form>
