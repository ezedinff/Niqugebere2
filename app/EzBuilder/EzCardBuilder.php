<?php
namespace App\EzBuilder;

class EzCardBuilder
{
    static public function getCard($inputs, $values){
        return self::getCardBody($inputs['photo'],$inputs['labels'],$inputs['columns'],$inputs['buttons'],$values);
    }
    static public function getCardHead($photo){
        $part1 = '<div class="col l4 m4 s12"><div class="card">';
        if ($photo != null){
            $part1 .= '<div class="card-image"><img src="'.asset($photo).'" class="responsive-img" /></div>';
        }
        return $part1;
    }
    static public function getCardBody($photo,$labels,$columns,$buttons,$values){
        $final = '';
        foreach ($values as $value){
            $part1 = '';
            $part2 = '';
            for($i=0; $i < sizeof($columns); $i++){
                $part2 .= '<p><label>'.$labels[$i].': </label>'.$value[$columns[$i]].'</p>';
            }
            $edit = self::getCardEditButton($buttons['edit'] .'/'.$value->id .'/edit') ;
            $delete = self::getCardDeleteButton($buttons['delete'] .'/' .$value->id);
            $part1 .= self::getCardHead($value[$photo[0]]).'<div class ="card-content">'.$part2.self::getCardAction($edit,$delete);
            $final .= $part1;
        }
        return $final;
    }
    static public function getCardAction($edit,$delete){
        $action = '</div><div class="card-action no-padding">
                    <div class="row">
                        <div class="col l6 m6 s12">'.$edit.'</div>
                        <div class="col l6 m6 s12">'.$delete.'</div>
                    </div>
                    </div></div></div>';
        return $action;
    }
    static public function getCardEditButton($action){
        return '<a href="'.url($action).'" class="fa fa-edit btn-flat green-text"></a>';
    }
    static public function getCardDeleteButton($action){
        $postForm = '
			<form action = "'.url($action).'" method = "POST" style="display:inline;">
                '.method_field('DELETE').'
                '.csrf_field().'
                <button type = "submit" class="btn-flat wave-effects red-text fa fa-trash-o"></button>
		    </form>';
        return $postForm;
    }
}