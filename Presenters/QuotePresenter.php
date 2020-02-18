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
  public function treePdf()
  {
    $this->n = 0;
    return $this->treePdf2($this->entity->value,null);
  }
  public function total()
  {
    return $this->calculateTotal($this->entity->value,null);
  }
  public function treePdf2($childr = '', $selected = null, $total = 0){
    $text = "";
    if($childr!='') {
      $children = json_decode(json_encode($childr));
      foreach ($children as $k=>$child) {
        if(!empty($selected)){
          if($child->type === Type::OPTION) {
            if ($selected->model->value == $child->id) {
              $text .= "
                    <tr class='t1'>
                      <td width='45%' class='table-bg'>
                        <div style='padding-left: ".($total*10)."px;'>
                          <i class='fas fa-square text-primary'></i>".($child->name ?? $child->title)."
                          ".($child->notes?"<p>".$child->notes."</p>":"")."
                        </div>                                  
                      </td>
                      <td width='20%'>
                        " . number_format($child->price) . " ".($this->entity->options->currency->label ?? \Currency::getLocaleCurrency()->code)."
                      </td>
                      <td width='15%' align='center'>".($child->model ?? $child->quantity ?? '--')."</td>
                      <td width='20%' align='right'>
                        <div style='padding-right: ".($total*10)."px;'>" . number_format($selected->model->price) . " ".($this->entity->options->currency->label ?? \Currency::getLocaleCurrency()->code)."</div>
                      </td>                  
                    </tr>
                    <tr class='t2'>
                      <td colspan='4'>
                        <table width='100%' cellspacing='0' cellpadding='0'>
                          " . $this->treePdf2($child->characteristics ?? $child->children_generated ?? $child->children ?? '', $child ?? '',$total+1) . "                         
                        </table>
                      </td>
                    </tr>                               
              ";
            }
          }else if($child->type==Type::CHECKBOX || $child->type == Type::NUMBER) {
            if($child->model > 0) {
              $text .= "
                    <tr class='t1'>
                      <td width='45%' class='table-bg'>
                        <div style='padding-left: ".($total*10)."px;'>
                          <i class='fas fa-square text-primary'></i>".($child->name ?? $child->title)."
                          ".($child->notes?"<p>".$child->notes."</p>":"")."
                        </div>                                  
                      </td>
                      <td width='20%'>
                        " . number_format($child->price ?? $child->model) . " ".($this->entity->options->currency->label ?? \Currency::getLocaleCurrency()->code)."
                      </td>
                      <td width='15%' align='center'>".($child->model ?? $child->quantity ?? '--')."</td>
                      <td width='20%' align='right'>
                        <div style='padding-right: ".($total*10)."px;'>" . number_format($child->price * ($child->model ?? $child->quantity ?? 1)) . " ".($this->entity->options->currency->label ?? \Currency::getLocaleCurrency()->code)."</div>
                      </td>                  
                    </tr>
                    <tr class='t2'>
                      <td colspan='4'>
                        <table width='100%' cellspacing='0' cellpadding='0'>
                            " . $this->treePdf2($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '',$total+1) . "
                        </table>
                      </td>
                    </tr>                    
                ";
            }
          }else if($child->type == Type::VALUE && $child->model > 0){
            $text .= "
                  <tr class='t1'>
                    <td width='45%' class='table-bg'>
                      <div style='padding-left: ".($total*10)."px;'>
                        <i class='fas fa-square text-primary'></i>".($child->name ?? $child->title)."
                        ".($child->notes?"<p>".$child->notes."</p>":"")."
                      </div>                                  
                    </td>
                    <td width='55%' colspan='3' align='right'>
                      <div style='padding-right: ".($total*10)."px;'>" . number_format($child->model) . " ".($this->entity->options->currency->label ?? \Currency::getLocaleCurrency()->code)."</div>
                    </td>                  
                  </tr>
                  <tr class='t2'>
                    <td colspan='4'>
                      <table width='100%' cellspacing='0' cellpadding='0'>
                        ".$this->treePdf2($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '',$total+1)."                        
                      </table>
                    </td>
                  </tr>               
              ";
          }else{
            $text .= "
                  <tr class='t1'>
                    <td class='table-bg'>
                      <div style='padding-left: ".($total*10)."px;'>
                        <i class='fas fa-square text-primary'></i>".($child->name ?? $child->title)."
                        ".($child->notes?"<p>".$child->notes."</p>":"")."
                      </div>
                    </td>
                    <td colspan='3' align='right'><div style='padding-right: ".($total*10)."px;'>0 ".($this->entity->options->currency->label ?? \Currency::getLocaleCurrency()->code)."</div></td>                  
                  </tr> 
                  <tr class='t2'>
                    <td colspan='4'>
                      <table width='100%' cellspacing='0' cellpadding='0'>
                        ".$this->treePdf2($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '',$total+1)."
                      </table>
                    </td>
                  </tr>             
              ";
          }
        }else{
          $text .=
            "<table width='100%' valign='top' cellspacing='0' cellpadding='0' class='t3'>
                <tbody>
                  <tr>
                    <td class='text-primary text-bold' colspan='4' align='center'><span style='font-size: 18px'>".($child->name ?? $child->title)."</span></td>
                  </tr>
                  <tr>
                    <td align='center' width='45%'>
                      <div style='padding: 10px 0;width: 100%'>
                        <img src='".$child->main_image->path."' width='120mm' height='auto' title='".($child->name ?? $child->title)."' />
                      </div>
                    </td>
                    <td colspan='3' valign='middle'>
                      <div style='padding: 10px'>".($child->description)."</div>
                    </td>
                  </tr>
                  <tr class='t1 text-bold'>
                    <td width='45%' class='head-title'>".($child->name ?? $child->title)."</td>               
                    <td width='20%' class='text-primary'>".trans('iquote::quotes.pdf.unit_value')."</td>
                    <td width='15%' class='text-primary' align='center'>".trans('iquote::quotes.pdf.quantity')."</td>
                    <td width='20%' class='text-primary' align='right'>Total</td>
                  </tr>
                  ".$this->treePdf2($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '',$total+1)."
                </tbody>
                <tfoot>
                  ".(isset($child->characteristics) || isset($child->childrengenerated) || isset($child->children)?"
                    <tr class='t1 text-bold'>
                      <td class='text-primary table-bg' width='45%'><div style='padding-left: 10px;'>Total ".($child->name ?? $child->title)."</div></td>
                      <td colspan='3' align='right' class='text-primary'><div style='padding-right: 10px;'>".number_format($this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? ''))." ".($this->entity->options->currency->label ?? \Currency::getLocaleCurrency()->code)."</div></td>
                    </tr>
                    ":"")."
                </tfoot>
              </table>                            
              ";
        }
      }
    }
    return $text;
  }
  public function calculateTotal($childr = null, $selected = '')
  {
    $total = 0;
    $children = json_decode(json_encode($childr));
    if (!empty($children)){
      foreach ($children as $child) {
        if(!empty($selected)) {
          if ($child->type === Type::OPTION) {
            if ($selected->model->value == $child->id) {
              $total += $selected->model->price;
              $total += $this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '');
            }
          } else if ($child->type == Type::CHECKBOX || $child->type == Type::NUMBER) {
            if ($child->model > 0) {
              $total += $child->price * ($child->quantity ?? $child->model ?? 1);
              $total += $this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '');
            }
          } else if ($child->type == Type::VALUE && $child->model > 0) {
            $total += $child->model;
            $total += $this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '');
          } else {
            $total += $child->price;
            $total += $this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '');
          }
        }else{
          $total += $this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '');
        }
      }
    }
    return $total;
  }
}
