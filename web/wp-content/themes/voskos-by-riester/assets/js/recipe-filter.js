var recipe_filter = {
	items : null,
	filterOptionsContainer : null,
	resultsContainer : null,
	resultCountContainer : null,	
	activeFiltersContainer : null,
	resetFilterDOM : null,
	init : function(items, filterOptionsContainer, resultsContainer, resultCountContainer, activeFiltersContainer, resetFilterDOM){
		var self = this;
		
		this.items = items;
		this.filterOptionsContainer = filterOptionsContainer;
		this.resultsContainer = resultsContainer;
		this.resultCountContainer = resultCountContainer;
		this.activeFiltersContainer = activeFiltersContainer;
		this.resetFilterDOM = resetFilterDOM;

		$(this.resetFilterDOM).click(function(event){
			self.resetFilter();
		});
		
		this.initFilterOptions();
		this.filter();
	},
	initFilterOptions : function(){
		var self = this;
		$('.filter-option', this.filterOptionsContainer).change(function(){
			self.filter();
		});
	},
	filter : function(){
		var activeFilters = {};
		$('.filter-option:checked', this.filterOptionsContainer).each(function(index,value){
			var taxonomy = $(value).attr('data-taxonomy');
			var option = $(value).attr('data-option');
			
			if(typeof activeFilters[taxonomy] === 'undefined'){
				activeFilters[taxonomy] = [];
			}
								
			activeFilters[taxonomy].push(option);
		});

		this.activeFilters = activeFilters;
		
		var filteredItems = this.filterItems(activeFilters);
		this.updateDisplay(filteredItems);
	},
	filterItems : function(activeFilters){
		var self = this;
		var results = this.items.slice(0);
		
		$.each(activeFilters, function(taxonomy,options){
			$.each(results, function(index,item){
				if(item != null && !self.itemMeetsFilterCriteria(item, taxonomy, options)){							
					results[index] = null;
				}
			});
		});

		var newResult = [];
		$.each(results, function(index,value){
			if(value != null){
				newResult.push(value);
			}
		});
		results = newResult;
		
		return results;
	},
	resetFilter : function(){
		$('.filter-option:checked', this.filterOptionsContainer).each(function(index,checkboxDOM){
			$(checkboxDOM).attr('checked', false);
		});

		this.filter();
	},
	itemMeetsFilterCriteria: function(item, taxonomy, options){
		var rval = true;
		var itemTaxonomyOptions = item['taxonomies'][taxonomy];
		
		if(typeof itemTaxonomyOptions !== 'undefined'){
			$.each(options, function(index,option){
				// Added function for IE8 to handle 'indexOf'
				if(itemTaxonomyOptions.indexOf(option) == -1){
					rval = false;
				}
			});					
		} else {
			rval = false;
		}

		return rval;
	},
	updateDisplay : function(activeItems){
		this.hideAllItems();
		this.showItems(activeItems);
		this.updateResultCounter(activeItems.length, this.items.length);
		this.updateSelectedFilters();			
		this.updateFilterOptions(activeItems);	
	},
	updateFilterOptions : function(activeItems){
		$('.filter-option').attr('disabled','disabled');
		$('.filter-option').parent().addClass('inactive');
		
		$.each(activeItems, function(index,item){
			$.each(item['taxonomies'], function(taxonomy, options){
				$.each(options, function(optionIndex, optionSlug){
					$('.filter-option[data-option="'+ optionSlug +'"]').attr('disabled', false);
					$('.filter-option[data-option="'+ optionSlug +'"]').parent().removeClass('inactive');
				});
			});
		});				
	},
	updateSelectedFilters : function(){
		$('.active-filters', this.activeFiltersContainer).empty();

		$('.filter-option:checked', this.filterOptionsContainer).each(function(index,checkboxDOM){
			var taxonomy = $(checkboxDOM).attr('data-taxonomy');
			var option = $(checkboxDOM).attr('data-option');
			var name = $(checkboxDOM).attr('data-name');

			var dom = $('<a>');
			dom.append(name);

			dom.click(function(event){
				$(checkboxDOM).attr('checked', false);			
				$(checkboxDOM).change();			
			});
			
			$('.active-filters').append(dom);

			$('.recipe-filter').addClass('')
		});
	},
	updateResultCounter : function(activeCount, totalCount){
		var string = 'Showing ';

		string += '<span class="active">';
		string += activeCount;
		string += '</span>';
		
		if(activeCount > 1){
			string += ' results ';	
		} else {
			string += ' result ';	
		}

		string += ' of ';
		string += '<span class="total">';
		string += totalCount;
		string += '</span>';

		$(this.resultCountContainer).empty();
		$(this.resultCountContainer).html(string);			
	},
	hideAllItems : function(){
		$('.item', this.resultsContainer).hide();				
	},
	showItems : function(items){
		$.each(items, function(index,value){
			$('.item[data-postid="'+ value.id +'"]', this.resultsContainer).show();
		});	
	}
}

if (!('indexOf' in Array.prototype)) {
    Array.prototype.indexOf= function(find, i /*opt*/) {
        if (i===undefined) i= 0;
        if (i<0) i+= this.length;
        if (i<0) i= 0;
        for (var n= this.length; i<n; i++)
            if (i in this && this[i]===find)
                return i;
        return -1;
    };
}