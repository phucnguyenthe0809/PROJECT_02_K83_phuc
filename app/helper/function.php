<?php

function showErrors($errors,$name){
    if ($errors->has($name)){
        echo '<div class="alert alert-danger" role="alert">';
        echo '<strong>'.$errors->first($name).'</strong>';
        echo '</div>';
    }
}


function getCate($arr,$parent,$tab){
	foreach($arr as $value){

		if($value['parent']==$parent){
			echo '<option value="'.$value['id'].'">'.$tab.$value['name'].'</option>';

		    getCate($arr,$value['id'],$tab.'--|');

		}
	}
}

function showCate($arr,$parent,$tab){
	foreach($arr as $value){

		if($value['parent']==$parent){
			echo '<div class="item-menu"><span>'.$tab.$value['name'].'</span><div class="category-fix">';
            echo '<a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>';
            echo '<a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>';
            echo '</div></div>';

		    showCate($arr,$value['id'],$tab.'--|');

		}
	}
}








