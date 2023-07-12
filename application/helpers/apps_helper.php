<?php

/* ========================================================================= */
/* 
/* ========================================================================= */

function user()
{
    $CI = get_instance();

    $CI->load->library('ion_auth');

    if (!$CI->ion_auth->logged_in())
    {
        redirect('auth/login');
    } else {
        return $CI->ion_auth->user()->row();
    }
}

/* ========================================================================= */
/* 
/* ========================================================================= */

function authorized()
{
    $CI = get_instance();

    $CI->load->library('ion_auth');

    if (!$CI->ion_auth->is_admin())
    {
        show_404();
    }
}

/* ========================================================================= */
/* 
/* ========================================================================= */

function upload_file($location, $file)
{
    $CI = get_instance();

    $config['upload_path']      = $location;
    $config['allowed_types']    = 'jpg|jpeg|png|pdf';
    $config['file_name']        = 'dokumen_'.date("ymds").rand();
    // $config['overwrite']     = true;
    // $config['max_size']      = 2048; // 2MB

    $CI->load->library('upload', $config);

    $CI->upload->do_upload($file);

    return $CI->upload->data('file_name');
}