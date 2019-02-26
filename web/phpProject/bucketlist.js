'using strict'

function moveCard(cardId) {

    //Make the ajax request to update the database. Once it has been updated, then change the ui.

    var abcPriority = $(`#abcPriority${cardId}`).val();
    var numberPriority = $(`#numberPriority${cardId}`).val();
    var coordinate = abcPriority + "-" + numberPriority;
    var cardContent =  $(`#${cardId}`).parent().html();

    //Insert the card content to the new location
    $(`#${coordinate}`).html(cardContent);
    
    //Update the abc and number priorities
    $(`#abcPriority${cardId}`).val(abcPriority);
    $(`#numberPriority${cardId}`).val(numberPriority);

    //Remove the card from it's current location
    $(`#${cardId}`).parent().empty();

    



}