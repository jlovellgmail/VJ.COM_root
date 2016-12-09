//Instamax 4.0 - http://www.codehandling.com/2015/04/instamax-20-embed-complete-instagram.html
//Buy at http://codecanyon.net/item/instamax-instagram-photo-gallery-on-your-website/11012618


/*!
 * imagesLoaded PACKAGED v3.0.4
 * https://github.com/desandro/imagesloaded
 * JavaScript is all like "You images are done yet or what?"
 */

(function(){"use strict";function e(){}function t(e,t){for(var n=e.length;n--;)if(e[n].listener===t)return n;return-1}var n=e.prototype;n.getListeners=function(e){var t,n,i=this._getEvents();if("object"==typeof e){t={};for(n in i)i.hasOwnProperty(n)&&e.test(n)&&(t[n]=i[n])}else t=i[e]||(i[e]=[]);return t},n.flattenListeners=function(e){var t,n=[];for(t=0;e.length>t;t+=1)n.push(e[t].listener);return n},n.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},n.addListener=function(e,n){var i,r=this.getListenersAsObject(e),o="object"==typeof n;for(i in r)r.hasOwnProperty(i)&&-1===t(r[i],n)&&r[i].push(o?n:{listener:n,once:!1});return this},n.on=n.addListener,n.addOnceListener=function(e,t){return this.addListener(e,{listener:t,once:!0})},n.once=n.addOnceListener,n.defineEvent=function(e){return this.getListeners(e),this},n.defineEvents=function(e){for(var t=0;e.length>t;t+=1)this.defineEvent(e[t]);return this},n.removeListener=function(e,n){var i,r,o=this.getListenersAsObject(e);for(r in o)o.hasOwnProperty(r)&&(i=t(o[r],n),-1!==i&&o[r].splice(i,1));return this},n.off=n.removeListener,n.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},n.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},n.manipulateListeners=function(e,t,n){var i,r,o=e?this.removeListener:this.addListener,s=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(i=n.length;i--;)o.call(this,t,n[i]);else for(i in t)t.hasOwnProperty(i)&&(r=t[i])&&("function"==typeof r?o.call(this,i,r):s.call(this,i,r));return this},n.removeEvent=function(e){var t,n=typeof e,i=this._getEvents();if("string"===n)delete i[e];else if("object"===n)for(t in i)i.hasOwnProperty(t)&&e.test(t)&&delete i[t];else delete this._events;return this},n.emitEvent=function(e,t){var n,i,r,o,s=this.getListenersAsObject(e);for(r in s)if(s.hasOwnProperty(r))for(i=s[r].length;i--;)n=s[r][i],o=n.listener.apply(this,t||[]),(o===this._getOnceReturnValue()||n.once===!0)&&this.removeListener(e,s[r][i].listener);return this},n.trigger=n.emitEvent,n.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},n.setOnceReturnValue=function(e){return this._onceReturnValue=e,this},n._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},n._getEvents=function(){return this._events||(this._events={})},"function"==typeof define&&define.amd?define(function(){return e}):"undefined"!=typeof module&&module.exports?module.exports=e:this.EventEmitter=e}).call(this),function(e){"use strict";var t=document.documentElement,n=function(){};t.addEventListener?n=function(e,t,n){e.addEventListener(t,n,!1)}:t.attachEvent&&(n=function(t,n,i){t[n+i]=i.handleEvent?function(){var t=e.event;t.target=t.target||t.srcElement,i.handleEvent.call(i,t)}:function(){var n=e.event;n.target=n.target||n.srcElement,i.call(t,n)},t.attachEvent("on"+n,t[n+i])});var i=function(){};t.removeEventListener?i=function(e,t,n){e.removeEventListener(t,n,!1)}:t.detachEvent&&(i=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(i){e[t+n]=void 0}});var r={bind:n,unbind:i};"function"==typeof define&&define.amd?define(r):e.eventie=r}(this),function(e){"use strict";function t(e,t){for(var n in t)e[n]=t[n];return e}function n(e){return"[object Array]"===c.call(e)}function i(e){var t=[];if(n(e))t=e;else if("number"==typeof e.length)for(var i=0,r=e.length;r>i;i++)t.push(e[i]);else t.push(e);return t}function r(e,n){function r(e,n,s){if(!(this instanceof r))return new r(e,n);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=i(e),this.options=t({},this.options),"function"==typeof n?s=n:t(this.options,n),s&&this.on("always",s),this.getImages(),o&&(this.jqDeferred=new o.Deferred);var a=this;setTimeout(function(){a.check()})}function c(e){this.img=e}r.prototype=new e,r.prototype.options={},r.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);for(var i=n.querySelectorAll("img"),r=0,o=i.length;o>r;r++){var s=i[r];this.addImage(s)}}},r.prototype.addImage=function(e){var t=new c(e);this.images.push(t)},r.prototype.check=function(){function e(e,r){return t.options.debug&&a&&s.log("confirm",e,r),t.progress(e),n++,n===i&&t.complete(),!0}var t=this,n=0,i=this.images.length;if(this.hasAnyBroken=!1,!i)return this.complete(),void 0;for(var r=0;i>r;r++){var o=this.images[r];o.on("confirm",e),o.check()}},r.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded;var t=this;setTimeout(function(){t.emit("progress",t,e),t.jqDeferred&&t.jqDeferred.notify(t,e)})},r.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";this.isComplete=!0;var t=this;setTimeout(function(){if(t.emit(e,t),t.emit("always",t),t.jqDeferred){var n=t.hasAnyBroken?"reject":"resolve";t.jqDeferred[n](t)}})},o&&(o.fn.imagesLoaded=function(e,t){var n=new r(this,e,t);return n.jqDeferred.promise(o(this))});var f={};return c.prototype=new e,c.prototype.check=function(){var e=f[this.img.src];if(e)return this.useCached(e),void 0;if(f[this.img.src]=this,this.img.complete&&void 0!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void 0;var t=this.proxyImage=new Image;n.bind(t,"load",this),n.bind(t,"error",this),t.src=this.img.src},c.prototype.useCached=function(e){if(e.isConfirmed)this.confirm(e.isLoaded,"cached was confirmed");else{var t=this;e.on("confirm",function(e){return t.confirm(e.isLoaded,"cache emitted confirmed"),!0})}},c.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},c.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},c.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindProxyEvents()},c.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindProxyEvents()},c.prototype.unbindProxyEvents=function(){n.unbind(this.proxyImage,"load",this),n.unbind(this.proxyImage,"error",this)},r}var o=e.jQuery,s=e.console,a=s!==void 0,c=Object.prototype.toString;"function"==typeof define&&define.amd?define(["eventEmitter/EventEmitter","eventie/eventie"],r):e.imagesLoaded=r(e.EventEmitter,e.eventie)}(window);


