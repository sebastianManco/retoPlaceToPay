<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * @var string
     */
   public $name;
   /**
    * @var string
    */
   public $type;
   /**
    * @var string
    */
   public $label;
   /**
    * @var string
    */
   public $value;

    /**
     * Create a new component instance.
     * @param string $name
     * @param string $type
     * @param string $label
     * @param string $value
     * @return void
     */
    public function __construct(string $name, string $type = 'text', string $label, string $value)
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
