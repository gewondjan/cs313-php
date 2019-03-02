'using strict'

function checkTodo(todoId) {

    $.ajax({
        method: 'get',
        url: `action.php?action=addCompletedDateToTodo&todoId=${todoId}`,
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
        url: `action.php?action=removeCompletedDateFromTodo&todoId=${todoId}`,
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
        url: `action.php?action=deleteTodo&todoId=${todoId}`,
        success: function(returnedValue) {
            $(`#todo-${todoId}`).remove();                    
        }
    });
}

function editTodo(todoId) {
    var todoValue = $(`#todo-title-${todoId}`).html();
    var editorHTML = `<input type='text' id='todo-editor-${todoId}' value='${todoValue}'>
    <button onclick='setTodo(${todoId})'><i class='fas fa-check-square'></button>`;
    $(`#todo-title-${todoId}`).parent().html(editorHTML);
}
function setTodo(todoId) {
    var newTitle = $(`#todo-editor-${todoId}`).val();
    $.ajax({
        method: 'get',
        url: `action.php?action=setNewTodoTitle&todoId=${todoId}&newTitle=${newTitle}`,
        success: function(returnedValue) {
            var setValueHTML = `<h4 id='todo-title-${todoId} onclick='editTodo(${todoId})'>${newTitle}</h4>`;
            $(`#todo-editor-${todoId}`).parent().html(setValueHTML);
        }
    });


}

function addNewTodo(bucketlistId) {
    $.ajax({
        method: 'get',
        url: `action.php?action=addNewTodo&bucketlistId=${bucketlistId}`,
        success: function(newTodoId) {
            var currentTodos = $(`#allTodosHolder`).html();
            var newTodo = `<div class='card' id='todo-${newTodoId}><div class='card-body todo-card'>
            <i id='checkbox-${newTodoId} class='large-icon far fa-square' onclick='checkTodo(${newTodoId})'></i>&nbsp;
            <div class='todo'><input type='text' id='todo-editor-${newTodoId}' value=''>
            <button onclick='setTodo(${newTodoId})'><i class='fas fa-check-square'></button></div>
            <button class='icon-button' onclick='deleteTodo(${newTodoId})'><i class='fas fa-times'></i></button>`;
            $(`#todo-editor-${newTodoId}`).focus();
        }
    });



}