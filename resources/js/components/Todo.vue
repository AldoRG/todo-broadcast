<template>
    <li class="todo" :class="{ completed: todo.completed }">
        <div class="view">
            <input :dusk="`check-todo${todo.id}`" type="checkbox" @click="completeTodo(todo)" v-model="todo.completed" class="toggle">
            <label>{{todo.title}}</label>
            <button :dusk="`delete-todo${todo.id}`" @click="removeTodo(todo)" class="destroy"></button>
        </div>
    </li>
</template>
<script>
    export default {
        name: "Todo",
        props: ["todo"],

        methods: {
            removeTodo(todo) {
                this.$store.commit("CACHE_REMOVED", todo)
                this.$store.dispatch("DELETE_TODO", todo);
            },
            completeTodo(todo) {
                this.$store.commit("CACHE_COMPLETED", todo)
                this.$store.dispatch("COMPLETE_TODO", todo);
            }
        }
    };
</script>
