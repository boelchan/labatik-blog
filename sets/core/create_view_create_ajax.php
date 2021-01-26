<?php $string = "<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack() ?>
                    <span class='caption-subject bold '>Tambah Data</span>
                </div>
            </div>
            <div class='portlet-body form'>
            ";
foreach ($non_pk as $row) {
    if ($row["img"]) {
        $str = "<?php echo form_open_multipart(\$action, 'id=\"input-form\" class=\"form-horizontal\"'); ?>";
    }
    else
    {
        $str = "<?php echo form_open(\$action, 'id=\"input-form\" class=\"form-horizontal\"'); ?>";        
    }
}

$string .= "
                $str";
$string .= "

                    <div class='form-body'> ";
$i=0;
foreach ($non_pk as $row) {
    $bintang = '';
    if ($row['is_nullable'] != "YES") {
        $bintang = ' <span class="font-red">*</span> ';
    }
    $i++;
    if ($i % 2 == 1) {
        $string .="

                        <div class='row'>
                        ";
}

if ($row["data_type"] == 'text') {
    $string .= "
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>". label($row["f_name"]) . $bintang . "</label>
                                    <div class='col-md-9'>
                                        <textarea class=\"form-control\" rows=\"3\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"" . label($row["column_name"]) . "\"></textarea>
                                    </div>
                                </div>
                            </div>
                            ";
} else if($row['r_table'] ) {
    $string .= "
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>". label($row["f_name"]) . $bintang . "</label>
                                    <div class='col-md-9'>
                                        <select name='".$row["column_name"]."' class='form-control select2-ajax' data-url='<?php echo site_url('form/dd/".lcfirst($row["r_model"])."') ?>'> </select>
                                    </div>
                                </div>
                            </div>
                            ";
} else if($row["data_type"] == 'date' || $row["data_type"] == 'year' ){
    if ($row["data_type"] == 'date') {
        $class_date ='date-picker';
    }elseif($row["data_type"] == 'year'){
        $class_date ='date-year';
    }

    $string .= "
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>". label($row["f_name"]) . $bintang . "</label>
                                    <div class='col-md-9'>
                                        <div class='input-group date ".$class_date."' >
                                            <span class='input-group-btn'>
                                                <button class='btn default' type='button'>
                                                    <i class='fa fa-calendar'></i> </button>
                                            </span>
                                            <input type='text' class='form-control ' readonly name=\"" . $row["column_name"] . "\" value=\"\">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
} else if ($row["data_type"] == 'int' ){
    $string .= "
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>". label($row["f_name"]) . $bintang . "</label>
                                    <div class='col-md-9'>
                                        <input type=\"text\" class=\"form-control mask-number\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"" . label($row["column_name"]) . "\" value=\"<?php echo (isset(\$row->".$row["column_name"].")) ? \$row->".$row["column_name"]." : ''; ?>\" />
                                    </div>
                                </div>
                            </div>
                            ";
} else if($row["img"] ){
    $string2 .= "
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'> ". label($row["f_name"]) . $bintang . "</label>
                                    <div class='col-md-9'>
                                        <?php \$".$row["column_name"]." = (isset(\$row)) ? \$row->".$row["column_name"]." : ''; ?>
                                        <input type=\"hidden\" class=\"form-control\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"" . label($row["column_name"]) . "\" value=\"<?php echo \$".$row["column_name"]."; ?>\" />
                                        <img class=\"btn no-space upload_img_single\" id=\"" . $row["column_name"] . "_preview\" style=\"max-width: 100px; max-height: 100px;\" src=\"<?php echo load_image('uploads/temp/'.$" . $row["column_name"] . "); ?>\" alt=\"Image\">
                                    </div>
                                </div>
                            </div>
                            ";
    $string .= "
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'> ". label($row["f_name"]) . $bintang . "</label>
                                    <div class='col-md-9'>
                                        <?php \$".$row["column_name"]." = (isset(\$row)) ? \$row->".$row["column_name"]." : ''; ?>
                                        <div class=\"fileinput fileinput-new\" data-provides=\"fileinput\">
                                            <div class=\"fileinput-preview thumbnail\" data-trigger=\"fileinput\" style=\"width: 200px; height: 150px;\">
                                                <img src=\"<?php echo load_image(\"".$table_name."_".label($row["f_name"])."/\".\$".$row["column_name"]. ", \"thumb\") ?>\" alt=\"\">
                                            </div>
                                            <div>
                                                <span class=\"btn blue btn-outline btn-file\">
                                                    <span class=\"fileinput-new\"> Select image </span>
                                                    <span class=\"fileinput-exists\"> Change </span>
                                                    <input type=\"file\" name=\"image\" value=\"\"> </span>
                                                <a href=\"javascript:;\" class=\"btn red fileinput-exists\" data-dismiss=\"fileinput\"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
} else if($row["file"] ){
    $string2 .= "
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'> ". label($row["f_name"]) . $bintang . "</label>
                                    <div class='col-md-9'>
                                        <div>
                                            <?php \$".$row["column_name"]." = (isset(\$row)) ? \$row->".$row["column_name"]." : ''; ?>
                                            <input type=\"hidden\" class=\"form-control\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"" . label($row["column_name"]) . "\" value=\"<?php echo $" . $row["column_name"] . "; ?>\" />
                                            <button type=\"button\" class=\"btn btn-info\" onclick=\"$(this).next().click()\">Select file</button>
                                            <input data-url=\"<?php echo site_url('upload/do_upload_file') ?>\" type=\"file\" id=\"my_file\" style=\"display: none;\" onchange=\"upload_file($(this))\" />
                                            <span class=\"upload-filename\"><?php echo $" . $row["column_name"] . "; ?></span>
                                            <div class=\"upload-progres\"></div>
                                            <span class='help-block'> <?php echo form_error('video_file') ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
    $string .= "
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'> ". label($row["f_name"]) . $bintang . "</label>
                                    <div class='col-md-9'>
                                        <div>
                                            <?php \$".$row["column_name"]." = (isset(\$row)) ? \$row->".$row["column_name"]." : ''; ?>
                                            <div class=\"fileinput fileinput-new\" data-provides=\"fileinput\">
                                                <span class=\"btn green btn-file\">
                                                    <span class=\"fileinput-new\"> Select file </span>
                                                    <span class=\"fileinput-exists\"> Change </span>
                                                    <input type=\"file\" name=\"" . $row["column_name"] . "\"> </span>
                                                <span class=\"fileinput-filename\"> </span> &nbsp;
                                                <a href=\"javascript:;\" class=\"close fileinput-exists\" data-dismiss=\"fileinput\"> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
} else {
    $string .= "
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>". label($row["f_name"]) . $bintang . "</label>
                                    <div class='col-md-9'>
                                        <input type=\"text\" class=\"form-control\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"" . label($row["column_name"]) . "\" value=\"\" />
                                    </div>
                                </div>
                            </div>
                            ";
}
if ($i % 2 == 0) {
    $string .="
                        </div>";
}

}
if ($i % 2 == 1) {
    $string .="
                        </div>";
}
$string .= "
              
                    </div>
            
                    <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-offset-5 col-md-7'>
                                <button type='submit' class='btn blue btn-circle btn-outline'>Simpan Data Baru</button>
                            </div>
                        </div>
                    </div>
                        ";
$string .= "
                <?php echo form_close() ?>
                
            </div>
        </div>
    </div>
</div> ";

$hasil_view_create = createFile($string, $target_view . $v_create_file);
?>
