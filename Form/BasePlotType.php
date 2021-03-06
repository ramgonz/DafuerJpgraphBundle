<?php

namespace Dafuer\JpgraphBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class BasePlotType extends AbstractType
{
    
    private $name;
    private $subnum;

    public function __construct($name="0_graphviewer",$subnum=0){
        $this->name=$name;
        $this->subnum=$subnum;
    }

    public function addUniqueField(FormBuilder $builder, $name, $type, $options){
        if($this->subnum!=0){ // Hide it
            $type='hidden';
            $options=array('attr'=>array('data-linkedto'=>$this->name."_0_".$name));
        }
        
        $builder
            ->add($name,$type,$options)
        ;
        return $this;
    }
    
    public function addColor(FormBuilder $builder, array $options){
        $colors=array(''=>'','blue'=>'Blue','red'=>'Red', 'black'=>'Black', 'green'=>'Green', 'yellow'=>'Yellow', 'aqua'=>'Aqua', 'brown'=>'Brown','blueviolet'=>'BlueViolet', 'coral'=>'Coral');
        
        $c=0;$autocolor="";
        foreach($colors as $colorindex=>$color){
            if($c==$this->subnum){
                $autocolor=$colorindex;
                break;
            }
            $c++;
        }
        
        $builder
            ->add('lineplot_color', 'choice',array('choices' => $colors, 'data'=>$autocolor,'attr' => array('placeholder' => "Default")))
        ;
        return $this;
    }    

    public function addMarks(FormBuilder $builder, array $options){
        $builder
            ->add('lineplot_marks', 'choice',array('choices' => array(''=>'Auto','-1'=>'Always','0'=>'Never')))     
        ;      
        return $this;
    }
    
    public function addMultipleYAxis(FormBuilder $builder, array $options){
        $builder
            ->add('graph_yaxis_number', 'choice',array('choices' => array('0'=>'Left','1'=>'Right','2'=>'Extra Rigth'),'attr' => array('placeholder' => "Default")))     
        ;      
        return $this;
    }
    

   /* public function getDefaultOptions(array $options)
    {
        return array(
            'csrf_protection' => false,
            );
    }*/
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }     
    
    public function getName()
    {
        return $this->name."_".$this->subnum;
    }
    
    
    

    
}
