let mutations = {
    ADD_TODO(state, todo) {
        state.todos.unshift(todo)
    },
    CACHE_REMOVED(state, todo) {
        state.toRemove = todo;
    },
    CACHE_COMPLETED(state, todo) {
        state.toComplete = todo;
    },
    GET_TODOS(state, todos) {
        state.todos = todos
    },
    DELETE_TODO(state, todo) {
        state.todos.splice(state.todos.indexOf(todo), 1)
        state.toRemove = null;
    },
    COMPLETE_TODO(state, todo) {
        let index = state.todos.findIndex(el => el.id == todo.id);
        state.todos.splice(index, 1, todo);
        state.toComplete = null
    }
}
export default mutations