/*!
  jQuery Wookmark plugin
  @name jquery.wookmark.js
  @author Christoph Ono (chri@sto.ph or @gbks)
  @author Sebastian Helzle (sebastian@helzle.net or @sebobo)
  @version 1.4.8
  @date 07/08/2013
  @category jQuery plugin
  @copyright (c) 2009-2014 Christoph Ono (www.wookmark.com)
  @license Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) license.
*/
(function (factory) {
  if (typeof define === 'function' && define.amd)
    define(['jquery'], factory);
  else
    factory(jQuery);
}(function ($) {
  var Wookmark, defaultOptions, __bind;

  __bind = function(fn, me) {
    return function() {
      return fn.apply(me, arguments);
    };
  };

  // Wookmark default options
  defaultOptions = {
    align: 'center',
    autoResize: false,
    comparator: null,
    container: $('body'),
    direction: undefined,
    ignoreInactiveItems: true,
    itemWidth: 0,
    fillEmptySpace: false,
    flexibleWidth: 0,
    offset: 2,
    outerOffset: 0,
    onLayoutChanged: undefined,
    possibleFilters: [],
    resizeDelay: 50,
    verticalOffset: undefined
  };

  // Function for executing css writes to dom on the next animation frame if supported
  var executeNextFrame = window.requestAnimationFrame || function(callback) {callback();},
      $window = $(window);

  function bulkUpdateCSS(data) {
    executeNextFrame(function() {
      var i, item;
      for (i = 0; i < data.length; i++) {
        item = data[i];
        item.obj.css(item.css);
      }
    });
  }

  function cleanFilterName(filterName) {
    return $.trim(filterName).toLowerCase();
  }

  // Main wookmark plugin class
  Wookmark = (function() {

    function Wookmark(handler, options) {
      // Instance variables.
      this.handler = handler;
      this.columns = this.containerWidth = this.resizeTimer = null;
      this.activeItemCount = 0;
      this.itemHeightsDirty = true;
      this.placeholders = [];

      $.extend(true, this, defaultOptions, options);

      this.verticalOffset = this.verticalOffset || this.offset;

      // Bind instance methods
      this.update = __bind(this.update, this);
      this.onResize = __bind(this.onResize, this);
      this.onRefresh = __bind(this.onRefresh, this);
      this.getItemWidth = __bind(this.getItemWidth, this);
      this.layout = __bind(this.layout, this);
      this.layoutFull = __bind(this.layoutFull, this);
      this.layoutColumns = __bind(this.layoutColumns, this);
      //this.filter = __bind(this.filter, this);
      this.clear = __bind(this.clear, this);
      this.getActiveItems = __bind(this.getActiveItems, this);
      this.refreshPlaceholders = __bind(this.refreshPlaceholders, this);
      this.sortElements = __bind(this.sortElements, this);
      //this.updateFilterClasses = __bind(this.updateFilterClasses, this);

      // Initial update of the filter classes
      //this.updateFilterClasses();

      // Listen to resize event if requested.
      if (this.autoResize)
        $window.bind('resize.wookmark', this.onResize);

      this.container.bind('refreshWookmark', this.onRefresh);
    }

	/*
    Wookmark.prototype.updateFilterClasses = function() {
      // Collect filter data
      var i = 0, j = 0, k = 0, filterClasses = {}, itemFilterClasses,
          $item, filterClass, possibleFilters = this.possibleFilters, possibleFilter;

      for (; i < this.handler.length; i++) {
        $item = this.handler.eq(i);

        // Read filter classes and globally store each filter class as object and the fitting items in the array
        itemFilterClasses = $item.data('filterClass');
        if (typeof itemFilterClasses == 'object' && itemFilterClasses.length > 0) {
          for (j = 0; j < itemFilterClasses.length; j++) {
            filterClass = cleanFilterName(itemFilterClasses[j]);

            if (typeof(filterClasses[filterClass]) === 'undefined') {
              filterClasses[filterClass] = [];
            }
            filterClasses[filterClass].push($item[0]);
          }
        }
      }

      for (; k < possibleFilters.length; k++) {
        possibleFilter = cleanFilterName(possibleFilters[k]);
        if (!(possibleFilter in filterClasses)) {
          filterClasses[possibleFilter] = [];
        }
      }

      this.filterClasses = filterClasses;
    }; */

    // Method for updating the plugins options
    Wookmark.prototype.update = function(options) {
      this.itemHeightsDirty = true;
      $.extend(true, this, options);
    };

    // This timer ensures that layout is not continuously called as window is being dragged.
    Wookmark.prototype.onResize = function() {
      clearTimeout(this.resizeTimer);
      this.itemHeightsDirty = this.flexibleWidth !== 0;
      this.resizeTimer = setTimeout(this.layout, this.resizeDelay);
    };

    // Marks the items heights as dirty and does a relayout
    Wookmark.prototype.onRefresh = function() {
      this.itemHeightsDirty = true;
      this.layout();
    };

    /**
     * Filters the active items with the given string filters.
     * @param filters array of string
     * @param mode 'or' or 'and'
     */
	/*
    Wookmark.prototype.filter = function(filters, mode, dryRun) {
      var activeFilters = [], activeFiltersLength, activeItems = $(),
          i, j, k, filter;

      filters = filters || [];
      mode = mode || 'or';
      dryRun = dryRun || false;

      if (filters.length) {
        // Collect active filters
        for (i = 0; i < filters.length; i++) {
          filter = cleanFilterName(filters[i]);
          if (filter in this.filterClasses) {
            activeFilters.push(this.filterClasses[filter]);
          }
        }

        // Get items for active filters with the selected mode
        activeFiltersLength = activeFilters.length;
        if (mode == 'or' || activeFiltersLength == 1) {
          // Set all items in all active filters active
          for (i = 0; i < activeFiltersLength; i++) {
            activeItems = activeItems.add(activeFilters[i]);
          }
        } else if (mode == 'and') {
          var shortestFilter = activeFilters[0],
              itemValid = true, foundInFilter,
              currentItem, currentFilter;

          // Find shortest filter class
          for (i = 1; i < activeFiltersLength; i++) {
            if (activeFilters[i].length < shortestFilter.length) {
              shortestFilter = activeFilters[i];
            }
          }

          // Iterate over shortest filter and find elements in other filter classes
          shortestFilter = shortestFilter || [];
          for (i = 0; i < shortestFilter.length; i++) {
            currentItem = shortestFilter[i];
            itemValid = true;

            for (j = 0; j < activeFilters.length && itemValid; j++) {
              currentFilter = activeFilters[j];
              if (shortestFilter == currentFilter) continue;

              // Search for current item in each active filter class
              for (k = 0, foundInFilter = false; k < currentFilter.length && !foundInFilter; k++) {
                foundInFilter = currentFilter[k] == currentItem;
              }
              itemValid &= foundInFilter;
            }
            if (itemValid)
              activeItems.push(shortestFilter[i]);
          }
        }
        // Hide inactive items
        if (!dryRun)
          this.handler.not(activeItems).addClass('inactive');
      } else {
        // Show all items if no filter is selected
        activeItems = this.handler;
      }

      // Show active items
      if (!dryRun) {
        activeItems.removeClass('inactive');
        // Unset columns and refresh grid for a full layout
        this.columns = null;
        this.layout();
      }
      return activeItems;
    };
	*/

    /**
     * Creates or updates existing placeholders to create columns of even height
     */
    Wookmark.prototype.refreshPlaceholders = function(columnWidth, sideOffset) {
      var i = this.placeholders.length,
          $placeholder, $lastColumnItem,
          columnsLength = this.columns.length, column,
          height, top, innerOffset,
          containerHeight = this.container.innerHeight();

      for (; i < columnsLength; i++) {
        $placeholder = $('<div class="wookmark-placeholder"/>').appendTo(this.container);
        this.placeholders.push($placeholder);
      }

      innerOffset = this.offset + parseInt(this.placeholders[0].css('borderLeftWidth'), 10) * 2;

      for (i = 0; i < this.placeholders.length; i++) {
        $placeholder = this.placeholders[i];
        column = this.columns[i];

        if (i >= columnsLength || !column[column.length - 1]) {
          $placeholder.css('display', 'none');
        } else {
          $lastColumnItem = column[column.length - 1];
          if (!$lastColumnItem) continue;
          top = $lastColumnItem.data('wookmark-top') + $lastColumnItem.data('wookmark-height') + this.verticalOffset;
          height = containerHeight - top - innerOffset;

          $placeholder.css({
            position: 'absolute',
            display: height > 0 ? 'block' : 'none',
            left: i * columnWidth + sideOffset,
            top: top,
            width: columnWidth - innerOffset,
            height: height
          });
        }
      }
    };

    // Method the get active items which are not disabled and visible
    Wookmark.prototype.getActiveItems = function() {
      return this.ignoreInactiveItems ? this.handler.not('.inactive') : this.handler;
    };

    // Method to get the standard item width
    Wookmark.prototype.getItemWidth = function() {
      var itemWidth = this.itemWidth,
          innerWidth = this.container.width() - 2 * this.outerOffset,
          firstElement = this.handler.eq(0),
          flexibleWidth = this.flexibleWidth;

      if (this.itemWidth === undefined || this.itemWidth === 0 && !this.flexibleWidth) {
        itemWidth = firstElement.outerWidth();
      }
      else if (typeof this.itemWidth == 'string' && this.itemWidth.indexOf('%') >= 0) {
        itemWidth = parseFloat(this.itemWidth) / 100 * innerWidth;
      }

      // Calculate flexible item width if option is set
      if (flexibleWidth) {
        if (typeof flexibleWidth == 'string' && flexibleWidth.indexOf('%') >= 0) {
          flexibleWidth = parseFloat(flexibleWidth) / 100 * innerWidth;
        }

        // Find highest column count
        var paddedInnerWidth = (innerWidth + this.offset),
            flexibleColumns = ~~(0.5 + paddedInnerWidth / (flexibleWidth + this.offset)),
            fixedColumns = ~~(paddedInnerWidth / (itemWidth + this.offset)),
            columns = Math.max(flexibleColumns, fixedColumns),
            columnWidth = Math.min(flexibleWidth, ~~((innerWidth - (columns - 1) * this.offset) / columns));

        itemWidth = Math.max(itemWidth, columnWidth);

        // Stretch items to fill calculated width
        this.handler.css('width', itemWidth);
      }

      return itemWidth;
    };

    // Main layout method.
    Wookmark.prototype.layout = function(force) {
      // Do nothing if container isn't visible
      if (!this.container.is(':visible')) return;

      // Calculate basic layout parameters.
      var columnWidth = this.getItemWidth() + this.offset,
          containerWidth = this.container.width(),
          innerWidth = containerWidth - 2 * this.outerOffset,
          columns = ~~((innerWidth + this.offset) / columnWidth),
          offset = 0, maxHeight = 0, i = 0,
          activeItems = this.getActiveItems(),
          activeItemsLength = activeItems.length,
          $item;

      // Cache item height
      if (this.itemHeightsDirty || !this.container.data('itemHeightsInitialized')) {
        for (; i < activeItemsLength; i++) {
          $item = activeItems.eq(i);
          $item.data('wookmark-height', $item.outerHeight());
        }
        this.itemHeightsDirty = false;
        this.container.data('itemHeightsInitialized', true);
      }

      // Use less columns if there are to few items
      columns = Math.max(1, Math.min(columns, activeItemsLength));

      // Calculate the offset based on the alignment of columns to the parent container
      offset = this.outerOffset;
      if (this.align == 'center') {
        offset += ~~(0.5 + (innerWidth - (columns * columnWidth - this.offset)) >> 1);
      }

      // Get direction for positioning
      this.direction = this.direction || (this.align == 'right' ? 'right' : 'left');

      // If container and column count hasn't changed, we can only update the columns.
      if (!force && this.columns !== null && this.columns.length == columns && this.activeItemCount == activeItemsLength) {
        maxHeight = this.layoutColumns(columnWidth, offset);
      } else {
        maxHeight = this.layoutFull(columnWidth, columns, offset);
      }
      this.activeItemCount = activeItemsLength;

      // Set container height to height of the grid.
      this.container.css('height', maxHeight);

      // Update placeholders
      if (this.fillEmptySpace) {
        this.refreshPlaceholders(columnWidth, offset);
      }

      if (this.onLayoutChanged !== undefined && typeof this.onLayoutChanged === 'function') {
        this.onLayoutChanged();
      }
    };

    /**
     * Sort elements with configurable comparator
     */
    Wookmark.prototype.sortElements = function(elements) {
      return typeof(this.comparator) === 'function' ? elements.sort(this.comparator) : elements;
    };

    /**
     * Perform a full layout update.
     */
    Wookmark.prototype.layoutFull = function(columnWidth, columns, offset) {
      var $item, i = 0, k = 0,
          activeItems = $.makeArray(this.getActiveItems()),
          length = activeItems.length,
          shortest = null, shortestIndex = null,
          sideOffset, heights = [], itemBulkCSS = [],
          leftAligned = this.align == 'left' ? true : false;

      this.columns = [];

      // Sort elements before layouting
      activeItems = this.sortElements(activeItems);

      // Prepare arrays to store height of columns and items.
      while (heights.length < columns) {
        heights.push(this.outerOffset);
        this.columns.push([]);
      }

      // Loop over items.
      for (; i < length; i++ ) {
        $item = $(activeItems[i]);

        // Find the shortest column.
        shortest = heights[0];
        shortestIndex = 0;
        for (k = 0; k < columns; k++) {
          if (heights[k] < shortest) {
            shortest = heights[k];
            shortestIndex = k;
          }
        }
        $item.data('wookmark-top', shortest);

        // stick to left side if alignment is left and this is the first column
        sideOffset = offset;
        if (shortestIndex > 0 || !leftAligned)
          sideOffset += shortestIndex * columnWidth;

        // Position the item.
        (itemBulkCSS[i] = {
          obj: $item,
          css: {
            position: 'absolute',
            top: shortest
          }
        }).css[this.direction] = sideOffset;

        // Update column height and store item in shortest column
        heights[shortestIndex] += $item.data('wookmark-height') + this.verticalOffset;
        this.columns[shortestIndex].push($item);
      }

      bulkUpdateCSS(itemBulkCSS);

      // Return longest column
      return Math.max.apply(Math, heights);
    };

    /**
     * This layout method only updates the vertical position of the
     * existing column assignments.
     */
    Wookmark.prototype.layoutColumns = function(columnWidth, offset) {
      var heights = [], itemBulkCSS = [],
          i = 0, k = 0, j = 0, currentHeight,
          column, $item, itemData, sideOffset;

      for (; i < this.columns.length; i++) {
        heights.push(this.outerOffset);
        column = this.columns[i];
        sideOffset = i * columnWidth + offset;
        currentHeight = heights[i];

        for (k = 0; k < column.length; k++, j++) {
          $item = column[k].data('wookmark-top', currentHeight);
          (itemBulkCSS[j] = {
            obj: $item,
            css: {
              top: currentHeight
            }
          }).css[this.direction] = sideOffset;

          currentHeight += $item.data('wookmark-height') + this.verticalOffset;
        }
        heights[i] = currentHeight;
      }

      bulkUpdateCSS(itemBulkCSS);

      // Return longest column
      return Math.max.apply(Math, heights);
    };

    /**
     * Clear event listeners and time outs and the instance itself
     */
    Wookmark.prototype.clear = function() {
      clearTimeout(this.resizeTimer);
      $window.unbind('resize.wookmark', this.onResize);
      this.container.unbind('refreshWookmark', this.onRefresh);
      this.handler.wookmarkInstance = null;
    };

    return Wookmark;
  })();

  $.fn.wookmark = function(options) {
    // Create a wookmark instance if not available
    if (!this.wookmarkInstance) {
      this.wookmarkInstance = new Wookmark(this, options || {});
    } else {
      this.wookmarkInstance.update(options || {});
    }

    // Apply layout
    this.wookmarkInstance.layout(true);

    // Display items (if hidden) and return jQuery object to maintain chainability
    return this.show();
  };
}));


