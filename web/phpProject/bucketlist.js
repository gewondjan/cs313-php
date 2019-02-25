'using strict'

function reorderBucketlistBoard(cardId) {

    //PHP todos
    //set the columns to have a class corresponding with the column (A-col, B-col, C-col)
    //set the cards to have a class corresponding with the column (A-card, B-card, C-card)

    //Use jquery to find the card classes (1 class for the abc (eg. A, B, and C)) and 1 class for the number priority 1
    // alert(cardId);

    alert($(`#${cardId}`).parent().html());

}