<script id="tmpl_curso_insc" type="x-tmpl-mustache">
{{#data}}
    <div class="col-lg-4">
                    <div class="contact-box" style="min-height: 171px">
                        <a style="align-items: center" class="row" href="?url=detalle">
                            <div class="col-5">
                                <div class="text-center">
                                    <div>
                                        <img alt="image" class="m-t-xs img-fluid" src="public/web/assets/img/cursos/curso1.jpg">
                                    </div>
                                    <div style="text-transform:uppercase" class="m-t-xs font-bold">
                                    {{description}}</div>
                                </div>
                            </div>
                            <div class="col-7">
                                <h3><strong>Status</strong></h3>

                                <p style="margin:0">
                                    <i class="fa fa-angle-double-right"></i>
                                    <strong>Curso:</strong> <span>{{estado_curso}}</span>

                                </p>
                                <p style="margin:0">
                                    <i class="fa fa-angle-double-right"></i>
                                    <strong>fecha de Termino:</strong> <span>{{fecha_fin}}</span>

                                </p>

                                <p style="margin:0">
                                    <i class="fa fa-angle-double-right"></i>
                                    <strong>Profesor.</strong> <span>{{profesor}}</span>

                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            {{/data}}
</script>
