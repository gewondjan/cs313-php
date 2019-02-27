'using strict'

function moveCard(cardId) {

    //Make the ajax request to update the database. Once it has been updated, then change the ui.

    var abcPriority = $(`#abcPriority${cardId}`).val();
    var numberPriority = $(`#numberPriority${cardId}`).val();
    var coordinate = abcPriority + "-" + numberPriority;
    var cardContent =  $(`#${cardId}`).parent().html();

    $.ajax({
        method: 'get',        
        url: `action.php?action=updateBucketlistGrid&cardId=${cardId}&abcPriority=${abcPriority}&numberPriority=${numberPriority}`,
        success: function (returnedValues) {
        
        //All the code below is good for a UI shuffling of the cards, but since the bucketlist.php file will be returned to anyway, this code
        //is unnecessary for now.  It is amazing code though that may be useful at a later time.
        
        //Remove the card from it's current location
        $(`#${cardId}`).parent().empty();


        //Can add a conditional here where I will handle the case of adding a card in the same place as an existing card.

        //Insert the card content to the new location
        $(`#${coordinate}`).html(cardContent);

        //Clear all selected values
        $(`#numberPriority${cardId} > option`).attr("selected", "false");
        $(`#abcPriority${cardId} > option`).attr("selected", "false");

        //Update the abc and number priorities
        $(`#abcOption${abcPriority}-${cardId}`).attr("selected", "selected");
        $(`#numberOption${numberPriority}-${cardId}`).attr("selected", "selected");

        //Make sure the correct values are showing.
        $(`#abcPriority${cardId}`).val(abcPriority);
        $(`#numberPriority${cardId}`).val(numberPriority);

        // alert($(`#${coordinate}`).html());
    
    }    
    
    
});
    
    

    
}