/*! Magnific Popup - v1.0.0 - 2015-01-03
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2015 Dmitry Semenov; */
;(function (factory) { 
if (typeof define === 'function' && define.amd) { 
 // AMD. Register as an anonymous module. 
 define(['jquery'], factory); 
 } else if (typeof exports === 'object') { 
 // Node/CommonJS 
 factory(require('jquery')); 
 } else { 
 // Browser globals 
 factory(window.jQuery || window.Zepto); 
 } 
 }(function($) { 

/*>>core*/
/**
 * 
 * Magnific Popup Core JS file
 * 
 */


/**
 * Private static constants
 */
var CLOSE_EVENT = 'Close',
	BEFORE_CLOSE_EVENT = 'BeforeClose',
	AFTER_CLOSE_EVENT = 'AfterClose',
	BEFORE_APPEND_EVENT = 'BeforeAppend',
	MARKUP_PARSE_EVENT = 'MarkupParse',
	OPEN_EVENT = 'Open',
	CHANGE_EVENT = 'Change',
	NS = 'mfp',
	EVENT_NS = '.' + NS,
	READY_CLASS = 'mfp-ready',
	REMOVING_CLASS = 'mfp-removing',
	PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


/**
 * Private vars 
 */
/*jshint -W079 */
var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
	MagnificPopup = function(){},
	_isJQ = !!(window.jQuery),
	_prevStatus,
	_window = $(window),
	_document,
	_prevContentType,
	_wrapClasses,
	_currPopupType;


/**
 * Private functions
 */
var _mfpOn = function(name, f) {
		mfp.ev.on(NS + name + EVENT_NS, f);
	},
	_getEl = function(className, appendTo, html, raw) {
		var el = document.createElement('div');
		el.className = 'mfp-'+className;
		if(html) {
			el.innerHTML = html;
		}
		if(!raw) {
			el = $(el);
			if(appendTo) {
				el.appendTo(appendTo);
			}
		} else if(appendTo) {
			appendTo.appendChild(el);
		}
		return el;
	},
	_mfpTrigger = function(e, data) {
		mfp.ev.triggerHandler(NS + e, data);

		if(mfp.st.callbacks) {
			// converts "mfpEventName" to "eventName" callback and triggers it if it's present
			e = e.charAt(0).toLowerCase() + e.slice(1);
			if(mfp.st.callbacks[e]) {
				mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
			}
		}
	},
	_getCloseBtn = function(type) {
		if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
			mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
			_currPopupType = type;
		}
		return mfp.currTemplate.closeBtn;
	},
	// Initialize Magnific Popup only when called at least once
	_checkInstance = function() {
		if(!$.magnificPopup.instance) {
			/*jshint -W020 */
			mfp = new MagnificPopup();
			mfp.init();
			$.magnificPopup.instance = mfp;
		}
	},
	// CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
	supportsTransitions = function() {
		var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
			v = ['ms','O','Moz','Webkit']; // 'v' for vendor

		if( s['transition'] !== undefined ) {
			return true; 
		}
			
		while( v.length ) {
			if( v.pop() + 'Transition' in s ) {
				return true;
			}
		}
				
		return false;
	};



/**
 * Public functions
 */
MagnificPopup.prototype = {

	constructor: MagnificPopup,

	/**
	 * Initializes Magnific Popup plugin. 
	 * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
	 */
	init: function() {
		var appVersion = navigator.appVersion;
		mfp.isIE7 = appVersion.indexOf("MSIE 7.") !== -1; 
		mfp.isIE8 = appVersion.indexOf("MSIE 8.") !== -1;
		mfp.isLowIE = mfp.isIE7 || mfp.isIE8;
		mfp.isAndroid = (/android/gi).test(appVersion);
		mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
		mfp.supportsTransition = supportsTransitions();

		// We disable fixed positioned lightbox on devices that don't handle it nicely.
		// If you know a better way of detecting this - let me know.
		mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
		_document = $(document);

		mfp.popupsCache = {};
	},

	/**
	 * Opens popup
	 * @param  data [description]
	 */
	open: function(data) {

		var i;

		if(data.isObj === false) { 
			// convert jQuery collection to array to avoid conflicts later
			mfp.items = data.items.toArray();

			mfp.index = 0;
			var items = data.items,
				item;
			for(i = 0; i < items.length; i++) {
				item = items[i];
				if(item.parsed) {
					item = item.el[0];
				}
				if(item === data.el[0]) {
					mfp.index = i;
					break;
				}
			}
		} else {
			mfp.items = $.isArray(data.items) ? data.items : [data.items];
			mfp.index = data.index || 0;
		}

		// if popup is already opened - we just update the content
		if(mfp.isOpen) {
			mfp.updateItemHTML();
			return;
		}
		
		mfp.types = []; 
		_wrapClasses = '';
		if(data.mainEl && data.mainEl.length) {
			mfp.ev = data.mainEl.eq(0);
		} else {
			mfp.ev = _document;
		}

		if(data.key) {
			if(!mfp.popupsCache[data.key]) {
				mfp.popupsCache[data.key] = {};
			}
			mfp.currTemplate = mfp.popupsCache[data.key];
		} else {
			mfp.currTemplate = {};
		}



		mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data ); 
		mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

		if(mfp.st.modal) {
			mfp.st.closeOnContentClick = false;
			mfp.st.closeOnBgClick = false;
			mfp.st.showCloseBtn = false;
			mfp.st.enableEscapeKey = false;
		}
		

		// Building markup
		// main containers are created only once
		if(!mfp.bgOverlay) {

			// Dark overlay
			mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
				mfp.close();
			});

			mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
				if(mfp._checkIfClose(e.target)) {
					mfp.close();
				}
			});

			mfp.container = _getEl('container', mfp.wrap);
		}

		mfp.contentContainer = _getEl('content');
		if(mfp.st.preloader) {
			mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
		}


		// Initializing modules
		var modules = $.magnificPopup.modules;
		for(i = 0; i < modules.length; i++) {
			var n = modules[i];
			n = n.charAt(0).toUpperCase() + n.slice(1);
			mfp['init'+n].call(mfp);
		}
		_mfpTrigger('BeforeOpen');


		if(mfp.st.showCloseBtn) {
			// Close button
			if(!mfp.st.closeBtnInside) {
				mfp.wrap.append( _getCloseBtn() );
			} else {
				_mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
					values.close_replaceWith = _getCloseBtn(item.type);
				});
				_wrapClasses += ' mfp-close-btn-in';
			}
		}

		if(mfp.st.alignTop) {
			_wrapClasses += ' mfp-align-top';
		}

	

		if(mfp.fixedContentPos) {
			mfp.wrap.css({
				overflow: mfp.st.overflowY,
				overflowX: 'hidden',
				overflowY: mfp.st.overflowY
			});
		} else {
			mfp.wrap.css({ 
				top: _window.scrollTop(),
				position: 'absolute'
			});
		}
		if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
			mfp.bgOverlay.css({
				height: _document.height(),
				position: 'absolute'
			});
		}

		

		if(mfp.st.enableEscapeKey) {
			// Close on ESC key
			_document.on('keyup' + EVENT_NS, function(e) {
				if(e.keyCode === 27) {
					mfp.close();
				}
			});
		}

		_window.on('resize' + EVENT_NS, function() {
			mfp.updateSize();
		});


		if(!mfp.st.closeOnContentClick) {
			_wrapClasses += ' mfp-auto-cursor';
		}
		
		if(_wrapClasses)
			mfp.wrap.addClass(_wrapClasses);


		// this triggers recalculation of layout, so we get it once to not to trigger twice
		var windowHeight = mfp.wH = _window.height();

		
		var windowStyles = {};

		if( mfp.fixedContentPos ) {
            if(mfp._hasScrollBar(windowHeight)){
                var s = mfp._getScrollbarSize();
                if(s) {
                    windowStyles.marginRight = s;
                }
            }
        }

		if(mfp.fixedContentPos) {
			if(!mfp.isIE7) {
				windowStyles.overflow = 'hidden';
			} else {
				// ie7 double-scroll bug
				$('body, html').css('overflow', 'hidden');
			}
		}

		
		
		var classesToadd = mfp.st.mainClass;
		if(mfp.isIE7) {
			classesToadd += ' mfp-ie7';
		}
		if(classesToadd) {
			mfp._addClassToMFP( classesToadd );
		}

		// add content
		mfp.updateItemHTML();

		_mfpTrigger('BuildControls');

		// remove scrollbar, add margin e.t.c
		$('html').css(windowStyles);
		
		// add everything to DOM
		mfp.bgOverlay.add(mfp.wrap).prependTo( mfp.st.prependTo || $(document.body) );

		// Save last focused element
		mfp._lastFocusedEl = document.activeElement;
		
		// Wait for next cycle to allow CSS transition
		setTimeout(function() {
			
			if(mfp.content) {
				mfp._addClassToMFP(READY_CLASS);
				mfp._setFocus();
			} else {
				// if content is not defined (not loaded e.t.c) we add class only for BG
				mfp.bgOverlay.addClass(READY_CLASS);
			}
			
			// Trap the focus in popup
			_document.on('focusin' + EVENT_NS, mfp._onFocusIn);

		}, 16);

		mfp.isOpen = true;
		mfp.updateSize(windowHeight);
		_mfpTrigger(OPEN_EVENT);

		return data;
	},

	/**
	 * Closes the popup
	 */
	close: function() {
		if(!mfp.isOpen) return;
		_mfpTrigger(BEFORE_CLOSE_EVENT);

		mfp.isOpen = false;
		// for CSS3 animation
		if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
			mfp._addClassToMFP(REMOVING_CLASS);
			setTimeout(function() {
				mfp._close();
			}, mfp.st.removalDelay);
		} else {
			mfp._close();
		}
	},

	/**
	 * Helper for close() function
	 */
	_close: function() {
		_mfpTrigger(CLOSE_EVENT);

		var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

		mfp.bgOverlay.detach();
		mfp.wrap.detach();
		mfp.container.empty();

		if(mfp.st.mainClass) {
			classesToRemove += mfp.st.mainClass + ' ';
		}

		mfp._removeClassFromMFP(classesToRemove);

		if(mfp.fixedContentPos) {
			var windowStyles = {marginRight: ''};
			if(mfp.isIE7) {
				$('body, html').css('overflow', '');
			} else {
				windowStyles.overflow = '';
			}
			$('html').css(windowStyles);
		}
		
		_document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
		mfp.ev.off(EVENT_NS);

		// clean up DOM elements that aren't removed
		mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
		mfp.bgOverlay.attr('class', 'mfp-bg');
		mfp.container.attr('class', 'mfp-container');

		// remove close button from target element
		if(mfp.st.showCloseBtn &&
		(!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
			if(mfp.currTemplate.closeBtn)
				mfp.currTemplate.closeBtn.detach();
		}


		if(mfp._lastFocusedEl) {
			$(mfp._lastFocusedEl).focus(); // put tab focus back
		}
		mfp.currItem = null;	
		mfp.content = null;
		mfp.currTemplate = null;
		mfp.prevHeight = 0;

		_mfpTrigger(AFTER_CLOSE_EVENT);
	},
	
	updateSize: function(winHeight) {

		if(mfp.isIOS) {
			// fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
			var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
			var height = window.innerHeight * zoomLevel;
			mfp.wrap.css('height', height);
			mfp.wH = height;
		} else {
			mfp.wH = winHeight || _window.height();
		}
		// Fixes #84: popup incorrectly positioned with position:relative on body
		if(!mfp.fixedContentPos) {
			mfp.wrap.css('height', mfp.wH);
		}

		_mfpTrigger('Resize');

	},

	/**
	 * Set content of popup based on current index
	 */
	updateItemHTML: function() {
		var item = mfp.items[mfp.index];

		// Detach and perform modifications
		mfp.contentContainer.detach();

		if(mfp.content)
			mfp.content.detach();

		if(!item.parsed) {
			item = mfp.parseEl( mfp.index );
		}

		var type = item.type;	

		_mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
		// BeforeChange event works like so:
		// _mfpOn('BeforeChange', function(e, prevType, newType) { });
		
		mfp.currItem = item;

		

		

		if(!mfp.currTemplate[type]) {
			var markup = mfp.st[type] ? mfp.st[type].markup : false;

			// allows to modify markup
			_mfpTrigger('FirstMarkupParse', markup);

			if(markup) {
				mfp.currTemplate[type] = $(markup);
			} else {
				// if there is no markup found we just define that template is parsed
				mfp.currTemplate[type] = true;
			}
		}

		if(_prevContentType && _prevContentType !== item.type) {
			mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
		}
		
		var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
		mfp.appendContent(newContent, type);

		item.preloaded = true;

		_mfpTrigger(CHANGE_EVENT, item);
		_prevContentType = item.type;
		
		// Append container back after its content changed
		mfp.container.prepend(mfp.contentContainer);

		_mfpTrigger('AfterChange');
	},


	/**
	 * Set HTML content of popup
	 */
	appendContent: function(newContent, type) {
		mfp.content = newContent;
		
		if(newContent) {
			if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
				mfp.currTemplate[type] === true) {
				// if there is no markup, we just append close button element inside
				if(!mfp.content.find('.mfp-close').length) {
					mfp.content.append(_getCloseBtn());
				}
			} else {
				mfp.content = newContent;
			}
		} else {
			mfp.content = '';
		}

		_mfpTrigger(BEFORE_APPEND_EVENT);
		mfp.container.addClass('mfp-'+type+'-holder');

		mfp.contentContainer.append(mfp.content);
	},



	
	/**
	 * Creates Magnific Popup data object based on given data
	 * @param  {int} index Index of item to parse
	 */
	parseEl: function(index) {
		var item = mfp.items[index],
			type;

		if(item.tagName) {
			item = { el: $(item) };
		} else {
			type = item.type;
			item = { data: item, src: item.src };
		}

		if(item.el) {
			var types = mfp.types;

			// check for 'mfp-TYPE' class
			for(var i = 0; i < types.length; i++) {
				if( item.el.hasClass('mfp-'+types[i]) ) {
					type = types[i];
					break;
				}
			}

			item.src = item.el.attr('data-mfp-src');
			if(!item.src) {
				item.src = item.el.attr('href');
			}
		}

		item.type = type || mfp.st.type || 'inline';
		item.index = index;
		item.parsed = true;
		mfp.items[index] = item;
		_mfpTrigger('ElementParse', item);

		return mfp.items[index];
	},


	/**
	 * Initializes single popup or a group of popups
	 */
	addGroup: function(el, options) {
		var eHandler = function(e) {
			e.mfpEl = this;
			mfp._openClick(e, el, options);
		};

		if(!options) {
			options = {};
		} 

		var eName = 'click.magnificPopup';
		options.mainEl = el;
		
		if(options.items) {
			options.isObj = true;
			el.off(eName).on(eName, eHandler);
		} else {
			options.isObj = false;
			if(options.delegate) {
				el.off(eName).on(eName, options.delegate , eHandler);
			} else {
				options.items = el;
				el.off(eName).on(eName, eHandler);
			}
		}
	},
	_openClick: function(e, el, options) {
		var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


		if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey ) ) {
			return;
		}

		var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

		if(disableOn) {
			if($.isFunction(disableOn)) {
				if( !disableOn.call(mfp) ) {
					return true;
				}
			} else { // else it's number
				if( _window.width() < disableOn ) {
					return true;
				}
			}
		}
		
		if(e.type) {
			e.preventDefault();

			// This will prevent popup from closing if element is inside and popup is already opened
			if(mfp.isOpen) {
				e.stopPropagation();
			}
		}
			

		options.el = $(e.mfpEl);
		if(options.delegate) {
			options.items = el.find(options.delegate);
		}
		mfp.open(options);
	},


	/**
	 * Updates text on preloader
	 */
	updateStatus: function(status, text) {

		if(mfp.preloader) {
			if(_prevStatus !== status) {
				mfp.container.removeClass('mfp-s-'+_prevStatus);
			}

			if(!text && status === 'loading') {
				text = mfp.st.tLoading;
			}

			var data = {
				status: status,
				text: text
			};
			// allows to modify status
			_mfpTrigger('UpdateStatus', data);

			status = data.status;
			text = data.text;

			mfp.preloader.html(text);

			mfp.preloader.find('a').on('click', function(e) {
				e.stopImmediatePropagation();
			});

			mfp.container.addClass('mfp-s-'+status);
			_prevStatus = status;
		}
	},


	/*
		"Private" helpers that aren't private at all
	 */
	// Check to close popup or not
	// "target" is an element that was clicked
	_checkIfClose: function(target) {

		if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
			return;
		}

		var closeOnContent = mfp.st.closeOnContentClick;
		var closeOnBg = mfp.st.closeOnBgClick;

		if(closeOnContent && closeOnBg) {
			return true;
		} else {

			// We close the popup if click is on close button or on preloader. Or if there is no content.
			if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
				return true;
			}

			// if click is outside the content
			if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
				if(closeOnBg) {
					// last check, if the clicked element is in DOM, (in case it's removed onclick)
					if( $.contains(document, target) ) {
						return true;
					}
				}
			} else if(closeOnContent) {
				return true;
			}

		}
		return false;
	},
	_addClassToMFP: function(cName) {
		mfp.bgOverlay.addClass(cName);
		mfp.wrap.addClass(cName);
	},
	_removeClassFromMFP: function(cName) {
		this.bgOverlay.removeClass(cName);
		mfp.wrap.removeClass(cName);
	},
	_hasScrollBar: function(winHeight) {
		return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
	},
	_setFocus: function() {
		(mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
	},
	_onFocusIn: function(e) {
		if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
			mfp._setFocus();
			return false;
		}
	},
	_parseMarkup: function(template, values, item) {
		var arr;
		if(item.data) {
			values = $.extend(item.data, values);
		}
		_mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

		$.each(values, function(key, value) {
			if(value === undefined || value === false) {
				return true;
			}
			arr = key.split('_');
			if(arr.length > 1) {
				var el = template.find(EVENT_NS + '-'+arr[0]);

				if(el.length > 0) {
					var attr = arr[1];
					if(attr === 'replaceWith') {
						if(el[0] !== value[0]) {
							el.replaceWith(value);
						}
					} else if(attr === 'img') {
						if(el.is('img')) {
							el.attr('src', value);
						} else {
							el.replaceWith( '<img src="'+value+'" class="' + el.attr('class') + '" />' );
						}
					} else {
						el.attr(arr[1], value);
					}
				}

			} else {
				template.find(EVENT_NS + '-'+key).html(value);
			}
		});
	},

	_getScrollbarSize: function() {
		// thx David
		if(mfp.scrollbarSize === undefined) {
			var scrollDiv = document.createElement("div");
			scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
			document.body.appendChild(scrollDiv);
			mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
			document.body.removeChild(scrollDiv);
		}
		return mfp.scrollbarSize;
	}

}; /* MagnificPopup core prototype end */




