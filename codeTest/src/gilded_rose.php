<?php

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {

	/*
	// first solution:
	// added a few lines of code, but did not alter the structure.
	
	
        foreach ($this->items as $item) {
        	// adjust quality
            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {

	                if(preg_match('/Conjured/', $item->name)){ 
						$item->quality = $item->quality - 2;
	                }elseif ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $item->quality = $item->quality - 1;
                    }

                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sell_in < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            //adjust sell in
            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sell_in = $item->sell_in - 1;
            }


            if ($item->sell_in < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0 && $item->name != 'Sulfuras, Hand of Ragnaros') {

                            $item->quality = $item->quality - 1;

                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
		*/
		
		
		// second solution:
		// refactored the structure to switch off item name.
		
		foreach ($this->items as $item) {
			switch($item->name){
				case 'Backstage passes to a TAFKAL80ETC concert':
					$item->quality = $item->quality + 1;
					if ($item->sell_in < 11) {
						if ($item->quality < 50) {
							$item->quality = $item->quality + 1;
						}
					}
					if ($item->sell_in < 6) {
						if ($item->quality < 50) {
							$item->quality = $item->quality + 1;
						}
					}
					
					$item->sell_in = $item->sell_in - 1;
				break;
				
				case 'Aged Brie':
					$item->quality = $item->quality + 1;
					
					$item->sell_in = $item->sell_in - 1;
				break;
				
				case 'Sulfuras, Hand of Ragnaros':
					// legendary item quality and sell in never change.
				break;
				
				default:
					if(preg_match('/Conjured/', $item->name)){ 
						$item->quality = $item->quality - 2;
	                }else{
                        $item->quality = $item->quality - 1;
                    }
					
					$item->sell_in = $item->sell_in - 1;
				break;
			}
		}
		
    }
}

class Item {

    public $name;
    public $sell_in;
    public $quality;

    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}

