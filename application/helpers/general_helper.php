<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function load_image($image, $thumb='')
{

    if (!empty($image)) {
        $image   = 'uploads/'.$image;

        if (file_exists($image)) {
            $extension_pos = strrpos($image, '.'); // find position of the last dot, so where the extension starts
            if ($thumb) {
                $filename      = substr($image, 0, $extension_pos) . '_thumb' . substr($image, $extension_pos);
            } else {
                $filename      = substr($image, 0, $extension_pos). substr($image, $extension_pos);
            }
            
            if (is_file($filename) && file_exists($filename) && $thumb) {
                return base_url($filename);
            }
            return base_url($image);
        }
    }

    if (strpos($image, 'users/')) {
        return base_url('assets/global/img/default/man.png');
    }
    return "data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==";
}


function delete_image($image)
{
    //delete main image
    $image = 'uploads/'.$image;
    if (is_file($image) && file_exists($image)) {
        unlink($image);
    }
    //delete thumb image
    $extension_pos = strrpos($image, '.'); // find position of the last dot, so where the extension starts
    $image          = substr($image, 0, $extension_pos) . '_thumb' . substr($image, $extension_pos);
    if (is_file($image) && file_exists($image)) {
        unlink($image);
    }
}

function url($string) {
   $string = strtolower(str_replace(' ', '-', $string)); // Replaces all spaces with hyphens. and lowercase
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}


function idr($angka)
{    
    $hasil_rupiah = number_format($angka,0,',','.');
    return $hasil_rupiah;
}

function convertDate($var = '', $array=false)
{
    if (is_null($var)) {
        return '';
    }
    $tgl = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Ags","Sep","Okt","Nov","Des");
    $pecah = explode("-", $var);
    if ( $array )
    {
        return $pecah+[3=> $tgl[$pecah[1] - 1]];
    }
    else
    {
        return $pecah[2]." ".$tgl[$pecah[1] - 1]." ".$pecah[0];
    }
}


/**
 * konfersi date time / times stamp
 * @param  [type] $tgl [description]
 * @return [type]      [description]
 */
function id_date($tgl = 0){
    if ($tgl == 0) 
    {
        return '';
    }
    else
    {
        $a = explode(' ', $tgl);
        
        $thn = substr($a[0],0,4);
        $bln = substr($a[0],5,2);
        $tgl = substr($a[0],8,2);
        $ok = $tgl.'-'.$bln.'-'.$thn.' '.@$a[1];
        return $ok;

    }
}

// d-m-Y
function sys_date($tgl){
    $thn = substr($tgl,6,4);
    $bln = substr($tgl,3,2);
    $tgl = substr($tgl,0,2);
    $ok = $thn.'-'.$bln.'-'.$tgl;
    return $ok;
}

function get_id()
{
    $CI =& get_instance();

    return $CI->jwt->id.date('ymdHis');
}


