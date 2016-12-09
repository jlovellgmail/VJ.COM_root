<?php
/**
* The Order class should implement Iterator so that you can loop through the order's contents.
* The Order class should implement Countable so that you can use count() on a order instance.
* The only assumption about order items is that they have a public getId() method.
*/
class OrderBase implements Iterator, Countable {

	/**
     * @var array $items Array stores the list of items in the order:
     */
    protected $items = array();
	
	/**
     * @var int $position For tracking iterations:
     */
    protected $position = 0;
	
	/**
     * @var array $ids For storing the IDs, as a convenience:
     */
    protected $ids = array();

	/**
     * Constructor
     */
    function __construct() {
        $this->items = array();
        $this->ids = array();
    }

	/**
     * Function to return the items list
     * 
     * @return items
     */
    public function getList(){
        return $this->items;
    }
    
	/**
     * Returns a Boolean indicating if the order is empty:
	 *
	 * @return isEmpty
     */
    public function isEmpty() {
        return (empty($this->items));
    }

	/**
     * Adds a new item to the order:
     */
    public function addItem(Product $item,$qty) {

        // Need the item id:
        $id = $item->getId();
        
        // Throw an exception if there's no id:
        if (!$id)
            throw new Exception('The order requires items with unique ID values.');

        // Add or update:
        if (isset($this->items[$id])) {
            //*******IMPLEMENT ERROR HANDLING FOR ADDING THE ITEM TWICE IN CART
            $this->updateItem($item, $this->items[$item]['qty'] + $qty);
        } else {
            $this->items[$id] = array('item' => $item, 'qty' => $qty);
            //$this->items[$id] = $item;
            $this->ids[] = $id; // Store the id, too!
        }
    }

	/**
     * Changes an item already in the order:
     */
    public function updateItem(Product $item, $qty) {

        // Need the unique item id:
        $id = $item->getId();

        // Delete or update accordingly:
        if ($qty === 0) {
            $this->deleteItem($item);
        } elseif (($qty > 0) && ($qty != $this->items[$id]['qty'])) {
            $this->items[$id]['qty'] = $qty;
        }
    }

	/**
     * Removes an item from the order:
     */
    public function deleteItem(Item $item) {

        // Need the unique item id:
        $id = $item->getId();

        // Remove it:
        if (isset($this->items[$id])) {
            unset($this->items[$id]);

            // Remove the stored id, too:
            $index = array_search($id, $this->ids);
            unset($this->ids[$index]);

            // Recreate that array to prevent holes:
            $this->ids = array_values($this->ids);
        }
    }

	/**
     * Required by Iterator; returns the current value:
	 *
	 * @return current value
     */
    public function current() {

        // Get the index for the current position:
        $index = $this->ids[$this->position];

        // Return the item:
        return $this->items[$index];
    }

	/**
     * Required by Iterator; returns the current key:
	 *
	 * @return current key
     */
    public function key() {
        return $this->position;
    }

	/**
     * Required by Iterator; increments the position:
     */
    public function next() {
        $this->position++;
    }

	/**
     * Required by Iterator; returns the position to the first spot:
     */
    public function rewind() {
        $this->position = 0;
    }

	/**
     * Required by Iterator; returns a Boolean indiating if a value is indexed at this position:
	 *
	 * @return Boolean indiating if a value is indexed at this position
     */
    public function valid() {
        return (isset($this->ids[$this->position]));
    }

	/**
     * Required by Countable:
	 *
	 * @return count of items list
     */
    public function count() {
        return count($this->items);
    }

}

// End of ShoppingCart class.
