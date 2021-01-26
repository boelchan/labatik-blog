<?php

$string = "<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='portlet light'>
                <div class='portlet-title'>
                    <div class='caption'>
                        <?php echo btnBack() ?>
                        <span class='caption-subject bold'></span>
                    </div>
                    <div class=\"actions\">
                        <?php echo btnEdit(\$row->".$pk.") ?>
                    </div>
                </div>
                <div class='portlet-body'>
                    <table class=\"table\">";
                foreach ($non_pk as $row) {
                    if($row['r_table'] ) {
                        $string .= "
                        <?php
                            \$".$row["column_name"]." = \$row->".$row["column_name"].";
                            if (!empty($".$row["column_name"].")) 
                            {
                                \$".$row["column_name"]."_name = \$this->".$row["r_model"]."->get($" . $row["column_name"] . ")->{".$row["r_label"]."};
                            }
                            else
                            {
                                \$".$row["column_name"]."_name = '';
                            }
                        ?>
                        <tr>
                            <td>".label($row["column_name"])."</td>
                            <td><?php echo \$".$row["column_name"]."_name; ?></td>
                        </tr>";
                    }else if($row["img"] ){
                        $string .= "
                        <?php \$".$row["column_name"]." = (isset(\$row)) ? \$row->".$row["column_name"]." : ''; ?>
                        <tr>
                            <td>".label($row["column_name"])."</td>
                            <td>
                                <img class=\"btn no-space\" style=\"max-width: 100px; max-height: 100px;\" src=\"<?php echo load_image('uploads/temp/'.$" . $row["column_name"] . "); ?>\" alt=\"Image\">
                            </td>
                        </tr>";
                    }
                    else {
                        $string .= "
                        <tr>
                            <td>".label($row["column_name"])."</td>
                            <td><?php echo \$row->".$row["f_name"]."; ?></td>
                        </tr>";
                    }
                }
                      $string .= "
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>";



$hasil_view_read = createFile($string, $target_view. $v_read_file);

?>
