'using strict'

function addBucketlistItem() {
    $.ajax({
        method: 'get',
        url: 'action.php?action=addNewBucketlistItem',
        success: function(returnedValue) {
            alert(returnedValue);
            var existingHTML = $("#newItems").html();
            var appendedHTML = existingHTML + getCardHTML(returnedValue);
            $("#newItems").html(appendedHTML);
        }

    });




}

function getCardHTML(cardId) {
    var cardHTML = "<div class='card-holder'>";
    cardHTML += "<div class='card' id='" + cardId + "'>";
    cardHTML += "<div class='card-body'>";
    cardHTML += "<a class='no-underline-link' href='todos.php?bucketlistItemId=2'><h4 class='card-title bucket-list-item'>Untitled</h4></a>";
    cardHTML += "<b>Priority: </b>";
    cardHTML += "<label class='priorityLabel' for='abcPriority" + cardId + "'>A-C: </label>";
    cardHTML += "<select onchange='moveCard(2)' id='abcPriority" + cardId + "' class='priority prioritySelect'>";
    cardHTML += "<option class='priority' id='abcOption0-" + cardId + "' value='0'></option>";
    cardHTML += "<option class='priority' id='abcOptionA-2' value='A' selected='selected'>A</option>";
    cardHTML += "<option class='priority' id='abcOptionB-" + cardId + "' value='B'>B</option>";
    cardHTML += "<option class='priority' id='abcOptionC-" + cardId + "' value='C'>C</option>";
    cardHTML += "</select>&nbsp;&nbsp;";
    cardHTML += "<label class='priorityLabel' for='numberPriority" + cardId + "'>1-10: </label>";
    cardHTML += "<select onchange='moveCard(2)' id='numberPriority" + cardId + "' class='priority prioritySelect'>";
    
    cardHTML += "<option class='priority' id='numberOption0-" + cardId + "' selected='selected'></option>";
    for (var i = 1; i <= 10; i++) {

        cardHTML += "<option class='priority' id='numberOption" + i + "-" + cardId + "'>" + i +"</option>";

    }
    cardHTML +=  "</select></div></div></div>";

    return cardHTML;
}


function setCardToShowTheseOptions(cardId, letter, number) {
        //Clear all selected values
        $(`#numberPriority${cardId} > option`).attr("selected", "false");
        $(`#abcPriority${cardId} > option`).attr("selected", "false");

        //Update the abc and number priorities
        $(`#abcOption${letter}-${cardId}`).attr("selected", "selected");
        $(`#numberOption${number}-${cardId}`).attr("selected", "selected");

        //Make sure the correct values are showing.
        $(`#abcPriority${cardId}`).val(letter);
        $(`#numberPriority${cardId}`).val(number);


}


function moveCard(cardId) {

    //Make the ajax request to update the database. Once it has been updated, then change the ui.

    var abcPriority = $(`#abcPriority${cardId}`).val();
    var numberPriority = $(`#numberPriority${cardId}`).val();
    var coordinate = abcPriority + '-' + numberPriority;
    var cardContent =  $(`#${cardId}`).parent().html();

    $.ajax({
        method: 'get',        
        url: `action.php?action=updateBucketlistGrid&cardId=${cardId}&abcPriority=${abcPriority}&numberPriority=${numberPriority}`,
        success: function (returnedValues) {
        
        //All the code below is good for a UI shuffling of the cards, but since the bucketlist.php file will be returned to anyway, this code
        //is unnecessary for now.  It is amazing code though that may be useful at a later time.
        
        //Remove the card from it's current location
        $(`#${cardId}`).parent().empty();

        //Logic to bump an existing card to the newItems div if a card is heading for a spot that already has a card
        if ($(`#${coordinate}`).html() !=  "") {

            var cardIdOfCardToBump = $(`#${coordinate} :first`).attr("id");
            $.ajax({
                method: 'get',        
                url: `action.php?action=updateBucketlistGrid&cardId=${cardIdOfCardToBump}&abcPriority=0&numberPriority=0`,
                success: function (returnedValues) {
                    //Need to put a holder class around the existing card because we will be placing it in the newItems holder div
                    var cardToBump = "<div class='card-holder'>" + $(`#${coordinate}`).html() + "</div>";
                    var allNewItems = $(`#newItems`).html();
                    allNewItems += cardToBump;
                    $(`#newItems`).html(allNewItems);
                    setCardToShowTheseOptions(cardIdOfCardToBump, '0', 0)
                }
            
        });
        
        }

        
        //Insert the card content to the new location
        $(`#${coordinate}`).html(cardContent);
       
        //Make the card display right
        setCardToShowTheseOptions(cardId, abcPriority, numberPriority);
    
    }    
    
    
});
    
}