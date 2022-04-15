<?php

function authentication()
{
    $CI = get_instance();

    if(!$CI->session->userdata('user_id')){
		$CI->session->set_flashdata('message', '<div class="alert alert-danger fade show">Silakan login terlebih dahulu !</div>');
		
        redirect('auth');
    }
}
