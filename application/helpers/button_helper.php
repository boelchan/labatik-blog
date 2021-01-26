<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


function btnRead($id, $content)
{
    $CI =& get_instance();

    if ( $content == '' )
    {
        $content = '---';
    }
    return anchor($CI->areaUrl.'read/'.$id, $content, 'title="klik untuk melihat"');
}

function btnCreate($text = '', $url='')
{
    $CI =& get_instance();

    if ($CI->create)
    {
        if ( empty($url) )
        {
            return anchor($CI->areaUrl.'create','<i class="fa fa-plus fa-md"></i> '.$text,array('title'=>'tambah data baru','class'=>'btn btn-outline btn-circle blue btn-sm'));
        }
        else
        {
            return anchor($url, '<i class="fa fa-plus fa-md"></i> '.$text,array('title'=>'tambah data baru','class'=>'btn btn-outline btn-circle blue btn-sm'));
        }
    } 
    else 
    {
        return '';
    }
    
}

function btnEdit($id='', $text = '', $url='')
{
    $CI =& get_instance();
    if ($CI->edit) 
    {
        if ( empty($url) )
        {
            return anchor($CI->areaUrl.'edit/'.$id, '<i class="icon-pencil"> </i> '.$text,array('title'=>'ubah data','class'=>'btn btn-outline btn-circle btn-sm yellow'));
        }
        else
        {
            return anchor($url.'/'.$id, '<i class="icon-pencil"> </i> '.$text,array('title'=>'ubah data','class'=>'btn btn-outline btn-circle btn-sm yellow'));
        }
    } 
    else 
    {
        return '';
    }
}

function btnEditTable($id = '', $url='')
{
    $CI =& get_instance();
    if ($CI->edit)
    {
        if ( empty($url) )
        {
            return anchor($CI->areaUrl.'edit/'.$id, '<i class="icon-pencil"> </i>', array('title'=>'ubah data','class'=>' font-yellow '));
        }
        else
        {
            return anchor($url.'/'.$id, '<i class="icon-pencil"> </i>', array('title'=>'ubah data','class'=>' font-yellow '));
        }
    } 
    else 
    {
        return '';
    }
}

function btnBack($url = '')
{
    if ($url == '') 
    {
        $CI =& get_instance();
        $url = $CI->areaUrl;
    }
        
    return anchor($url,'<i class="fa fa-arrow-left fa-lg"> </i>',array('title'=>'kembali','class'=>'btn btn-outline btn-circle btn-icon-only blue'));
}

function btnDestroy($id="")
{
    $CI =& get_instance();
    if ($CI->destroy) 
    {
        return '<button class="btn btn-outline btn-circle btn-sm red btn-destroy" data-id="'.$id.'"> <i class="fa fa-times fa-lg"> </i> Hapus </button>';
    } 
    else 
    {
        return '';
    }
}

function btnDestroyTable()
{
    $CI =& get_instance();
    if ($CI->destroy) 
    {
        return '<option value="destroy">Hapus</option>';
    } 
}