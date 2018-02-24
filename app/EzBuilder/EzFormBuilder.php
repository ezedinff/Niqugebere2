<?php
namespace App\EzBuilder;

class EzFormBuilder
{


    static public function getForm($inputs , $action , $method){
        $formStart = self::methodIdentifier($method , $action);
        $formEnd = self::endForm();
        if (strtoupper($method)== "DELETE") {
            return $formStart  . $formEnd;
        }
        else{
            $formMiddle = self::mdForm($inputs);
            return $formStart . $formMiddle . $formEnd;
        }
    }

    static public function methodIdentifier($method , $action)
    {
        $form = "";
        if (strtoupper($method)== "POST") {
            $form = self::postForm($action);
        }elseif (strtoupper($method)== "PATCH") {
            $form = self::updateForm($action);
        }
        elseif (strtoupper($method)== "DELETE") {
            $form = self::deleteForm($action);
        }
        return $form;
    }
    static public function postForm($action)
    {
        $postForm = '
			<form action = "'.url($action).'" method = "POST" enctype="multipart/form-data">
			'.csrf_field().'
		';
        return $postForm;
    }
    static public function updateForm($action)
    {
        $postForm = '
			<form action = "'.url($action).'" method = "POST" enctype="multipart/form-data">
			'.method_field('PATCH').'
			'.csrf_field().'
		';
        return $postForm;
    }
    static public function deleteForm($action)
    {
        $postForm = '
			<form action = "'.url($action).'" method = "POST">
			'.method_field('DELETE').'
			'.csrf_field().'
			<button type = "submit" class="btn wave-effects red fa fa-trash-o">DELETE</button>
		';
        return $postForm;
    }

    static public function mdForm($inputs)
    {
        $md = "";
        for ($i=0; $i < sizeof($inputs); $i++) {
            if ($inputs[$i]['type'] == "text") {
                $md .= self::getInputText($inputs[$i]['name'],$inputs[$i]['label'],$inputs[$i]['value']);
			}
            elseif ($inputs[$i]['type'] == "select") {
                $md .= self::getInputSelect($inputs[$i]['name'],$inputs[$i]['label'],$inputs[$i]['options'],$inputs[$i]['value']);
			}
            elseif ($inputs[$i]['type'] == "radio") {
                $md .= self::getInputRadio($inputs[$i]['name'],$inputs[$i]['label'],$inputs[$i]['value']);
			}
            elseif ($inputs[$i]['type'] == "number") {
                $md .= self::getInputNumber($inputs[$i]['name'],$inputs[$i]['label'],$inputs[$i]['value']);
			}
            elseif ($inputs[$i]['type'] == "date") {
                $md .= self::getInputDate($inputs[$i]['name'],$inputs[$i]['label'],$inputs[$i]['value']);
			}
            elseif ($inputs[$i]['type'] == "file") {
                $md .= self::getInputFile();
            }
        }
        return $md;
    }

    static public function endForm()
    {
        $end = '
	                   <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input type="submit" value="save" class="btn-large wave-effect wave-light teal white-text right">
                            </div>
                        </div>
                       </form>
		';
        return $end;
    }


    //////////////////// form elements ////////////////////////////////////
    static public function getInputText($name,$label,$value)
    {
        $text = '
				<div class="row">
			        <div class="input-field col s12">
			          <input name="'.$name.'" id="'.$name.'" type="text" class="validate" value="'.$value.'" required>
			          <label for="'.$name.'">'.$label.'</label>
			        </div>
			    </div>
			';
        return $text;
    }

    static public function getInputNumber($name,$label,$value)
    {
        $number = '
				<div class="row">
			        <div class="input-field col s12">
			          <input name="'.$name.'" id="'.$name.'" type="number" class="validate" value="'.$value.'" required>
			          <label for="'.$name.'">'.$label.'</label>
			        </div>
			    </div>
			';
        return $number;
    }


    static public function getInputDate($name,$label,$value)
    {
        $date = '
				<div class="row">
			        <div class="input-field col s12">
			          <input name="'.$name.'" id="'.$name.'" type="date" class="validate datepicker" value="'.$value.'" required>
			          <label for="'.$name.'">'.$label.'</label>
			        </div>
			    </div>
			';
        return $date;
    }



    static public function getInputRadio($name,$label,$value)
    {
        $radio = '
			<span class="col l6 m6 s12">
	     		<input name="'.$name.'" type="radio" value="'.$value.'" id="'.$name.'" />
      			<label for="'.$name.'">'.$label.'</label>
			</span>
		';
        return  $radio;
    }

    static public function getInputSelect($name,$label,$options,$v)
    {
        $part1 = '
			<div class="row">
			  <div class="input-field">
			    <select id = "'.$name.'" name="'.$name.'" required>
			      <option value="" disabled selected>select '.$label.'</option>
		';
        $part2 = '';

        if ($options != ""){
            foreach ($options as  $value) {
                if ($v != null and $v->name == $value->name and $v->id == $value->id){
                    $part2 .= '<option value="'.$value->id.'" selected>'.$value->name.'</option>';
                }
                $part2 .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }
        }
        $part3 = '
				</select>
			    <label>'.$label.'</label>
			  </div>
			</div>
		';
        $select = $part1 . $part2 . $part3;

        return $select;
    }

    static public function getInputFile()
    {
        $file = '
			<div class="file-field input-field">
			    <div class="btn">
			       <span>File</span>
			       <input type="file" name="file">
			    </div>
			    <div class="file-path-wrapper">
			       <input class="file-path validate" type="text">
			    </div>
			</div>
		';

        return $file;
    }
}
