window.addEvent('domready', function(){
    document.formvalidator.setHandler('autor', function(value){
        regex = /^[\w\d\W]+$/;
        return regex.test(value);
    });

    document.formvalidator.setHandler('picture', function(value){
        regex = /^[\w\d\W]+$/;
        return regex.test(value);
    });

});
