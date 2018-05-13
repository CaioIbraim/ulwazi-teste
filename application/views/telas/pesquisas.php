<div class="col-md-12">
            <div class="team-player">
              <h4 class="title">Cadastro de pesquisas</h4>
                  <form class="form" method="post" action="<?= base_url(); ?>pesquisas/cadastrar">
                      <div class="content">
                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <input type="text" name="titulo" class="form-control" placeholder="Titulo...">
                          </div>




                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <!-- markup -->
                              <input type="text" name="dt_ini" class="form-control" placeholder="Data de início..." / data-datepicker-color="primary">

                          </div>




                          <div class="input-group form-group-no-border input-lg">
                              <span class="input-group-addon">
                                  <i class="now-ui-icons users_circle-08"></i>
                              </span>
                              <!-- markup -->
                              <input type="text" name="dt_fim" class="form-control" placeholder="Data de Finalização..." / data-datepicker-color="primary">

                          </div>



                          <textarea class="form-control" name="descricao" placeholder="Here can be your nice text" rows="5"></textarea>





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