/**
 * Public static functions
 */
$.magnificPopup = {
	instance: null,
	proto: MagnificPopup.prototype,
	modules: [],

	open: function(options, index) {
		_checkInstance();	

		if(!options) {
			options = {};
		} else {
			options = $.extend(true, {}, options);
		}
			

		options.isObj = true;
		options.index = index || 0;
		return this.instance.open(options);
	},

	close: function() {
		return $.magnificPopup.instance && $.magnificPopup.instance.close();
	},

	registerModule: function(name, module) {
		if(module.options) {
			$.magnificPopup.defaults[name] = module.options;
		}
		$.extend(this.proto, module.proto);			
		this.modules.push(name);
	},

	defaults: {   

		// Info about options is in docs:
		// http://dimsemenov.com/plugins/magnific-popup/documentation.html#options
		
		disableOn: 0,	

		key: null,

		midClick: false,

		mainClass: '',

		preloader: true,

		focus: '', // CSS selector of input to focus after popup is opened
		
		closeOnContentClick: false,

		closeOnBgClick: true,

		closeBtnInside: true, 

		showCloseBtn: true,

		enableEscapeKey: true,

		modal: false,

		alignTop: false,
	
		removalDelay: 0,

		prependTo: null,
		
		fixedContentPos: 'auto', 
	
		fixedBgPos: 'auto',

		overflowY: 'auto',

		closeMarkup: '<button title="%title%" type="button" class="mfp-close">&times;</button>',

		tClose: 'Close (Esc)',

		tLoading: 'Loading...'

	}
};



$.fn.magnificPopup = function(options) {
	_checkInstance();

	var jqEl = $(this);

	// We call some API method of first param is a string
	if (typeof options === "string" ) {

		if(options === 'open') {
			var items,
				itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
				index = parseInt(arguments[1], 10) || 0;

			if(itemOpts.items) {
				items = itemOpts.items[index];
			} else {
				items = jqEl;
				if(itemOpts.delegate) {
					items = items.find(itemOpts.delegate);
				}
				items = items.eq( index );
			}
			mfp._openClick({mfpEl:items}, jqEl, itemOpts);
		} else {
			if(mfp.isOpen)
				mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
		}

	} else {
		// clone options obj
		options = $.extend(true, {}, options);
		
		/*
		 * As Zepto doesn't support .data() method for objects 
		 * and it works only in normal browsers
		 * we assign "options" object directly to the DOM element. FTW!
		 */
		if(_isJQ) {
			jqEl.data('magnificPopup', options);
		} else {
			jqEl[0].magnificPopup = options;
		}

		mfp.addGroup(jqEl, options);

	}
	return jqEl;
};


//Quick benchmark
/*
var start = performance.now(),
	i,
	rounds = 1000;

for(i = 0; i < rounds; i++) {

}
console.log('Test #1:', performance.now() - start);

start = performance.now();
for(i = 0; i < rounds; i++) {

}
console.log('Test #2:', performance.now() - start);
*/


/*>>core*/





/*>>image*/
var _imgInterval,
	_getTitle = function(item) {
		if(item.data && item.data.title !== undefined) 
			return item.data.title;

		var src = mfp.st.image.titleSrc;

		if(src) {
			if($.isFunction(src)) {
				return src.call(mfp, item);
			} else if(item.el) {
				return item.el.attr(src) || '';
			}
		}
		return '';
	};

$.magnificPopup.registerModule('image', {

	options: {
		markup: '<div class="mfp-figure">'+
					'<div class="mfp-close"></div>'+
					'<figure>'+
						'<div class="mfp-img"></div>'+
						'<figcaption>'+
							'<div class="mfp-bottom-bar">'+
								'<div class="mfp-title"></div>'+
								'<div class="mfp-counter"></div>'+
							'</div>'+
						'</figcaption>'+
					'</figure>'+
				'</div>',
		cursor: 'mfp-zoom-out-cur',
		titleSrc: 'title', 
		verticalFit: true,
		tError: '<a href="%url%">The image</a> could not be loaded.'
	},

	proto: {
		initImage: function() {
			var imgSt = mfp.st.image,
				ns = '.image';

			mfp.types.push('image');

			_mfpOn(OPEN_EVENT+ns, function() {
				if(mfp.currItem.type === 'image' && imgSt.cursor) {
					$(document.body).addClass(imgSt.cursor);
				}
			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(imgSt.cursor) {
					$(document.body).removeClass(imgSt.cursor);
				}
				_window.off('resize' + EVENT_NS);
			});

			_mfpOn('Resize'+ns, mfp.resizeImage);
			if(mfp.isLowIE) {
				_mfpOn('AfterChange', mfp.resizeImage);
			}
		},
		resizeImage: function() {
			var item = mfp.currItem;
			if(!item || !item.img) return;

			if(mfp.st.image.verticalFit) {
				var decr = 0;
				// fix box-sizing in ie7/8
				if(mfp.isLowIE) {
					decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
				}
				item.img.css('max-height', mfp.wH-decr);
				//Added for Imax
				//console.log($(item.img).next());
				$(item.img).next().css('max-height', mfp.wH-decr-80);
				$videoElement = $(item.img).prev();
				//console.log("$videoElement",$videoElement);
				if(null!=$videoElement && $videoElement.length>0) {
					$videoElement.css('max-height', mfp.wH-decr);
				}
			}
		},
		_onImageHasSize: function(item) {
			if(item.img) {
				
				item.hasSize = true;

				if(_imgInterval) {
					clearInterval(_imgInterval);
				}
				
				item.isCheckingImgSize = false;

				_mfpTrigger('ImageHasSize', item);

				if(item.imgHidden) {
					if(mfp.content)
						mfp.content.removeClass('mfp-loading');
					
					item.imgHidden = false;
				}

			}
		},

		/**
		 * Function that loops until the image has size to display elements that rely on it asap
		 */
		findImageSize: function(item) {

			var counter = 0,
				img = item.img[0],
				mfpSetInterval = function(delay) {

					if(_imgInterval) {
						clearInterval(_imgInterval);
					}
					// decelerating interval that checks for size of an image
					_imgInterval = setInterval(function() {
						if(img.naturalWidth > 0) {
							mfp._onImageHasSize(item);
							return;
						}

						if(counter > 200) {
							clearInterval(_imgInterval);
						}

						counter++;
						if(counter === 3) {
							mfpSetInterval(10);
						} else if(counter === 40) {
							mfpSetInterval(50);
						} else if(counter === 100) {
							mfpSetInterval(500);
						}
					}, delay);
				};

			mfpSetInterval(1);
		},

		getImage: function(item, template) {

			var guard = 0,

				// image load complete handler
				onLoadComplete = function() {
					if(item) {
						if (item.img[0].complete) {
							item.img.off('.mfploader');
							
							if(item === mfp.currItem){
								mfp._onImageHasSize(item);

								mfp.updateStatus('ready');
							}

							item.hasSize = true;
							item.loaded = true;

							_mfpTrigger('ImageLoadComplete');
							
						}
						else {
							// if image complete check fails 200 times (20 sec), we assume that there was an error.
							guard++;
							if(guard < 200) {
								setTimeout(onLoadComplete,100);
							} else {
								onLoadError();
							}
						}
					}
				},

				// image error handler
				onLoadError = function() {
					if(item) {
						item.img.off('.mfploader');
						if(item === mfp.currItem){
							mfp._onImageHasSize(item);
							mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
						}

						item.hasSize = true;
						item.loaded = true;
						item.loadError = true;
					}
				},
				imgSt = mfp.st.image;


			var el = template.find('.mfp-img');
			if(el.length) {
				var img = document.createElement('img');
				img.className = 'mfp-img';
				if(item.el && item.el.find('img').length) {
					img.alt = item.el.find('img').attr('alt');
				}
				item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
				img.src = item.src;

				// without clone() "error" event is not firing when IMG is replaced by new IMG
				// TODO: find a way to avoid such cloning
				if(el.is('img')) {
					item.img = item.img.clone();
				}

				img = item.img[0];
				if(img.naturalWidth > 0) {
					item.hasSize = true;
				} else if(!img.width) {										
					item.hasSize = false;
				}
			}

			mfp._parseMarkup(template, {
				title: _getTitle(item),
				img_replaceWith: item.img
			}, item);

			mfp.resizeImage();

			if(item.hasSize) {
				if(_imgInterval) clearInterval(_imgInterval);

				if(item.loadError) {
					template.addClass('mfp-loading');
					mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
				} else {
					template.removeClass('mfp-loading');
					mfp.updateStatus('ready');
				}
				return template;
			}

			mfp.updateStatus('loading');
			item.loading = true;

			if(!item.hasSize) {
				item.imgHidden = true;
				template.addClass('mfp-loading');
				mfp.findImageSize(item);
			} 

			return template;
		}
	}
});



