'using strict'

function checkTodo(todoId) {

    $.ajax({
        method: 'get',
        url: `action.php?action=addCompletedDateToTodo?todoId=${todoId}`,
        success: function(returnedValue) {
            $(`#checkbox-${todoId}`).removeClass('fa-square');
            $(`#checkbox-${todoId}`).addClass('fa-check-square');                    
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