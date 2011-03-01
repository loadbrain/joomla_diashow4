window.addEvent('domready', function(){
    document.formvalidator.setHandler('title', function(value){
        regex = /^[\w\d\W]+$/;
        return regex.test(value);
    });

    document.formvalidator.setHandler('image', function(value){
    	regex = /[\d\w].+\s*/;
        return regex.test(value);
    });

    document.formvalidator.setHandler('menu_id', function(value){
    	regex = //;
        return regex.test(value);
    });



});
