<div class="col-md-12">
            <div class="team-player">
              <h4 class="title">Alterar pesquisa</h4>





              {pesquisa}


                  <form class="form" method="post" action="<?= base_url(); ?>pesquisas/alterarPesquisa">
                      <div class="content">
                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <input type="text" name="titulo" class="form-control" value="{titulo}" placeholder="Titulo...">
                          </div>




                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <!-- markup -->
                              <input type="text" name="dt_ini" class="form-control" value="{dt_ini}" placeholder="Data de início..." / data-datepicker-color="primary">

                          </div>




                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <!-- markup -->
                              <input type="text" name="dt_fim" class="form-control" value="{dt_fim}" placeholder="Data de Finalização..." / data-datepicker-color="primary">

                          </div>

                          <textarea class="form-control" name="descricao" placeholder="Here can be your nice text" rows="5">{descricao}</textarea>

                              <!-- markup -->
                              <select class="form-control" name="status">
                                  <option value="0">Criada</option>
                                  <option value="1">Publicada</option>
                                  <option value="2">Finalizada</option>
                              </select>

                              <input type="hidden" name="id_pesquisa" value="{id_pesquisa}"/>

                      </div>
                      <div class="footer text-center">
                          <button  class="btn btn-primary btn-round btn-lg btn-block">Salvar</button>
                      </div>
                  </form>




            </div>
        </div>





        {/pesquisa}





        <hr>

        <div class="col-md-12">
                    <div class="team-player">
                      <h4 class="title">Questões</h4>


{questao}





<form class="form" method="post" action="<?= base_url(); ?>questoes/alterar">
    <div class="content">




      <div class="radio">
          <input type="radio" name="tipo" id="radio1" value="0" checked>
          <label for="radio1">
              Qualitativa
          </label>

          <input type="radio" name="tipo" id="radio2" value="1">
          <label for="radio2">
              Quantitativa
          </label>
      </div>



        <textarea class="form-control" name="texto" placeholder="Here can be your nice text" rows="5">{texto}</textarea>


        <div class="input-group form-group-no-border input-lg">
            <span class="input-group-addon">
                <i class="now-ui-icons users_circle-08"></i>
            </span>
            <input type="text" name="a" class="form-control" value="{a}" placeholder="Escreva a opção...">
        </div>

        <div class="input-group form-group-no-border input-lg">
            <span class="input-group-addon">
                <i class="now-ui-icons users_circle-08"></i>
            </span>
            <input type="text" name="b" class="form-control" value="{b}" placeholder="Escreva a opção...">
        </div>

        <div class="input-group form-group-no-border input-lg">
            <span class="input-group-addon">
                <i class="now-ui-icons users_circle-08"></i>
            </span>
            <input type="text" name="c" class="form-control" value="{c}" placeholder="Escreva a opção...">
        </div>

        <div class="input-group form-group-no-border input-lg">
            <span class="input-group-addon">
                <i class="now-ui-icons users_circle-08"></i>
            </span>
            <input type="text" name="d" class="form-control" value="{d}" placeholder="Escreva a opção...">
        </div>

        <div class="input-group form-group-no-border input-lg">
            <span class="input-group-addon">
                <i class="now-ui-icons users_circle-08"></i>
            </span>
            <input type="text" name="e" class="form-control" value="{e}" placeholder="Escreva a opção ...">
        </div>

      <input type="hidden" name="id_questao" value="{id_questao}">

    </div>
    <div class="footer text-center">
        <button  class="btn btn-primary btn-round btn-lg btn-block">Salvar</button>
    </div>
</form>
</div>
</div>




<hr>
{/questao}


</div>
</div>
</div>


        <!-- javascript -->
        <script>
        $('.date-picker').each(function(){
            $(this).datepicker({
                templates:{
                    leftArrow: '<i class="now-ui-icons arrows-1_minimal-left"></i>',
                    rightArrow: '<i class="now-ui-icons arrows-1_minimal-right"></i>'
                }
            }).on('show', function() {
                    $('.datepicker').addClass('open');

                    datepicker_color = $(this).data('datepicker-color');
                    if( datepicker_color.length != 0){
                        $('.datepicker').addClass('datepicker-'+ datepicker_color +'');
                    }
                }).on('hide', function() {
                    $('.datepicker').removeClass('open');
                });
        });
    </script>
