<form class="form" method="post" action="<?= base_url(); ?>conta/alterar">
        <div class="input-group form-group-no-border input-lg">
            <span class="input-group-addon">
                <i class="now-ui-icons text_caps-small"></i>
            </span>
            <input type="text" name="nome" value="{nome}" placeholder="Nome ..." class="form-control" />
        </div>
        <div class="input-group form-group-no-border input-lg">
            <span class="input-group-addon">
                <i class="now-ui-icons text_caps-small"></i>
            </span>
            <input type="text" name="email" value="{email}" placeholder="Email ..." class="form-control" />
        </div>


          <textarea class="form-control"  name="descr" placeholder="Insira uma descrição para o seu perfil" rows="5"> {descr} </textarea>

    <div class="footer text-center">
        <button  class="btn btn-primary btn-round btn-lg btn-block">Alterar</button>
    </div>
</form>
