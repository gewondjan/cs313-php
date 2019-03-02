'using strict'

function checkTodo(todoId) {

    $.ajax({
        method: 'get',
        url: `action.php?action=addCompletedDateToTodo?todoId=${todoId}`,
        success: function(returnedValue) {
            $(`#checkbox-${todoId}`).removeClass('fa-square');
            $(`#checkbox-${todoId}`).addClass('fa-check-square');        
            
            $(`#checkbox-${todoId}`).attr("onclick", `uncheckTodo(${todoId})`);

        }

    });


}

function uncheckTodo(todoId) {


    $.ajax({
        method: 'get',
        url: `action.php?action=removeCompletedDateFromTodo?todoId=${todoId}`,
        success: function(returnedValue) {
            $(`#checkbox-${todoId}`).removeClass('fa-check-square');
            $(`#checkbox-${todoId}`).addClass('fa-square');                    

            $(`#checkbox-${todoId}`).attr("onclick", `checkTodo(${todoId})`);


        }

    });

}


function deleteTodo(todoId) {
    $.ajax({
        method: 'get',
        url: `action.php?action=deleteTodo?todoId=${todoId}`,
        success: function(returnedValue) {
            $(`#todo-${todoId}`).remove();                    
        }
    });
}