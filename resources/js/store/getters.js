let getters = {
    newTodo: state => {
        return state.newTodo
    },
    todos: state => {
        return state.todos
    },
    toRemove: state => {
        return state.toRemove
    },
    toComplete: state => {
        return state.toComplete
    }
}
export default getters
