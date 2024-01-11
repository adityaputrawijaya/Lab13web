<?php
/**
* Nama Class: Form
* Deskripsi: CLass untuk membuat form inputan text sederhan
**/
 
class Form
{
   private $fields = array();
   private $action;
   private $cssClass;
   private $submit = "Submit Form";
   private $jumField = 0;
 
   public function __construct($action, $submit, $class="form")
   {
       $this->action = $action;
       $this->submit = $submit;
       $this->cssClass = $class;
   }
 
   public function displayForm()
   {
       echo "<form action='".$this->action."' class='".$this->cssClass."' method='POST'>";
       echo '<table width="100%" border="0">';
       for ($j=0; $j<count($this->fields); $j++) {
           echo "<tr><td align='right'>".$this->fields[$j]['label']."</td>";
           echo "<td><input type='".$this->fields[$j]['type']."' name='".$this->fields[$j]['name']."'></td></tr>";
       }
       echo "<tr><td colspan='2' class=\"submit-form\">";
       echo "<input name='submit' type='submit' value='".$this->submit."'></td></tr>";
       echo "</table>";
   }
 
   public function addField($name, $label, $type="text")
   {
       $this->fields [$this->jumField]['name'] = $name;
       $this->fields [$this->jumField]['label'] = $label;
       $this->fields [$this->jumField]['type'] = $type;
       $this->jumField ++;
   }

   public function addSelect($name, $label, $selected=false)
   {
    
   }
}
?>
