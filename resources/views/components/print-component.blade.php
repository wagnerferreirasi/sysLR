<div id="printThis">
    <div>
        <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="receipt">
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                        <div class="row">
                                            <div class="col-sm-12 px-5 py-4">
                                                <h3>Voucher</h3>
                                            </div>
                                            <div class="col-sm-12 px-5 pb-4">
                                                <span class="badge badge-pill badge-warning">
                                                    <h6 class="mb-0" id="code"></h6>
                                                </span>
                                            </div>
                                            <div class="col-sm-12 px-5 pb-5">
                                                <div id="printable" class="sheet padding-10mm">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col text-center">
                                                            <img src="{{ asset('assets/img/logoalpha.png') }}"
                                                                class="img-fluid" alt="logo header voucher">
                                                        </div>
                                                    </div>

                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col">
                                                            <hr>
                                                            <p class="my-2 font-weight-bold h3 text-center">LR TUR
                                                                TRANSLOG</p>
                                                            <p class="small my-0">CNPJ:</p>
                                                            <p class="small my-0">LOJA:</p>
                                                            <p class="small my-0">
                                                                ENDEREÇO:
                                                                <br />
                                                                <br />
                                                                CEP:
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col">
                                                            <hr>
                                                            <p class="my-2 text-center lead">COMPROVANTE DO CLIENTE</p>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col">
                                                            <p class="text-left my-0" id="cashier">
                                                                <br />
                                                            <h3 id="payOnDelivery"></h3>
                                                            </p>
                                                            <p class="my-0" id="user"></p>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col">
                                                            <table class="table table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">ITEM</th>
                                                                        <th scope="col">VALOR</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th id="size"></th>
                                                                        <td id="value"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <p class="my-0" id="value"></p>
                                                            <p class="my-0" id="destiny"></p>
                                                            <p class="my-0" id="size"></p>
                                                            <p class="my-0 texto-maior text-center">RASTREADOR:</p>
                                                            <p class="my-0 texto-maior text-center" id="code1"></p>
                                                            <p class="my-0 display-4 text-center">
                                                            <p class="lead text-center my-0 font-weight-bold"></p>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="d-flex">
                                                            <img src="" width="330px" />
                                                            <hr>
                                                        </div>
                                                        <div class="col text-center">
                                                            <p class="my-0 display-5" id="code2"></p>
                                                        </div>
                                                    </div>

                                                    <div class="page"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="showModalButtons">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-success" onClick="window.print();return false">Imprimir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
