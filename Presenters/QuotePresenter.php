<?php

namespace Modules\Iquote\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Iquote\Entities\Type;

class QuotePresenter extends Presenter
{
    /**
     * @var \Modules\Iquote\Repositories\QuoteRepository
     */
    private $quote;
    private $n;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->quote = app('Modules\Iquote\Repositories\QuoteRepository');
        $this->n = 0;
    }

    /**
     * Get the post status
     * @return string
     */
    public function tree()
    {
      return $this->tree2($this->entity->value);
    }
    public function tree2($childr = '', $selected = null){
      $text = "";
      if($childr!='') {
        $children = json_decode(json_encode($childr));
        foreach ($children as $child) {
          if(!empty($selected)){
            if($child->type === Type::OPTION) {
              if ($selected->model->value == $child->id) {
                $text .= "
              <div class='mj-column-per-" . (isset($child->characteristics) ? '33' : '100') . " outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'>
                <table role='presentation' cellpadding='0' cellspacing='0' style='vertical-align:top;' width='100%' border='0'>
                  <tbody>"
                  . (isset($child->characteristics) ? "<tr>
                      <td style='word-wrap:break-word;font-size:0px;padding:0px 0px 0px 0px;width: 100%' align='center' width='100%'>
                          " . (isset($child->main_image) ? "<img alt height='auto' src='" . $child->main_image->path . "' style='border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;' width='100%'>" : "") . "                        
                      </td>
                    </tr>
                    " : "") .
                  "<tr>
                      <td style='word-wrap:break-word;font-size:0px'>
                        <div style='cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:1.5;padding-left: 10px;'>                          
                            <p>Valor Unidad: " . number_format($child->price) . " COP</p>
                            <p>Cantidad: ".(isset($selected->quantity)?$selected->quantity: '1')."</p>
                            <p>Total: " . number_format($selected->model->price) . " COP</p>
                            " . $this->tree2($child->characteristics ?? $child->children ?? '', $child ?? '') . "
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              ";
              }
            }else if($child->type==Type::CHECKBOX){
              $text .= "
                <div class='mj-column-per-".(isset($child->characteristics)?'33':'100')." outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'>
                  <table role='presentation' cellpadding='0' cellspacing='0' style='vertical-align:top;' width='100%' border='0'>
                    <tbody>"
                  .(isset($child->characteristics)?"<tr>
                        <td style='word-wrap:break-word;font-size:0px;padding:0px 0px 0px 0px;width: 100%' align='center' width='100%'>
                            ".(isset($child->main_image)?"<img alt height='auto' src='".$child->main_image->path."' style='border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;' width='100%'>":"")."
                        </td>
                      </tr>
                      ":"").
                  "<tr>
                        <td style='word-wrap:break-word;font-size:0px'>
                          <div style='cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:1.5;padding-left: 10px;'>
                              <h3 style='text-align: ".(isset($child->characteristics)?'center':'left')."'>".($child->name ?? $child->title)."</h3>
                              <p>Valor Unidad: " . number_format($child->price) . " COP</p>
                              <p>Cantidad: ".(isset($child->quantity)?$child->quantity: '1')."</p>
                              <p>Total: " . number_format($child->price*($child->quantity ?? 1)) . " COP</p>
                              ".$this->tree2($child->characteristics ?? $child->children ?? '', $child ?? '')."
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              ";
            }else{
              $text .= "
                <div class='mj-column-per-".(isset($child->characteristics)?'33':'100')." outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'>
                  <table role='presentation' cellpadding='0' cellspacing='0' style='vertical-align:top;' width='100%' border='0'>
                    <tbody>"
                .(isset($child->characteristics)?"<tr>
                        <td style='word-wrap:break-word;font-size:0px;padding:0px 0px 0px 0px;width: 100%' align='center' width='100%'>
                            ".(isset($child->main_image)?"<img alt height='auto' src='".$child->main_image->path."' style='border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;' width='100%'>":"")."
                        </td>
                      </tr>
                      ":"").
                "<tr>
                        <td style='word-wrap:break-word;font-size:0px'>
                          <div style='cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:1.5;padding-left: 10px;'>
                              <h3 style='text-align: ".(isset($child->characteristics)?'center':'left')."'>".($child->name ?? $child->title)."</h3>
                              <p>".($child->model->label ?? $child->description)."</p>
                              ".$this->tree2($child->characteristics ?? $child->children ?? '', $child ?? '')."
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              ";
            }
          }else{
            $text .= "
              <div class='mj-column-per-".(isset($child->characteristics)?'33':'100')." outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'>
                <table role='presentation' cellpadding='0' cellspacing='0' style='vertical-align:top;' width='100%' border='0'>
                  <tbody>"
              .(isset($child->characteristics)?"<tr>
                      <td style='word-wrap:break-word;font-size:0px;padding:0px 0px 0px 0px;width: 100%' align='center' width='100%'>
                          ".(isset($child->main_image)?"<img alt height='auto' src='".$child->main_image->path."' style='border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;' width='100%'>":"")."
                      </td>
                    </tr>
                    ":"").
                  "<tr>
                      <td style='word-wrap:break-word;font-size:0px'>
                        <div style='cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:1.5;padding-left: 10px;'>
                            <h3 style='text-align: ".(isset($child->characteristics)?'center':'left')."'>".($child->name ?? $child->title)."</h3>
                            <p>".($child->model->label ?? $child->description)."</p>
                            ".$this->tree2($child->characteristics ?? $child->children ?? '', $child ?? '')."
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            ";
            }
        }
      }
      return $text;
    }

}
