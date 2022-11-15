var ComponentsTypeahead = function () {

    var handleTwitterTypeahead = function() {

       
    	
        // Example #3
        var custom = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens;  },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: site_url+'photos/typeahead_custom/'+$('#typeahead_example_modal_3').typeahead('val')
        });
         
        custom.initialize();
         
        if (App.isRTL()) {
          $('#typeahead_example_3').attr("dir", "rtl");  
        }  
        $('#typeahead_example_3').typeahead(null, {
          name: 'datypeahead_example_3',
          displayKey: 'value',
          source: custom.ttAdapter(),
          hint: (App.isRTL() ? false : true),
          templates: {
            suggestion: Handlebars.compile([
              '<div class="media">',
                    '<div class="pull-left">',
                        '<div class="media-object">',
                            '<img src="{{img}}" width="50" height="50"/>',
                        '</div>',
                    '</div>',
                    '<div class="media-body">',
                        '<h4 class="media-heading">{{value}}</h4>',
                    '</div>',
              '</div>',
            ].join(''))
          }
        });

       

    }

    var handleTwitterTypeaheadModal = function() {

        
        var custom = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens; 
          },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: site_url+'photos/typeahead_custom/'+$('#typeahead_example_modal_3').typeahead('val')
        });
         
        custom.initialize();
         
        if (App.isRTL()) {
          $('#typeahead_example_modal_3').attr("dir", "rtl");  
        }
        $('#typeahead_example_modal_3').typeahead(null, {
          name: 'datypeahead_example_modal_3',
          displayKey: 'value',
          hint: (App.isRTL() ? false : true),
          source: custom.ttAdapter(),
          templates: {
            suggestion: Handlebars.compile([
              '<div class="media">',
                    '<div class="pull-left">',
                        '<div class="media-object">',
                            '<img src="{{img}}" width="50" height="50"/>',
                        '</div>',
                    '</div>',
                    '<div class="media-body">',
                        '<h4 class="media-heading">{{value}}</h4>',
                        '<p>{{desc}}</p>',
                    '</div>',
              '</div>',
            ].join(''))
          }
        });

       

    }

    return {
        //main function to initiate the module
        init: function () {
            handleTwitterTypeahead();
            handleTwitterTypeaheadModal();
        }
    };

}();

jQuery(document).ready(function() {    
   ComponentsTypeahead.init(); 
});