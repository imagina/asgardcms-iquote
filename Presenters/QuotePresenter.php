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
                      ".($child->name ?? $child->title)."                                  
                    </td>
                    <td width='20%'>
                      " . number_format($child->price) . " COP
                    </td>
                    <td width='15%' align='center'>".($child->model ?? $child->quantity ?? '1')."</td>
                    <td width='20%' align='right'>
                      " . number_format($selected->model->price) . " COP
                    </td>                  
                  </tr>
                  <tr>
                    <td colspan='4'>
                      <table width='100%' cellspacing='0' cellpadding='0'>
                        <tbody>
                          " . $this->treePdf2($child->characteristics ?? $child->children_generated ?? $child->children ?? '', $child ?? '',$total+$selected->model->price) . "
                          ".(isset($child->characteristics) || isset($child->childrengenerated) || isset($child->children)?"
                            <tr class='t1 text-bold'>
                              <td class='text-primary table-bg' width='45%'>Total ".($child->name ?? $child->title)."</td>
                              <td colspan='3' align='right' class='text-primary'>".number_format($this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? ''))." COP</td>
                            </tr>
                          ":"")."
                        </tbody>
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
                      ".($child->name ?? $child->title)."                                  
                    </td>
                    <td width='20%'>
                      " . number_format($child->price ?? $child->model) . " COP
                    </td>
                    <td width='15%' align='center'>".($child->model ?? $child->quantity ?? '1')."</td>
                    <td width='20%' align='right'>
                      " . number_format($child->price * ($child->model ?? $child->quantity ?? 1)) . " COP
                    </td>                  
                  </tr>                  
                  <tr>
                    <td colspan='4'>
                      <table width='100%' cellspacing='0' cellpadding='0'>
                        <tbody>                 
                          " . $this->treePdf2($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '',$total+($child->price * ($child->model ?? $child->quantity ?? 1))) . "
                          ".(isset($child->characteristics) || isset($child->childrengenerated) || isset($child->children)?"
                            <tr class='t1 text-bold'>
                              <td class='text-primary table-bg' width='45%'>Total ".($child->name ?? $child->title)."</td>
                              <td colspan='3' align='right' class='text-primary'>".number_format($this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? ''))." COP</td>
                            </tr>
                          ":"")."
                        </tbody>
                      </table>
                    </td>
                  </tr>                      
                ";
            }
          }else if($child->type == Type::VALUE && $child->model > 0){
            $text .= "
                <tr class='t1'>
                  <td width='45%' class='table-bg'>
                    ".($child->name ?? $child->title)."                                  
                  </td>
                  <td width='20%'>
                    " . number_format($child->model) . " COP
                  </td>
                  <td width='15%' align='center'>1</td>
                  <td width='20%' align='right'>
                    " . number_format($child->model) . " COP
                  </td>                  
                </tr>
                <tr>
                  <td colspan='4'>
                    <table width='100%' cellspacing='0' cellpadding='0'>
                      <tbody>                                        
                        ".$this->treePdf2($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '')."
                        ".(isset($child->characteristics) || isset($child->childrengenerated) || isset($child->children)?"
                        <tr class='t1 text-bold'>
                          <td class='text-primary table-bg' width='45%'>Total ".($child->name ?? $child->title)."</td>
                          <td colspan='3' align='right' class='text-primary'>".number_format($this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? ''))." COP</td>
                        </tr>
                        ":"")."
                      </tbody>
                    </table>
                  </td>
                </tr>                     
              ";
          }else{
            $text .= "
                <tr class='t1'>
                  <td class='table-bg'>".($child->name ?? $child->title)."</td>
                  <td colspan='3'>&nbsp;</td>                  
                </tr>  
                <tr>
                  <td colspan='4'>
                    <table width='100%' cellspacing='0' cellpadding='0'>
                      <tbody>                            
                        ".$this->treePdf2($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '')."
                        ".(isset($child->characteristics) || isset($child->childrengenerated) || isset($child->children)?"
                        <tr class='t1 text-bold'>
                          <td class='text-primary table-bg' width='45%'>Total ".($child->name ?? $child->title)."</td>
                          <td colspan='3' align='right' class='text-primary'>".number_format($this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? ''))." COP</td>
                        </tr>
                        ":"")."
                      </tbody>                      
                    </table>
                  </td>
                </tr>                
              ";
          }
        }else{
          $text .=
            "<table width='100%' valign='top' cellspacing='0' cellpadding='0'>
                <thead>
                  <tr class='t1'>
                    <td class='head-title' width='45%'>".($child->name ?? $child->title)."</td>
                    <td colspan='3'>&nbsp;</td>
                  </tr>
                  <tr class='t1'>           
                    <td width='45%' class='table-bg'>&nbsp;</td>               
                    <td width='20%'>Valor Unidad</td>
                    <td width='15%' align='center'>Cantidad</td>
                    <td width='20%' align='right'>Total</td>
                  </tr>            
                </thead>
                <tbody>
                  ".$this->treePdf2($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? '')."
                  ".(isset($child->characteristics) || isset($child->childrengenerated) || isset($child->children)?"
                    <tr class='t1 text-bold'>
                      <td class='text-primary table-bg' width='45%'>Total ".($child->name ?? $child->title)."</td>
                      <td colspan='3' align='right' class='text-primary'>".number_format($this->calculateTotal($child->characteristics ?? $child->childrengenerated ?? $child->children ?? '', $child ?? ''))." COP</td>
                    </tr>
                    ":"")."
                </tbody>
              </table>";
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
