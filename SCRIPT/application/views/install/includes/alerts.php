<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (validation_errors()){
	echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.validation_errors('<p>','</p>').'</div>';
}
if ($this->session->flashdata('error_msg')){
	echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('error_msg').'</div>';
}
if ($this->session->flashdata('success_msg')){
	echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('success_msg').'</div>';
}
?>
