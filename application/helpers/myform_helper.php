<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function my_select($label='', $name='', $options, $required=true)
{
    $CI =& get_instance();

    $options[''] = 'Pilih';

    $readonly = '';
    if ( $CI->mode != 'w' )
    {
        $readonly = 'disabled';
    }
    
    $req = '';
    $bintang = '';
    if ( $required)
    {
        $req = 'required';
        $bintang = '<span class="font-red"> * </span>';
    }

    $value='';
    if($CI->d){
        $value = $CI->d->{$name};
    }

    if ( $CI->mode != 'w' )
    {
        $res =
            '<label class="form-control">'.$options[$value].'</label>';
    }
    else
    {
        $res = 
            form_dropdown($name, $options, $value, 'class="form-control '.$req.' select2" ');
    }

    return '
    <div class="form-group">
        <label class="control-label col-md-3">'.$label.$bintang.'</label>
        </label>
        <div class="col-md-4">
            '.$res.'
        </div>
    </div>
    ';

}

function my_text($label='', $name='', $required=true, $class='', $placeholder='')
{
    $CI =& get_instance();

    $req = '';
    $bintang = '';
    if ( $required )
    {
        $req = 'required';
        $bintang = '<span class="font-red"> * </span>';
    }

    $value='';
    if($CI->d){
        $value = $CI->d->{$name};
    }

    if ( $CI->mode != 'w' )
    {
        $res =
            '<label class="form-control">'.$value.'</label>';
    }
    else
    {
        $res = 
            '<input type="text" class="form-control '.$class.' '.$req.'" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';

    }

    
    return '  
    <div class="form-group">
        <label class="control-label col-md-3">'.$label.$bintang.' </label>
        <div class="col-md-4">
            '.$res.'
        </div>
    </div>

    ';

}

function my_textarea($label='', $name='', $required=true, $class='')
{
    $CI =& get_instance();

    $req = '';
    $bintang = '';
    if ( $required )
    {
        $req = 'required';
        $bintang = '<span class="font-red"> * </span>';
    }

    $value='';
    if($CI->d){
        $value = $CI->d->{$name};
    }

    if ( $CI->mode != 'w' )
    {
        $res =
            '<textarea class="form-control" name="'.$name.'" rows="3" >'.$value.'</textarea>';
    }
    else
    {
        $res = 
            '<textarea class="form-control '.$req.'" name="'.$name.'" rows="3">'.$value.'</textarea>';
    }

    
    return '  
    <div class="form-group">
        <label class="control-label col-md-3">'.$label.$bintang.' </label>
        <div class="col-md-4">
            '.$res.'
        </div>
    </div>

    ';

}

function my_block($label='')
{
    return '<h3 class="block">'.$label.'</h3>';
}

function my_date($label='', $name='', $required=true, $class='')
{
    $CI =& get_instance();

    $req = '';
    $bintang = '';
    if ( $required )
    {
        $req = 'required';
        $bintang = '<span class="font-red"> * </span>';
    }

    $value='';
    if($CI->d){
        $value = $CI->d->{$name};
    }
    $value = formatTanggal($value);

    if ( $CI->mode != 'w' )
    {
        $res =
            '<label class="form-control">'.$value.'</label>';
    }
    else
    {
        $res =
            '<div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <input type="text" class="form-control date-picker'.$class.' '.$req.'" name="'.$name.'" value="'.$value.'" readonly />
            </div>';

    }

    
    return '  
    <div class="form-group">
        <label class="control-label col-md-3">'.$label.$bintang.' </label>
        <div class="col-md-4">
            '.$res.'
        </div>
    </div>

    ';

}