<div class="col-md-12">
            <div class="team-player">
              <h4 class="title">Cadastro de questões para {titulo}</h4>
                  <form class="form" method="post" action="<?= base_url(); ?>questoes/cadastrar">
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



                          <textarea class="form-control" name="texto" placeholder="Here can be your nice text" rows="5"></textarea>


                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <input type="text" name="a" class="form-control" placeholder="Escreva a opção...">
                          </div>

                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <input type="text" name="b" class="form-control" placeholder="Escreva a opção...">
                          </div>

                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <input type="text" name="c" class="form-control" placeholder="Escreva a opção...">
                          </div>

                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <input type="text" name="d" class="form-control" placeholder="Escreva a opção...">
                          </div>

                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <input type="text" name="e" class="form-control" placeholder="Escreva a opção ...">
                          </div>




                          <input type="hidden" name="id_pesquisa" value="{id}">

                      </div>
                      <div class="footer text-center">
                          <button  class="btn btn-primary btn-round btn-lg btn-block">Criar</button>
                      </div>
                  </form>
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
