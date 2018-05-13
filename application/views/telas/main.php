


  <div class="page-header-image">
        </div>
        <div class="container">
            <div class="content-center brand">
                <h1 class="h1-seo">Plataforma de pesquisas ULWAZI</h1>
                {acao}
                <p>Software de pesquisa & inquéritos online - Crie um questionário e analise as respostas.</p>
            </div>
               <hr>
   </div>


   <div class="container">

     {info}
   </div>



       <div class="container">

                 {pesquisas}
                        <div class="row">
                              <div class="col-md-6">
                                <h4 class="title">{titulo}</h4>
                              </div>
                              <div class="col-md-6">
                                <h6 class="title">{participacao}</h6>
                                <p><small class="title"> {status} </small></p>
                                <p><small class="title"> Autor da pesquisa : {nome} </small></p>
                                <a href="<?= base_url();?>pesquisas/info/{id_pesquisa}" class="btn btn-primary btn-icon btn-round"><i class="fa fa-university"></i></a><a href="<?= base_url();?>pesquisas/questao/{id_pesquisa}" class="btn btn-primary btn-icon btn-round"><i class="fa fa-check"></i></a>
                             </div>
                        </div>
        <hr>
                 {/pesquisas}
       </div>