/*>>image*/

/*>>zoom*/
var hasMozTransform,
	getHasMozTransform = function() {
		if(hasMozTransform === undefined) {
			hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
		}
		return hasMozTransform;		
	};

$.magnificPopup.registerModule('zoom', {

	options: {
		enabled: false,
		easing: 'ease-in-out',
		duration: 300,
		opener: function(element) {
			return element.is('img') ? element : element.find('img');
		}
	},

	proto: {

		initZoom: function() {
			var zoomSt = mfp.st.zoom,
				ns = '.zoom',
				image;
				
			if(!zoomSt.enabled || !mfp.supportsTransition) {
				return;
			}

			var duration = zoomSt.duration,
				getElToAnimate = function(image) {
					var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
						transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
						cssObj = {
							position: 'fixed',
							zIndex: 9999,
							left: 0,
							top: 0,
							'-webkit-backface-visibility': 'hidden'
						},
						t = 'transition';

					cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

					newImg.css(cssObj);
					return newImg;
				},
				showMainContent = function() {
					mfp.content.css('visibility', 'visible');
				},
				openTimeout,
				animatedImg;

			_mfpOn('BuildControls'+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);
					mfp.content.css('visibility', 'hidden');

					// Basically, all code below does is clones existing image, puts in on top of the current one and animated it
					
					image = mfp._getItemToZoom();

					if(!image) {
						showMainContent();
						return;
					}

					animatedImg = getElToAnimate(image); 
					
					animatedImg.css( mfp._getOffset() );

					mfp.wrap.append(animatedImg);

					openTimeout = setTimeout(function() {
						animatedImg.css( mfp._getOffset( true ) );
						openTimeout = setTimeout(function() {

							showMainContent();

							setTimeout(function() {
								animatedImg.remove();
								image = animatedImg = null;
								_mfpTrigger('ZoomAnimationEnded');
							}, 16); // avoid blink when switching images 

						}, duration); // this timeout equals animation duration

					}, 16); // by adding this timeout we avoid short glitch at the beginning of animation


					// Lots of timeouts...
				}
			});
			_mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);

					mfp.st.removalDelay = duration;

					if(!image) {
						image = mfp._getItemToZoom();
						if(!image) {
							return;
						}
						animatedImg = getElToAnimate(image);
					}
					
					
					animatedImg.css( mfp._getOffset(true) );
					mfp.wrap.append(animatedImg);
					mfp.content.css('visibility', 'hidden');
					
					setTimeout(function() {
						animatedImg.css( mfp._getOffset() );
					}, 16);
				}

			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {
					showMainContent();
					if(animatedImg) {
						animatedImg.remove();
					}
					image = null;
				}	
			});
		},

		_allowZoom: function() {
			return mfp.currItem.type === 'image';
		},

		_getItemToZoom: function() {
			if(mfp.currItem.hasSize) {
				return mfp.currItem.img;
			} else {
				return false;
			}
		},

		// Get element postion relative to viewport
		_getOffset: function(isLarge) {
			var el;
			if(isLarge) {
				el = mfp.currItem.img;
			} else {
				el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
			}

			var offset = el.offset();
			var paddingTop = parseInt(el.css('padding-top'),10);
			var paddingBottom = parseInt(el.css('padding-bottom'),10);
			offset.top -= ( $(window).scrollTop() - paddingTop );


			/*
			
			Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

			 */
			var obj = {
				width: el.width(),
				// fix Zepto height+padding issue
				height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
			};

			// I hate to do this, but there is no another option
			if( getHasMozTransform() ) {
				obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
			} else {
				obj.left = offset.left;
				obj.top = offset.top;
			}
			return obj;
		}

	}
});



/*>>zoom*/



/*>>gallery*/
/**
 * Get looped index depending on number of slides
 */
var _getLoopedId = function(index) {
		var numSlides = mfp.items.length;
		if(index > numSlides - 1) {
			return index - numSlides;
		} else  if(index < 0) {
			return numSlides + index;
		}
		return index;
	},
	_replaceCurrTotal = function(text, curr, total) {
		return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
	};

$.magnificPopup.registerModule('gallery', {

	options: {
		enabled: false,
		arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
		preload: [0,2],
		navigateByImgClick: true,
		arrows: true,

		tPrev: 'Previous (Left arrow key)',
		tNext: 'Next (Right arrow key)',
		tCounter: '%curr% of %total%'
	},

	proto: {
		initGallery: function() {

			var gSt = mfp.st.gallery,
				ns = '.mfp-gallery',
				supportsFastClick = Boolean($.fn.mfpFastClick);

			mfp.direction = true; // true - next, false - prev
			
			if(!gSt || !gSt.enabled ) return false;

			_wrapClasses += ' mfp-gallery';

			_mfpOn(OPEN_EVENT+ns, function() {

				if(gSt.navigateByImgClick) {
					mfp.wrap.on('click'+ns, '.mfp-img', function() {
						if(mfp.items.length > 1) {
							mfp.next();
							return false;
						}
					});
				}

				_document.on('keydown'+ns, function(e) {
					if (e.keyCode === 37) {
						mfp.prev();
					} else if (e.keyCode === 39) {
						mfp.next();
					}
				});
			});

			_mfpOn('UpdateStatus'+ns, function(e, data) {
				if(data.text) {
					data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
				}
			});

			_mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
				var l = mfp.items.length;
				values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
			});

			_mfpOn('BuildControls' + ns, function() {
				if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
					var markup = gSt.arrowMarkup,
						arrowLeft = mfp.arrowLeft = $( markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left') ).addClass(PREVENT_CLOSE_CLASS),			
						arrowRight = mfp.arrowRight = $( markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right') ).addClass(PREVENT_CLOSE_CLASS);

					var eName = supportsFastClick ? 'mfpFastClick' : 'click';
					arrowLeft[eName](function() {
						mfp.prev();
					});			
					arrowRight[eName](function() {
						mfp.next();
					});	

					// Polyfill for :before and :after (adds elements with classes mfp-a and mfp-b)
					if(mfp.isIE7) {
						_getEl('b', arrowLeft[0], false, true);
						_getEl('a', arrowLeft[0], false, true);
						_getEl('b', arrowRight[0], false, true);
						_getEl('a', arrowRight[0], false, true);
					}

					mfp.container.append(arrowLeft.add(arrowRight));
				}
			});

			_mfpOn(CHANGE_EVENT+ns, function() {
				if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

				mfp._preloadTimeout = setTimeout(function() {
					mfp.preloadNearbyImages();
					mfp._preloadTimeout = null;
				}, 16);		
			});


			_mfpOn(CLOSE_EVENT+ns, function() {
				_document.off(ns);
				mfp.wrap.off('click'+ns);
			
				if(mfp.arrowLeft && supportsFastClick) {
					mfp.arrowLeft.add(mfp.arrowRight).destroyMfpFastClick();
				}
				mfp.arrowRight = mfp.arrowLeft = null;
			});

		}, 
		next: function() {
			mfp.direction = true;
			mfp.index = _getLoopedId(mfp.index + 1);
			mfp.updateItemHTML();
		},
		prev: function() {
			mfp.direction = false;
			mfp.index = _getLoopedId(mfp.index - 1);
			mfp.updateItemHTML();
		},
		goTo: function(newIndex) {
			mfp.direction = (newIndex >= mfp.index);
			mfp.index = newIndex;
			mfp.updateItemHTML();
		},
		preloadNearbyImages: function() {
			var p = mfp.st.gallery.preload,
				preloadBefore = Math.min(p[0], mfp.items.length),
				preloadAfter = Math.min(p[1], mfp.items.length),
				i;

			for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
				mfp._preloadItem(mfp.index+i);
			}
			for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
				mfp._preloadItem(mfp.index-i);
			}
		},
		_preloadItem: function(index) {
			index = _getLoopedId(index);

			if(mfp.items[index].preloaded) {
				return;
			}

			var item = mfp.items[index];
			if(!item.parsed) {
				item = mfp.parseEl( index );
			}

			_mfpTrigger('LazyLoad', item);

			if(item.type === 'image') {
				item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
					item.hasSize = true;
				}).on('error.mfploader', function() {
					item.hasSize = true;
					item.loadError = true;
					_mfpTrigger('LazyLoadError', item);
				}).attr('src', item.src);
			}


			item.preloaded = true;
		}
	}
});

/*
Touch Support that might be implemented some day

addSwipeGesture: function() {
	var startX,
		moved,
		multipleTouches;

		return;

	var namespace = '.mfp',
		addEventNames = function(pref, down, move, up, cancel) {
			mfp._tStart = pref + down + namespace;
			mfp._tMove = pref + move + namespace;
			mfp._tEnd = pref + up + namespace;
			mfp._tCancel = pref + cancel + namespace;
		};

	if(window.navigator.msPointerEnabled) {
		addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
	} else if('ontouchstart' in window) {
		addEventNames('touch', 'start', 'move', 'end', 'cancel');
	} else {
		return;
	}
	_window.on(mfp._tStart, function(e) {
		var oE = e.originalEvent;
		multipleTouches = moved = false;
		startX = oE.pageX || oE.changedTouches[0].pageX;
	}).on(mfp._tMove, function(e) {
		if(e.originalEvent.touches.length > 1) {
			multipleTouches = e.originalEvent.touches.length;
		} else {
			//e.preventDefault();
			moved = true;
		}
	}).on(mfp._tEnd + ' ' + mfp._tCancel, function(e) {
		if(moved && !multipleTouches) {
			var oE = e.originalEvent,
				diff = startX - (oE.pageX || oE.changedTouches[0].pageX);

			if(diff > 20) {
				mfp.next();
			} else if(diff < -20) {
				mfp.prev();
			}
		}
	});
},
*/


/*>>gallery*/




 _checkInstance(); }));
 
 
//Instamax 4.0 - http://www.codehandling.com/2015/04/instamax-20-embed-complete-instagram.html
//Buy at http://codecanyon.net/item/instamax-instagram-photo-gallery-on-your-website/11012618

var instamaxLoggedInUser = {};
var instamaxRefreshTimer;
var instamaxReloadCount = 1;

