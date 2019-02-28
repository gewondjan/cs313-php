'using strict'

// function addBucketlistItem() {

//     alert("adding item..");

//     var existingHTML = $("#newItems").html();

//     existingHTML += 
//     <div class='card-holder'>
//         <div class='card' id='add-card-id-here'>
//         <div class='card-body'>
//             <a class='no-underline-link' href='todos.php?bucketlistItemId=2'><h4 class='card-title bucket-list-item'>Run a Marathon</h4></a>
//             <b>Priority: </b>
//             <label class='priorityLabel' for='abcPriority2'>A-C: </label>
//             <select onchange='moveCard(2)' id='abcPriority2' class='priority prioritySelect'>
//             <option class='priority' id='abcOption0-2' value='0'>
//             </option><option class='priority' id='abcOptionA-2' value='A' selected='selected'>A</option>
//             <option class='priority' id='abcOptionB-2' value='B'>B</option>
//             <option class='priority' id='abcOptionC-2' value='C'>C</option>
//             </select>&nbsp;&nbsp;
//             <label class='priorityLabel' for='numberPriority2'>1-10: </label>
//             <select onchange='moveCard(2)' id='numberPriority2' class='priority prioritySelect'>
//             <option class='priority' id='numberOption0-2'></option>
//             <option class='priority' id='numberOption1-2' selected='selected'>1</option>
//             <option class='priority' id='numberOption2-2'>2</option>
//             <option class='priority' id='numberOption3-2'>3</option>
//             <option class='priority' id='numberOption4-2'>4</option>
//             <option class='priority' id='numberOption5-2'>5</option>
//             <option class='priority' id='numberOption6-2'>6</option>
//             <option class='priority' id='numberOption7-2'>7</option>
//             <option class='priority' id='numberOption8-2'>8</option>
//             <option class='priority' id='numberOption9-2'>9</option>
//             <option class='priority' id='numberOption10-2'>10</option>
//             </select>
//             </div>
//             </div>
//             </div>


// }

// function getCardHTML(cardId) {
//     var cardHTML = "<div class='card-holder'>";
//     cardHTML += "<div class='card' id='" + cardId + "'>";
//     cardHTML += "<div class='card-body'>";
//     cardHTML += "<a class='no-underline-link' href='todos.php?bucketlistItemId=2'><h4 class='card-title bucket-list-item'>Untitled</h4></a>";
//     cardHTML += "<b>Priority: </b>";
//     cardHTML += "<label class='priorityLabel' for='abcPriority2'>A-C: </label>";
//     cardHTML += "<select onchange='moveCard(2)' id='abcPriority2' class='priority prioritySelect'>";
//     cardHTML += "<option class='priority' id='abcOption0-2' value='0'>";

//     //TODO: Need to make sure that the id's are going to work with all the selects and options.
//             </option><option class='priority' id='abcOptionA-2' value='A' selected='selected'>A</option>
//             <option class='priority' id='abcOptionB-2' value='B'>B</option>
//             <option class='priority' id='abcOptionC-2' value='C'>C</option>
//             </select>&nbsp;&nbsp;
//             <label class='priorityLabel' for='numberPriority2'>1-10: </label>
//             <select onchange='moveCard(2)' id='numberPriority2' class='priority prioritySelect'>
//             <option class='priority' id='numberOption0-2'></option>
//             <option class='priority' id='numberOption1-2' selected='selected'>1</option>
//             <option class='priority' id='numberOption2-2'>2</option>
//             <option class='priority' id='numberOption3-2'>3</option>
//             <option class='priority' id='numberOption4-2'>4</option>
//             <option class='priority' id='numberOption5-2'>5</option>
//             <option class='priority' id='numberOption6-2'>6</option>
//             <option class='priority' id='numberOption7-2'>7</option>
//             <option class='priority' id='numberOption8-2'>8</option>
//             <option class='priority' id='numberOption9-2'>9</option>
//             <option class='priority' id='numberOption10-2'>10</option>
//             </select>
//             </div>
//             </div>
//             </div>



// }



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