<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light bordered'>
            <div class='portlet-title'>
                <div class="caption">
                    <span class="caption-subject font-dark sbold">Data</span>
                </div>
                <div class="actions">
                </div>
            </div>
            <div class='portlet-body'>
                <div class="panel-group accordion" id="accordion3">
                    <?php foreach ($pages as $p) : ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#<?php echo $p->page ?>"><?php echo $p->page ?></a>
                                </h4>
                            </div>
                            
                            <div id="<?php echo $p->page ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>
                                        <a href="<?php echo $this->areaUrl.'edit/'.$p->id ?>" class="btn btn-outline blue"><i class="fa fa-pencil"></i>ubah</a>
                                    </p>
                                    <p>
                                        <?php echo $p->content ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>