(function ($) {

	//get photos of any user using instagram API
	var getUserPhotos = function ($instamaxContainer,nextPageUrl) {
		//console.log('inside getUserPhotos');
		var loadMoreFlag = false;
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');

		if(null!=nextPageUrl && nextPageUrl!="") {
			apiUserPhotosURL = nextPageUrl;
			loadMoreFlag = true;		
		} else {
			apiUserPhotosURL = "https://api.instagram.com/v1/users/"+instamax_global_options.userId+"/media/recent?count="+instamax_global_options.maxResults+"&client_id="+instamax_global_options.clientId;
		}
		
		//console.log('getUserPhotos apiUserPhotosURL-'+apiUserPhotosURL);
		
		$.ajax({
			url: apiUserPhotosURL,
			type: "GET",
			async: true,
			cache: true,
			dataType: 'jsonp',
			success: function(response) { insertUserPhotos(response,loadMoreFlag,$instamaxContainer);},
			error: function(html) { alert(html); },
			beforeSend: setHeader
		});
	},
	

	//get photos of any user using instagram API
	getUserPhotosBasedOnTags = function (tabId,$instamaxContainer,nextPageUrl) {
		//console.log('inside getUserPhotos');
		var loadMoreFlag = false;
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		
		if(null!=nextPageUrl && nextPageUrl!="") {
			apiUserPhotosURL = nextPageUrl;
			loadMoreFlag = true;		
		} else {
			apiUserPhotosURL = "https://api.instagram.com/v1/users/"+instamax_global_options.userId+"/media/recent?count=100&client_id="+instamax_global_options.clientId;
		}
		
		var hashTag = tabId.substring(tabId.indexOf('_')+1);
		hashTag = hashTag.replace(/\s*/g,'');		
		
		//console.log('getUserPhotos apiUserPhotosURL-'+apiUserPhotosURL);
		
		$.ajax({
			url: apiUserPhotosURL,
			type: "GET",
			async: true,
			cache: true,
			dataType: 'jsonp',
			success: function(response) { insertUserPhotos(response,loadMoreFlag,$instamaxContainer,hashTag);},
			error: function(html) { alert(html); },
			beforeSend: setHeader
		});
	},	

	//get comments of any photo using instagram API
	getPhotoComments = function ($instamaxContainer,mediaId,loadMoreFlag) {
		//console.log('inside getPhotoComments');
		//var loadMoreFlag = false;
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		
		//$instamaxContainer.find("."+mediaId)
		mediaElementComments = $instamaxContainer.find("#"+mediaId).data("comments");
		if(null!=mediaElementComments && mediaElementComments!="") {
			//console.log("found saved comments");
			insertPhotoComments(mediaElementComments,mediaId,loadMoreFlag,$instamaxContainer);
			return;
		}

		/*if(null!=nextPageUrl && nextPageUrl!="") {
			apiPhotoCommentsURL = nextPageUrl;
			loadMoreFlag = true;		
		} else {
		}*/
		
		apiPhotoCommentsURL = "https://api.instagram.com/v1/media/"+mediaId+"/comments?count="+instamax_global_options.maxResults+"&client_id="+instamax_global_options.clientId;

		//console.log("getting new comments");
		//console.log('getPhotoComments apiPhotoCommentsURL-'+apiPhotoCommentsURL);
		
		$.ajax({
			url: apiPhotoCommentsURL,
			type: "GET",
			async: true,
			cache: true,
			dataType: 'jsonp',
			success: function(response) { insertPhotoComments(response,mediaId,loadMoreFlag,$instamaxContainer);},
			error: function(html) { alert(html); },
			beforeSend: setHeader
		});
	},

	insertPhotoComments = function(response,mediaId,loadMoreFlag,$instamaxContainer) {
		//console.log("insertPhotoComments");
		//console.log(response);		
		
		//save comments in media element
		$instamaxContainer.find("#"+mediaId).data("comments",response);
		
		var commentArray = response.data;
		var $instamaxCommentHolder = $instamaxContainer.find('#instamax-encloser-comments');
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		
		var $instamaxMoreCommentsButton = $instamaxContainer.find("#instamax-load-more-comments");
		var start_index = $instamaxMoreCommentsButton.data("startindex");
		if(loadMoreFlag && null!=start_index && start_index!="") {
			start_index = parseInt(start_index,10);
			if(start_index >= commentArray.length) {
				//console.log("all done");
				$instamaxMoreCommentsButton.text("All Done");
				return;
			}
		} else {
			start_index = 0;
			//clear comment area
			$instamaxCommentHolder.empty();
		}
		var end_index = start_index + instamax_global_options.maxComments;
		
		if(end_index > commentArray.length) {
			end_index=commentArray.length;
		}
		
		$instamaxMoreCommentsButton.data("startindex",end_index);
		//console.log(start_index+":"+end_index+":"+commentArray.length);
		
		for(var i=start_index; i<end_index; i++) {
			comment = commentArray[i].text;
			commentPublished = commentArray[i].created_time;
			authorFullname = commentArray[i].from.full_name;
			authorUsername = commentArray[i].from.username;
			authorLink = "https://instagram.com/"+authorUsername;
			authorImage = commentArray[i].from.profile_picture;
			
			//console.log("commentPublished-"+commentPublished);

			$instamaxCommentHolder.append('<div  class="instamax-video-comment"><div class="instamax-from"><a target="_blank" href="'+authorLink+'"><div class="instamax-from-img" style="background-image:url(\''+authorImage+'\');"></div></a><div class="instamax-from-name">'+authorFullname+'</div><div class="instamax-published">'+getDateDiff(commentPublished)+' </div></div><div class="instamax-comment"><span class="instamax-comment-content">'+comment+'</span><div></div>');

		}
		
		
		resetLoadMoreComments($instamaxContainer);
		
	
	},
	
	loadMoreComments = function($instamaxContainer) {
	
		var $instamaxMoreButton = $instamaxContainer.find("#instamax-load-more-comments");
		$instamaxMoreButton.addClass('instamax-load-more-comments-clicked');
		$instamaxMoreButton.text('loading...');

		mediaId = $instamaxContainer.find("#instamax-load-more-comments").data("mediaid");
		getPhotoComments($instamaxContainer,mediaId,true);		
		
	},	
	
	resetLoadMoreComments = function($instamaxContainer) {
		var $instamaxMoreButton = $instamaxContainer.find("#instamax-load-more-comments");
		$instamaxMoreButton.removeClass('youmax-load-more-comments-clicked');
		$instamaxMoreButton.text('Load More');
	},
	
	//get photos of any hashtag using instagram API
	getTagPhotos = function (tabId,$instamaxContainer,nextPageUrl) {
		//console.log('inside getTagPhotos');
		var loadMoreFlag = false;
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');

		var hashTag = tabId.substring(tabId.indexOf('_')+1);
		hashTag = hashTag.replace(/\s*/g,'');
		
		if(null!=nextPageUrl && nextPageUrl!="") {
			apiUserPhotosURL = nextPageUrl;
			loadMoreFlag = true;		
		} else {
			apiUserPhotosURL = "https://api.instagram.com/v1/tags/"+hashTag+"/media/recent?count="+instamax_global_options.maxResults+"&client_id="+instamax_global_options.clientId;
		}
		
		//console.log('getTagPhotos apiUserPhotosURL-'+apiUserPhotosURL);
		
		$.ajax({
			url: apiUserPhotosURL,
			type: "GET",
			async: true,
			cache: true,
			dataType: 'jsonp',
			success: function(response) { insertUserPhotos(response,loadMoreFlag,$instamaxContainer);},
			error: function(html) { alert(html); },
			beforeSend: setHeader
		});
	},
	

	
	//display Instagram Follow button
	renderSubscribeButton = function() {
	
		$.ajaxSetup({
		  cache: true
		});
		
		$.getScript("")
		.done(function( script, textStatus ) {
			//alert( textStatus );
		})
		.fail(function( jqxhr, settings, exception ) {
			//alert( "Triggered ajaxError handler." );
		});
		

		
	},
	
	//initialize youamx - add necessary HTML code
	initInstamax = function($instamaxContainer) {
	
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		
		//Empty the container - ajax compatibility
		$instamaxContainer.empty();
		
		//header
		$instamaxContainer.append('<div id="instamax-header"><div id="instamax-header-wrapper"></div></div>');
		
		//tabs
		$instamaxContainer.append('<div id="instamax-tabs"></div>');
				
		//select
		$instamaxContainer.append('<div id="instamax-select-box"><select id="instamax-select"></select></div>');		
		
		//showing search xxxx
		$instamaxContainer.append('<div id="instamax-showing-title"></div>');
		
		//list
		$instamaxContainer.append('<div id="instamax-photo-list-div"><ul id="tiles"></ul></div>');
		
		//load more
		$instamaxContainer.append('<button id="instamax-load-more-div">LOAD MORE</button>');
		$instamaxLoadMoreDiv = $instamaxContainer.find('#instamax-load-more-div');
		
		$instamaxLoadMoreDiv.data('nextpagetoken','');
		
		$instamaxLoadMoreDiv.on('click',function(){
			loadMorePhotos($instamaxContainer);
			return false;
		});
		
		$instamaxContainer.find('#instamax-tabs').on('click','.instamax-tab',function() {
			$instamaxContainer.find('#instamax-load-more-div').removeAttr('disabled');
			displayPhotos(this.id,$instamaxContainer);
		});
		
		$instamaxContainer.find('#instamax-select').change(function() {
			var tabId = $(this).find(":selected").val();
			displayPhotos(tabId,$instamaxContainer);
		});
		
		if(instamax_global_options.alwaysUseDropdown) {
			//console.log('options.alwaysUseDropdown-'+options.alwaysUseDropdown);	
			$instamaxContainer.find('#instamax-select-box').css('display','block');
			//$instamaxContainer.find('#instamax-select-box').show();
			$instamaxContainer.find('#instamax-tabs').hide();
		}
		
		//added in 3.0 
		$instamaxContainer.on('keyup','#instamax-search-box', function (e) {
			if (e.keyCode == 13) {
				searchText = "query_" + $(this).val();
				displayPhotos(searchText,$instamaxContainer);
			}
		});

		//added in 4.0
		$instamaxContainer.on('click','#instamax-load-more-comments',function(){
			loadMoreComments($instamaxContainer);
		});
		
		if(instamax_global_options.skin=="clean") {
			$instamaxContainer.on('mouseenter','#tiles li',function(){
				$(this).find(".instamax-duration").show();
				$(this).find(".instamax-definition").show();
			});

			$instamaxContainer.on('mouseleave','#tiles li',function(){
				$(this).find(".instamax-duration").hide();
				$(this).find(".instamax-definition").hide();
			});
		}

		
	},
	
	//load more button functionality
	loadMorePhotos = function($instamaxContainer) {
		var $instamaxLoadMoreDiv = $instamaxContainer.find('#instamax-load-more-div');
		$instamaxLoadMoreDiv.text('LOADING...');
		$instamaxLoadMoreDiv.addClass('instamax-load-more-div-click');
		var tabId = $instamaxContainer.find('.instamax-tab.instamax-tab-hover').attr('id');
		var nextPageUrl = $instamaxLoadMoreDiv.data('nextpageurl');
		//console.log('load more clicked : nextStartIndex-'+nextStartIndex);		
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		if(null!=nextPageUrl && nextPageUrl!="") {
			if(tabId.indexOf("photos")!=-1) {
				getUserPhotos($instamaxContainer,nextPageUrl);
			} else if(tabId.indexOf("hashtag_")!=-1) {
				if(instamax_global_options.tagScope=="user") {
					getUserPhotosBasedOnTags(tabId,$instamaxContainer,nextPageUrl);
				} else {
					getTagPhotos(tabId,$instamaxContainer,nextPageUrl);
				}
			} else if(tabId.indexOf("query_")!=-1) {
				if(instamax_global_options.searchScope=="user") {
					getUserPhotosBasedOnTags(tabId,$instamaxContainer,nextPageUrl);
				} else {
					getTagPhotos(tabId,$instamaxContainer,nextPageUrl);
				}
			}
		} else {
			$instamaxLoadMoreDiv.text('ALL DONE');
		}
	},
	
	//gets user Id using Instagram API
	getUserId = function ($instamaxContainer) {
		//console.log('inside getUserDetails');
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		//console.log(instamax_global_options);
		apiUrl = "https://api.instagram.com/v1/users/search?q="+instamax_global_options.userName+"&client_id="+instamax_global_options.clientId+"&count=1";
		//console.log('getUserId apiUrl-'+apiUrl);
		//showLoader();
		
		$.ajax({
			url: apiUrl,
			type: "GET",
			async: true,
			cache: true,
			dataType: 'jsonp',
			success: function(response) { saveUserId(response,$instamaxContainer);},
			error: function(html) { alert(html); },
			beforeSend: setHeader
		});
	},

	saveUserId = function (response,$instamaxContainer) {
		//console.log(response);
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		instamax_global_options.userName = response.data[0].username;
		instamax_global_options.userId = response.data[0].id;
		getUserDetailsForHeader($instamaxContainer);
	},

	//gets user details using Instagram API
	getUserDetailsForHeader = function ($instamaxContainer) {
		//console.log('inside getUserDetails');
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		//console.log(instamax_global_options);
		apiUrl = "https://api.instagram.com/v1/users/"+instamax_global_options.userId+"?client_id="+instamax_global_options.clientId+"&count=1";
		//console.log('apiUrl-'+apiUrl);
		//showLoader();
		
		$.ajax({
			url: apiUrl,
			type: "GET",
			async: true,
			cache: true,
			dataType: 'jsonp',
			success: function(response) { displayUserHeader(response,$instamaxContainer);},
			error: function(html) { alert(html); },
			beforeSend: setHeader
		});
	},
	
	setHeader = function (xhr) {
		if(xhr && xhr.overrideMimeType) {
			xhr.overrideMimeType("application/j-son;charset=UTF-8");
		}
	},
	
	//utility function to displaye view counts
	convertViewCount = function(photoViewCount) {
		photoViewCount = parseInt(photoViewCount,10);
		if(photoViewCount<1000) {
			
		} else if (photoViewCount<1000000) {
			photoViewCount = Math.round(photoViewCount/1000) + "K";
			
		} else if (photoViewCount<1000000000) {
			photoViewCount = (photoViewCount/1000000).toFixed(1) + "M";
		} else {
			photoViewCount = (photoViewCount/1000000000).toFixed(1) + "B";
		}
		
		return photoViewCount;
		
	},
	
	//display user header
	displayUserHeader = function(response,$instamaxContainer) {
		//console.log("displayUserHeader");
		//console.log(response);
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		var userData = response;
		
		//alert(photoArray.length);
		userId = instamax_global_options.userId;
		userTitle = instamax_global_options.userName;
		userImage = userData.data.profile_picture;
		
		//added in 4.0
		userBio = userData.data.bio;
		userWebsite = userData.data.website;
		userFullname = userData.data.full_name;
		userFollowing = convertViewCount(userData.data.counts.follows);
		/*if(userImage.indexOf("?")!=-1) {
			userImage = userImage.substring(0,userImage.indexOf("?"));
		}*/
		
		userFollowers = convertViewCount(userData.data.counts.followed_by);
		userPosts = convertViewCount(userData.data.counts.media);
		//not present via the API
		//userViews = userData.statistics.viewCount;
		
		userBackgroundImage = instamax_global_options.coverImage;
		//console.log('userBackgroundImage-',userBackgroundImage);
		
		
		$instamaxContainer.find('#instamax-header').css('background-image',"url("+userBackgroundImage+")");
		
		$instamaxContainer.find('#instamax-header-wrapper').append('<a href="https://instagram.com/'+userTitle+'" target="_blank"><div class="instamax-user-icon"><img src="'+userImage+'"/></div><div class="instamax-user-title">'+userTitle+'</div></a><div class="instamax-subscribe"><a href="https://instagram.com/'+userTitle+'" target="_blank"><i class="fa fa-instagram fa-lg"></i>&nbsp;&nbsp;FOLLOW&nbsp;&nbsp;<span class="instamax-subscriber-count">'+userFollowers+'</span></a></div><div id="instamax-stat-holder"></div>');
		
		$instamaxContainer.find('#instamax-header-wrapper').append('<div id="instamax-header-info"><div id="instamax-header-title">'+userTitle+'</div><div class="instamax-subscribe-clean-wrapper"><div class="instamax-subscribe-clean"><a href="https://instagram.com/'+userTitle+'" target="_blank"><i class="fa fa-instagram fa-lg"></i>&nbsp;&nbsp;FOLLOW</a></div></div><div id="instamax-header-bio">'+userBio+'</div><div id="instamax-header-website"><a href="'+userWebsite+'" target="_blank">'+userWebsite+'</a></div><div id="instamax-header-counts"><span class="instamax-header-posts"><span class="instamax-count">'+userPosts+'</span> posts</span><span class="instamax-header-followers"><span class="instamax-count">'+userFollowers+'</span> followers</span><span class="instamax-header-following"><span class="instamax-count">'+userFollowing+'</span> following</span></div></div>');
		
		$instmaxStatHolder = $instamaxContainer.find('#instamax-stat-holder');
		if(instamax_global_options.showSearchBox) {
			$instmaxStatHolder.append('<div id="instamax-search-holder"><input id="instamax-search-box" type="text" placeholder=""/><i class="fa fa-search instamax-search-icon"></i></div>');
		} else {
			if(null!=userFollowers && userFollowers>0) {
				$instmaxStatHolder.append('<div class="instamax-stat"><span class="instamax-stat-count">'+convertViewCount(userFollowers)+'</span><br/>FOLLOWERS</div>');
			}
			
			if(null!=userPosts && userPosts>0) {
				$instmaxStatHolder.append('<div class="instamax-stat"><span class="instamax-stat-count">'+convertViewCount(userPosts)+'</span><br/>POSTS</div>');
			}		
		}
		
		//$instamaxContainer.find('#instamax-header-wrapper').append('');
		
		$instamaxContainer.find('#instamax-tabs').prepend('<span id="photos" class="instamax-tab" >Photos</span>');
		
		$instamaxContainer.find('#instamax-select').prepend('<option value="photos" class="instamax-option-highlight" >Photos</option>');

		//selected Tab
		if(instamax_global_options.selectedTab.charAt(0)=='p') {
			$instamaxContainer.find('#photos').click();
		}
		
		
		//renderSubscribeButton();
	},
	
	//insert HTML for photo thumbnails into instamax grid
	insertUserPhotos = function(response,loadMoreFlag,$instamaxContainer,hashTag) {
		//console.log('into insertUserPhotos');
		//console.log(response);
		var photoIdArray = [];
		var $instamaxContainerList = $instamaxContainer.find('ul');
		//console.log('insertAlbumPhotos loadMoreFlag-'+loadMoreFlag);
		
		if(!loadMoreFlag) {
			//$instamaxContainerList.empty();
			if($instamaxContainer.find('.instamax-tab-hover').length==0) {
				query = $instamaxContainer.find('#instamax-search-box').val();
				$instamaxContainer.find('#instamax-showing-title').append('<div id="query_'+query+'" class="instamax-tab instamax-tab-hover">Showing Search for "'+query+'"</div>').show();
			}
		}
		
		/*if(!loadMoreFlag) {
			$instamaxContainerList.empty();
		}*/
		
		var photoArray = response.data;
		
		var $instamaxLoadMoreDiv = $instamaxContainer.find('#instamax-load-more-div');
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');	
		var nextPageUrl = response.pagination;
		
		if(null!=nextPageUrl && null!=nextPageUrl.next_url) {
			nextPageUrl = nextPageUrl.next_url;
			$instamaxLoadMoreDiv.data('nextpageurl',nextPageUrl);
		} else {
			$instamaxLoadMoreDiv.data('nextpageurl','');
		}
		//console.log('nextStartIndex-'+nextStartIndex);

		if(null!=hashTag && hashTag!="") {
		
			if(instamaxReloadCount>=instamax_global_options.maxAutoReloads) {
				instamaxReloadCount = 1;
			} else {
				$instamaxLoadMoreDiv.click();
				instamaxReloadCount++;
			}
			
		}
	
		if(null==photoArray || photoArray.length==0) {
			$instamaxContainerList.empty().append('<div class="instamax-not-found"><span style="opacity:0;">.</span><br><br><br><br><br><br>No Photos Found..<br><br><br><br><br><br><span style="opacity:0;">.</span></div>');
			return;
		}
		
		//Display first image as Cover Image if not explicitly specified
		if(null==instamax_global_options.coverImage || instamax_global_options.coverImage=="") {
			$instamaxContainer.find('#instamax-header').css('background-image','url('+photoArray[0].images.standard_resolution.url+')');
		}
		
		
		//alert(photoArray.length);
		for(var i=0; i<photoArray.length; i++) {
			photoId = photoArray[i].id;
			//albumId = photoArray[i].gphoto$albumid.$t;
			if($instamaxContainerList.find('#'+photoId).length>0) {
				continue;
			}
			
			photoTitle = photoArray[i].caption;
			if(null!=photoTitle) {
				photoTitle = photoTitle.text;
			} else {
				photoTitle="";
			}
			
			if(null!=hashTag && hashTag!="" && photoTitle.indexOf(hashTag)==-1) {
				continue;
			}
			
			//console.log('Photo title-'+photoTitle);
			photoThumbnail = photoArray[i].images.thumbnail.url;
			photoThumbnail = photoArray[i].images.thumbnail.url;
			photoHD = photoArray[i].images.standard_resolution.url;
			photoLD = photoArray[i].images.low_resolution.url;

			photoUploaded = photoArray[i].created_time;			
			photoComments = photoArray[i].comments.count;
			photoLikes = photoArray[i].likes.count;
			
			photoLink = photoArray[i].link;
			type = photoArray[i].type;
			
			videoLink = "";
			videoIcon = "";
			if(type=="video") {
				videoLink = photoArray[i].videos.standard_resolution.url;
				videoIcon = '<div class="instamax-play-icon"><i class="fa fa-play fa-5x"></i></div>';
			}
			//photoIdArray.push(albumId+"_"+photoId);
			
			if(instamax_global_options.displayMode=="link") {
				linkHtmlStart = '<a class="instamax-photo-link" href="'+photoLink+'" target="_blank">';
				linkHtmlEnd = '</a>';
			} else {
				linkHtmlStart = "";
				linkHtmlEnd = "";
			}
			
			//console.log('photoUploaded-'+photoUploaded);
			
			$instamaxContainerList.append('<li id="'+photoId+'" href="'+photoHD+'" class="instamax-gallery-item">'+linkHtmlStart+videoIcon+'<img class="instamax-thumbnail" src="'+photoThumbnail+'" data-photold="'+photoLD+'" data-photolink="'+photoLink+'" data-videolink="'+videoLink+'"><p><span class="instamax-photo-list-title">'+photoTitle+'</span><span class="instamax-photo-list-views">'+getDateDiff(photoUploaded)+'</span></p><div class="instamax-duration">'+'<i class="fa fa-comment"></i>&nbsp;'+convertViewCount(photoComments)+'</div><div class="instamax-definition">'+'<i class="fa fa-heart"></i>&nbsp;'+convertViewCount(photoLikes)+'</div>'+linkHtmlEnd+'</li>');
		}
		
		createGrid($instamaxContainer);
		
		//getPhotoStats(photoIdArray,response.feed.gphoto$user.$t,$instamaxContainer);
		
	},
	
	//utility function for date time
	getDateDiff = function (photoUploadDate) {
		dateDiffMS = Math.abs(new Date() - new Date(photoUploadDate * 1000));
		//console.log("dateDiffMS-"+dateDiffMS);
		
		dateDiffHR = dateDiffMS/1000/60/60;
		if(dateDiffHR>24) {
			dateDiffDY = dateDiffHR/24;
			if(dateDiffDY>30) {
				dateDiffMH = dateDiffDY/12;
				if(dateDiffMH>12) {
					dateDiffYR = dateDiffMH/12;
					dateDiffYR = Math.round(dateDiffYR);
					if(dateDiffYR<=1) {
						return dateDiffYR+" year ago";
					} else {
						return dateDiffYR+" years ago";
					}						
				} else {
					dateDiffMH = Math.round(dateDiffMH);
					if(dateDiffMH<=1) {
						return dateDiffMH+" month ago";
					} else {
						return dateDiffMH+" months ago";
					}						
				}
			} else {
				dateDiffDY = Math.round(dateDiffDY);
				if(dateDiffDY<=1) {
					return dateDiffDY+" day ago";
				} else {
					return dateDiffDY+" days ago";
				}
			}
		} else {
			dateDiffHR = Math.round(dateDiffHR);
			if(dateDiffHR<1) {
				return "just now";
			} else if(dateDiffHR==1) {
				return dateDiffHR+" hour ago";
			} else {
				return dateDiffHR+" hours ago";
			}
		}
	},
	
	//create grid layout using Wookmark plugin
	createGrid = function($instamaxContainer) {
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');	
		var $instamaxContainerList = $instamaxContainer.find('ul');
		$instamaxContainerList.imagesLoaded(function() {

			$instamaxContainerList.find('.instamax-loading-div').remove();			
		
			var options = {
			  autoResize: true, // This will auto-update the layout when the browser window is resized.
			  container: $instamaxContainer.find('#instamax-photo-list-div'), // Optional, used for some extra CSS styling
			  offset: instamax_global_options.innerOffset, // Optional, the distance between grid items
			  itemWidth: instamax_global_options.minItemWidth, // Optional, the width of a grid item
			  flexibleWidth : instamax_global_options.maxItemWidth,
			  outerOffset: instamax_global_options.outerOffset
			};

			
			var handler = $instamaxContainerList.find('li');
			
			// Call the layout function.
			handler.wookmark(options);
			
			if(instamax_global_options.displayMode=="popup") {
				registerPopup($instamaxContainer);
			}
			
			resetLoadMoreButton($instamaxContainer);
			
			window.clearTimeout(instamaxRefreshTimer);
			instamaxRefreshTimer = setTimeout(function(){updateThumbnails($instamaxContainer);}, instamax_global_options.refreshTimeout);

			//updateThumbnails($instamaxContainer);
		});
	},
	
	updateThumbnails = function($instamaxContainer) {
		//var $instamaxContainerImg = $instamaxContainer.find('ul>li>img');
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');	
		var albumThumbnail,updatedAlbumThumbnail;
		//console.log("in updateThumbnails");

		var items = document.getElementsByClassName("instamax-thumbnail");
		for (var i = items.length; i--;) {
			albumThumbnail = items[i].src;
			updatedAlbumThumbnail=albumThumbnail.replace("s150x150","s306x306");
			items[i].src = updatedAlbumThumbnail;
		}
		instamaxRefreshGrid($instamaxContainer);
		
		/*
		window.clearTimeout(instamaxRefreshTimer);
		instamaxRefreshTimer = setTimeout(function(){instamaxRefreshGrid($instamaxContainer)}, instamax_global_options.refreshTimeout);
		*/
	},
	
	instamaxRefreshGrid = function($instamaxContainer) {
		//console.log("in instamaxRefreshGrid");
		var $instamaxContainerList = $instamaxContainer.find('ul');
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');	
		
		$instamaxContainerList.imagesLoaded(function() {

			$instamaxContainerList.find('.instamax-loading-div').remove();
		
			var options = {
			  autoResize: true, // This will auto-update the layout when the browser window is resized.
			  container: $instamaxContainer.find('#instamax-photo-list-div'), // Optional, used for some extra CSS styling
			  offset: instamax_global_options.innerOffset, // Optional, the distance between grid items
			  itemWidth: instamax_global_options.minItemWidth, // Optional, the width of a grid item
			  flexibleWidth : instamax_global_options.maxItemWidth,
			  outerOffset: instamax_global_options.outerOffset
			};
			
			var handler = $instamaxContainerList.find('li');			
			$instamaxContainerList.find('li').wookmark(options);
			//console.log('triggered refresh');
		});	
	
	},	
	
	//display tabs for hashtags
	displayTabs = function(hashTagArray,$instamaxContainer) {
		//console.log(response);
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		//var playlistArray = response.items;
		
		//alert(videoArray.length);
		$instamaxTabs = $instamaxContainer.find('#instamax-tabs');
		$instamaxSelect = $instamaxContainer.find('#instamax-select');
		for(var i=0; i<hashTagArray.length; i++) {
			if(hashTagArray[i].length>instamax_global_options.maxTabNameLength) {
				tabTitleShort = hashTagArray[i].substring(0,instamax_global_options.maxTabNameLength) + "..";
			} else {
				tabTitleShort = hashTagArray[i];
			}
			
			$instamaxTabs.append('<span id="hashtag_'+hashTagArray[i]+'" class="instamax-tab" >#'+tabTitleShort+'</span>');
			$instamaxSelect.append('<option value="hashtag_'+hashTagArray[i]+'" >#'+hashTagArray[i]+'</option>');
		}
		
		//click the selectedTab
		if(instamax_global_options.selectedTab.charAt(0)=='h') {
			tabSelect = (instamax_global_options.selectedTab.charAt(1)) - 1;
			if(null!=hashTagArray[tabSelect]) {
				$('#hashtag_'+hashTagArray[tabSelect]).click();
			}
		}
	},
	
	
	resetLoadMoreButton = function($instamaxContainer) {
		var $instamaxLoadMoreDiv = $instamaxContainer.find('#instamax-load-more-div');
		$instamaxLoadMoreDiv.removeClass('instamax-load-more-div-click');
		$instamaxLoadMoreDiv.text('LOAD MORE');
	},
	
	//register photo popup on photo thumbnails
	registerPopup = function($instamaxContainer) {
	
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');

		
			$instamaxContainer.find('#instamax-photo-list-div li').magnificPopup({
				type:'image',
				gallery: {
					enabled:true
				},
				preloader:false,
				showCloseBtn: true, 
				closeBtnInside: false, 
				closeOnContentClick: false, 
				closeOnBgClick: true, 
				enableEscapeKey: true, 
				modal: false, 
				alignTop: false, 
				removalDelay: 100, 
				mainClass: ' ',
				prependTo: $instamaxContainer.get(),
				callbacks: {
					change: function() {
						
						//console.log(this);
						var $baseElement = $(this.currItem.el.context);
						mediaId = $baseElement.attr("id");
						mediaLikes = $baseElement.find(".instamax-definition").text().trim();
						mediaComments = $baseElement.find(".instamax-duration").text().trim();
						mediaUploaded = $baseElement.find(".instamax-photo-list-views").text().trim();
						mediaLink = $baseElement.find(".instamax-thumbnail").data("photolink");
						videoLink = $baseElement.find(".instamax-thumbnail").data("videolink");
						
						userLink = "https://instagram.com/" + instamax_global_options.userName;
						//console.log("mediaLikes-"+mediaLikes);
						photoTitle = $baseElement.find(".instamax-photo-list-title").text();
						
						//console.log($(".mfp-bottom-bar"));
						setTimeout(function(){
							if(null!=videoLink && videoLink!="") {
								//console.log("videoLink-"+videoLink);
								$(".mfp-content figure>img").hide();
								maximumHeight = $(".mfp-content figure>img").css("max-height").replace("px","");
								maximumHeight = parseInt(maximumHeight,10);
								$(".mfp-content figure").prepend('<video controls style="max-height:'+maximumHeight+'px"><source src="'+videoLink+'" type="video/mp4">Your browser does not support the video tag.</video>');
							} else {
								$(".mfp-content figure>video").remove();
							}
							$(".mfp-bottom-bar").empty().append('<div id="photo-detail-holder"><div class="photo-popup-title">'+photoTitle+'</div><div class="photo-popup-stats"><span class="media-likes">'+mediaLikes+' likes </span><span class="media-comments">'+mediaComments+' comments</span>'+'<span class="media-uploaded">'+mediaUploaded+'</span></div> <div class="photo-popup-buttons"><a href="'+mediaLink+'" target="_blank"><div class="photo-like-comment-button">Like & Comment</div></a><a href="'+userLink+'" target="_blank"><div class="photo-follow-button">Follow</div></a></div> <div id="instamax-encloser-comments"></div> <div class="instamax-load-more-wrapper"><div id="instamax-load-more-comments">Load More</div></div> </div>');
							getPhotoComments ($instamaxContainer,mediaId,null);
							$instamaxContainer.find("#instamax-load-more-comments").data("mediaid",mediaId);
						}, 100);

						
					}
				}
	  
	  
			});
	
	},
	
	
	//display loading.. text
	showLoader = function($instamaxContainer) {
		$instamaxContainer.find('#instamax-photo-list-div>ul').empty();
		//$instamaxContainer.find('#instamax-photo').hide();
		//$instamaxContainer.find('#instamax-photo').attr('src','');
		$instamaxContainer.find('#instamax-photo-list-div>ul').append('<div class="instamax-loading-div" style="text-align:center; height:200px; font:14px Calibri;"><br><br><br><br><br><br>loading HD...<br><br><br><br><br><br></div>');
		$instamaxContainer.find('#instamax-showing-title').empty().hide();
	},
	
	displayPhotos = function(tabId,$instamaxContainer) {
	
		showLoader($instamaxContainer);
		var instamax_global_options = $instamaxContainer.data('instamax_global_options');
		
		if(tabId.indexOf("photos")!=-1) {
			getUserPhotos($instamaxContainer,null);
		} else if(tabId.indexOf("hashtag_")!=-1) {
			if(instamax_global_options.tagScope=="user") {
				getUserPhotosBasedOnTags(tabId,$instamaxContainer,null);
			} else {
				getTagPhotos(tabId,$instamaxContainer,null);
			}
		} else if(tabId.indexOf("query_")!=-1) {
			if(instamax_global_options.searchScope=="user") {
				getUserPhotosBasedOnTags(tabId,$instamaxContainer,null);
			} else {
				getTagPhotos(tabId,$instamaxContainer,null);
			}
		}
		
		$instamaxContainer.find('.instamax-tab').removeClass('instamax-tab-hover');	
		$('#'+tabId).addClass('instamax-tab-hover');
		$instamaxContainer.find('#instamax-select').val(tabId);

	};	

	//instamax plugin definition
    $.fn.instamax = function(options) {
		
		var instamax_global_options = {};
		var $instamaxContainer = this;
		//console.log($instamaxContainer.attr('id'));
		
		//add fontawesome icons
		if (document.createStyleSheet){
			document.createStyleSheet("http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css");
		} else {
			$("head").append("<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' type='text/css' />");
		}
		
		//Get CSS for Skins
		//console.log(options.skin);
		if(options.widgetMode) {
			$("head").append("<style>#instamax-header-info,.instamax-duration,#instamax-select-box {display:none !important;}.instamax-definition {width: 100% !important;text-align: center !important;}#instamax-header-wrapper>a {width: 100% !important;  margin: 0px !important;}.instamax-user-icon img {margin: 0px !important;}button#instamax-load-more-div {width: 100px;height: 100px;word-break: break-word;font-size: 13px;}</style>");
			options.skin="clean";
		}

		if(options.skin=="white" || options.skin=="grey" || options.skin=="clean") {
			if (document.createStyleSheet){
                document.createStyleSheet("./css/instamax_"+options.skin+".min.css");
            } else {
                $("head").append("<link rel='stylesheet' href='./css/instamax_"+options.skin+".min.css' type='text/css' />");
            }
		} else {
			//don't load any styles
			//user will load them manually
		}
		
		//set local options
		instamax_global_options.clientId = options.clientId;
		instamax_global_options.maxResults = options.maxResults||9;
		instamax_global_options.innerOffset = options.innerOffset||40;
		instamax_global_options.outerOffset = options.outerOffset||40;
		instamax_global_options.minItemWidth = options.minItemWidth||250;
		instamax_global_options.maxItemWidth = options.maxItemWidth||400;

		instamax_global_options.refreshTimeout = options.refreshTimeout||1000;
		instamax_global_options.coverImage = options.coverImage||"";
		
		//3.0 options
		instamax_global_options.selectedTab = options.selectedTab||"p"; //can be p|h1|h2|...
		instamax_global_options.alwaysUseDropdown = options.alwaysUseDropdown;
		instamax_global_options.maxTabNameLength = 22;
		instamax_global_options.showSearchBox = options.showSearchBox;
		

		//4.0 options
		instamax_global_options.maxComments = options.maxComments||20;
		instamax_global_options.tagScope = options.tagScope||"user"; //can be user or global
		instamax_global_options.searchScope = options.searchScope||"user"; //can be user or global
		instamax_global_options.widgetMode = options.widgetMode; 
		instamax_global_options.maxAutoReloads = options.maxAutoReloads||6;
		instamax_global_options.displayMode = options.displayMode||"popup"; //can be popup or link
		instamax_global_options.skin=options.skin;

		
		options.maxContainerWidth = options.maxContainerWidth||1000;
		$instamaxContainer.css('max-width',(options.maxContainerWidth)+'px');
		
		//adding media queries manually if maxContainerWidth is very low (widget mode)
		if(options.maxContainerWidth<800) {
			$("body").append("<style>#instamax-stat-holder {display:none;}.instamax-subscribe {left:initial;}#instamax-select-box{display:block;}#instamax-tabs {display:none;}</style>");
		}

		if(options.maxContainerWidth<500) {
			$("body").append("<style>#instamax-stat-holder {display:none;}.instamax-subscribe {display:none;}.instamax-tab {width: 42%;text-align: center;}</style>");
		}

		if(options.maxContainerWidth<300) {
			$("body").append("<style>.instamax-tab {width: 90%;text-align: center;}</style>");
		}
		
		
		//console.log(options);
		
		
		var s,albumId,apiUrl;
		var hashTagArray = [];
		
		//Get User header and details 
		if(options.user!=null) {
			s=options.user.lastIndexOf("/");
			//console.log('s-'+s);
			if(s!=-1) {
				instamax_global_options.userName = options.user.substring(s+1);
			} else {
				instamax_global_options.userName="";
				alert("Could Not Find User..");
				return;
			}
		}
		
		//set the options into Instamax
		$instamaxContainer.data('instamax_global_options',instamax_global_options);
		
		//init Instamax
		initInstamax($instamaxContainer);
		getUserId($instamaxContainer);
		
		
		//get hashtag details
		if($.isArray(options.hashtag)) {
			for(var i=0; i<options.hashtag.length; i++) {
				hashTag = options.hashtag[i].replace(/#/g,'');
				//console.log('hashTag-'+hashTag);
				hashTagArray.push(hashTag);
			}
		}
		
		displayTabs(hashTagArray,$instamaxContainer);
		
		//return this for chaining
		return this;
 
    };
	
 
}( jQuery ));
