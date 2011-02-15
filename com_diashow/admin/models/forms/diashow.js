window.addEvent('domready', function(){
    document.formvalidator.setHandler('title', function(value){
        regex = /^[\w\d\W]+$/;
        return regex.test(value);
    });

    document.formvalidator.setHandler('image', function(value){
        regex = /^[\w\d\W]+$/;
        return regex.test(value);
    });
});
