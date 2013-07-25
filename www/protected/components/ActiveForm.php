<?php

class ActiveForm extends CActiveForm {

    public function dropDownTree($model,$attribute,$treeModel,$htmlOptions=array())
    {
        $data = $treeModel->getTree(true);
        return CHtml::activeDropDownList($model,$attribute,$data,$htmlOptions);
    }

}