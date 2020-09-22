$(".colorUnico").spectrum({
    allowEmpty:true,
    showInitial: true,
    showInput: true,
     showAlpha: true,
    showPalette: true,
    palette: [
        ['black', 'white', 'brown','yellow','blue','green','pink','red']
        
    ],
    change: function(color){
    
        color.toHexString();
}
    
});